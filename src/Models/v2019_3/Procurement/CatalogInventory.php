<?php

namespace Spinen\ConnectWise\Models\v2019_3\Procurement;

use Spinen\ConnectWise\Support\Model;

/**
 * Class CatalogInventory
 *
 * @property integer $id
 * @property integer $onHand
 * @property array $serialNumbers
 */
class CatalogInventory extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'onHand' => 'integer',
        'serialNumbers' => 'array',
    ];
}
