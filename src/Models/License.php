<?php

namespace Hanafalah\ModuleLicense\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleLicense\Resources\License\{
    ViewLicense,
    ShowLicense
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;

class License extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'license_key',
        'reference_type',
        'reference_id',
        'expired_at',
        'last_paid',
        'billing_generated_at',
        'due_date',
        'status',
        'recurring_type',
        'flag',
        'props',
    ];

    protected static function booted(): void{
        static::creating(function($query){
            $query->license_key ??= Str::orderedUuid();
        });
    }

    protected $casts = [
        'name' => 'string',
        'flag' => 'string'
    ];
    
    public function viewUsingRelation(): array{
        return [
            'modelHasLicense'
        ];
    }

    public function showUsingRelation(): array{
        return [
            'reference','modelHasLicense'
        ];
    }

    public function getViewResource(){
        return ViewLicense::class;
    }

    public function getShowResource(){
        return ShowLicense::class;
    }

    public function modelHasLicense(){return $this->hasOneModel('ModelHasLicense','license_id');}
    public function reference(){return $this->morphTo();}
}
