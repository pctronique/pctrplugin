<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('Dlfcn')) {

    include_once __DIR__ . '/LoadClass.php';
    include_once __DIR__ . '/../pctrpath/Path.php';

    /**
     * Travailler avec les plugins en php.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class Dlfcn
    {

        private static null|string $dir_prev;
        private static null|string $name_prev;
        private static null|string $nb_prev;

        /**
         * Récupérer la liste des plugins à partir d'un dossier.
         * 
         * @param null|string $folder le dossier qui contient les plugins.
         * @return array|null listes de plugins trouvées.
         */
        public static function dlopen(null|string $folder): null|array {
            if($folder !== null && !empty($folder) && is_dir($folder)) {
                $folder=(new Path($folder))->getAbsolutePath();
                if(!is_dir($folder)) {
                    return [];
                }
                $files = [];
                $files = Dlfcn::loadFolderFiles($files, $folder);
                return $files;
            }
            return [];
        }

        /**
         * Récupérer l'objet d'un plugin à partir d'une liste de plugins et son nom.
         * 
         * @param null|array $files une liste de plugins.
         * @param null|string $name le nom du plugins.
         * @return object|null retourne l'objet du plugins.
         */
        public static function dlsym(null|array $files, null|String $name): null|object {
            if($files == null) {
                return (object)null;
            }
            foreach($files as $ff){
                $loadClass = new LoadClass($ff);
                if(!empty($loadClass->getInterfaces())) {
                    foreach ($loadClass->getInterfaces() as $value) {
                        if($value === $name) {
                            return $loadClass->getObj();
                        }
                    }
                }
            }
            return null;
        }

        /**
         * Lecture des dossiers par récurcifs pour récupérer les fichier plugins.
         * 
         * @param null|array $files fichier ou dossier à vérifier
         * @param null|string $dir dossier de lecture
         * @return array|null récupération d'une liste de plugins.
         */
        private static function loadFolderFiles(null|array $files, null|string $dir): null|array {
            if(!isset(Dlfcn::$dir_prev)) { Dlfcn::$dir_prev = null; }
            if(!isset(Dlfcn::$name_prev)) { Dlfcn::$name_prev = null; }
            if(!isset(Dlfcn::$nb_prev)) { Dlfcn::$nb_prev = 0; }
            if($dir !== null && $files !== null && !empty($dir) && is_dir($dir) && !is_link($dir) && Dlfcn::$dir_prev !== $dir && $dir !== "/sys/devices") {
                Dlfcn::$dir_prev = $dir;
                $file_name = (new Path($dir))->getName();
                if(Dlfcn::$name_prev !== $file_name) {
                    Dlfcn::$name_prev = $file_name;
                    Dlfcn::$nb_prev = 0;
                } else {
                    Dlfcn::$nb_prev++;
                }
                if(Dlfcn::$nb_prev === 6) { return []; }
                $ffs = scandir($dir);
                if($ffs !== null && !empty($ffs)) {
                    unset($ffs[array_search('.', $ffs, true)]);
                    unset($ffs[array_search('..', $ffs, true)]);

                    foreach($ffs as $ff){
                        $file = (new Path($dir, $ff))->getAbsolutePath();
                        if(is_dir($file)) {
                            $files = Dlfcn::loadFolderFiles($files, $file);
                        } else {
                            array_push($files, $file);
                        }
                    }
                }
                return $files;
            }
            return $files === null ? [] : $files;
        }
    }

}