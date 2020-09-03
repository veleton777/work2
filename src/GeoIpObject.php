<?php

namespace App;

class GeoIpObject
{
    private $Region;
    private $Town;
    private $Lon;
    private $Lat;
    private $TZ;
    private $Country;
    private $TwilNavEnd;
    private $TwilNavBeg;
    private $SunRise;
    private $SunSet;
    private $TwilCivBeg;
    private $TwilCivEnd;
    private $TwilAstBeg;
    private $TwilAstEnd;

    public function __construct($data)
    {
        $properties = get_object_vars($this);
        $data = get_object_vars($data->GeoAddr);

        foreach ($data as $key => $value) {
            foreach ($properties as $property => $v) {
                if ($property === $key) {
                    $this->{$property} = $value;
                }
            }
        }
    }

    public function getInfo(): array
    {
        $params = $this->getParams();

        $data = [];

        foreach(get_object_vars($this) as $k => $item) {
            if (!empty($this->{$k})) {
                $data[$params[$k]] = $this->{$k};
            }
        }

        return $data;
    }

    private function getParams(): array
    {
        return [
            'Town' => 'Город',
            'Country' => 'Страна',
            'Region' => 'Область',
            'TZ' => 'Временная зона',
            'Lat' => 'Широта',
            'Lon' => 'Долгота',
            'SunRise' => 'Время восхода солнца',
            'SunSet' => 'Время захода солнца',
            'TwilCivBeg' => 'Время начала гражданских сумерек',
            'TwilCivEnd' => 'Время окончания гражданских сумерек',
            'TwilNavBeg' => 'Время начала навигационных сумерек',
            'TwilNavEnd' => 'Время окончания навигационных сумерек',
            'TwilAstBeg' => 'Время начала астрономических сумерек',
            'TwilAstEnd' => 'Время окончания астрономических сумерек',
        ];
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->Region;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->Town;
    }

    /**
     * @return mixed
     */
    public function getLon()
    {
        return $this->Lon;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->Lat;
    }

    /**
     * @return mixed
     */
    public function getTZ()
    {
        return $this->TZ;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @return mixed
     */
    public function getTwilNavEnd()
    {
        return $this->TwilNavEnd;
    }

    /**
     * @return mixed
     */
    public function getTwilNavBeg()
    {
        return $this->TwilNavBeg;
    }

    /**
     * @return mixed
     */
    public function getSunRise()
    {
        return $this->SunRise;
    }

    /**
     * @return mixed
     */
    public function getSunSet()
    {
        return $this->SunSet;
    }

    /**
     * @return mixed
     */
    public function getTwilCivBeg()
    {
        return $this->TwilCivBeg;
    }

    /**
     * @return mixed
     */
    public function getTwilCivEnd()
    {
        return $this->TwilCivEnd;
    }

    /**
     * @return mixed
     */
    public function getTwilAstBeg()
    {
        return $this->TwilAstBeg;
    }

    /**
     * @return mixed
     */
    public function getTwilAstEnd()
    {
        return $this->TwilAstEnd;
    }
}