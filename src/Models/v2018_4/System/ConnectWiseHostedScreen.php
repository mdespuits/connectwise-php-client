<?php

namespace Spinen\ConnectWise\Models\v2018_4\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class ConnectWiseHostedScreen
 *
 * @property integer $id
 * @property string $screenId
 * @property string $name
 */
class ConnectWiseHostedScreen extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'screenId' => 'string',
        'name' => 'string',
    ];
}
