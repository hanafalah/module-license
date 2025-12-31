<?php

namespace Hanafalah\ModuleLicense\Resources\License;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewLicense extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'id' => $this->id,
      'license_key' => $this->license_key,
      'name' => $this->name ?? null,
      // 'reference_type' => $this->reference_type,
      // 'reference_id' => $this->reference_id,
      'model_has_license' => $this->relationValidation('modelHasLicense',function(){
        return $this->modelHasLicense->toViewApi()->resolve();
      }),
      'expired_at' => $this->expired_at,
      'last_paid' => $this->last_paid,
      'billing_generated_at' => $this->billing_generated_at,
      'due_date' => $this->due_date,
      'status' => $this->status,
      'recurring_type' => $this->recurring_type,
      'flag' => $this->flag,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
    return $arr;
  }
}