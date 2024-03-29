<?php

namespace Rhmt\Verihubs\Verihubs;

use Rhmt\Verihubs\Exceptions\VerihubsException;
use Rhmt\Verihubs\Requests\Request;

class IdCheck
{
    private $request;
    private $nik;
    private $name;
    private $birthDate;
    private $email;
    private $phone;
    private $selfiePhoto;
    private $ktpPhoto;
    private $channel;

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

    public function setImage($selfiePhoto)
    {
        $this->selfiePhoto = $selfiePhoto;
        return $this;
    }

    public function setKtp($ktpPhoto)
    {
        $this->ktpPhoto = $ktpPhoto;
        return $this;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;
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
            'birth_date' => $this->birthDate,
            'email' => $this->email,
            'phone' => $this->phone,
            'selfie_photo' => $this->selfiePhoto,
            'ktp_photo' => $this->ktpPhoto,
            'channel' => $this->channel,
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

        $endpoint = '/data-verification/certificate-electronic/verify';
        $payloads = $this->toArray();

        return $this->request->post($endpoint, $payloads);
    }
}
