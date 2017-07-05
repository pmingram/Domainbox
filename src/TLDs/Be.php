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
class Be extends TLD
{
    protected $tld = '.be';
    protected $idnTLD = 'be';
    protected $dnsName = 'be';

    protected $periods = [1];
    protected $fee_registry = 5.00;
    protected $fee_renew = 5.00;
    protected $fee_transfer = 5.00;
    protected $fee_domainbox = 2.00;
    protected $fee_icann = 0.00;
    protected $fee_setup = 0.00;
    protected $fee_application = 0.00;
    protected $fee_total = 7.00;
    protected $fee_restore = 80.00;
    protected $fee_backorder = null;

    protected $additionalData = [
        'EUBEAdditionalData' => [
                'Language'  => ['nl' => 'nl (Dutch)', 'fr' => 'fr (French)', 'en'  => 'en (English)'],
                'VATNumber' => false,
            ],
    ];

    protected $type = 'ccLTD';

    protected $applyLock = false;
    protected $applyPrivacy = false;
    protected $numberOfNameServers = 9;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    public function __construct()
    {
        parent::__construct();
    }
}
