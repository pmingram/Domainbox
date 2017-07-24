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
class Archi extends TLD
{
    protected $tld = '.archi';
    protected $idnTLD = 'archi';
    protected $dnsName = 'archi';

    protected $periods = null;
    protected $fee_registry = 65;
    protected $fee_renew = 65;
    protected $fee_transfer = 65;
    protected $fee_domainbox = 7;
    protected $fee_icann = 0.18;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 72.18;
    protected $fee_restore = 225;
    protected $fee_backorder = null;

    protected $type = 'gTLD';

    protected $applyLock = true;
    protected $applyPrivacy = false;
    protected $numberOfNameServers = 13;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    protected $refund = true;
    protected $refundPeriodAdd = 5;
    protected $refundPeriodTransfer = 5;
    protected $refundPeriodRenew = 5;
    protected $refundLimit = 10;

    protected $registerText = 'By registering this domain name, you certify that the registrant of this domain is an individual professional architect (or an architecture firm) registered as a member of a national architects association authorized by the registry operator, or an architecture-related organization authorized by the registry operator.';

    public function __construct()
    {
        parent::__construct();
    }
}
