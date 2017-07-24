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
class Jp extends TLD
{
    protected $tld = '.jp';
    protected $idnTLD = 'jp';
    protected $dnsName = 'jp';

    protected $periods = null;
    protected $fee_registry = 40;
    protected $fee_renew = 40;
    protected $fee_transfer = 40;
    protected $fee_domainbox = 12;
    protected $fee_icann = 0;
    protected $fee_setup = 0;
    protected $fee_application = 0;
    protected $fee_total = 52;
    protected $fee_restore = 65;
    protected $fee_backorder = null;
    
    protected $extension = [
        'JPProxyServiceData' => [
            'UseProxyService' => ['required' => true, 'type' => 'boolean']
        ],
    ];

    protected $type = 'ccTLD';

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

    public function __construct()
    {
        parent::__construct();
    }
}