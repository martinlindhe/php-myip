<?php
require __DIR__.'/../vendor/autoload.php';

$ipProvider = MartinLindhe\MyIp\IpProvider\IpProvider::factory();

$ip = $ipProvider->getIPv4();
nfo("ip ".$ip);
