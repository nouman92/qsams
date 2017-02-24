<?php
require_once __DIR__ . '/orm/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory(__DIR__ . '/models');
    $cfg->set_connections(array('development' => 'mysql://nouman92:nouman92@noumananjum.c4wrdesrpkah.ap-south-1.rds.amazonaws.com:3306/qsams'));
    //$cfg->set_connections(array('development' => 'mysql://root:nouman92@127.0.0.1:3307/qaams'));
});
?>
