<?php

namespace FormKit\Inputs;
class Email extends \FormKit\FormKitInputs
{
    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#accept
     */
    function accept(string $accept)
    {
        $this->setAttribute("accept", $accept);
        return $this;
    }

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#capture
     */
    function capture(bool $capture)
    {
        $this->setAttribute("capture", $capture);
        return $this;
    }

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#multiple
     */
    function multiple(bool $multiple)
    {
        if ($multiple) {
            $this->setAttribute("multiple", "");
        } else {
            $this->removeAttribute("multiple");
        }
        return $this;
    }

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#webkitdirectory
     */
    function webkitdirectory(bool $webkitdirectory)
    {
        if ($webkitdirectory) {
            $this->setAttribute("webkitdirectory", "");
        } else {
            $this->removeAttribute("webkitdirectory");
        }
        return $this;
    }


    /**
     * 	Specifies an icon to put in the fileItemIcon section. Only shows when there is a file selected. Defaults to the fileDoc icon.
     */
    function fileItemIcon(string $fileItemIcon)
    {
        $this->setAttribute("file-item-icon", $fileItemIcon);
        return $this;
    }

    /**
     * Specifies an icon to put in the fileRemoveIcon section. Only shows when a file is selected. Defaults to the close icon.
     */
    function fileRemoveIcon(string $fileRemoveIcon)
    {
        $this->setAttribute("file-remove-icon", $fileRemoveIcon);
        return $this;
    }

    /**
     * no-files-icon
     */
    function noFilesIcon(string $noFilesIcon)
    {
        $this->setAttribute("no-files-icon", $noFilesIcon);
        return $this;
    }
}
