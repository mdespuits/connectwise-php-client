<?php

namespace Spinen\ConnectWise\Models\v2018_5\Procurement;

use Spinen\ConnectWise\Support\Model;

/**
 * Class ProductComponent
 *
 * @property integer $id
 * @property integer $sequenceNumber
 * @property double $quantity
 * @property boolean $hidePriceFlag
 * @property boolean $hideItemIdentifierFlag
 * @property boolean $hideDescriptionFlag
 * @property boolean $hideQuantityFlag
 * @property double $price
 * @property double $cost
 */
class ProductComponent extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sequenceNumber' => 'integer',
        'quantity' => 'double',
        'hidePriceFlag' => 'boolean',
        'hideItemIdentifierFlag' => 'boolean',
        'hideDescriptionFlag' => 'boolean',
        'hideQuantityFlag' => 'boolean',
        'price' => 'double',
        'cost' => 'double',
    ];
}
