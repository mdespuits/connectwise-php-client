<?php

namespace Spinen\ConnectWise\Models\v2019_1\Procurement;

use Spinen\ConnectWise\Support\Model;

/**
 * Class Category
 *
 * @property integer $id
 * @property string $name
 * @property boolean $inactiveFlag
 * @property string $priceLevelXref
 * @property string $integrationXref
 * @property array $locationIds
 * @property boolean $addAllLocations
 * @property boolean $removeAllLocations
 */
class Category extends Model
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
        'priceLevelXref' => 'string',
        'integrationXref' => 'string',
        'locationIds' => 'array',
        'addAllLocations' => 'boolean',
        'removeAllLocations' => 'boolean',
    ];
}
