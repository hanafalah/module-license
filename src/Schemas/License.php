<?php

namespace Hanafalah\ModuleLicense\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleLicense\{
    Supports\BaseModuleLicense
};
use Hanafalah\ModuleLicense\Contracts\Schemas\License as ContractsLicense;
use Hanafalah\ModuleLicense\Contracts\Data\LicenseData;

class License extends BaseModuleLicense implements ContractsLicense
{
    protected string $__entity = 'License';
    public $license_model;
    protected mixed $__order_by_created_at = true;

    protected array $__cache = [
        'index' => [
            'name'     => 'license',
            'tags'     => ['license', 'license-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreLicense(LicenseData $license_dto): Model{
        $add = [
            'expired_at' => $license_dto->expired_at,
            'last_paid' => $license_dto->last_paid,
            'status' => $license_dto->status,
            'recurring_type' => $license_dto->recurring_type,
            'reference_type' => $license_dto->reference_type,
            'reference_id'   => $license_dto->reference_id,
            'due_date' => $license_dto->due_date,
            'billing_generated_at' => $license_dto->billing_generated_at,
            'flag' => $license_dto->flag
        ];
        if (isset($license_dto->id)){
            $guard  = ['id' => $license_dto->id];
        }else{
            $guard = ['id' => null];
        }

        $create = [$guard, $add];
        $license = $this->usingEntity()->updateOrCreate(...$create);

        $reference = $license_dto->reference_model ?? $license->reference;
        if (isset($reference)){
            $license_dto->props['prop_reference'] = $reference->toViewApi()->resolve();
        }
        if (isset($license_dto->model_has_license)){
            $model_has_license_dto = &$license_dto->model_has_license;
            $model_has_license_dto->license_model = $license;
            $model_has_license_dto->license_id = $license->getKey();
            $this->schemaContract('model_has_license')->prepareStoreModelHasLicense($model_has_license_dto);
        }

        $this->fillingProps($license,$license_dto->props);
        $license->save();
        return $this->license_model = $license;
    }
}