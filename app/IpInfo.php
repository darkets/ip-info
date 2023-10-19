<?php
declare(strict_types=1);

namespace App;

class IpInfo
{
    private string $ip;
    private string $city;
    private string $region;
    private string $country;
    private string $timezone;

    public function __construct
    (
        string $ip,
        string $city,
        string $region,
        string $country,
        string $timezone
    )
    {
        $this->ip = $ip;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->timezone = $timezone;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
}