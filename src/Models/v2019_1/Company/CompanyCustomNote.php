<?php

namespace Spinen\ConnectWise\Models\v2019_1\Company;

use Spinen\ConnectWise\Support\Model;

/**
 * Class CompanyCustomNote
 *
 * @property integer $id
 * @property string $customNote
 */
class CompanyCustomNote extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customNote' => 'string',
    ];
}
