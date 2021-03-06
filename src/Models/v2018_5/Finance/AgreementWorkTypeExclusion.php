<?php

namespace Spinen\ConnectWise\Models\v2018_5\Finance;

use Spinen\ConnectWise\Support\Model;

/**
 * Class AgreementWorkTypeExclusion
 *
 * @property integer $id
 * @property integer $agreementId
 */
class AgreementWorkTypeExclusion extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'agreementId' => 'integer',
    ];
}
