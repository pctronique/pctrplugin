<?php
if (!class_exists('LoadClass')) {

    class LoadClass
    {

        private null|string $file;
        private null|string $name;
        private null|string $extend;
        private null|array $interfaces;

        public function __construct(null|string $file)
        {
            $this->interfaces = [];
            if($file != null) {
                $this->file = $file;
                $this->loadfile();
            }
        }

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

        public function getObj(): Object {
            if($this->name == null) {
                return null;
            }
            include $this->file;
            return (new $this->name());
        }

        private function arrayImp(null|string $values): null|array {
            if($values == null) {
                return null;
            }
            $valuevirg = str_replace(" ", "", $values);
            return explode(",", $valuevirg);
        }

        public function getName(): null|string {
            return $this->name;
        }

        public function getExtend(): null|string {
            return $this->extend;
        }
        
        public function getInterfaces(): null|array {
            return $this->interfaces;
        }
        
    }
}