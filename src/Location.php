<?php

namespace App;

use \DomainException;
use GuzzleHttp\Client;
use \SimpleXMLElement;

class Location
{
    private $geoIpUrl = 'http://geoip.top/cgi-bin/getdata.pl';
    private $data;

    public function __construct(string $clientId, string $ipAddress, string $option)
    {
        $this->calculate($clientId, $ipAddress, $option);
    }

    public function getData(): array
    {
        return $this->getObject()->getInfo();
    }

    public function getObject(): GeoIpObject
    {
        return new GeoIpObject($this->data);
    }

    private function calculate(string $clientId, string $ipAddress, string $option): void
    {
        $params = [
            'ip' => $ipAddress,
            'sid' => $clientId,
            'hex' => $option
        ];

        $urlAddress = $this->geoIpUrl . '?' . http_build_query($params);

        $client = new Client();

        try {
            $this->parser($client->request('GET', $urlAddress)->getBody());
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $e->getMessage();
        } catch (DomainException $e) {
            echo $e->getMessage();
        }
    }

    private function parser($data): void
    {
        $this->data = new SimpleXMLElement($data);

        if (isset($this->data->GeoAddr->Error)) {
            switch ($this->data->GeoAddr->Error) {
                case 0:
                    break;
                case 10:
                    throw new DomainException('Неверная длина указанного адреса');
                    break;
                case 11:
                    throw new DomainException('Неверный формат Ip адреса');
                    break;
                case 150:
                    throw new DomainException('Внутренняя ошибка сервера');
                    break;
                case 162:
                    throw new DomainException('Идентификатор сайта не указан');
                    break;
                case 200:
                    throw new DomainException('Ошибка соединения с сервером');
                    break;
                case 205:
                    throw new DomainException('Нет данных по запросу');
                    break;
            }
        } else if (isset($this->data->Error)) {
            switch ($this->data->Error) {
                case 163:
                    throw new DomainException('Идентификатор сайта содержит ошибку или не зарегистрирован');
                    break;
            }
        }
    }
}