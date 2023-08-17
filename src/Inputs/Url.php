<?php

namespace FormKit\Inputs;

class Url extends \FormKit\FormKitInputs
{
    public function maxlength(int $val)
    {
        $this->setAttribute("maxlength", $val);
        return $this;
    }

    public function minlength(int $val)
    {
        $this->setAttribute("minlength", $val);
        return $this;
    }

    public function placeholder(string $val)
    {
        $this->setAttribute("placeholder", $val);
        return $this;
    }
}
