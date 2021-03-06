<?php

namespace Spinen\ConnectWise\Models\v2019_2\Service;

use Spinen\ConnectWise\Support\Model;

/**
 * Class ServiceLocation
 *
 * @property integer $id
 * @property string $name
 * @property string $where
 * @property boolean $defaultFlag
 */
class ServiceLocation extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'where' => 'string',
        'defaultFlag' => 'boolean',
    ];
}
