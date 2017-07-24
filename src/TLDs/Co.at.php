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
class Coat extends TLD
{
    protected $tld = '.co.at';
    protected $idnTLD = 'co.at';
    protected $dnsName = 'co.at';

    protected $periods = [1];
    protected $fee_registry = 11.5;
    protected $fee_renew = 11.5;
    protected $fee_transfer = 0;
    protected $fee_domainbox = 3;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 14.5;
    protected $fee_restore = null;
    protected $fee_backorder = null;

    protected $type = 'ccTLD';

    protected $applyLock = false;
    protected $applyPrivacy = false;
    protected $numberOfNameServers = 8;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    protected $dnsVerification = true;

    protected $domainRenewBeforeMin = 30; //0days
    protected $domainRenewBeforeMax = null;
    protected $renewPeriods = [30, 45, 60, 90]; //array with values

    protected $refund = false;
    protected $refundPeriodAdd = 0;
    protected $refundPeriodTransfer = 0;
    protected $refundPeriodRenew = 0;
    protected $refundLimit = 0;

    public function __construct()
    {
        parent::__construct();
    }
}
