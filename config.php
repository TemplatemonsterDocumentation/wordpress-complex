<?php

include_once 'functions.php';

//$path = dirname($_SERVER['PHP_SELF']);
//$path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://" . $_SERVER["SERVER_NAME"] . str_replace('//', '', '/' . trim(dirname($_SERVER["PHP_SELF"]), '/'));

if ( false === defined('DOCUMENT_ROOT')) {
    define('DOCUMENT_ROOT', str_replace(
        array('/', '\\'),
        DIRECTORY_SEPARATOR,
        $_SERVER['DOCUMENT_ROOT']
    ));
}

$path = '//' . $_SERVER['SERVER_NAME'] . str_replace(array(DOCUMENT_ROOT, '\\'), array('', '/'), __DIR__);

/**
 * List of allowed project names
 * @var array
 */

$allowedProjects = array('wildride', 'blogetti', 'cherryframework4', 'wordpress', 'monstroid', 'woocommerce');
//$allowedProjects = array('monstroid', 'cherryframework4', 'wordpress', 'woocommerce');
$defaultProject = $project = $allowedProjects[0]; // default project equals first object in array above
if (isset($_REQUEST['project'])) {
    $project = allowedParameterValue($_REQUEST['project'], $allowedProjects);
}

$projectName = $_REQUEST['project'];

/**
 * Project text logo and project title depending on project name
 */
switch ($project) {
    case 'blogetti':
        $projectTextLogo = '';
        $projectTitle = 'Blogetti';
        $projectTitleCaption = 'Slow-Cooker Alabamian';
        break;
    case 'wildride':
        $projectTextLogo = '';
        $projectTitle = 'Wild Ride';
        $projectTitleCaption = 'Bicycle NXT 3000 exhibited at CES in Vegas';
        break;
    case 'monstroid':
        $projectTextLogo = '<span>Monstroid</span><small>premium theme</small>';
        $projectTitle = 'Monstroid Premium Theme Documentation';
        break;
    case 'wordpress':
        $projectTextLogo = '';
        $projectTitle = 'WordPress Themes Documentation v4-0';
        break;
     case 'woocommerce':
        $projectTextLogo = '';
        $projectTitle = 'WooCommerce Themes Documentation v4-0';
        break;
     case 'cherryframework4':
        $projectTextLogo = '';
        $projectTitle = 'Cherry4';
        $projectTitleCaption = 'WorPress Framework';
        break;
    default:
        $projectTextLogo = '';
        $projectTitle = 'TM WordPress';
        break;
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