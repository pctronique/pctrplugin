<?php
if (!class_exists('NewMain2')) {

    require_once __DIR__ . '/../pctrplugin/PctrPlugin.php';
    require_once __DIR__ . '/../pctrpath/Path.php';

    class NewMain2
    {
        public function __construct()
        {
            $pctrPlugin = new PctrPlugin("AddPluginInterface");
            $pctrPlugin->loadPlugins(new Path(__DIR__ . "/../../../plugins/"));
            foreach ($pctrPlugin->getPlugins() as $value) {
                echo $value->getName() . " : " . $value->getTitle() . " : " . $value->getMessage() . "<br />";
            }
        }
        
    }

}