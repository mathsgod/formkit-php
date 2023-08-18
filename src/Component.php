<?php

namespace FormKit;

use DOMText;
use JsonSerializable;

class Component extends Schema\Node implements JsonSerializable
{

    public function jsonSerialize()
    {
        $props = [];

        foreach ($this->attributes as $attr) {
            if ($attr->name[0] == ":") {
                //decode json
                $props[substr($attr->name, 1)] = json_decode($attr->value);
                continue;
            }

            $props[$attr->name] = $attr->value === "" ? true : $attr->value;
        }


        $data = [
            '$cmp' => $this->tagName,
            "props" => $props,
            "children" => array_map(function ($node) {
                if ($node instanceof DOMText) {
                    return $node->nodeValue;
                }
                return $node;
            }, iterator_to_array($this->childNodes))
        ];

        //if no children, remove children
        if (count($data["children"]) === 0) {
            unset($data["children"]);
        }

        return $data;
    }
}
