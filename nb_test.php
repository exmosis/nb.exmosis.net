<?php

/** Basic test script for NotebookParser **/

require_once('./Furniture.php');
require_once('./NotebookParser.php');

// Where do we keep notebooks?
define('NOTEBOOK_DIR', 'notebooks');

$page_furniture = new exmosis\Notebooks\Furniture();


$page_furniture->header();


$url = 'test'; // will try to find notebooks/test.md and process it

$notebook_parser = new exmosis\Notebooks\NotebookParser(NOTEBOOK_DIR, $url);
$notebook_parser->run();

echo "\n\n";

$url = '1/1'; // will try to find notebooks/test.md and process it

$notebook_parser = new exmosis\Notebooks\NotebookParser(NOTEBOOK_DIR, $url);
$notebook_parser->run();


$page_furniture->footer();

