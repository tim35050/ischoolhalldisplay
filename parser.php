<?php

// FEED PARAMETERS
$PROFILES_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-profiles";
$PROJECTS_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-mims-projects";

// CYCLE2 PARAMETERS
// see api here: http://jquery.malsup.com/cycle2/api/
$CYCLE_FX = "scrollHorz";
$CYCLE_SPEED = 800;
$CYCLE_TIMEOUT = 10000;

// SLIDESHOW PARAMETERS
$NUM_SLIDES = -1; // -1 for all slides
$ONLY_PROFILES = False;
$ONLY_PROJECTS = False;

// Load feed into variables
$profiles_xml = simplexml_load_file($PROFILES_URL) or die("Error: Cannot create profiles object");
$projects_xml = simplexml_load_file($PROJECTS_URL) or die("Error: Cannot create projects object");

$slides = array();

if (!$ONLY_PROJECTS) {
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
}

if (!$ONLY_PROFILES) {
    foreach($projects_xml->children() as $node) { 
        $format = 
            '<div class="slide-container">
                <img class="projects" src="%s">
                <div class="text-container">
                    <div class="title projects">%s</div>
                    <div class="teaser-text projects">%s</div>
                    <div class="year">%s</div>
                    <div class="students">%s</div>
                </div>
            </div>';
        $slides[] = sprintf($format, 
                            $node->teaser_image_original, 
                            $node->title, 
                            $node->teaser_text,
                            $node->year,
                            $node->students);
    }
}


shuffle($slides);

if ($NUM_SLIDES > -1) {
    $slides = array_slice($slides, 0, $NUM_SLIDES);
}

$slides_combined = implode('', $slides);

