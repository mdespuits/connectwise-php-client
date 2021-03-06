<?php

namespace Spinen\ConnectWise\Models\v2019_3\Marketing;

use Spinen\ConnectWise\Support\Model;

/**
 * Class CampaignEmailsOpened
 *
 * @property integer $id
 * @property integer $campaignId
 * @property integer $contactId
 * @property carbon $dateOpened
 */
class CampaignEmailsOpened extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'campaignId' => 'integer',
        'contactId' => 'integer',
        'dateOpened' => 'carbon',
    ];
}
