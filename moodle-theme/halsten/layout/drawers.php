<?php
defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes([]);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID)]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettings' => !empty($regionmainsettingsmenu),
];

echo $OUTPUT->render_from_template('theme_boost/drawers', $templatecontext);