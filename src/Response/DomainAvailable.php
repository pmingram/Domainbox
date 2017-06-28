<?php

namespace MadeITBelgium\Domainbox\Response;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class DomainAvailable
{
    private $statusMessages = [
        0 => 'Available', 
        1 => 'Unavailable', 
        2 => 'InvalidDomainSupplied', 
        3 => 'ErrorOccurred', 
        4 => 'ExceededLimit', 
        5 => 'NotChecked',
        6 => 'TimedOut',
        7 => 'AvailableOfflineLookup', 
        8 => 'UnavailableOfflineLookup', 
        9 => 'AvailableRegistryTimeout', 
        10 => 'UnavailableRegistryTimeout', 
        11 => 'AvailableWithProvidedDomainId'
    ];

    private $status;
    private $available;
    private $launchPhase;
    private $dropDate;
    private $backOrderAvailable;
    private $domainName;

    public function __construct($command, $data)
    {
        if($command == "CheckDomainAvailability") {
            $this->loadCheckDomainAvailability($data);
        }
        elseif($command == "CheckDomainAvailabilityPlus") {
            $this->loadCheckDomainAvailabilityPlus($data);
        }
    }
    
    private function loadCheckDomainAvailability($data) {
        $this->status = $this->statusMessages[$data['d']['AvailabilityStatus']];

        $this->available = false;
        if (in_array($this->status, ['Available', 'AvailableOfflineLookup', 'AvailableRegistryTimeout', 'AvailableWithProvidedDomainId'])) {
            $this->available = true;
        }
        $this->launchPhase = $data['d']['LaunchPhase'];
        $this->dropDate = $data['d']['DropDate'];
        $this->backOrderAvailable = $data['d']['BackOrderAvailable'];
    }
    
    private function loadCheckDomainAvailabilityPlus($data) {
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

    public function getStatus()
    {
        return $this->status;
    }

    public function isAvailable()
    {
        return $this->available;
    }

    public function getLauchPhase()
    {
        return $this->launchPhase;
    }

    public function getDropDate()
    {
        return $this->dropDate;
    }

    public function canBackOrder()
    {
        return $this->backOrderAvailable;
    }
    
    public function getDomainName() {
        return $this->domainName;
    }
}
