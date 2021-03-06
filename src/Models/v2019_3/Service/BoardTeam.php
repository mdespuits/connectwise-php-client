<?php

namespace Spinen\ConnectWise\Models\v2019_3\Service;

use Spinen\ConnectWise\Support\Model;

/**
 * Class BoardTeam
 *
 * @property integer $id
 * @property string $name
 * @property array $members
 * @property boolean $defaultFlag
 * @property boolean $notifyOnTicketDelete
 * @property integer $boardId
 * @property integer $locationId
 * @property integer $businessUnitId
 */
class BoardTeam extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'members' => 'array',
        'defaultFlag' => 'boolean',
        'notifyOnTicketDelete' => 'boolean',
        'boardId' => 'integer',
        'locationId' => 'integer',
        'businessUnitId' => 'integer',
    ];
}
