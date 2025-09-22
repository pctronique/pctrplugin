<?php
if (!interface_exists('AddPluginInterface')) {

    require_once __DIR__ . '/../pctrplugin/DefaultPluginInterf.php';

    interface AddPluginInterface extends DefaultPluginInterf
    {
    }

}