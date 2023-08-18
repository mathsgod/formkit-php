<?php

namespace FormKit\Schema;

use DOMElement;

class Node extends DOMElement
{

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
