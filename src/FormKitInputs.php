<?php

namespace FormKit;

use DOMElement;
use DOMText;
use JsonSerializable;

class FormKitInputs  extends DOMElement implements JsonSerializable
{
    public function appendHTML(string $html): array
    {
        /** @var Schema $schema */
        $schema = $this->ownerDocument;
        $nodes = $schema->appendHTML($html);
        foreach ($nodes as $node) {
            $this->appendChild($node);
        }
        return $nodes;
    }

    /**
     * Text for help text associated with the input.
     */
    public function help(string $help)
    {
        $this->setAttribute("help", $help);
        return $this;
    }

    public function delay(int $delay)
    {
        $this->setAttribute("delay", $delay);
        return $this;
    }

    /**
     * The unique id of the input. Providing an id also allows the input’s node to be globally accessed.
     */
    public function id(string $id)
    {
        $this->setAttribute("id", $id);
        return $this;
    }

    /**
     * Allows an input to be inserted at the given index if the parent is a list. If the input’s value is undefined, it inherits the value from that index position. If it has a value it inserts it into the lists’s values at the given index.
     */
    public function index(int $index)
    {
        $this->setAttribute("index", $index);
        return $this;
    }

    /**
     * The name of the input as identified in the data object. This should be unique within a group of fields.
     */
    public function name($value)
    {
        $this->setAttribute("name", $value);
        return $this;
    }

    /**
     * Specifies an icon to put in the prefixIcon section.
     */
    public function prefixIcon(string $prefixIcon)
    {
        $this->setAttribute("prefix-icon", $prefixIcon);
        return $this;
    }

    /**
     * Specifies an icon to put in the suffixIcon section.
     */
    public function suffixIcon(string $suffixIcon)
    {
        $this->setAttribute("suffix-icon", $suffixIcon);
        return $this;
    }

    /**
     * The validation rules to be applied to the input.
     */
    public function validation(string|array $validation)
    {
        $this->setAttribute(":validation", json_encode($validation, JSON_UNESCAPED_UNICODE));
        return $this;
    }

    /**
     * Determines when to show an input's failing validation rules. Valid values are blur, dirty, and live.
     */
    public function validationVisibility(string $validationVisibility)
    {
        $this->setAttribute("validation-visibility", $validationVisibility);
        return $this;
    }

    /**
     * Determines what label to use in validation error messages, by default it uses the label prop if available, otherwise it uses the name prop.
     */
    public function validationLabel(string $validationLabel)
    {
        $this->setAttribute("validation-label", $validationLabel);
        return $this;
    }

    public function validationMessages(array $validationMessages)
    {
        $this->setAttribute(":validation-messages", json_encode($validationMessages, JSON_UNESCAPED_UNICODE));
        return $this;
    }

    /**
     * Text for the label element associated with the input.
     */
    public function label(string $val)
    {
        $this->setAttribute("label", $val);
        return $this;
    }

    public function jsonSerialize()
    {
        $type = $this->getAttribute("type");

        $data = [
            '$formkit' => $type,
        ];

        foreach ($this->attributes as $attr) {

            if ($attr->name[0] == ":") {
                //decode json
                $data[substr($attr->name, 1)] = json_decode($attr->value);
                continue;
            }

            $data[$attr->name] = $attr->value === "" ? true : $attr->value;
        }
        //remove type
        unset($data["type"]);

        $data["children"] = array_map(function ($node) {
            if ($node instanceof DOMText) {
                return $node->nodeValue;
            }
            return $node;
        }, iterator_to_array($this->childNodes));

        //if no children, remove children
        if (count($data["children"]) === 0) {
            unset($data["children"]);
        }


        return $data;
    }
}
