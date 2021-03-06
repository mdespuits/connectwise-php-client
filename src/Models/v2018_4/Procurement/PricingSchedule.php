<?php

namespace Spinen\ConnectWise\Models\v2018_4\Procurement;

use Spinen\ConnectWise\Support\Model;

/**
 * Class PricingSchedule
 *
 * @property integer $id
 * @property string $name
 * @property boolean $inactiveFlag
 * @property boolean $defaultFlag
 * @property array $companies
 * @property boolean $setAllCompaniesFlag
 * @property boolean $removeAllCompaniesFlag
 */
class PricingSchedule extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'inactiveFlag' => 'boolean',
        'defaultFlag' => 'boolean',
        'companies' => 'array',
        'setAllCompaniesFlag' => 'boolean',
        'removeAllCompaniesFlag' => 'boolean',
    ];
}
