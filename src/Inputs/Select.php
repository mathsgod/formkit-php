<?php

namespace FormKit\Inputs;


class Select extends \FormKit\FormKitInputs
{
    public function options(array $options)
    {
        $this->setAttribute(":options", json_encode($options));
        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->setAttribute("placeholder", $placeholder);
        return $this;
    }

    public function selectIcon(string $icon)
    {
        $this->setAttribute("select-icon", $icon);
        return $this;
    }
}
