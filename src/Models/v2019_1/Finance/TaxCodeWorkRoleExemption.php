<?php

namespace Spinen\ConnectWise\Models\v2019_1\Finance;

use Spinen\ConnectWise\Support\Model;

/**
 * Class TaxCodeWorkRoleExemption
 *
 * @property integer $id
 * @property array $taxableLevels
 */
class TaxCodeWorkRoleExemption extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'taxableLevels' => 'array',
    ];
}
