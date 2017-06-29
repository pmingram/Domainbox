<?php
namespace MadeITBelgium\Domainbox\Command;

use MadeITBelgium\Domainbox\Response\DomainAvailable;
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
    protected $version = '1.0.0';
    private $domainbox;

    /**
     * Construct Domainbox.
     * 
     * @param $reseller
     * @param $username
     * @param $password
     * @param sandbox
     */
    public function __construct($domainbox)
    {
        $this->domainbox = $domainbox;
    }
    
    public function checkDomainAvailability($domainname, $launchPhase = "GA")
    {
        $response = $this->domainbox->call('CheckDomainAvailability', [
            'DomainName' => $domainname,
            'LaunchPhase' => $launchPhase
        ]);
        
        return new DomainAvailable($response);
    }
}