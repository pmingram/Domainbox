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
class Academy extends TLD
{
    private $tld = '.academy';
    private $idnTLD = 'academy';
    private $dnsName = 'academy';

    private $periods = null;
    private $fee_registry = 20.00;
    private $fee_renew = 20.00;
    private $fee_transfer = 20.00;
    private $fee_domainbox = 7.00;
    private $fee_icann = 0.18;
    private $fee_setup = 0.00;
    private $fee_application = 0.00;
    private $fee_total = 27.18;
    private $fee_restore = 65.00;
    private $fee_backorder = null;
    private $numberOfCategories = 9;
    private $categories = [
        'category1' => [
            'registry'    => 9200.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 9207.18,
        ],
        'category2' => [
            'registry'    => 5150.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 5157.18,
        ],
        'category3' => [
            'registry'    => 3100.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 3107.18,
        ],
        'category4' => [
            'registry'    => 820.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 827.18,
        ],
        'category5' => [
            'registry'    => 410.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 417.18,
        ],
        'category6' => [
            'registry'    => 205.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 212.18,
        ],
        'category7' => [
            'registry'    => 105.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 112.18,
        ],
        'category8' => [
            'registry'    => 70.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 77.18,
        ],
        'category9' => [
            'registry'    => 35.00,
            'renew'       => 20.00,
            'transfer'    => 20.00,
            'domainbox'   => 7.00,
            'icann'       => 0.18,
            'setup'       => 0,
            'application' => 0,
            'total'       => 42.18,
        ],
    ];

    private $type = 'gLTD'; //gTLD, ccTLD, pTLD
    private $launchPhase = 'GA'; //SR, LR, EAP, GA

    private $applyLock = true;
    private $autoRenew = true;
    private $autoRenewDays = null;
    private $autoRenewDaysDefault = 14;
    private $applyPrivacy = true;
    private $acceptTerms = true;
    private $numberOfNameServers = 13;

    private $extension = null;

    private $launchDate = null;
    private $dnssec = false;
    private $ipv6 = true;
    private $ipv4 = true;

    public function __construct()
    {
        parent::__construct();
    }
}
