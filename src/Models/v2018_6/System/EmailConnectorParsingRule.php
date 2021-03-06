<?php

namespace Spinen\ConnectWise\Models\v2018_6\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class EmailConnectorParsingRule
 *
 * @property integer $id
 * @property integer $priority
 * @property string $searchTerm
 */
class EmailConnectorParsingRule extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'priority' => 'integer',
        'searchTerm' => 'string',
    ];
}
