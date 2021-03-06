<?php

namespace Spinen\ConnectWise\Models\v2019_3\Sales;

use Spinen\ConnectWise\Support\Model;

/**
 * Class SalesProbability
 *
 * @property integer $id
 * @property integer $probability
 */
class SalesProbability extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'probability' => 'integer',
    ];
}
