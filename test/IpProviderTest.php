<?php

use DebugHelper\Stopwatch;

use MartinLindhe\MyIp\IpProvider\IpProvider;
use MartinLindhe\MyIp\IpProvider\HostIpProvider;
use MartinLindhe\MyIp\IpProvider\ICanHazIpCom;
use MartinLindhe\MyIp\IpProvider\IdentMe;
use MartinLindhe\MyIp\IpProvider\IpechoNet;

class ExternalIpProviderTest extends PHPUnit_Framework_TestCase
{
    private function assertIpV4($ip)
    {
        $this->assertEquals(true, filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false);
    }

    public function testFactory()
    {
        $ip = IpProvider::factory()->getIPv4();
        $this->assertIpV4($ip);
    }

    public function testIdentMe()
    {
        $ip = (new IdentMe)->getIPv4();
        $this->assertInternalType('string', $ip);
        $this->assertIpV4($ip);

        return $ip;
    }

    /**
     * @depends testIdentMe
     */
    public function testIpechoNet($prevIp)
    {
        $ip = (new IpechoNet())->getIPv4();
        $this->assertIpV4($ip);
        $this->assertEquals($prevIp, $ip);

        return $ip;
    }

    /**
     * @depends testIpechoNet
     */
    public function testICanHazIpCom($prevIp)
    {
        $ip = (new ICanHazIpCom())->getIPv4();
        $this->assertIpV4($ip);
        $this->assertEquals($prevIp, $ip);

        return $ip;
    }

    /**
     * @depends testICanHazIpCom
     */
    public function testHostProvider($prevIp)
    {
        $ip = (new HostIpProvider())->getIPv4();
        $this->assertIpV4($ip);
        $this->assertEquals($prevIp, $ip);
    }

    public function testBenchmark()
    {
        $watch = (new Stopwatch('ident.me'))->start();
        $ip = (new IdentMe)->getIPv4();
        $watch->stopAndPrintResult($ip);

        $watch = (new Stopwatch('ipecho.net'))->start();
        $ip = (new IpechoNet)->getIPv4();
        $watch->stopAndPrintResult($ip);

        $watch = (new Stopwatch('icanhazip.com'))->start();
        $ip = (new ICanHazIpCom)->getIPv4();
        $watch->stopAndPrintResult($ip);

        $watch = (new Stopwatch('host provider (dig)'))->start();
        $ip = (new HostIpProvider)->getIPv4();
        $watch->stopAndPrintResult($ip);
    }
}
