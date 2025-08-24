<?php
if (!class_exists('Plugin1')) {

    include_once __DIR__ . '/../../src/class/testplugin/AddPluginInterface.php';

    class Plugin1 implements AddPluginInterface
    {
    
        public function getName(): null|string {
            return "plugin1";
        }

        public function getMessage(): null|string {
            return "the plugin1";
        }

    }

}