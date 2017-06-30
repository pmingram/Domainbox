<?php

namespace MadeITBelgium\Domainbox\Object;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Domain
{
    private $statusMessages = [
        0  => 'Available',
        1  => 'Unavailable',
        2  => 'InvalidDomainSupplied',
        3  => 'ErrorOccurred',
        4  => 'ExceededLimit',
        5  => 'NotChecked',
        6  => 'TimedOut',
        7  => 'AvailableOfflineLookup',
        8  => 'UnavailableOfflineLookup',
        9  => 'AvailableRegistryTimeout',
        10 => 'UnavailableRegistryTimeout',
        11 => 'AvailableWithProvidedDomainId',
    ];

    private $domainName;
    private $status;
    private $available;
    private $launchPhase;
    private $dropDate;
    private $backOrderAvailable;

    private $period;
    private $applyLock;
    private $autoRenew;
    private $autoRenewDays;
    private $applyPrivacy;
    private $acceptTerms;
    private $nameServers;
    private $glueRecords;
    private $registrant;
    private $admin;
    private $tech;
    private $billing;

    private $trademark;
    private $extension;
    private $sunriseData;
    private $commandOptions;
    
    
    private $orderId;
    private $domainId;
    private $registrantContactId;
    private $adminContactId;
    private $techContactId;
    private $billingContactId;

    public function __construct()
    {
    }

    public function create($domainName = null, $launchPhase = 'GA', $period = 1, $applyLock = false, $autoRenew = true, $autoRenewDays = 7, $applyPrivacy = false, $acceptTerms = true, $nameServers = [], $glueRecords = [], $registrant = null, $admin = null, $tech = null, $billing = null, $trademark = null, $extension = null, $sunriseData = null, $commandOptions = null)
    {
        $this->setDomainName($domainName);
        $this->setLaunchPhase($launchPhase);
        $this->setPeriod($period);
        $this->setApplyLock($applyLock);
        $this->setAutoRenew($autoRenew);
        $this->setAutoRenewDays($autoRenewDays);
        $this->setApplyPrivacy($applyPrivacy);
        $this->setAcceptTerms($acceptTerms);
        $this->setNameservers($nameServers);
        $this->setGlueRecords($glueRecords);
        $this->setRegistrant($registrant);
        $this->setAdmin($admin);
        $this->setTech($tech);
        $this->setBilling($billing);
        $this->setTrademark($trademark);
        $this->setExtension($extension);
        $this->setSunriseData($sunriseData);
        $this->setCommandOptions($commandOptions);
    }

    public function loadData($command, $data)
    {
        if ($command == 'CheckDomainAvailability') {
            $this->loadCheckDomainAvailability($data);
        } elseif ($command == 'CheckDomainAvailabilityPlus') {
            $this->loadCheckDomainAvailabilityPlus($data);
        }
    }

    private function loadCheckDomainAvailability($data)
    {
        $this->status = $this->statusMessages[$data['d']['AvailabilityStatus']];

        $this->available = false;
        if (in_array($this->status, ['Available', 'AvailableOfflineLookup', 'AvailableRegistryTimeout', 'AvailableWithProvidedDomainId'])) {
            $this->available = true;
        }
        $this->launchPhase = $data['d']['LaunchPhase'];
        $this->dropDate = $data['d']['DropDate'];
        $this->backOrderAvailable = $data['d']['BackOrderAvailable'];
    }

    private function loadCheckDomainAvailabilityPlus($data)
    {
        $this->status = $this->statusMessages[$data['AvailabilityStatus']];

        $this->available = false;
        if (in_array($this->status, ['Available', 'AvailableOfflineLookup', 'AvailableRegistryTimeout', 'AvailableWithProvidedDomainId'])) {
            $this->available = true;
        }
        $this->launchPhase = $data['LaunchPhase'];
        $this->dropDate = $data['DropDate'];
        $this->backOrderAvailable = $data['BackOrderAvailable'];
        $this->domainName = $data['DomainName'];
    }
    
    private function loadFromRegistration($data) {
        $this->setOrderId($data['OrderId']);
        $this->setDomainId($data['DomainId']);
        $this->setRegistrantContactId($data['RegistrantContactId']);
        $this->setAdminContactId($data['AdminContactId']);
        $this->setTechContactId($data['TechContactId']);
        $this->setBillingContactId($data['BillingContactId']);
    }

    public function getDomainName()
    {
        return $this->domainName;
    }

    public function setDomainName($domainName)
    {
        $this->domainName = $domainName;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function isAvailable()
    {
        return $this->available;
    }

    public function setAvailable($available)
    {
        $this->available = $available;
    }

    public function getLaunchPhase()
    {
        return $this->launchPhase;
    }

    public function setLaunchPhase($launchPhase)
    {
        $this->launchPhase = $launchPhase;
    }

    public function getDropDate()
    {
        return $this->dropDate;
    }

    public function setDropDate($dropDate)
    {
        $this->dropDate = $dropDate;
    }

    public function canBackOrder()
    {
        return $this->backOrderAvailable;
    }

    public function setBackOrderAvailable($backOrderAvailable)
    {
        $this->backOrderAvailable = $backOrderAvailable;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    public function getApplyLock()
    {
        return $this->applyLock;
    }

    public function setApplyLock($applyLock)
    {
        $this->applyLock = $applyLock;
    }

    public function getAutoRenew()
    {
        return $this->autoRenew;
    }

    public function setAutoRenew($autoRenew)
    {
        $this->autoRenew = $autoRenew;
    }

    public function getAutoRenewDays()
    {
        return $this->autoRenewDays;
    }

    public function setAutoRenewDays($autoRenewDays)
    {
        $this->autoRenewDays = $autoRenewDays;
    }

    public function getApplyPrivacy()
    {
        return $this->applyPrivacy;
    }

    public function setApplyPrivacy($applyPrivacy)
    {
        $this->applyPrivacy = $applyPrivacy;
    }

    public function getAcceptTerms()
    {
        return $this->acceptTerms;
    }

    public function setAcceptTerms($acceptTerms)
    {
        $this->acceptTerms = $acceptTerms;
    }

    public function getNameServers()
    {
        return $this->nameServers;
    }

    public function setNameServers($nameServers)
    {
        $this->nameServers = $nameServers;
    }

    public function getGlueRecords()
    {
        return $this->glueRecords;
    }

    public function setGlueRecords($glueRecords)
    {
        $this->glueRecords = $glueRecords;
    }

    public function getRegistrant()
    {
        return $this->registrant;
    }

    public function setRegistrant($registrant)
    {
        $this->registrant = $registrant;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function getTech()
    {
        return $this->tech;
    }

    public function setTech($tech)
    {
        $this->tech = $tech;
    }

    public function getBilling()
    {
        return $this->billing;
    }

    public function setBilling($billing)
    {
        $this->billing = $billing;
    }

    public function getTrademark()
    {
        return $this->trademark;
    }

    public function setTrademark($trademark)
    {
        $this->trademark = $trademark;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getSunriseData()
    {
        return $this->sunriseData;
    }

    public function setSunriseData($sunriseData)
    {
        $this->sunriseData = $sunriseData;
    }

    public function getCommandOptions()
    {
        return $this->commandOptions;
    }

    public function setCommandOptions($commandOptions)
    {
        $this->commandOptions = $commandOptions;
    }

    public function generateDomainboxCommand()
    {
        $hostname = substr($this->getDomainName(), 0, strpos($this->getDomainName(), '.'));
        $tld = substr($this->getDomainName(), strlen($hostname));

        $command = [
            'DomainName'    => $this->getDomainName(),
            'LaunchPhase'   => $this->getLaunchPhase(),
            'Period'        => $this->getPeriod(),
            'ApplyLock'     => $this->getApplyLock(),
            'AutoRenew'     => $this->getAutoRenew(),
            'AutoRenewDays' => $this->getAutoRenewDays(),
            'AcceptTerms'   => $this->getAcceptTerms(),
            'ApplyPrivacy'  => $this->getApplyPrivacy(),

            'Contacts' => [
                'Registrant' => $this->getRegistrant()->generateDomainboxCommand(),
                'Admin'      => $this->getAdmin()->generateDomainboxCommand(),
                'Billing'    => $this->getBilling()->generateDomainboxCommand(),
                'Tech'       => $this->getTech()->generateDomainboxCommand(),
            ],
        ];

        if ($this->getExtension() != null) {
            $command['Extension'] = $this->getExtension();
        }

        $nameservers = $this->getNameServers();
        $command['Nameservers'] = [
            'NS1'         => isset($nameservers[0]) ? $nameservers[0] : '',
            'NS2'         => isset($nameservers[1]) ? $nameservers[1] : '',
            'NS3'         => isset($nameservers[2]) ? $nameservers[2] : '',
            'NS4'         => isset($nameservers[3]) ? $nameservers[3] : '',
            'NS5'         => isset($nameservers[4]) ? $nameservers[4] : '',
            'NS6'         => isset($nameservers[5]) ? $nameservers[5] : '',
            'NS7'         => isset($nameservers[6]) ? $nameservers[6] : '',
            'NS8'         => isset($nameservers[7]) ? $nameservers[7] : '',
            'NS9'         => isset($nameservers[8]) ? $nameservers[8] : '',
            'NS10'        => isset($nameservers[9]) ? $nameservers[9] : '',
            'NS11'        => isset($nameservers[10]) ? $nameservers[10] : '',
            'NS12'        => isset($nameservers[11]) ? $nameservers[11] : '',
            'NS13'        => isset($nameservers[12]) ? $nameservers[12] : '',
            'GlueRecords' => [],
        ];

        if (in_array($tld, ['.co.uk', '.org.uk', '.me.uk', '.ltd.uk', '.plc.uk', '.net.uk'])) {
            $command['ApplyLock'] = false;
            $command['Contacts']['Registrant']['AdditionalData']['UKAdditionalData'] = '';
            $command['Extension']['UKDirectData']['RelatedDomainId'] = 0;
        }
        if (in_array($tld, ['.us'])) {
            $command['ApplyLock'] = false;
            $command['Contacts']['Registrant']['AdditionalData']['USAdditionalData'] = '';
        }
        if (in_array($tld, ['.im'])) {
            if (!in_array($command['Period'], [1, 2])) {
                $command['Period'] = 2;
            }
        }
        if (in_array($tld, ['.in'])) {
            $command['ApplyPrivacy'] = false;
        }
        if (in_array($tld, ['.eu'])) {
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.be'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
            unset($command['Nameservers']['NS13']);
        }
        if (in_array($tld, ['.es'])) {
            if (!in_array($command['Period'], [1, 2, 3, 4, 5, 10])) {
                $command['Period'] = 1;
            }
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.af', '.com.af', '.net.af', '.org.af', '.com.cc', '.edu.cc', '.net.cc', '.org.cc', '.cx', '.gs', '.ht', '.art.ht', '.org.ht', '.com.ht', '.net.ht', '.pro.ht', '.firm.ht', '.info.ht', '.shop.ht', '.adult.ht', '.pol.ht', '.rel.ht', '.asso.ht', '.perso.ht', '.ki', '.biz.ki', '.com.ki', '.net.ki', '.org.ki', '.tel.ki', '.info.ki', '.mobi.ki', '.phone.ki', '.mu', '.ac.mu', '.co.mu', '.net.mu', '.com.mu', '.org.mu', '.nf', '.com.nf', '.net.nf', '.per.nf', '.web.nf', '.arts.nf', '.firm.nf', '.info.nf', '.store.nf', '.rec.nf', '.other.nf', '.com.sb', '.net.sb', '.org.sb', '.tl'])) {
            if (!in_array($command['Period'], [1, 2, 3, 4, 5])) {
                $command['Period'] = 1;
            }
        }
        if (in_array($tld, ['.tel'])) {
            unset($command['Nameservers']);
        }
        if (in_array($tld, ['.at', '.or.at', '.co.at'])) {
            $command['AutoRenew'] = true;
            if (!in_array($command['AutoRenewDays'], [30, 45, 60, 90])) {
                $command['AutoRenewDays'] = 45;
            }
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            $command['AcceptTerms'] = true;
            $command['Period'] = 1;
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.nl'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
        }
        if (in_array($tld, ['.tk'])) {
            if (!in_array($command['Period'], [1, 2, 3, 4, 5, 9])) {
                $command['Period'] = 1;
            }
            $command['ApplyLock'] = false;
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.qa'])) {
            if (!in_array($command['Period'], [1, 2, 3, 4, 5])) {
                $command['Period'] = 1;
            }
        }
        if (in_array($tld, ['.fr', '.yt', '.tf', '.pm', '.re', '.wf'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.de'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            $command['AcceptTerms'] = true;
            $command['Extension']['DeBillingData']['MonthlyBilling'] = false;
        }
        if (in_array($tld, ['.mx'])) {
            if (!in_array($command['Period'], [1, 2, 3, 4, 5])) {
                $command['Period'] = 1;
            }
            unset($command['Nameservers']['NS5']);
            unset($command['Nameservers']['NS6']);
            unset($command['Nameservers']['NS7']);
            unset($command['Nameservers']['NS8']);
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.it'])) {
            $command['Period'] = 1;
            unset($command['Nameservers']['NS7']);
            unset($command['Nameservers']['NS8']);
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.co.za'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            unset($command['Nameservers']['NS5']);
            unset($command['Nameservers']['NS6']);
            unset($command['Nameservers']['NS7']);
            unset($command['Nameservers']['NS8']);
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.fm'])) {
            if (!in_array($command['Period'], [1, 2, 3, 4, 5])) {
                $command['Period'] = 1;
            }
        }
        if (in_array($tld, ['.pl', '.com.pl', '.net.pl'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.io', '.sh', '.ac'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
        }
        if (in_array($tld, ['.jp'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            $command['Extension']['JPProxyServiceData']['UseProxyService'] = true;
        }
        if (in_array($tld, ['.lv'])) {
            $command['Period'] = 1;
            unset($command['Nameservers']['NS6']);
            unset($command['Nameservers']['NS7']);
            unset($command['Nameservers']['NS8']);
            unset($command['Nameservers']['NS9']);
            unset($command['Nameservers']['NS10']);
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.gg', '.je'])) {
            if (!in_array($command['Period'], [1, 2])) {
                $command['Period'] = 1;
            }
        }
        if (in_array($tld, ['.ch', '.li'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
        }
        if (in_array($tld, ['.dm', '.co.dm'])) {
            $command['ApplyPrivacy'] = false;
        }
        if (in_array($tld, ['.co.nz', '.net.nz', '.org.nz', '.gen.nz', '.kiwi.nz', '.ac.nz', '.geek.nz', '.maori.nz', '.school.nz'])) {
            $command['Period'] = 1;
            $command['ApplyLock'] = false;
            $command['ApplyPrivacy'] = false;
            $command['AcceptTerms'] = true;
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.sx'])) {
            unset($command['Nameservers']['NS11']);
            unset($command['Nameservers']['NS12']);
        }
        if (in_array($tld, ['.pro'])) {
            $command['ApplyPrivacy'] = false;
        }
        if (in_array($tld, ['.cat'])) {
            $command['Extension']['CatParameterData'] = ['Maintainer' => '', 'AuthId' => '', 'AuthKey' => '', 'IntendedUse' => ''];
        }
        if (in_array($tld, ['.academy', '.accountants', '.agency', '.associates', '.bargains', '.bike', '.boutique', '.builders', '.business', '.cab', '.camera', '.camp', '.capital', '.cards', '.care', '.careers', '.cash', '.catering', '.center', '.cheap', '.church', '.city', '.claims', '.cleaning', '.clinic', '.clothing', '.codes', '.coffee', '.community', '.company', '.computer', '.condos', '.construction', '.contractors', '.cool', '.credit', '.creditcard', '.cruises', '.dating', '.deals', '.dental', '.diamonds', '.digital', '.direct', '.directory', '.discount', '.domains', '.education', '.email', '.engineering', '.enterprises', '.equipment', '.estate', '.events', '.exchange', '.expert', '.exposed', '.fail', '.farm', '.finance', '.financial', '.fish', '.fitness', '.flights', '.florist', '.foundation', '.fund', '.furniture', '.gallery', '.gifts', '.glass', '.graphics', '.gratis', '.gripe', '.guide', '.guru', '.healthcare', '.holdings', '.holiday', '.house', '.immo', '.industries', '.institute', '.insure', '.international', '.investments', '.kitchen', '.land', '.lease', '.life', '.lighting', '.limited', '.limo', '.loans', '.maison', '.management', '.marketing', '.media', '.network', '.partners', '.parts', '.photography', '.photos', '.pictures', '.pizza', '.place', '.plumbing', '.productions', '.properties', '.recipes', '.reisen', '.rentals', '.repair', '.report', '.restaurant', '.sarl', '.schule', '.services', '.shoes', '.singles', '.solar', '.solutions', '.supplies', '.supply', '.support', '.surgery', '.systems', '.tax', '.technology', '.tienda', '.tips', '.today', '.tools', '.town', '.toys', '.training', '.university', '.vacations', '.ventures', '.viajes', '.villas', '.vision', '.voyage', '.watch', '.works', '.wtf', '.zone'])) {
            $command['Extension']['DonutsPriceCategoryData']['PriceCategory'] = '';
        }
        if (in_array($tld, ['.audio', '.blackfriday', '.christmas', '.click', '.diet', '.gift', '.guitars', '.help', '.hiphop', '.hosting', '.juegos', '.link', '.photo', '.pics', '.property', '.sexy', '.tattoo'])) {
            $command['Extension']['ChallengeParameters']['Challenges'] = $extension;
        }
        if (in_array($tld, ['.actor', '.dance', '.democrat', '.futbol', '.immobilien', '.kaufen', '.pub', '.moda', '.ninja', '.reviews', '.social'])) {
            $command['Extension']['PremiumPriceCategory']['PriceCategory'] = 'Category16';
        }
        if (in_array($tld, ['.archi'])) {
            $command['ApplyPrivacy'] = false;
        }
        if (in_array($tld, ['.scot'])) {
            $command['Extension']['IntendedUseParams'] = ['IntendedUse' => '', 'ReferenceUrl' => '', 'TrademarkId' => '', 'TrademarkIssuer' => ''];
        }

        return $command;
    }
}
