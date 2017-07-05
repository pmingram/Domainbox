<?php

namespace MadeITBelgium\Domainbox\TLDs;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Academy extends TLD
{
    protected $tld = '.academy';
    protected $idnTLD = 'academy';
    protected $dnsName = 'academy';

    protected $periods = null;
    protected $fee_registry = 20.00;
    protected $fee_renew = 20.00;
    protected $fee_transfer = 20.00;
    protected $fee_domainbox = 7.00;
    protected $fee_icann = 0.18;
    protected $fee_setup = 0.00;
    protected $fee_application = 0.00;
    protected $fee_total = 27.18;
    protected $fee_restore = 65.00;
    protected $fee_backorder = null;
    protected $numberOfCategories = 9;
    protected $categories = [
        'category1' => [
            'registry'    => 9200.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 9207.18,
        ],
        'category2' => [
            'registry'    => 5150.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 5157.18,
        ],
        'category3' => [
            'registry'    => 3100.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 3107.18,
        ],
        'category4' => [
            'registry'    => 820.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 827.18,
        ],
        'category5' => [
            'registry'    => 410.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 417.18,
        ],
        'category6' => [
            'registry'    => 205.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 212.18,
        ],
        'category7' => [
            'registry'    => 105.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 112.18,
        ],
        'category8' => [
            'registry'    => 70.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 77.18,
        ],
        'category9' => [
            'registry'    => 35.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 42.18,
        ],
    ];

    protected $type = 'gLTD';

    protected $applyLock = true;
    protected $applyPrivacy = true;
    protected $numberOfNameServers = 13;
    
    
    protected $refund = true;
    protected $refundPeriodAdd = 5;
    protected $refundPeriodTransfer = 5;
    protected $refundPeriodRenew = 5;
    protected $refundLimit = 10;

    public function __construct()
    {
        parent::__construct();
    }
}
