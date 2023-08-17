<?php

namespace FormKit\Inputs;
class Group  extends \FormKit\FormKitInputs
{
    /**
     * Disables all the inputs in the group.
     */
    public function disabled(bool $disabled = true)
    {
        if ($disabled === true) {
            $this->setAttribute("disabled", "");
        } else {
            $this->removeAttribute("disabled");
        }
        return $this;
    }
}
