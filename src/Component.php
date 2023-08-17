<?php

namespace FormKit;

use DOMElement;
use DOMText;
use JsonSerializable;

class Component extends DOMElement implements JsonSerializable
{
    public function jsonSerialize()
    {
        $props = [];

        foreach ($this->attributes as $attr) {
            $props[$attr->name] = $attr->value === "" ? true : $attr->value;
        }


        return [
            '$cmp' => $this->tagName,
            "props" => $props,
            "children" => array_map(function ($node) {
                if ($node instanceof DOMText) {
                    return $node->nodeValue;
                }
                return $node;
            }, iterator_to_array($this->childNodes))
        ];
    }
}
