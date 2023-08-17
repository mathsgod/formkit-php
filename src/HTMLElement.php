<?php

namespace FormKit;

use DOMElement;
use DOMText;
use JsonSerializable;

class HTMLElement extends DOMElement implements JsonSerializable
{
    public function jsonSerialize()
    {
        $attrs = [];

        foreach ($this->attributes as $attr) {
            $attrs[$attr->name] = $attr->value === "" ? true : $attr->value;
        }

        return [
            '$el' => $this->tagName,
            "attrs" => $attrs,
            "children" => array_map(function ($node) {
                if ($node instanceof DOMText) {
                    return $node->nodeValue;
                }
                return $node;
            }, iterator_to_array($this->childNodes))
        ];
    }
}
