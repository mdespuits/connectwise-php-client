<?php

namespace Spinen\ConnectWise\Models\v2018_6\Marketing;

use Spinen\ConnectWise\Support\Model;

/**
 * Class CampaignFormsSubmitted
 *
 * @property integer $id
 * @property integer $campaignId
 * @property integer $contactId
 * @property carbon $dateSubmitted
 * @property string $url
 * @property string $queryString
 * @property string $pageType
 * @property string $pageSubType
 * @property string $topic
 * @property string $version
 * @property string $status
 */
class CampaignFormsSubmitted extends Model
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
        'dateSubmitted' => 'carbon',
        'url' => 'string',
        'queryString' => 'string',
        'pageType' => 'string',
        'pageSubType' => 'string',
        'topic' => 'string',
        'version' => 'string',
        'status' => 'string',
    ];
}
