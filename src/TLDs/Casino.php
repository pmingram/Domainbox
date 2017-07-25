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
class Casino extends TLD
{
    protected $tld = '.casino';
    protected $idnTLD = 'casino';
    protected $dnsName = 'casino';

    protected $periods = null;
    protected $fee_registry = 99;
    protected $fee_renew = 99;
    protected $fee_transfer = 99;
    protected $fee_domainbox = 7;
    protected $fee_icann = 0.18;
    protected $fee_setup = 0;
    protected $fee_application = 80;
    protected $fee_total = 186.18;
    protected $fee_restore = null;
    protected $fee_backorder = null;

    protected $type = 'gTLD';
    protected $launchDate = '2015-06-03';

    protected $applyLock = true;
    protected $applyPrivacy = true;
    protected $numberOfNameServers = 13;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

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
