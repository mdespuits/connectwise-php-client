<?php

namespace Spinen\ConnectWise\Models\v2019_1\Procurement;

use Spinen\ConnectWise\Support\Model;

/**
 * Class AdjustmentType
 *
 * @property integer $id
 * @property string $identifier
 * @property string $name
 * @property boolean $auditTrailFlag
 * @property carbon $dateCreated
 * @property string $createdBy
 */
class AdjustmentType extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'identifier' => 'string',
        'name' => 'string',
        'auditTrailFlag' => 'boolean',
        'dateCreated' => 'carbon',
        'createdBy' => 'string',
    ];
}
