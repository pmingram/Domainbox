<?php

namespace MadeITBelgium\Domainbox\TLDs;

use MadeITBelgium\Domainbox\TLDs\TLD;

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
    private $tld = ".com";
    private $idnTLD = "com";
    private $dnsName = "com";
    
    private $periods = null;
    private $fee_registry = 7.85;
    private $fee_renew = 7.85;
    private $fee_transfer = 7.85;
    private $fee_domainbox = 2.00;
    private $fee_icann = 0.18;
    private $fee_setup = 0.00;
    private $fee_application = 0.00;
    private $fee_total = 10.03;
    private $fee_restore = 75.00;
    private $fee_backorder = 40.00;
    private $numberOfCategories = 0;
    private $categories = null;
    
    private $type = "gLTD"; //gTLD, ccTLD, pTLD
    private $launchPhase = "GA"; //SR, LR, EAP, GA
    
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
    
    private $canCHangeContact = true;
    private $canChangeContactOrganisation = true;
    private $canChangeContactName = true;
    private $canChangeContactBirth = true;
    private $canChangeContactFax = true;
    private $canChangeContactCountryCode = true;
    private $canChangeContactEntityType = true;
    private $canChangeContactNationality = true;
    private $canChangeContactRegCode = true;

    public function __construct()
    {
        parent::__construct();
    }
}
