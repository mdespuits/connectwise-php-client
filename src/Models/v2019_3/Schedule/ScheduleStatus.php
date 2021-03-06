<?php

namespace Spinen\ConnectWise\Models\v2019_3\Schedule;

use Spinen\ConnectWise\Support\Model;

/**
 * Class ScheduleStatus
 *
 * @property integer $id
 * @property string $name
 * @property boolean $defaultFlag
 * @property boolean $showAsTentativeFlag
 */
class ScheduleStatus extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'defaultFlag' => 'boolean',
        'showAsTentativeFlag' => 'boolean',
    ];
}
