<?php

namespace FormKit;

use DOMText;
use JsonSerializable;

class Component extends Schema\Node implements JsonSerializable
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

    public function jsonSerialize()
    {
        $props = [];

        foreach ($this->attributes as $attr) {
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
