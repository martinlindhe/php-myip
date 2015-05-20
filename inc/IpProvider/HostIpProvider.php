<?php namespace MartinLindhe\MyIp\IpProvider;

class HostIpProvider extends IpProvider
{
    public function getIPv4()
    {
        $cmd = 'dig +short myip.opendns.com @resolver1.opendns.com';
        exec($cmd, $res);
        return $res[0];
    }
}
