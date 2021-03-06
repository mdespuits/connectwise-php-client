<?php

namespace Spinen\ConnectWise\Models\v2019_1\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class InOutBoard
 *
 * @property integer $id
 * @property string $additionalInfo
 * @property carbon $dateBack
 */
class InOutBoard extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'additionalInfo' => 'string',
        'dateBack' => 'carbon',
    ];
}
