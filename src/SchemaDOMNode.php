<?php

namespace FormKit;

use DOMText;
use JsonSerializable;

class SchemaDOMNode extends Schema\Node implements JsonSerializable
{

    public function jsonSerialize()
    {
        $attrs = [];

        foreach ($this->attributes as $attr) {
            if ($attr->name[0] == ":") {
                //decode json
                $props[substr($attr->name, 1)] = json_decode($attr->value);
                continue;
            }
            $attrs[$attr->name] = $attr->value === "" ? true : $attr->value;
        }

        $data = [
            '$el' => $this->tagName,
            "attrs" => $attrs,
            "children" => array_map(function ($node) {
                if ($node instanceof DOMText) {
                    return $node->nodeValue;
                }
                return $node;
            }, iterator_to_array($this->childNodes))
        ];

        //if no children, remove children key
        if (count($data["children"]) === 0) {
            unset($data["children"]);
        }

        //if no attrs, remove attrs key
        if (count($data["attrs"]) === 0) {
            unset($data["attrs"]);
        }


        $data = array_merge($data, parent::jsonSerialize());

        return $data;
    }
}
