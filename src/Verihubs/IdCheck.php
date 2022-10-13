<?php

namespace Rhmt\Verihubs;

use Rhmt\Verihubs\Exceptions\VerihubsException;
use Rhmt\Verihubs\Requests\Request;

class IdCheck
{
    private $request;
    private $nik;
    private $name;
    private $birthPlace;
    private $birthDate;
    private $image;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Setters
     */

    public function setNik($nik)
    {
        $this->nik = $nik;
        return $this;
    }

    // Optional
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    // Optional
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
        return $this;
    }

    // Optional
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    // Optional
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Getters
     */

    public function toArray()
    {
        return  [
            'nik' => $this->nik,
            'name' => $this->name,
            'birthPlace' => $this->birthPlace,
            'birthDate' => $this->birthDate,
            'image' => $this->image,
        ];
    }

    public function toJson($jsonOptions = 0)
    {
        return json_encode($this->toArray(), $jsonOptions);
    }

    /**
     * Validator
     */

    private function validate()
    {
        $properties = $this->toArray();

        foreach ($properties as $key => $property) {
            if (is_null($properties[$key]) || empty($properties[$key])) {
                throw new VerihubsException(sprintf('The %s needs to be set before calling %s::get()', $key, __CLASS__));
            }
        }
    }

    /**
     * Actual request
     */

    public function get()
    {
        $this->validate();

        $endpoint = '/id/check';
        $payloads = $this->toArray();

        return $this->request->post($endpoint, $payloads);
    }
}
