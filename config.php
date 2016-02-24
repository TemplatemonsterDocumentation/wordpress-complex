<?php

include_once 'functions.php';

if ( false === defined('DOCUMENT_ROOT')) {
    define( 'DOCUMENT_ROOT', realpath( str_replace(
        array('/', '\\'),
        DIRECTORY_SEPARATOR,
        realpath( dirname( basename( __DIR__ ) ) )
    ) ) );
}

// Get relative path
$path = str_replace( array(
  realpath( $_SERVER['DOCUMENT_ROOT'] ),
  DIRECTORY_SEPARATOR,
), array(
  '',
  '/'
), __DIR__ );

$projectList = get_projects_list();

/**
 * List of allowed project names
 * @var array
 */
$allowedProjects = array_keys($projectList);

$defaultProject = $project = $allowedProjects[0]; // default project equals first object in array above
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
$projectImgLogoPath = $path . "/img/logo.png";
if (file_exists(dirname(__FILE__) . "/projects/".$project."/img/logo_" . $project . ".png")) {
    $projectImgLogoPath = $path . "/projects/".$project."/img/logo_" . $project . ".png";
}

/**
 * Project favicon path
 * @var string
 */
$projectFaviconPath = $path . "/img/favicon.ico";
if (file_exists(dirname(__FILE__) . "/projects/".$project."/img/favicon_" . $project . ".ico")) {
    $projectFaviconPath = $path ."/projects/".$project."/img/favicon_" . $project . ".ico";
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
