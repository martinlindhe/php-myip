<?php
require __DIR__.'/../vendor/autoload.php';

function nfo($s)
{
    echo "\n".date('r')." ".$s."\n";
}

$ipProvider = \MyIp\IpProvider\IpProvider::factory();

$ip = $ipProvider->getIPv4();
nfo("ip ".$ip);

do {
    sleep(30);
    try {
        $newIp = $ipProvider->getIPv4();

        if ($ip != $newIp) {
            nfo("ip changed to ".$newIp);
            $ip = $newIp;
        } else {
            echo ".";
        }
    } catch (Exception $e) {
        nfo('EXCEPTION '.$e->getMessage());
    }
} while (1);
