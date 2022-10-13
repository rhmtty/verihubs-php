<?php

namespace Rhmt\Verihubs\Verihubs;

use Rhmt\Verihubs\Exceptions\VerihubsException;
use Rhmt\Verihubs\Requests\Request;

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
    public function setisQuality($isQuality)
    {
        $this->isQuality = $isQuality;
        return $this;
    }

    // Optional
    public function setIsAttribute($IsAttribute)
    {
        $this->IsAttribute = $IsAttribute;
        return $this;
    }

    // Optional
    public function setValidateQuality($ValidateQuality)
    {
        $this->ValidateQuality = $ValidateQuality;
        return $this;
    }

    // Optional
    public function setValidateAttribute($ValidateAttribute)
    {
        $this->ValidateAttribute = $ValidateAttribute;
        return $this;
    }

    /**
     * Getters
     */

    public function toArray()
    {
        return  [
            'image' => $this->image,
            'isQuality' => $this->isQuality,
            'isAttribute' => $this->isAttribute,
            'validateQuality' => $this->validateQuality,
            'validateAttribute' => $this->validateAttribute,
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
            if (!in_array($key, ['isQuality', 'isAttribute', 'validateQuality', 'validateAttribute']) && (is_null($properties[$key]) || empty($properties[$key]))) {
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

        $endpoint = '/face/liveness';
        $payloads = $this->toArray();

        return $this->request->post($endpoint, $payloads);
    }
}
