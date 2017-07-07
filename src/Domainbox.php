<?php

namespace MadeITBelgium\Domainbox;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Domainbox
{
    protected $version = '1.0.0';
    private $reseller;
    private $username;
    private $password;
    private $sandbox;

    private $client;

    /**
     * Construct Domainbox.
     *
     * @param $reseller
     * @param $username
     * @param $password
     * @param sandbox
     */
    public function __construct($reseller, $username, $password, $sandbox = false)
    {
        if (!extension_loaded('soap'))
            throw new \Exception('DomainBox needs the SOAP PHP extension.');
        $this->reseller = $reseller;
        $this->username = $username;
        $this->password = $password;
        $this->sandbox = $sandbox;
        
        $url = 'https://sandbox.domainbox.net/?WSDL';
        if ($this->sandbox) {
            $url = 'https://live.domainbox.net/?WSDL';
        }
        $this->client = new \SoapClient($url, array('soap_version' => SOAP_1_2));
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Execute Domainbox call.
     *
     * @param $endpoint
     * @param $parameters
     */
    public function call($endPoint, $parameters)
    {  
        $auth = array('AuthenicationParameters' => array('Reseller' => $this->reseller, 'Username' => $this->username, 'Password' => $this->password));
        $command = array('CommandParameters' => $parameters);

        $request = array_merge($auth, $command);
        $result = $this->client->$endPoint($request);
        
        if (is_soap_fault($result)) {
            throw new \Exception();
        }

        $resultKey = $endPoint . 'Result';
        $this->checkResultCode($result->$resultKey);

        return $result->$resultKey;
    }

    private function checkResultCode($output)
    {
        if (!isset($output->ResultCode)) {
            throw new \Exception('Wrong output.');
        }

        switch ($output->ResultCode) {
            //Command Successful
            case 100: return true; break; //Command Successful
            case 101: return true; break; //Application Submitted
            case 102: return true; break; //Queued
            case 104: return true; break; //Pending Restore
            case 110: return true; break; //But Apply Lock Failed
            case 121: return true; break; //But Part Failure

            case 201: throw new \Exception('Authentication Failure'); break; //Authentication Failure
            case 210: throw new \Exception('Part Failure'); break; //Part Failure (Part of the command failed)
            case 215: throw new \Exception('Timeout'); break; //Timeout
            case 220: throw new \Exception('Billing Failure - Insufficient Funds'); break; //Billing Failure - Insufficient Funds
            case 230: throw new \Exception('Command Unavailable'); break; //Command Unavailable
            case 240: throw new \Exception('Required Parameter Missing'); break; //Required Parameter Missing
            case 250: throw new \Exception('TLD Not Supported'); break; //TLD Not Supported
            case 260: throw new \Exception('Invalid Parameter'); break; //Invalid Parameter
            case 261: throw new \Exception('IDN Not Supported'); break; //IDN Not Supported
            case 262: throw new \Exception('Invalid Contacts'); break; //Invalid Contacts
            case 263: throw new \Exception('Invalid Contacts Proxy Available'); break; //Invalid Contacts Proxy Available
            case 270: throw new \Exception('Transfer Unavailable'); break; //Transfer Unavailable
            case 275: throw new \Exception('DomainExpired'); break; //DomainExpired
            case 276: throw new \Exception('DomainPendingSync'); break; //DomainPendingSync
            case 277: throw new \Exception('DomainRenewable'); break; //DomainRenewable
            case 278: throw new \Exception('DomainPendingPremiumAction'); break; //DomainPendingPremiumAction
            case 280: throw new \Exception('Domain Locked'); break; //Domain Locked
            case 285: throw new \Exception('Premium Domain Not Listed'); break; //Premium Domain Not Listed
            case 286: throw new \Exception('Premium Domain Already Listed'); break; //Premium Domain Already Listed
            case 287: throw new \Exception('Premium Domain Unavailable'); break; //Premium Domain Unavailable
            case 290: throw new \Exception('Domain Exists'); break; //Domain Exists
            case 291: throw new \Exception('Nameserver Exists'); break; //Nameserver Exists
            case 292: throw new \Exception('Parameter Incompatible'); break; //Parameter Incompatible
            case 293: throw new \Exception('Transfer Incorrect Status'); break; //Transfer Incorrect Status
            case 294: throw new \Exception('Tel Object Incorrect Status'); break; //Tel Object Incorrect Status
            case 295: throw new \Exception('Domain Not Found'); break; //Domain Not Found
            case 296: throw new \Exception('Nameserver Not Found'); break; //Nameserver Not Found
            case 297: throw new \Exception('Transfer Not Found'); break; //Transfer Not Found
            case 298: throw new \Exception('IP Address Error'); break; //IP Address Error
            case 301: throw new \Exception('SSL Product Type Not Supported'); break; //SSL Product Type Not Supported
            case 302: throw new \Exception('SSL Order Not Found'); break; //SSL Order Not Found
            case 303: throw new \Exception('SSL Order Incorrect Status'); break; //SSL Order Incorrect Status
            case 305: throw new \Exception('Email Type Not Supported'); break; //Email Type Not Supported
            case 306: throw new \Exception('Email Not Found'); break; //Email Not Found
            case 307: throw new \Exception('Email Incorrect'); break; //Email Incorrect
            case 308: throw new \Exception('Email Exists'); break; //Email Exists
            case 309: throw new \Exception('DNS Zone/Record Not Found'); break; //DNS Zone/Record Not Found
            case 310: throw new \Exception('DNS Zone/Record Incorrect'); break; //DNS Zone/Record Incorrect
            case 311: throw new \Exception('DNS Zone/Record Exists'); break; //DNS Zone/Record Exists
            case 312: throw new \Exception('DNS Not Supported'); break; //DNS Not Supported
            case 320: throw new \Exception('Transition Not Found'); break; //Transition Not Found
            case 321: throw new \Exception('Transition Incorrect Status'); break; //Transition Incorrect Status
            case 322: throw new \Exception('Contact Not Found'); break; //Contact Not Found
            case 331: throw new \Exception('Queue Message Not Found'); break; //Queue Message Not Found
            case 361: throw new \Exception('Trademark Not Found'); break; //Trademark Not Found
            case 391: throw new \Exception('PublishingTypeNotSupported'); break; //PublishingTypeNotSupported
            case 392: throw new \Exception('PublishingDomainExists'); break; //PublishingDomainExists
            case 460: throw new \Exception('Registry System Unavailable'); break; //Registry System Unavailable
            case 461: throw new \Exception('SSL System Unavailable'); break; //SSL System Unavailable
            case 462: throw new \Exception('Email System Unavailable'); break; //Email System Unavailable
            case 463: throw new \Exception('DNS System Unavailable'); break; //DNS System Unavailable
            case 465: throw new \Exception('PublishingSystemUnavailable'); break; //PublishingSystemUnavailable
            case 500: throw new \Exception('System Error'); break; //System Error
        }
    }

    public function domain()
    {
        return new Command\Domain($this);
    }

    public function contact()
    {
        return new Command\Contact($this);
    }
}
