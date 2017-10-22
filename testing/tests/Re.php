<?php

namespace SpencerMortensen\RegularExpressions;


// Test
$output = Re::quote($input);

// Input
$input = "x\n'\"^.$\x03";

// Output
$output = "x\n'\"\\^\\.\\$\\\x03";


// Test
$matches = Re::split($expression, $input, $flags);

// Input
$expression = ',\s*';
$input = '';
$flags = '';

// Output
$matches = array();

// Input
$expression = ',\s*';
$input = ',';
$flags = '';

// Output
$matches = array();

// Input
$expression = ',\s*';
$input = 'a';
$flags = '';

// Output
$matches = array('a');

// Input
$expression = ',\s*';
$input = 'a,b';
$flags = '';

// Output
$matches = array('a', 'b');

// Input
$expression = ',\s*';
$input = ', a, , b, ';
$flags = '';

// Output
$matches = array('a', 'b');


// Test
$isMatch = Re::match($expression, $input, $match, $flags);

// Input
$expression = 'a+';
$input = 'baaa';
$flags = '';

// Output
$isMatch = true;
$match = 'aaa';

// Input
$expression = 'a+';
$input = 'baaa';
$flags = 'A';

// Output
$isMatch = false;
$match = null;

// Input
$expression = '^([0-9]+)\\s*-\\s*([0-9]+)$';
$input = '3 - 1';
$flags = '';

// Output
$isMatch = true;
$match = array('3 - 1', '3', '1');
