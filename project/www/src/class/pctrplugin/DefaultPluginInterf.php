<?php
// verifier qu'on n'a pas deja creer l'interface'
if (!interface_exists('DefaultPluginInterf')) {

    /**
     * Pour la création de base de l'interface d'un plugin.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    interface DefaultPluginInterf
    {
    
        /**
         * Le nom du plugin
         * @return null|string Le nom du plugin
         */
        public function getName(): null|string;
    
        /**
         * Le titre du plugin
         * @return null|string Le titre du plugin
         */
        public function getTitle(): null|string;
    
        /**
         * Une description du plugin
         * @return null|string Une description du plugin
         */
        public function getMessage(): null|string;

    }

}