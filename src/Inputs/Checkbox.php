<?php

namespace FormKit\Inputs;

class Checkbox extends \FormKit\FormKitInputs
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
        $this->setAttribute(":options", json_encode($options));
        return $this;
    }

    /**
     * The value when the checkbox is checked (single checkboxes only).
     */
    public function onValue($onValue)
    {
        $this->setAttribute("on-value", $onValue);
        return $this;
    }

    /**
     * The value when the checkbox is unchecked (single checkboxes only).
     */
    public function offValue($offValue)
    {
        $this->setAttribute("off-value", $offValue);
        return $this;
    }
}
