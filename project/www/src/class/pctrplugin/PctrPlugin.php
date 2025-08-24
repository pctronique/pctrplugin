<?php
if (!class_exists('PctrPlugin')) {
    
    include_once __DIR__ . '/Dlfcn.php';

    class PctrPlugin
    {
    
        private null|array $all_plugin;
        private null|String $path;
        private null|String $nameInterf;

        public function __construct(string $nameInterf)
        {
            $this->path = "./plugins/";
            $this->nameInterf = $nameInterf;
            $this->all_plugin = [];
        }

        public function loadPlugins(null|string $file = null): self
        {
            $folderPlugins = $this->path . "/";
            if(!empty($file)) {
                $folderPlugins = $file;
            }
            if(is_dir($folderPlugins)) {
                $ffs = scandir($folderPlugins);
                unset($ffs[array_search('.', $ffs, true)]);
                unset($ffs[array_search('..', $ffs, true)]);
                foreach ($ffs as $listFile) {
                    $plibobj = Dlfcn::dlopen($folderPlugins . "/" . $listFile);
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
    
        public function getPlugins(): null|array {
            return $this->all_plugin;
        }

    }

}