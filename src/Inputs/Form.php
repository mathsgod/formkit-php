<?php

namespace FormKit;

class Form extends \FormKit\FormKitInputs
{
    /**
     * Disables the form submit button and all the inputs in the form.
     */
    function disabled(bool $disabled = true)
    {
        if ($disabled === true) {
            $this->setAttribute("disabled", "");
        } else {
            $this->removeAttribute("disabled");
        }
        return $this;
    }

    /**
     * The message that is shown to near the submit button when a user attempts to submit a form, but not all inputs are valid.
     */
    function incompleteMessage(string|bool $incompleteMessage)
    {
        if ($incompleteMessage === false) {
            $this->removeAttribute("incomplete-message");
            return $this;
        } else {
            $this->setAttribute("incomplete-message", $incompleteMessage);
        }
        return $this;
    }


    /**
     * Attributes or props that should be passed to the built-in submit button.
     */
    function submitAttrs(array $submitAttrs)
    {
        $this->setAttribute(":submit-attrs", json_encode($submitAttrs, JSON_UNESCAPED_UNICODE));
        return $this;
    }


    /**
     * Async submit handlers automatically disable the form while pending, you can change this by setting this prop to 'live'.
     */
    function submitBehavior(string $submitBehavior)
    {
        $this->setAttribute("submit-behavior", $submitBehavior);
        return $this;
    }

    /**
     * The label to use on the built-in submit button.
     */
    function submitLabel(string $submitLabel)
    {
        $this->setAttribute("submit-label", $submitLabel);
        return $this;
    }

    /**
     * Whether or not to include the actions bar at the bottom of the form (ex. you want to remove the submit button and use your own, set this to false).
     */
    function actions(bool $actions = true)
    {
        if ($actions === true) {
            $this->setAttribute("actions", "");
        } else {
            $this->removeAttribute("actions");
        }
        return $this;
    }
}
