<?php

namespace Spinen\ConnectWise\Models\v2018_6\Finance;

use Spinen\ConnectWise\Support\Model;

/**
 * Class AccountingUnpostedProcurementTaxableLevel
 *
 * @property integer $id
 * @property integer $taxLevel
 * @property string $taxCodeXref
 * @property double $taxAmount
 */
class AccountingUnpostedProcurementTaxableLevel extends Model
{
    /**
     * Properties that need to be casts to a specific object or type
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'taxLevel' => 'integer',
        'taxCodeXref' => 'string',
        'taxAmount' => 'double',
    ];
}
