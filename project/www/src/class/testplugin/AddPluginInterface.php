<?php
if (!interface_exists('AddPluginInterface')) {

    interface AddPluginInterface
    {
    
        public function getName(): null|string;
        public function getMessage(): null|string;

    }

}