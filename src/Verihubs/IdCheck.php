<?php

namespace Rhmt\Verihubs\Verihubs;

use Rhmt\Verihubs\Exceptions\VerihubsException;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Support\Helper;

class IdCheck
{
    private $request;
    private $nik;
    private $name;
    private $birthDate;
    private $birthPlace;
    private $email;
    private $phone;
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


    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = date('d-m-Y', strtotime($birthDate));
        return $this;
    }

    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

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
            'birth_place' => $this->birthPlace,
            'birth_date' => $this->birthDate,
            'image' => $this->image,
            'email' => $this->email,
            'phone' => $this->phone,
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
                throw new VerihubsException(sprintf('The %s needs to be set %s::get()', $key, __CLASS__));
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
