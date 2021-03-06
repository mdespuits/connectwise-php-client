<?php

namespace Spinen\ConnectWise\Models\v2019_2\System;

use Spinen\ConnectWise\Support\Model;

/**
 * Class Link
 *
 * @property integer $id
 * @property string $name
 * @property integer $tableReferenceId
 * @property string $url
 * @property string $screenLink
 */
class Link extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'tableReferenceId' => 'integer',
        'url' => 'string',
        'screenLink' => 'string',
    ];
}
