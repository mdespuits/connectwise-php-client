<?php

namespace Spinen\ConnectWise\Models\v2018_6\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class Lab
 *
 * @property integer $id
 * @property string $identifier
 * @property boolean $inactiveFlag
 * @property boolean $adminLock
 */
class Lab extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'identifier' => 'string',
        'inactiveFlag' => 'boolean',
        'adminLock' => 'boolean',
    ];
}
