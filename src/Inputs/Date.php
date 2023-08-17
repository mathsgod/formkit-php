<?php

namespace FormKit;

class Date extends \FormKit\FormKitInputs
{

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/date#min
     */
    public function min(int $min)
    {
        $this->setAttribute("min", $min);
        return $this;
    }

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/date#max
     */
    public function max(int $max)
    {
        $this->setAttribute("max", $max);
        return $this;
    }

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/date#step
     */
    public function step(int $step)
    {
        $this->setAttribute("step", $step);
        return $this;
    }
}
