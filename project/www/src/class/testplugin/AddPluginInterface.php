<?php
if (!interface_exists('AddPluginInterface')) {

    include_once __DIR__ . '/../pctrplugin/DefaultPluginInterf.php';

    interface AddPluginInterface extends DefaultPluginInterf
    {
    }

}