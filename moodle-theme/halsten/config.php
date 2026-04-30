<?php
defined('MOODLE_INTERNAL') || die();

$THEME->name = 'halsten';
$THEME->fullname = 'Halsten Academy';
$THEME->parents = ['boost'];
$THEME->enable_dock = false;
$THEME->usefallback = true;
$THEME->scss = function($theme) {
    return theme_boost_get_main_scss_content($theme);
};
$THEME->extra_scss = function($theme) {
    return file_get_contents(__DIR__ . '/scss/halsten.scss');
};
$THEME->layouts = [
    'base' => ['file' => 'drawers.php', 'regions' => []],
    'standard' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'course' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'coursecategory' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'incourse' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'frontpage' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'admin' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'mydashboard' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'mypublic' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
    'login' => ['file' => 'login.php', 'regions' => []],
    'popup' => ['file' => 'drawers.php', 'regions' => []],
    'frametop' => ['file' => 'drawers.php', 'regions' => []],
    'embedded' => ['file' => 'drawers.php', 'regions' => []],
    'maintenance' => ['file' => 'drawers.php', 'regions' => []],
    'print' => ['file' => 'drawers.php', 'regions' => []],
    'redirect' => ['file' => 'drawers.php', 'regions' => []],
    'report' => ['file' => 'drawers.php', 'regions' => ['side-pre']],
];