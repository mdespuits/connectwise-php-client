<?php

namespace Spinen\ConnectWise\Models\v2018_6\Time;

use Spinen\ConnectWise\Support\Model;

/**
 * Class TimePeriodSetup
 *
 * @property integer $id
 * @property string $periodApplyTo
 * @property integer $year
 * @property integer $numberFuturePeriods
 * @property string $type
 * @property string $description
 * @property string $firstPeriodEndDate
 * @property integer $monthlyPeriodEnds
 * @property integer $semiMonthlyFirstPeriod
 * @property integer $semiMonthlySecondPeriod
 * @property boolean $semiMonthlyLastDayFlag
 * @property boolean $lastDayFlag
 * @property integer $daysPastEndDate
 */
class TimePeriodSetup extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'periodApplyTo' => 'string',
        'year' => 'integer',
        'numberFuturePeriods' => 'integer',
        'type' => 'string',
        'description' => 'string',
        'firstPeriodEndDate' => 'string',
        'monthlyPeriodEnds' => 'integer',
        'semiMonthlyFirstPeriod' => 'integer',
        'semiMonthlySecondPeriod' => 'integer',
        'semiMonthlyLastDayFlag' => 'boolean',
        'lastDayFlag' => 'boolean',
        'daysPastEndDate' => 'integer',
    ];
}
