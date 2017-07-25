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
class De extends TLD
{
    protected $tld = '.de';
    protected $idnTLD = 'de';
    protected $dnsName = 'de';

    protected $periods = null;
    protected $fee_registry = 4.5;
    protected $fee_renew = 4.5;
    protected $fee_transfer = 4.5;
    protected $fee_domainbox = 3.5;
    protected $fee_icann = 0;
    protected $fee_setup = 1.5;
    protected $fee_application = 0;
    protected $fee_total = 9.5;
    protected $fee_restore = 25;
    protected $fee_backorder = 40;

    protected $type = 'ccTLD';

    protected $extension = [
        'DeBillingData' => [
            'MonthlyBilling' => ['required' => true, 'type' => 'boolean'],
        ],
    ];

    protected $applyLock = false;
    protected $applyPrivacy = false;
    protected $numberOfNameServers = 13;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    protected $refund = true;
    protected $refundPeriodAdd = 0;
    protected $refundPeriodTransfer = 0;
    protected $refundPeriodRenew = 0;
    protected $refundLimit = 0;

    protected $dnsVerification = true;

    public function __construct()
    {
        parent::__construct();
    }
}
