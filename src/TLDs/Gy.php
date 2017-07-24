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
class Gy extends TLD
{
    protected $tld = '.gy';
    protected $idnTLD = 'gy';
    protected $dnsName = 'gy';

    protected $periods = null;
    protected $fee_registry = 28;
    protected $fee_renew = 28;
    protected $fee_transfer = 28;
    protected $fee_domainbox = 6;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 34;
    protected $fee_restore = 35;
    protected $fee_backorder = null;

    protected $type = 'ccTLD';

    protected $applyLock = true;
    protected $applyPrivacy = true;
    protected $numberOfNameServers = 13;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    protected $refund = true;
    protected $refundPeriodAdd = 5;
    protected $refundPeriodTransfer = 0;
    protected $refundPeriodRenew = 5;
    protected $refundLimit = 0;

    public function __construct()
    {
        parent::__construct();
    }
}
