<?php
// verifier qu'on n'a pas deja creer la classe
if (!class_exists('LoadClass')) {

    /**
     * Lire un php pour trouver le bon plugin.
     * @version 1.1.0
     * @author pctronique (NAULOT ludovic)
     */
    class LoadClass
    {

        private null|string $file;
        private null|string $name;
        private null|string $extend;
        private null|array $interfaces;

        /**
         * Constructeur par référence, avec le fichier php à lire.
         * 
         * @param null|string $file le fichier php à lire
         */
        public function __construct(null|string $file)
        {
            $this->interfaces = [];
            $this->file = "";
            $this->name = "";
            $this->extend = "";
            if($file != null && is_file($file) && is_readable($file) && (mime_content_type($file) === "text/plain" || mime_content_type($file) === "text/x-php")) {
                $this->file = $file;
                $this->loadfile();
            }
        }

        /**
         * Lecture du fichier php et récupère les informations dans celui-ci.
         * 
         * @return LoadClass
         */
        private function loadfile():self {
            $content = file_get_contents($this->file);
            $patternAll = '/class ((.)*) extends ((.)*) implements (((?!(\{))(.))*)/im';
            $patternImp = '/class ((.)*) implements (((?!(\{))(.))*)/im';
            preg_match($patternAll, $content, $matches);
            if(!empty($matches)) {
                $this->name = trim($matches[1]);
                $this->extend = trim($matches[3]);
                $this->interfaces = $this->arrayImp(trim($matches[5]));
            } else {
                preg_match($patternImp, $content, $matches);
                if(!empty($matches)) {
                    $this->name = trim($matches[1]);
                    $this->interfaces = $this->arrayImp(trim($matches[3]));
                }
            }
            return $this;
        }

        /**
         * Créer l'objet à partir du nom de la classe php.
         * 
         * @return object|null l'objet de la classe.
         */
        public function getObj(): Object {
            if($this->name == null) {
                return null;
            }
            include $this->file;
            return (new $this->name());
        }

        /**
         * récupère les implemtations dans la valeur (ligne de la classe).
         * 
         * @param null|string $values la valeur (ligne de la classe)
         * @return string[]|null les implemtations
         */
        private function arrayImp(null|string $values): null|array {
            if($values == null) {
                return [];
            }
            $valuevirg = str_replace(" ", "", $values);
            return explode(",", $valuevirg);
        }

        /**
         * Récupère le nom de la classe.
         * 
         * @return string|null le nom de la classe.
         */
        public function getName(): null|string {
            return $this->name;
        }

        /**
         * Récupère l'extension de la classe (entension à partir d'une autre classe).
         * 
         * @return string|null extension de la classe.
         */
        public function getExtend(): null|string {
            return $this->extend;
        }
        
        /**
         * Récupère la liste des insterfaces de la classe.
         * 
         * @return array|null la liste des insterfaces de la classe.
         */
        public function getInterfaces(): null|array {
            return $this->interfaces;
        }
        
    }
}