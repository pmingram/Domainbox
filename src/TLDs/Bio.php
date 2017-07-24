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
class Bio extends TLD
{
    protected $tld = '.bio';
    protected $idnTLD = 'bio';
    protected $dnsName = 'bio';

    protected $periods = null;
    protected $fee_registry = 55;
    protected $fee_renew = 55;
    protected $fee_transfer = 55;
    protected $fee_domainbox = 7;
    protected $fee_icann = 0.18;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 62.18;
    protected $fee_restore = 225;
    protected $fee_backorder = null;

    protected $type = 'gTLD';

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

    protected $registerText = "By registering this domain name, the registrant commits to not undermine the Principles of Organic Agriculture as formulated by the IFOAM (POA). If the registrant is a producer, a transformer or retailer in the field of agriculture, food and farming, the registrant commits to abide by POA and by any regulations in force in the relevant markets where the registrant intends to present or promote its products within the on-line content associated with this .BIO domain name(s).";

    public function __construct()
    {
        parent::__construct();
    }
}