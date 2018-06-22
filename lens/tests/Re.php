<?php

namespace SpencerMortensen\RegularExpressions;


// Test
$isMatch = Re::match($expression, $input, $match, $flags);

// Cause
$expression = 'a+';
$input = 'baaa';
$flags = '';

// Effect
$isMatch = true;
$match = 'aaa';

// Cause
$expression = 'a+';
$input = 'baaa';
$flags = 'A';

// Effect
$isMatch = false;
$match = null;

// Cause
$expression = '^([0-9]+)\\s*-\\s*([0-9]+)$';
$input = '3 - 1';
$flags = '';

// Effect
$isMatch = true;
$match = ['3 - 1', '3', '1'];


// Test
$isMatch = Re::matches($expression, $input, $matches, $flags);

// Cause
$expression = 'a+';
$input = 'b';
$flags = '';

// Effect
$isMatch = false;
$matches = null;

// Cause
$expression = 'a+';
$input = 'ba';
$flags = '';

// Effect
$isMatch = true;
$matches = ['a'];

// Cause
$expression = 'a+';
$input = 'babaa';
$flags = '';

// Effect
$isMatch = true;
$matches = ['a', 'aa'];

// Cause
$expression = 'a+';
$input = 'BABAA';
$flags = '';

// Effect
$isMatch = false;
$matches = null;

// Cause
$expression = 'a+';
$input = 'BABAA';
$flags = 'i';

// Effect
$isMatch = true;
$matches = ['A', 'AA'];

// Cause
$expression = 'b(a+)';
$input = 'babaa';
$flags = '';

// Effect
$isMatch = true;
$matches = [['ba', 'a'], ['baa', 'aa']];


// Test
$output = Re::quote($input);

// Cause
$input = "x\n'\"^.$\x03";

// Effect
$output = "x\n'\"\\^\\.\\$\\\x03";


// Test
$output = Re::replace($expression, $replacement, $input, $flags);

// Cause
$expression = '[a-z]';
$replacement = '-';
$input = 'ab';
$flags = '';

// Effect
$output = '--';

// Cause
$expression = '[a-z]';
$replacement = '-';
$input = 'AB';
$flags = '';

// Effect
$output = 'AB';

// Cause
$expression = '[a-z]';
$replacement = '-';
$input = 'AB';
$flags = 'i';

// Effect
$output = '--';

// Cause
$expression = '^[a-z]([a-z])$';
$replacement = '$0,$1';
$input = 'ab';
$flags = '';

// Effect
$output = 'ab,b';


// Test
$matches = Re::split($expression, $input, $flags);

// Cause
$expression = ',\s*';
$input = '';
$flags = '';

// Effect
$matches = [];

// Cause
$expression = ',\s*';
$input = ',';
$flags = '';

// Effect
$matches = [];

// Cause
$expression = ',\s*';
$input = 'a';
$flags = '';

// Effect
$matches = ['a'];

// Cause
$expression = ',\s*';
$input = 'a,b';
$flags = '';

// Effect
$matches = ['a', 'b'];

// Cause
$expression = ',\s*';
$input = ', a, , b, ';
$flags = '';

// Effect
$matches = ['a', 'b'];
