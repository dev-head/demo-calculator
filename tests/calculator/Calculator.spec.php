<?php

require_once __DIR__ . '/bootstrap.php';

use \devhead\Calculator\Calculator;

describe ('Calculator', function() {

    beforeEach(function () {
        $this->calculator   = new Calculator();

        $this->equations    = [
            ['3 2 +', 5],
            ['3 2 -', 1],
            ['3 2 *', 6],
            ['3 2 x', 6],
            ['3 2 %', 1],
            ['3 2 ^', 9],
            ['10 1 -', 9]
        ];

    });

    describe('->calculate()', function(){

        it('should be an instance of Calculator', function(){
            expect($this->calculator)->to->be->an->instanceof('\devhead\Calculator\Calculator');
        });

        it ('should correctly calculate the equations', function(){
            $equations  = $this->equations;
            for ($i = 0; $i < $c = count($equations); $i++){
                $expression = $this->equations[$i][0];
                $expected   = $this->equations[$i][1];
                $result     = $this->calculator->calculate($expression);
                expect($result)->to->equal($expected);
            }
        });

    });

});
