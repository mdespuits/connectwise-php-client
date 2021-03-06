<?php

namespace Spinen\ConnectWise\Models\v2019_2\Sales;

use Spinen\ConnectWise\Support\Model;

/**
 * Class SalesTeamMember
 *
 * @property integer $id
 * @property boolean $allowAccessFlag
 */
class SalesTeamMember extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'allowAccessFlag' => 'boolean',
    ];
}
