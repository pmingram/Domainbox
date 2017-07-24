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
class Orghn extends TLD
{
    protected $tld = '.org.hn';
    protected $idnTLD = 'org.hn';
    protected $dnsName = 'org.hn';

    protected $periods = null;
    protected $fee_registry = 60;
    protected $fee_renew = 60;
    protected $fee_transfer = 60;
    protected $fee_domainbox = 7.5;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 67.5;
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
    protected $refundPeriodAdd = 15;
    protected $refundPeriodTransfer = 15;
    protected $refundPeriodRenew = 15;
    protected $refundLimit = 10;

    public function __construct()
    {
        parent::__construct();
    }
}