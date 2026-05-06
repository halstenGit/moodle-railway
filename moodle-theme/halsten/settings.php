<?php
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('theme_halsten', get_string('configtitle', 'theme_boost'));
    $page = new admin_settingpage('theme_halsten_general', get_string('generalsettings', 'theme_boost'));
    $settings->add($page);
}