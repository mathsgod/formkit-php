<?php

namespace FormKit;

use DOMText;
use JsonSerializable;

class SchemaDOMNode extends Schema\Node implements JsonSerializable
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
