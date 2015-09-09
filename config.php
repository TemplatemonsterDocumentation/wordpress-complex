<?php 
include_once 'functions.php';

$path = dirname($_SERVER['PHP_SELF']);

/**
 * [$project description]
 * @var string
 */
$project = 'cherryframework4';
if (isset($_GET['project'])) {
	$project = $_GET['project'];
}

$projectName = "Monstroid Theme";

switch ($project) {
    case 'monstroid':
        $projectTextLogo = '<span>Monstroid</span><small>premium theme</small>';
        $projectTitle = 'Monstroid Premium Theme Documentation';
        break;
    case 'wordpress-themes':
        $projectTextLogo = '';
        $projectTitle = 'WordPress Themes Documentation v4-0';
        break;
     case 'woocommerce-themes':
        $projectTextLogo = '';
        $projectTitle = 'WooCommerce Themes Documentation v4-0';
        break;
    default:
        $projectTextLogo = '';
        $projectTitle = 'Cherry Framework 4 Documentation';
        break;
}

/**
 * Language
 * @var string
 */
$lang = 'en';
if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
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