<?php
namespace exmosis\Notebooks;

class NotebookParser {

	private $init_url_path;
	private $notebook_dir;

	public function __construct(string $notebook_dir, string $url_path) {

		$this->setNotebookDir($notebook_dir);
		$this->setInitUrlPath($url_path);

	}

	/**
	 * @throws Exception	if further functions throw exceptions.
	 */
	public function run() {

		$this->validateInitialUrlPath(); // throws exception if invalid

		$target_file = $this->convertUrlPathToFileRef($this->getInitUrlPath());

		$this->validateFileRef($target_file);

		echo $this->getParsedContent($target_file);

	}

	/** 
	 * Set the directory to look for notes in - any '/' characters in the path will translate into directories.
	 *
	 * @param $notebook_dir	String	Directory to use
	 */
	public function setNotebookDir(string $notebook_dir) {
		$this->notebook_dir = $notebook_dir;
	}

	/**
	 * Fetch the current base directory to look for notes in.
	 *
	 * @return String Current directory being used
	 */
	public function getNotebookDir() {
		return $this->notebook_dir;
	}

	/**
	 * Set the URL path to use when parsing a file
	 *
	 * @param $url_path string Web path to use
	 */
	public function setInitUrlPath(string $url_path) {
		$this->init_url_path = $url_path;
	}

	/**
	 * Get the URL path currently set.
	 *
	 * @return String URL path to be used for processing.
	 */
	public function getInitUrlPath() {
		return $this->init_url_path;
	}

	/**
	 * Check the URL path set is valid.
	 *
	 * Actually, this doesn't need to do anything just yet.
	 *
	 * @throws Exception if invalid URL path set.
	 */
	public function validateInitialUrlPath() {
	}

	/**
	 * Take a path and convert it into a target file in the filesystem.
	 * File may or may not exist.
	 *
	 * @param $url_path String	URL path to use
	 * @return String	Filepath that corresponds to URL path
	 */
	public function convertUrlPathToFileRef(string $url_path) {

		$file = $url_path;

		$file .= '.md';

		// TODO: Also look for mkd files?

		return $file;

	}

	/**
	 * Run basic checks on given file.
	 *
	 * @param $target_file	String	File (including path) to check
	 * @throws Exception 	if failure encountered while validating
	 */
 	public function validateFileRef(string $target_file) {
	}

	/**
	 * Returns the parsed content from the given file.
	 *
	 * @param $target_file	String	Reference to target file
	 * @return String Parsed content from file
	 * @throws Exception	If file not found or other error
	 */
	public function getParsedContent($target_file) {

		$file_contents = file_get_contents($this->getNotebookDir() . DIRECTORY_SEPARATOR . $target_file);
		if (false === $file_contents) {
			throw new Exception('Could not open file');
		}

		require_once('ext/parsedown/Parsedown.php');

		$pd = new \Parsedown();

		return $pd->text($file_contents);

	}


}

