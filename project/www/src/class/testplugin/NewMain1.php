<?php
if (!class_exists('NewMain1')) {

    require_once __DIR__ . '/../pctrplugin/PctrPlugin.php';

    class NewMain1
    {
        public function __construct()
        {
            $pctrPlugin = new PctrPlugin("AddPluginInterface");
            $pctrPlugin->loadPlugins(__DIR__ . "/../../../plugins/");
            foreach ($pctrPlugin->getPlugins() as $value) {
                echo $value->getName() . " : " . $value->getTitle() . " : " . $value->getMessage() . "<br />";
            }
        }
        
    }

}