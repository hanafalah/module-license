<?php

namespace Hanafalah\ModuleLicense\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleLicense\Contracts\Data\LicenseData as DataLicenseData;
use Hanafalah\ModuleLicense\Contracts\Data\ModelHasLicenseData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class LicenseData extends Data implements DataLicenseData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id = null;

    #[MapInputName('reference_model')]
    #[MapName('reference_model')]
    public ?object $reference_model = null;

    #[MapInputName('license_key')]
    #[MapName('license_key')]
    public ?string $license_key = null;

    #[MapInputName('recurring_type')]
    #[MapName('recurring_type')]
    public ?string $recurring_type = null;

    #[MapInputName('flag')]
    #[MapName('flag')]
    public ?string $flag = null;

    #[MapInputName('expired_at')]
    #[MapName('expired_at')]
    public ?string $expired_at = null;

    #[MapInputName('last_paid')]
    #[MapName('last_paid')]
    public ?string $last_paid = null;

    #[MapInputName('due_date')]
    #[MapName('due_date')]
    public ?string $due_date = null;

    #[MapInputName('billing_generated_at')]
    #[MapName('billing_generated_at')]
    public ?string $billing_generated_at = null;

    #[MapInputName('status')]
    #[MapName('status')]
    public ?string $status = null;

    #[MapInputName('model_has_license')]
    #[MapName('model_has_license')]
    public ?ModelHasLicenseData $model_has_license = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;

}