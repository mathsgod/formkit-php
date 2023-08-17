<?php

namespace FormKit\Inputs;


class _List extends \FormKit\FormKitInputs
{

    public function disabled(bool $disabled = true)
    {
        if ($disabled) {
            $this->setAttribute("disabled", "");
        } else {
            $this->removeAttribute("disabled");
        }
    }

    public function dynamic(bool $dynamic = true)
    {
        if ($dynamic) {
            $this->setAttribute("dynamic", "");
        } else {
            $this->removeAttribute("dynamic");
        }
    }
}
