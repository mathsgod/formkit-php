<?php

namespace FormKit\Schema;

use DOMElement;
use FormKit\Component;
use FormKit\SchemaDOMNode;
use JsonSerializable;

class Node extends DOMElement implements JsonSerializable
{

    protected $if;
    protected $then;
    protected $for;
    protected $else;

    public function jsonSerialize()
    {
        $data = [];

        if ($this->if) {
            $data["if"] = $this->if;
        }

        if ($this->then) {
            $data["then"] = $this->then;
        }

        if ($this->for) {
            $data["for"] = $this->for;
        }

        if ($this->else) {
            $data["else"] = $this->else;
        }

        return $data;
    }

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
        $this->if = $if;
        return $this;
    }

    public function then(string|array $then)
    {
        $this->then = $then;
        return $this;
    }

    public function for(array $for)
    {
        $this->for = $for;
        return $this;
    }

    public function else(string|array $else)
    {
        $this->else = $else;
        return $this;
    }
}
