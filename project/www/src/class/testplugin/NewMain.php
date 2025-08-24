<?php
if (!class_exists('NewMain')) {

    include_once __DIR__ . '/../pctrplugin/PctrPlugin.php';

    class NewMain
    {
        public function __construct()
        {
            $pctrPlugin = new PctrPlugin("AddPluginInterface");
            $pctrPlugin->loadPlugins();
            foreach ($pctrPlugin->getPlugins() as $value) {
                echo $value->getName() . " : " . $value->getName() . "<br />";
            }
        }
        
    }

}