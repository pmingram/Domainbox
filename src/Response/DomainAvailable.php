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
    const Available = 0;
    const Unavailable = 1;
    const InvalidDomainSupplied = 2;
    const ErrorOccurred = 3;
    const ExceededLimit = 4;
    const AvailableOfflineLookup = 7;
    const UnavailableOfflineLookup = 8;
    const AvailableRegistryTimeout = 9;
    const UnavailableRegistryTimeout = 9;
    const AvailableWithProvidedDomainId = 11;
    
    private $status;
    private $available;
    private $launchPhase;
    private $dropDate;
    private $backOrderAvailable;
    
    function __construct($data) {
        $constants = array_flip((new \ReflectionClass(__CLASS__))->getConstants());
        $this->status = $constants[$data['d']['AvailabilityStatus']];
        
        $this->available = false;
        if(in_array($this->status, ['Available', 'AvailableOfflineLookup', 'AvailableRegistryTimeout', 'AvailableWithProvidedDomainId'])) {
            $this->available = true;
        }
        $this->launchPhase = $data['d']['LaunchPhase'];
        $this->dropDate = $data['d']['DropDate'];
        $this->backOrderAvailable = $data['d']['BackOrderAvailable'];
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function isAvailable() {
        return $this->available;
    }
    
    public function getLauchPhase() {
        return $this->launchPhase;
    }
    
    public function getDropDate() {
        return $this->dropDate;
    }
    
    public function canBackOrder() {
        return $this->backOrderAvailable;
    }
}