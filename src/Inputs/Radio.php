<?php

namespace FormKit\Inputs;


class Radio extends \FormKit\FormKitInputs
{
    /**
     * Specifies an icon to put in the decoratorIcon section. Shows when the radio is checked. Defaults to the radioDecorator icon.
     */
    public function decoratorIcon(string $decoratorIcon)
    {
        $this->setAttribute("decorator-icon", $decoratorIcon);
        return $this;
    }

    /**
     * An object of value/label pairs or an array of strings, or an array of objects that must contain a label and value property.
     */
    public function options(array $options)
    {
        $this->setAttribute(":options", json_encode($options, JSON_UNESCAPED_UNICODE));
        return $this;
    }
}
