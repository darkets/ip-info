<?php
declare(strict_types=1);

namespace App;

use Carbon\Carbon;

class Application
{
    private IpInfoAPI $api;

    public function __construct()
    {
        $this->api = new IpInfoAPI();
    }

    public function run(): void
    {
        while (true) {
            echo 'Ip address that you want to look up: ';
            $ip = readline();

            if (!filter_var($ip, FILTER_VALIDATE_IP)) {
                echo 'Please input a valid ip address.' . PHP_EOL;
                continue;
            }

            $ipInfo = $this->api->fetchInfo($ip);
            $this->displayIpInfo($ipInfo);
        }
    }

    private function displayIpInfo(IpInfo $data): void
    {
        echo "Ip Address: {$data->getIp()}" . PHP_EOL;
        echo "City: {$data->getCity()}" . PHP_EOL;
        echo "Region: {$data->getRegion()}" . PHP_EOL;
        echo "Country: {$data->getCountry()}" . PHP_EOL;
        echo "Timezone: {$data->getTimezone()}" . PHP_EOL;

        $ipTime = new Carbon('now', $data->getTimezone());
        $localTime = new Carbon('now', '+03:00');

        $offsetInSeconds = $ipTime->getOffset() - $localTime->getOffset();
        $offsetInHours = abs($offsetInSeconds / 3600);

        echo "Difference in time: $offsetInHours hours" . PHP_EOL;
    }
}
