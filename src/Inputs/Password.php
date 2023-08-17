<?php

namespace FormKit\Inputs;


class Password extends \FormKit\FormKitInputs
{
    public function maxLength(int $val)
    {
        $this->setAttribute("maxlength", $val);
        return $this;
    }

    public function minLength(int $val)
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
