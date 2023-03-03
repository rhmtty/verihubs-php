<?php

namespace Rhmt\Verihubs\Verihubs;

use Rhmt\Verihubs\Exceptions\VerihubsException;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Support\Helper;

class Liveness
{
    private $request;

    private $image;
    private $isQuality;
    private $isAttribute;
    private $validateQuality;
    private $validateAttribute;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Setters
     */

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    // Optional
    public function setisQuality($isQuality = true)
    {
        $this->isQuality = boolval($isQuality);
        return $this;
    }

    // Optional
    public function setIsAttribute($IsAttribute = true)
    {
        $this->isAttribute = boolval($IsAttribute);
        return $this;
    }

    // Optional
    public function setValidateQuality($ValidateQuality = false)
    {
        $this->validateQuality = boolval($ValidateQuality);
        return $this;
    }

    // Optional
    public function setValidateAttribute($ValidateAttribute = false)
    {
        $this->validateAttribute = boolval($ValidateAttribute);
        return $this;
    }

    /**
     * Getters
     */

    public function toArray()
    {
        return  [
            'image' => $this->image,
            'is_quality' => $this->isQuality,
            'is_attribute' => $this->isAttribute,
            'validate_quality' => $this->validateQuality,
            'validate_attribute' => $this->validateAttribute,
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
            if (!in_array($key, ['is_quality', 'is_attribute', 'validate_quality', 'validate_attribute']) && (is_null($properties[$key]) || empty($properties[$key]))) {
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

        $endpoint = '/data-verification/certificate-electronic/verify';
        $payloads = $this->toArray();

        return $this->request->post($endpoint, $payloads);
    }
}
