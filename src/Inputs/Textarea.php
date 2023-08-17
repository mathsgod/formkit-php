<?php

namespace FormKit\Inputs;

class Textarea extends \FormKit\FormKitInputs
{

    public function cols(int $val)
    {
        $this->setAttribute("cols", $val);
        return $this;
    }

    public function rows(int $val)
    {
        $this->setAttribute("rows", $val);
        return $this;
    }


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
