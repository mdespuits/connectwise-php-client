<?php

namespace Spinen\ConnectWise\Models\v2019_2\Service;

use Spinen\ConnectWise\Support\Model;

/**
 * Class BoardSubType
 *
 * @property integer $id
 * @property string $name
 * @property boolean $inactiveFlag
 * @property array $typeAssociationIds
 * @property boolean $addAllTypesFlag
 * @property boolean $removeAllTypesFlag
 */
class BoardSubType extends Model
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
        'typeAssociationIds' => 'array',
        'addAllTypesFlag' => 'boolean',
        'removeAllTypesFlag' => 'boolean',
    ];
}
