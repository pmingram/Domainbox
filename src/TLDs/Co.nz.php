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
class Conz extends TLD
{
    protected $tld = '.co.nz';
    protected $idnTLD = 'co.nz';
    protected $dnsName = 'co.nz';

    protected $periods = null;
    protected $fee_registry = 16;
    protected $fee_renew = 16;
    protected $fee_transfer = 16;
    protected $fee_domainbox = 9;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 25;
    protected $fee_restore = null;
    protected $fee_backorder = null;

    protected $type = 'ccTLD';

    protected $applyLock = false;
    protected $applyPrivacy = false;
    protected $numberOfNameServers = 10;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;
    
    protected $refund = false;
    protected $refundPeriodAdd = 5;
    protected $refundPeriodTransfer = 5;
    protected $refundPeriodRenew = 0;
    protected $refundLimit = 0;

    public function __construct()
    {
        parent::__construct();
    }
}