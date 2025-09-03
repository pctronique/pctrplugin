<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('PctrPlugin')) {
    include_once __DIR__ . '/../pctrpath/Path.php';
    
    include_once __DIR__ . '/Dlfcn.php';
    /**
     * Pour simplifier l'utilisation des plugins.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class PctrPlugin
    {
    
        private null|array $all_plugin;
        private null|String $path;
        private null|String $nameInterf;

        /**
         * Constructeur par référence, en utilisent le nom de l'interface qui sera utilisé pour le plugin.
         * 
         * @param string $nameInterf le nom de l'interface qui sera utilisé pour le plugin.
         */
        public function __construct(null|string $nameInterf)
        {
            $this->path = __DIR__ . "/../../../plugins/";
            $this->nameInterf = $nameInterf;
            $this->all_plugin = [];
        }

        /**
         * Création d'une liste de plugins. Possible de modifier l'emplacement du plugins.
         * 
         * @param null|string $file modifier l'emplacement du plugins.
         * @return PctrPlugin
         */
        public function loadPlugins(null|string $file = null): self
        {
            if($this->nameInterf === null) { return $this; }
            $folderPlugins = (new Path($this->path))->getAbsoluteParent();
            if(!empty($file)) {
                $folderPlugins = (new Path($file))->getAbsoluteParent();
            }
            if(is_dir($folderPlugins)) {
                $ffs = scandir($folderPlugins);
                unset($ffs[array_search('.', $ffs, true)]);
                unset($ffs[array_search('..', $ffs, true)]);
                foreach ($ffs as $listFile) {
                    $plibobj = Dlfcn::dlopen((new Path($folderPlugins, $listFile))->getAbsoluteParent());
                    if($plibobj == null) {
                        echo "Error loading the library : " . $listFile . "<br />";
                    } else {
                        $psqr = Dlfcn::dlsym($plibobj, $this->nameInterf);
                        if ($psqr == null) {
                            echo "Error accessing the symbol : " . $listFile . "<br />";
                        } else {
                            array_push($this->all_plugin, $psqr);
                        }
                    }
                }
            }
            return $this;
        }
    
        /**
         * Récupérer la liste des plugins.
         * 
         * @return array|null la liste des plugins.
         */
        public function getPlugins(): null|array {
            return $this->all_plugin;
        }

    }

}