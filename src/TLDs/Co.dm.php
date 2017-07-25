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
class Codm extends TLD
{
    protected $tld = '.co.dm';
    protected $idnTLD = 'co.dm';
    protected $dnsName = 'co.dm';

    protected $periods = null;
    protected $fee_registry = 200;
    protected $fee_renew = 200;
    protected $fee_transfer = 200;
    protected $fee_domainbox = 15;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 215;
    protected $fee_restore = null;
    protected $fee_backorder = null;

    protected $type = 'ccTLD';

    protected $applyLock = true;
    protected $applyPrivacy = false;
    protected $numberOfNameServers = 13;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    protected $refund = false;
    protected $refundPeriodAdd = 0;
    protected $refundPeriodTransfer = 30;
    protected $refundPeriodRenew = 0;
    protected $refundLimit = 0;

    public function __construct()
    {
        parent::__construct();
    }
}
