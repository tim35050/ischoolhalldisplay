<?php

// FEED PARAMETERS
$PROFILES_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-profiles";
$MIMS_PROJECTS_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-mims-projects";
$MIDS_PROJECTS_URL = "http://www.ischool.berkeley.edu/feeds/iplasmatron-mids-projects";

// CYCLE2 PARAMETERS
// see api here: http://jquery.malsup.com/cycle2/api/
$CYCLE_FX = "none";
$CYCLE_SPEED = 10 * 1000; // 10 seconds
$CYCLE_TIMEOUT = 50 * 1000; // 50 seconds

// SLIDESHOW PARAMETERS
$NUM_SLIDES = -1; // -1 for all slides
$ONLY_PROFILES = False;
$ONLY_PROJECTS = False;

// Load feed into variables
$profiles_xml = simplexml_load_file($PROFILES_URL) or die("Error: Cannot create profiles object");
$projects_xml = simplexml_load_file($MIMS_PROJECTS_URL) or die("Error: Cannot create projects object");
//$mids_projects_xml = simplexml_load_file($MIDS_PROJECTS_URL) or die("Error: Cannot create projects object");
//$projects_xml = array_merge($mims_projects_xml->children(), $mids_projects_xml->children());

$slides = array();

if (!$ONLY_PROJECTS) {
    foreach($profiles_xml->children() as $node) {
        $format =
            '<div class="slide-container profile">
                <div class="image-container" style="background-image: url(\'%s\')"></div>
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
            '<div class="slide-container project">
                <div class="image-container" style="background-image: url(\'%s\')"></div>
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
