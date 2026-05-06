<?php  // Moodle configuration file

$CFG = new stdClass();

$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'postgres.railway.internal';
$CFG->dbname    = 'railway';
$CFG->dbuser    = 'postgres';
$CFG->dbpass    = 'kxPvIgzjWDIVJzasrgGRbibuQPKIidYR';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = [
    'dbport' => 5432,
];

$CFG->wwwroot   = 'https://moodle-production-3e05.up.railway.app';
$CFG->dataroot  = '/var/www/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once('/var/www/html/lib/setup.php');