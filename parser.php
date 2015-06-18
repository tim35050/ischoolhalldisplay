<?php

// FEED PARAMETERS
$PROFILES_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-profiles";
$PROJECTS_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-mims-projects";

// SLIDESHOW PARAMETERS
// see api here: http://jquery.malsup.com/cycle2/api/
$CYCLE_FX = "scrollHorz";
$CYCLE_SPEED = 800;
$CYCLE_TIMEOUT = 5000;

// Load feed into variables
$profiles_xml = simplexml_load_file($PROFILES_URL) or die("Error: Cannot create profiles object");
$projects_xml = simplexml_load_file($PROJECTS_URL) or die("Error: Cannot create projects object");

$slides = array();

foreach($profiles_xml->children() as $node) { 
    $format = 
    	'<div class="slide-container">
            <img src="%s">
            <div class="text-container">
                <div class="title">%s</div>
                <div class="teaser-text">%s</div>
            </div>
        </div>';
	$slides[] = sprintf($format, 
						$node->teaser_image_original, 
						$node->title, 
						$node->teaser_text);
}

foreach($projects_xml->children() as $node) { 
    $format = 
    	'<div class="slide-container">
            <img src="%s">
            <div class="text-container">
                <div class="title">%s</div>
                <div class="teaser-text">%s</div>
                <div class="students">%s</div>
                <div class="year">%s</div>
            </div>
        </div>';
	$slides[] = sprintf($format, 
						$node->teaser_image_original, 
						$node->title, 
						$node->teaser_text,
						$node->students,
						$node->year);
}

shuffle($slides);
$slides_combined = implode('', $slides);

?>