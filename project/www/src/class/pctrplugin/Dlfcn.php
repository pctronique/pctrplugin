<?php
if (!class_exists('Dlfcn')) {

    include_once __DIR__ . '/LoadClass.php';

    class Dlfcn
    {

        public static function dlopen(null|string $folder): null|array {
            if($folder == null) {
                return null;
            }
            if(!is_dir($folder)) {
                return null;
            }
            $files = [];
            $files = Dlfcn::loadFolderFiles($files, $folder);
            return $files;
        }

        public static function dlsym(null|array $files, null|String $name): null|object {
            if($files == null) {
                return null;
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

        private static function loadFolderFiles(null|array $files, null|string $dir): null|array {

            if($dir === null || $files === null) {
                return $files;
            }
            $ffs = scandir($dir);
            unset($ffs[array_search('.', $ffs, true)]);
            unset($ffs[array_search('..', $ffs, true)]);

            foreach($ffs as $ff){
                $file = $dir . "/" . $ff;
                if(is_dir($file)) {
                    $files = Dlfcn::loadFolderFiles($files, $file);
                } else {
                    array_push($files, $file);
                }
            }
            return $files;
        }
    }

}