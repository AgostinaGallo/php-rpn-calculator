<?php

require_once 'Stack.php';
require_once 'Queue.php';

$queue = new Queue();

executeMenu($queue);

function executeMenu(Queue $queue)
{
    while (true) {
        echo "Menu:\n";
        echo "1. Enter an expression\n";
        echo "2. Evaluate an expression\n";
        echo "3. Print all expressions that have not been evaluated\n";
        echo "4. Exit\n";
        $choice = trim(readline("👉 Enter your choice: "));
        switch ($choice) {
            case "1":
                $expression = trim(readline("\nEnter RPN expression: "));
                if (
                    false === isFilled($expression)
                    || false === validateRPNExpression($expression)
                ) {
                    break;
                }
                $queue->addQ($expression);
                echo PHP_EOL;
                break;
            case "2":
                if (!$queue->isEmpty()) {
                    $expression = "";
                    $queue->front($expression);
                    try {
                        $result = evaluateRPN($expression);
                        echo "\n✅ Result of expression RPN {$expression} = $result\n\n";
                        $queue->removeQ(); // Remove the expression from queue after evaluation
                    } catch (Exception $e) {
                        echo "\n❌ Error evaluating expression RPN {$expression}: " . $e->getMessage() . "\n\n";
                        $queue->removeQ(); // Remove the expression from queue even if it causes an error
                    }
                } else {
                    echo "\n ... There are no expressions to evaluate. Try adding at least one.\n\n";
                }
                break;
            case "3":
                $queue->display();
                echo PHP_EOL;
                break;
            case "4":
                echo "Exiting 👋";
                exit(0);
            default:
                echo "\n❌ Not valid option. Try again.\n\n";
        }
    }
}

function isFilled(?string $value = null): bool
{
    if (!isset($value) || empty($value)) {
        echo "\n⚠️  You must enter a value. Try again.\n\n";
        return false;
    }
    return true;
}

function validateRPNExpression(string $expression): bool
{
    $expressionCharacters = str_split($expression);
    $operandCount = 0;
    $operatorCount = 0;
    $requiredOperators = ['+', '-', '*', '/'];

    foreach ($expressionCharacters as $expressionChar) {
        if (is_numeric($expressionChar)) {
            $operandCount++;
        } elseif (in_array($expressionChar, $requiredOperators)) {
            $operatorCount++;
            if ($operandCount < 2) {
                echo "\n⚠️  Invalid expression: not enough operands for operator '$expressionChar'.\n\n";
                return false;
            }
            $operandCount--;
        } else {
            echo "\n⚠️  Invalid expression: contains invalid character '$expressionChar'.\n\n";
            return false;
        }
    }

    if ($operandCount != 1) {
        echo "\n⚠️  Invalid expression: leftover operands or insufficient operations.\n\n";
        return false;
    }

    return true;
}

function evaluateRPN($expression)
{
    // Dividir la expresión en tokens
    $expressionCharacters = str_split($expression);
    var_dump($expressionCharacters);
    // stack for operands
    $stack = new Stack();

    foreach ($expressionCharacters as $expressionChar) {
        // if char is numeric, add it to stack
        if (is_numeric($expressionChar)) {
            $stack->push(intval($expressionChar));
            // if char is one of valid operators
        } elseif (in_array($expressionChar, ['+', '-', '*', '/'])) {
            if ($stack->isEmpty()) {
                throw new Exception("Invalid expression: not enough operands for operator '$expressionChar'");
            }
            // get second operand from stack
            $secondOperand = $stack->pop();
            if ($stack->isEmpty()) {
                throw new Exception("Invalid expression: not enough operands for operator '$expressionChar'");
            }
            // get first operand from stack
            $firstOperand = $stack->pop();

            // make corresponding operation and add it to stack
            switch ($expressionChar) {
                case '+':
                    $stack->push($firstOperand + $secondOperand);
                    break;
                case '-':
                    $stack->push($firstOperand - $secondOperand);
                    break;
                case '*':
                    $stack->push($firstOperand * $secondOperand);
                    break;
                case '/':
                    if ($secondOperand == 0) {
                        throw new Exception("Division by zero error");
                    }
                    $stack->push($firstOperand / $secondOperand);
                    break;
                default:
                    throw new Exception("Invalid operator: $expressionChar");
            }
        } else {
            // If character is not number nor operand
            throw new Exception("Invalid character: $expressionChar");
        }
    }

    if ($stack->isEmpty()) {
        throw new Exception("Invalid expression: no result");
    }

    $result = $stack->pop();
    if (!$stack->isEmpty()) {
        throw new Exception("Invalid expression: too many operands");
    }

    return $result;
}
