<?php

namespace Spinen\ConnectWise\Models\v2019_1\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class EmailConnectorParsingStyle
 *
 * @property integer $id
 * @property string $parseRule
 * @property integer $priority
 */
class EmailConnectorParsingStyle extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parseRule' => 'string',
        'priority' => 'integer',
    ];
}
