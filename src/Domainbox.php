<?php
use GuzzleHttp\Client;

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

    /**
     * Construct Domainbox.
     * 
     * @param $reseller
     * @param $username
     * @param $password
     * @param sandbox
     */
    public function __construct($reseller, $username, $password, $sandbox)
    {
        $this->reseller = $reseller;
        $this->username = $username;
        $this->password = $password;
        $this->sandbox = $sandbox;
    }

    /**
     * Execute Domainbox call.
     * 
     * @param $endpoint
     * @param $parameters
     */
    public function call($endPoint, $parameters) {
        $url = "https://json.domainbox.net";
        if($this->sandbox) {
            $url = "https://json-sandbox.domainbox.net";
        }
        $url .= "/" . $endPoint;
        
        $client = new Client();
        $response = $client->post($url, [
            'json' => [
                'AuthenticationParameters' => [
                    'Reseller' => $this->reseller,
                    'Username' => $this->username,
                    'Password' => $this->password,
                ], 
                'CommandParameters' => $parameters]
        ]);
        
        return $response;
    }
}
