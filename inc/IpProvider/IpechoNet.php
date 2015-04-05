<?php namespace MyIp\IpProvider;

use Httpful\Request;
use Httpful\Response;

class IpechoNet extends IpProvider
{
    /**
     * @return string current external ip
     * @throws \Exception
     */
    public function getIPv4()
    {
        $uri = 'http://ipecho.net/plain';

        /** @var $response Response */
        $response = Request::get($uri)->send();

        if ($response->code != 200) {
            throw new \Exception('http error '.$response->code);
        }

        $ip = $response->body;
        if (!$ip) {
            throw new \Exception("no response");
        }

        return $ip;
    }
}
