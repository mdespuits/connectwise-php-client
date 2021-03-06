<?php

namespace Spinen\ConnectWise\Models\v2019_3\Marketing;

use Spinen\ConnectWise\Support\Model;

/**
 * Class CampaignType
 *
 * @property integer $id
 * @property string $name
 * @property boolean $defaultFlag
 */
class CampaignType extends Model
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
    ];
}
