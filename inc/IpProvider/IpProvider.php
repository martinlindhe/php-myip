<?php namespace MartinLindhe\MyIp\IpProvider;

abstract class IpProvider
{
    abstract function getIPv4();

    public static function factory()
    {
        return new HostIpProvider();
    }
}
