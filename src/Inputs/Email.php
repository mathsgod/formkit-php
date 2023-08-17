<?php

namespace FormKit;

class Email extends \FormKit\FormKitInputs
{
    public function placeholder(string $placeholder)
    {
        $this->setAttribute("placeholder", $placeholder);
        return $this;
    }
}
