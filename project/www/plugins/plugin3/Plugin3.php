<?php
if (!class_exists('Plugin3')) {

    include_once __DIR__ . '/../../src/class/testplugin/AddPluginInterface.php';

    class Plugin3 implements AddPluginInterface
    {
    
        public function getName(): null|string {
            return "plugin3";
        }

        public function getMessage(): null|string {
            return "the plugin3";
        }

    }

}