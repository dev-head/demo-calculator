<?php

require_once __DIR__ . '/bootstrap.php';

use \devhead\Calculator\Operator\OperatorFactory;

describe ('OperatorFactory', function() {

    describe('::getInstance()', function(){

        it ('should create an instance', function(){
            $operator_factory    = OperatorFactory::getInstance();
            expect($operator_factory)->to->be->an->instanceof('\devhead\Calculator\Operator\OperatorFactory');
        });

    });

    describe('::getOperators()', function(){

        it ('should give us an array of operators', function(){
            $operators  = OperatorFactory::getInstance()->getOperators();
            expect($operators)->to->not->be->empty();
        });

    });

});
