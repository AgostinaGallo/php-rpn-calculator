<?php

final class Stack
{
    //pointer to the top of the stack
    private ?Node $myTop;

    public function __construct()
    {
        // create an empty Stack
        $this->myTop = null;
    }

    //return true if stack is empty, otherwise return false
    public function isEmpty(): bool
    {
        return is_null($this->myTop);
    }

    //add a new value to the top of the stack
    public function push($newValue): void
    {
        if (empty($newValue)) {
            return;
        }

        $node = new Node($newValue);
        $node->next = $this->myTop;
        $this->myTop = $node;
    }

    //retrieves the data that is at the top of the stack
    public function top(&$x): void
    {
        if ($this->isEmpty()) {
            return;
        }
        $x = $this->myTop->data;
    }

    //removes the value at the top of the stack
    public function pop()
    {
        if ($this->isEmpty()) {
            throw new Exception("Stack is empty");
        }

        $data = $this->myTop->data;
        $this->myTop = $this->myTop->next;
        return $data;
    }

    public function display(): void
    {
        $current = $this->myTop;

        while ($current != null) {
            echo "{$current->data} ";
            $current = $current->next;
        }
        echo PHP_EOL;
    }
}

class Node
{
    public $next;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
