<?php

namespace FormKit;

use DOMElement;
use DOMText;
use JsonSerializable;

class FormKit  extends DOMElement implements JsonSerializable
{

    public function jsonSerialize()
    {
        $type = $this->getAttribute("type");

        $data = [
            '$formkit' => $type,
        ];

        foreach ($this->attributes as $attr) {
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

        return $data;
    }
}
