<?php

namespace FormKit\Input;

class Text extends \FormKit\FormKit
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
