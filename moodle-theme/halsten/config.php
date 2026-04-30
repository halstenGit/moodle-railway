<?php
defined('MOODLE_INTERNAL') || die();

$THEME->name = 'halsten';
$THEME->fullname = 'Halsten Academy';
$THEME->parents = ['boost'];
$THEME->scss = function($theme) {
    return theme_boost_get_main_scss_content($theme);
};
$THEME->extra_scss = function($theme) {
    return file_get_contents(__DIR__ . '/scss/halsten.scss');
};
$THEME->layouts = [];
$THEME->enable_dock = false;
$THEME->usefallback = true;