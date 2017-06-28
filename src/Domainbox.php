<?php

namespace MadeITBelgium\Domainbox;

use GuzzleHttp\Client;

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
        $this->reseller = $reseller;
        $this->username = $username;
        $this->password = $password;
        $this->sandbox = $sandbox;
        $this->client = new Client();
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
        $url = 'https://json.domainbox.net';
        if ($this->sandbox) {
            $url = 'https://json-sandbox.domainbox.net';
        }
        $url .= '/'.$endPoint;

        $response = $this->client->post($url, [
            'json' => [
                'AuthenticationParameters' => [
                    'Reseller' => $this->reseller,
                    'Username' => $this->username,
                    'Password' => $this->password,
                ],
                'CommandParameters' => $parameters, ],
        ]);

        if ($response->getStatusCode() == 200) {
            $output = json_decode($response->getBody(), true);
        } else {
            throw Exception();
        }

        $this->checkResultCode($output);

        return $output;
    }

    private function checkResultCode($output)
    {
        if (!isset($output['d']['ResultCode'])) {
            throw Exception('Wrong output.');
        }

        switch ($output['d']['ResultCode']) {
            //Command Successful
            case 100: return true; break; //Command Successful
            case 101: return true; break; //Application Submitted
            case 102: return true; break; //Queued
            case 104: return true; break; //Pending Restore
            case 110: return true; break; //But Apply Lock Failed
            case 121: return true; break; //But Part Failure

            case 201: throw Exception('Authentication Failure'); break; //Authentication Failure
            case 210: throw Exception('Part Failure'); break; //Part Failure (Part of the command failed)
            case 215: throw Exception('Timeout'); break; //Timeout
            case 220: throw Exception('Billing Failure - Insufficient Funds'); break; //Billing Failure - Insufficient Funds
            case 230: throw Exception('Command Unavailable'); break; //Command Unavailable
            case 240: throw Exception('Required Parameter Missing'); break; //Required Parameter Missing
            case 250: throw Exception('TLD Not Supported'); break; //TLD Not Supported
            case 260: throw Exception('Invalid Parameter'); break; //Invalid Parameter
            case 261: throw Exception('IDN Not Supported'); break; //IDN Not Supported
            case 262: throw Exception('Invalid Contacts'); break; //Invalid Contacts
            case 263: throw Exception('Invalid Contacts Proxy Available'); break; //Invalid Contacts Proxy Available
            case 270: throw Exception('Transfer Unavailable'); break; //Transfer Unavailable
            case 275: throw Exception('DomainExpired'); break; //DomainExpired
            case 276: throw Exception('DomainPendingSync'); break; //DomainPendingSync
            case 277: throw Exception('DomainRenewable'); break; //DomainRenewable
            case 278: throw Exception('DomainPendingPremiumAction'); break; //DomainPendingPremiumAction
            case 280: throw Exception('Domain Locked'); break; //Domain Locked
            case 285: throw Exception('Premium Domain Not Listed'); break; //Premium Domain Not Listed
            case 286: throw Exception('Premium Domain Already Listed'); break; //Premium Domain Already Listed
            case 287: throw Exception('Premium Domain Unavailable'); break; //Premium Domain Unavailable
            case 290: throw Exception('Domain Exists'); break; //Domain Exists
            case 291: throw Exception('Nameserver Exists'); break; //Nameserver Exists
            case 292: throw Exception('Parameter Incompatible'); break; //Parameter Incompatible
            case 293: throw Exception('Transfer Incorrect Status'); break; //Transfer Incorrect Status
            case 294: throw Exception('Tel Object Incorrect Status'); break; //Tel Object Incorrect Status
            case 295: throw Exception('Domain Not Found'); break; //Domain Not Found
            case 296: throw Exception('Nameserver Not Found'); break; //Nameserver Not Found
            case 297: throw Exception('Transfer Not Found'); break; //Transfer Not Found
            case 298: throw Exception('IP Address Error'); break; //IP Address Error
            case 301: throw Exception('SSL Product Type Not Supported'); break; //SSL Product Type Not Supported
            case 302: throw Exception('SSL Order Not Found'); break; //SSL Order Not Found
            case 303: throw Exception('SSL Order Incorrect Status'); break; //SSL Order Incorrect Status
            case 305: throw Exception('Email Type Not Supported'); break; //Email Type Not Supported
            case 306: throw Exception('Email Not Found'); break; //Email Not Found
            case 307: throw Exception('Email Incorrect'); break; //Email Incorrect
            case 308: throw Exception('Email Exists'); break; //Email Exists
            case 309: throw Exception('DNS Zone/Record Not Found'); break; //DNS Zone/Record Not Found
            case 310: throw Exception('DNS Zone/Record Incorrect'); break; //DNS Zone/Record Incorrect
            case 311: throw Exception('DNS Zone/Record Exists'); break; //DNS Zone/Record Exists
            case 312: throw Exception('DNS Not Supported'); break; //DNS Not Supported
            case 320: throw Exception('Transition Not Found'); break; //Transition Not Found
            case 321: throw Exception('Transition Incorrect Status'); break; //Transition Incorrect Status
            case 322: throw Exception('Contact Not Found'); break; //Contact Not Found
            case 331: throw Exception('Queue Message Not Found'); break; //Queue Message Not Found
            case 361: throw Exception('Trademark Not Found'); break; //Trademark Not Found
            case 391: throw Exception('PublishingTypeNotSupported'); break; //PublishingTypeNotSupported
            case 392: throw Exception('PublishingDomainExists'); break; //PublishingDomainExists
            case 460: throw Exception('Registry System Unavailable'); break; //Registry System Unavailable
            case 461: throw Exception('SSL System Unavailable'); break; //SSL System Unavailable
            case 462: throw Exception('Email System Unavailable'); break; //Email System Unavailable
            case 463: throw Exception('DNS System Unavailable'); break; //DNS System Unavailable
            case 465: throw Exception('PublishingSystemUnavailable'); break; //PublishingSystemUnavailable
            case 500: throw Exception('System Error'); break; //System Error
        }
    }

    public function domain()
    {
        return new Command\Domain($this);
    }
}
