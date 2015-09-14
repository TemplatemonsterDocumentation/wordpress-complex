<?php 
include_once 'functions.php';

$path = dirname($_SERVER['PHP_SELF']);

/**
 * List of allowed project names
 * @var array
 */
$allowedProjects = array('cherryframework4', 'wordpress', 'monstroid', 'woocommerce');
$defaultProject = $project = $allowedProjects[0];
if (isset($_REQUEST['project'])) {
    $project = allowedParameterValue($_REQUEST['project'], $allowedProjects);
}

/**
 * Project text logo and project title depending on project name
 */
switch ($project) {
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
    default:
        $projectTextLogo = '';
        $projectTitle = 'Cherry Framework 4 Documentation';     
        break;
}

/**
 * Project image logo path
 * @var string
 */
$projectImgLogoPath = $path . "/img/logo.png";
if (file_exists(dirname(__FILE__) . "/img/logo_" . $project . ".png")) {
    $projectImgLogoPath = $path . "/img/logo_" . $project . ".png";
}

/**
 * Project favicon path
 * @var string
 */
$projectFaviconPath = $path . "/img/favicon.ico";
if (file_exists(dirname(__FILE__) . "/img/favicon_" . $project . ".ico")) {
    $projectFaviconPath = $path . "/img/favicon_" . $project . ".ico";
}

/**
 * List of available languages
 * @var array
 */
$allowedLanguages = array('en');
$lang = $allowedLanguages[0];
if (isset($_REQUEST['lang'])) {
    $lang = allowedParameterValue($_REQUEST['lang'], $allowedLanguages);
}

/**
 * Section parameter
 * @var string
 */
$_sections = getSections($project);
$section_param = $_sections[0];
if (isset($_GET['section'])) {
	$section_param = $_GET['section'];
}

if (isset($_GET['utm_campaign'])) {
	header('Location: index.php');
}