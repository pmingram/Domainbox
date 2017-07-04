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
class Com extends TLD
{
    protected $tld = '.com';
    protected $idnTLD = 'com';
    protected $dnsName = 'com';

    protected $periods = null;
    protected $fee_registry = 7.85;
    protected $fee_renew = 7.85;
    protected $fee_transfer = 7.85;
    protected $fee_domainbox = 2.00;
    protected $fee_icann = 0.18;
    protected $fee_setup = 0.00;
    protected $fee_application = 0.00;
    protected $fee_total = 10.03;
    protected $fee_restore = 75.00;
    protected $fee_backorder = 40.00;
    protected $numberOfCategories = 0;
    protected $categories = null;

    protected $type = 'gLTD'; //gTLD, ccTLD, pTLD
    protected $launchPhase = 'GA'; //SR, LR, EAP, GA

    protected $applyLock = true;
    protected $autoRenew = true;
    protected $autoRenewDays = null;
    protected $autoRenewDaysDefault = 14;
    protected $applyPrivacy = true;
    protected $acceptTerms = true;
    protected $numberOfNameServers = 13;

    protected $extension = null;

    protected $launchDate = null;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;

    protected $canCHangeContact = true;
    protected $canChangeContactOrganisation = true;
    protected $canChangeContactName = true;
    protected $canChangeContactBirth = true;
    protected $canChangeContactFax = true;
    protected $canChangeContactCountryCode = true;
    protected $canChangeContactEntityType = true;
    protected $canChangeContactNationality = true;
    protected $canChangeContactRegCode = true;

    public function __construct()
    {
        parent::__construct();
    }
}
