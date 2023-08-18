<?php

namespace FormKit\Schema;

use DOMElement;
use FormKit\Component;
use FormKit\SchemaDOMNode;

class Node extends DOMElement
{

    public function appendElement(string $name): SchemaDOMNode
    {
        return $this->appendHTML("<{$name}></{$name}>")[0];
    }

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

    public function appendComponent(string $name): Component
    {
        //check to kebab case
        $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));

        /** @var \FormKit\Schema $schema */
        $schema = $this->ownerDocument;

        //if component is not registered, use default
        if (!$schema->hasNodeClass($name)) {
            $schema->registerClass($name, Component::class);
        }

        return $this->appendHTML("<{$name}></{$name}>")[0];
    }

    public function if(string $if)
    {
        $this->setAttribute('if', $if);
        return $this;
    }

    public function then(string|array $then)
    {
        $this->setAttribute(':then', json_encode($then, JSON_UNESCAPED_UNICODE));
        return $this;
    }

    public function for(array $for)
    {
        $this->setAttribute(':for', json_encode($for, JSON_UNESCAPED_UNICODE));
        return $this;
    }

    public function else(string|array $else)
    {
        $this->setAttribute(':else', json_encode($else, JSON_UNESCAPED_UNICODE));
        return $this;
    }
}
