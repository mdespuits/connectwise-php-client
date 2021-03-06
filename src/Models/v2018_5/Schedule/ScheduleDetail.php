<?php

namespace Spinen\ConnectWise\Models\v2018_5\Schedule;

use Spinen\ConnectWise\Support\Model;

/**
 * Class ScheduleDetail
 *
 * @property integer $id
 * @property carbon $dateStart
 * @property carbon $dateEnd
 */
class ScheduleDetail extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dateStart' => 'carbon',
        'dateEnd' => 'carbon',
    ];
}
