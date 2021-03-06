<?php

namespace Spinen\ConnectWise\Models\v2019_3\Finance;

use Spinen\ConnectWise\Support\Model;

/**
 * Class BillingStatus
 *
 * @property integer $id
 * @property string $name
 * @property integer $sortOrder
 * @property boolean $defaultFlag
 * @property boolean $closedFlag
 * @property boolean $inactiveFlag
 * @property boolean $sentFlag
 */
class BillingStatus extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'sortOrder' => 'integer',
        'defaultFlag' => 'boolean',
        'closedFlag' => 'boolean',
        'inactiveFlag' => 'boolean',
        'sentFlag' => 'boolean',
    ];
}
