<?php

namespace Spinen\ConnectWise\Models\v2019_1\Service;

use Spinen\ConnectWise\Support\Model;

/**
 * Class Impact
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property boolean $defaultFlag
 */
class Impact extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'defaultFlag' => 'boolean',
    ];
}
