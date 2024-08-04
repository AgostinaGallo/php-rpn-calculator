# Reverse Polish Notation (RPN) Calculator in PHP

## Introduction

This project showcases a PHP solution for implementing a Reverse Polish Notation (RPN) calculator using stacks and queues. The implementation includes custom Stack and Queue classes, which utilize linked lists to manage the data. The program allows users to input RPN expressions, store them in a queue, evaluate the expressions, and display them.

## Description

Reverse Polish Notation (RPN) is a mathematical notation in which every operator follows all of its operands. It is also known as postfix notation. This project involves creating a menu-driven program that allows users to enter RPN expressions, evaluate them, and display all entered expressions that have not been evaluated.

### Key Features:

1. **Stack Implementation**: A stack class that supports typical stack operations like push, pop, top, and display.
2. **Queue Implementation**: A queue class that supports typical queue operations like add, remove, front, and display.
3. **RPN Expression Handling**: The program can enter, evaluate, and display RPN expressions using the stack and queue classes.

## Task

The task was to implement a stack and a queue using linked lists and then use these data structures to create a program that evaluates RPN expressions. Below are the provided class definitions and the core functionality of the program.

### Provided Class Definitions

```php
// Stack PHP
class Stack {
    private $myTop; // pointer to the top of the stack

    public function __construct() {} // create an empty Stack
    public function empty() {} // return true if stack is empty, otherwise return false
    public function push($x) {} // add a new value to the top of the stack
    public function top(&$x) {} // retrieves the data that is at the top of the stack
    public function pop() {} // removes the value at the top of the stack
    public function display() {} // displays the data stored in the stack
}

class Node {
    public $data;
    public $next;

    public function __construct($data) {}
}

// Queue PHP
class Queue {
    private $myFront; // pointer to the front of the queue
    private $myBack; // pointer to the back of the queue

    public function __construct() {} // create an empty Queue
    public function empty() {} // return true if Queue is empty, otherwise return false
    public function addQ($x) {} // add a new value to the back of the Queue
    public function front(&$x) {} // retrieve the data at the front of the Queue
    public function removeQ() {} // remove the value at the front of the Queue
    public function display() {} // displays the data stored in the Queue (front to back)
}

class QNode {
    public $data;
    public $next;

    public function __construct($data) {}
}
```
