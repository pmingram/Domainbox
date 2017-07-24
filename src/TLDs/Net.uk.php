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
class Netuk extends TLD
{
    protected $tld = '.net.uk';
    protected $idnTLD = 'net.uk';
    protected $dnsName = 'net.uk';

    protected $periods = null;
    protected $fee_registry = 7;
    protected $fee_renew = 7;
    protected $fee_transfer = 0;
    protected $fee_domainbox = 1;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 8;
    protected $fee_restore = null;
    protected $fee_backorder = 40;

    protected $type = 'ccTLD';

    protected $additionalData = [
        'UKDirectData' => [
                'RelatedDomainId'  => ['type' => 'Numeric', 'required' => true],
            ],
    ];
    
    protected $applyLock = false;
    protected $applyPrivacy = true;
    protected $numberOfNameServers = 13;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;
    
    protected $refund = false;
    protected $refundPeriodAdd = 'END OF MONTH';
    protected $refundPeriodTransfer = 0;
    protected $refundPeriodRenew = 0;
    protected $refundLimit = 10;

    public function __construct()
    {
        parent::__construct();
    }
}