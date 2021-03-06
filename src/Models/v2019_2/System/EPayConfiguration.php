<?php

namespace Spinen\ConnectWise\Models\v2019_2\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class EPayConfiguration
 *
 * @property integer $id
 * @property string $url
 * @property string $storeIdentifier
 * @property string $encryptionKey
 * @property string $initializationVector
 */
class EPayConfiguration extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'storeIdentifier' => 'string',
        'encryptionKey' => 'string',
        'initializationVector' => 'string',
    ];
}
