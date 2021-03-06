<?php

namespace Spinen\ConnectWise\Models\v2018_4\Sales;

use Spinen\ConnectWise\Support\Model;

/**
 * Class OpportunityType
 *
 * @property integer $id
 * @property string $description
 * @property boolean $inactiveFlag
 */
class OpportunityType extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'inactiveFlag' => 'boolean',
    ];
}
