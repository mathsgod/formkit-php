<?php

namespace FormKit;


use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;
use JsonSerializable;

class Schema extends DOMDocument implements JsonSerializable
{
    private $nodeClasses = [];
    private $inputClasses = [];
    private $defaultDOMNode = SchemaDOMNode::class;

    public function __construct()
    {
        parent::__construct("1.0", "utf-8");
        $this->formatOutput = false;

        $this->registerClass("form-kit", FormKitInputs::class);
        $this->registerClass("form-kit-schema", FormKitSchema::class);



        $this->registerInputClass("text", Inputs\Text::class);
        $this->registerInputClass("checkbox", Inputs\Checkbox::class);
        $this->registerInputClass("color", Inputs\Color::class);
        $this->registerInputClass("date", Inputs\Date::class);
        $this->registerInputClass("datetime-local", Inputs\DatetimeLocal::class);
        $this->registerInputClass("email", Inputs\Email::class);
        $this->registerInputClass("file", Inputs\File::class);
        $this->registerInputClass("form", Inputs\Form::class);
        $this->registerInputClass("group", Inputs\Group::class);
        $this->registerInputClass("hidden", Inputs\Hidden::class);
        $this->registerInputClass("list", Inputs\_List::class);
        $this->registerInputClass("month", Inputs\Month::class);
        $this->registerInputClass("number", Inputs\Number::class);
        $this->registerInputClass("password", Inputs\Password::class);
        $this->registerInputClass("radio", Inputs\Radio::class);
        $this->registerInputClass("range", Inputs\Range::class);
        $this->registerInputClass("search", Inputs\Search::class);
        $this->registerInputClass("select", Inputs\Select::class);
        $this->registerInputClass("submit", Inputs\Submit::class);
        $this->registerInputClass("tel", Inputs\Tel::class);
        $this->registerInputClass("textarea", Inputs\Textarea::class);
        $this->registerInputClass("time", Inputs\Time::class);
        $this->registerInputClass("url", Inputs\Url::class);
        $this->registerInputClass("week", Inputs\Week::class);
    }

    public function appendElement(string $name): SchemaDOMNode
    {
        return $this->appendHTML("<{$name}></{$name}>")[0];
    }

    public function appendComponent(string $name): Component
    {
        //check to kebab case
        $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));

        //if component is not registered, use default
        if (!$this->hasNodeClass($name)) {
            $this->registerClass($name, Component::class);
        }

        return $this->appendHTML("<{$name}></{$name}>")[0];
    }

    public function hasNodeClass(string $tagName): bool
    {
        return isset($this->nodeClasses[$tagName]);
    }

    public function createElement(string $localName, string $value = '')
    {
        if (isset($this->nodeClasses[$localName])) {
            $this->registerNodeClass(DOMElement::class, $this->nodeClasses[$localName]);
        } else {
            $this->registerNodeClass(DOMElement::class, $this->defaultDOMNode);
        }
        return parent::createElement($localName, $value);
    }

    public function importNode(DOMNode $node, $deep = false): DOMNode
    {

        if ($node instanceof \DOMElement) {

            if ($node->tagName === "form-kit") {
                $typeClass = $this->inputClasses[$node->attributes->getNamedItem("type")->nodeValue];
                if ($typeClass) {
                    $this->registerNodeClass(DOMElement::class, $typeClass);
                    $n = parent::createElement($node->tagName);
                } else {
                    $n = $this->createElement($node->tagName);
                }
            } else {
                $n = $this->createElement($node->tagName);
            }

            foreach ($node->attributes as $attr) {
                $n->appendChild($this->importNode(clone $attr));
            }

            if ($deep) {
                foreach ($node->childNodes as $child) {
                    $n->appendChild($this->importNode(clone $child, true));
                }
            }
        } else {
            $n = parent::importNode($node, true);
        }

        return $n;
    }


    public function registerClass(string $tagName, string $className)
    {
        $this->nodeClasses[$tagName] = $className;
    }

    public function registerInputClass(string $type, string $className)
    {
        $this->inputClasses[$type] = $className;
    }

    public function registerDefaultDOMNodeClass(string $className)
    {
        $this->defaultDOMNode = $className;
    }

    private $nodes = [];

    public function appendHTML(string $html)
    {
        $option = 0;
        if (LIBXML_VERSION >= 20621) {
            $option |=  LIBXML_COMPACT;
        }


        if (LIBXML_VERSION >= 20708) {
            $option |= LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;
        }

        $document = new DOMDocument();
        $document->loadHTML(mb_convert_encoding("<div>" . $html . "</div>", 'HTML-ENTITIES', 'UTF-8'), $option);

        $nodes = [];
        foreach ($document->childNodes[0]->childNodes as $node) {
            $n = $this->appendChild($this->importNode($node, true));
            $nodes[] = $n;
            $this->nodes[] = $n; //we need to keep a reference to the node to prevent it to change back to DOMElement
        }
        return $nodes;
    }

    public function jsonSerialize()
    {
        return array_map(function ($node) {
            if ($node instanceof DOMText) {
                return $node->nodeValue;
            }
            return $node;
        }, iterator_to_array($this->childNodes));
    }
}
