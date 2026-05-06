<?php
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $setting = new admin_setting_heading('theme_halsten/generalheading',
        get_string('pluginname', 'theme_halsten'), '');
    $settings->add($setting);
}