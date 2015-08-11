<?php 
include_once 'config.php';
include_once 'functions.php';

// Get Sections
if (!isset($sections)) {
	$sections = getSections($project);
}

includeSection($sections, $lang, $section_param, $project);