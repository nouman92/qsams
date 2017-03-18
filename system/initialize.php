<?php
require_once __DIR__ . '/orm/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory(__DIR__ . '/models');
    //$cfg->set_connections(array('development' => 'mysql://pvlabpk_qasolar:qasolar123456789@localhost:3306/pvlabpk_qasolar'));
    $cfg->set_connections(array('development' => 'mysql://root:nouman92@127.0.0.1:3307/qaams'));
});
?>
