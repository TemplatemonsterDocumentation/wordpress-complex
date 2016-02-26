<?php

defined( 'DS' ) or define( 'DS', DIRECTORY_SEPARATOR );

$document_root = addslashes( realpath( __DIR__ ) );
//$document_root = addslashes( realpath( dirname( $_SERVER['DOCUMENT_ROOT'] ) ) . DS );
$relative_dir = addslashes( $_SERVER['REQUEST_URI'] );

if ( strpos( $relative_dir, 'index.php' ) > -1 ) {
  $relative_dir = explode( 'index.php', $relative_dir )[0];
}

defined( 'DOCUMENT_ROOT' ) or define( 'DOCUMENT_ROOT', $document_root );
defined( 'RELATIVE_DIR' ) or define( 'RELATIVE_DIR', $relative_dir );

include_once 'functions.php';

$projectList = get_projects_list();

/**
 * List of allowed project names
 * @var array
 */
$allowedProjects = array_keys($projectList);

$defaultProject = $project = isset( $allowedProjects[0] ) ? $allowedProjects[0] : ''; // default project equals first object in array above
if (isset($_REQUEST['project'])) {
    $project = allowedParameterValue($_REQUEST['project'], $allowedProjects);
}

/**
 * Project text logo and project title depending on project name
 */
$projectTitle        = 'TM Wordpress';
$projectTextLogo     = '';
$projectTitleCaption = '';
if ( true === isset( $projectList[ $project ] ) ) {
	$projectTitle        = $projectList[ $project ]['title'];
	$projectTextLogo     = $projectList[ $project ]['textLogo'];
	$projectTitleCaption = $projectList[ $project ]['titleCaption'];
}

/**
 * Project image logo path
 * @var string
 */
$projectImgLogoPath = RELATIVE_DIR . 'img/logo.png';
if (file_exists(DOCUMENT_ROOT . "/projects/".$project."/img/logo_" . $project . ".png")) {
    $projectImgLogoPath = RELATIVE_DIR . "projects/".$project."/img/logo_" . $project . ".png";
}

/**
 * Project favicon path
 * @var string
 */
$projectFaviconPath = RELATIVE_DIR . "img/favicon.ico";
if (file_exists(DOCUMENT_ROOT . RELATIVE_DIR . "/projects/".$project."/img/favicon_" . $project . ".ico")) {
    $projectFaviconPath = RELATIVE_DIR ."projects/".$project."/img/favicon_" . $project . ".ico";
}

/**
 * List of available languages
 * @var array
 */
$allowedLanguages = array('en', 'ru', 'es');
$lang = $allowedLanguages[0];
if (isset($_REQUEST['lang'])) {
    $lang = allowedParameterValue($_REQUEST['lang'], $allowedLanguages);
}

/**
 * Section parameter
 * @var string
 */
$_sections = getSections($project, $defaultProject);
$section_param = $_sections[0];
if (isset($_GET['section'])) {
	$section_param = $_GET['section'];
}

if (isset($_GET['utm_campaign'])) {
	header('Location: index.php');
}
