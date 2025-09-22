<?php
if (!class_exists('Plugin2')) {

    require_once __DIR__ . '/../../src/class/testplugin/AddPluginInterface.php';

    class Plugin2 implements AddPluginInterface
    {
    
        public function getName(): null|string {
            return "plugin2";
        }
    
        public function getTitle(): null|string {
            return "plugin 2";
        }

        public function getMessage(): null|string {
            return "the plugin 2";
        }

    }

}