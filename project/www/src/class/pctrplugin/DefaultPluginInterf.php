<?php
if (!interface_exists('DefaultPluginInterf')) {

    interface DefaultPluginInterf
    {
    
        public function getName(): null|string;
        public function getTitle(): null|string;
        public function getMessage(): null|string;

    }

}