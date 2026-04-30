<?php
defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes([]);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions() && !$PAGE->has_blocks();
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$header = $OUTPUT->full_header();
$sidepreblocks = $OUTPUT->blocks('side-pre');

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID)]),
    'output' => $OUTPUT,
    'sidepreblocks' => $sidepreblocks,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettings' => !empty($regionmainsettingsmenu),
];

echo $OUTPUT->render_from_template('theme_boost/drawers', $templatecontext);