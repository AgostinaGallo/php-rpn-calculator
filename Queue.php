<?php

final class Queue
{
    //pointer to the front of the queue
    private ?QNode $myFront;
    //pointer to the back of the queue
    private ?QNode $myBack;

    public function __construct()
    {
        // create an empty Queue
        $this->myFront = null;
        $this->myBack = null;
    }

    //return true if Queue is empty, otherwise return false
    public function isEmpty(): bool
    {
        return $this->myFront == null;
    }

    //add a new value to the back of the Queue
    public function addQ(string $newValue): void
    {
        $node = new QNode($newValue);

        if ($this->isEmpty()) {
            $this->myFront = $node;
            $this->myBack = $node;
        } else {
            $this->myBack->next = $node;
            $this->myBack = $node;
        }
    }

    //retrieve the data at the front of the Queue
    public function front(&$x): void
    {
        if ($this->isEmpty()) {
            return;
        }

        $x = $this->myFront->data;
    }

    //remove the value at the front of the Queue
    public function removeQ(): void
    {
        if ($this->isEmpty()) {
            return;
        }

        $this->myFront = $this->myFront->next;
        if ($this->myFront === null) {
            $this->myBack = null;
        }
    }

    //displays the data stored in the Queue (front to back)
    public function display()
    {
        echo "\n👀 Expressions in the queue awaiting evaluation:\n";
        $current = $this->myFront;
        while ($current != null) {
            echo "{$current->data}\n";
            $current = $current->next;
        }
        echo PHP_EOL;
    }
}

class QNode
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
