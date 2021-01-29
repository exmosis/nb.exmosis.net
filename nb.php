<?php

/**
 * Take URL as $_GET['url'] param, 
 * convert it to a file reference in the notebooks directory
 * get the contents and parse the markdown
 * and serve it up.
 */

require_once('./Furniture.php');
require_once('./NotebookParser.php');

// Where do we keep notebooks?
define('NOTEBOOK_DIR', 'notebooks');


$url = $_GET['url'];

$page_furniture->header();

try {
	$notebook_parser = new exmosis\Notebooks\NotebookParser(NOTEBOOK_DIR, $url);
	$content = $notebook_parser->run();

	$page_furniture = new exmosis\Notebooks\Furniture();
	$page_furniture->header();
	echo $content;
	$page_furniture->footer();

} catch (Exception $e) {
	// error time.
}


