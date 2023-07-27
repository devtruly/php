<?php
    class CreateDB extends db {
        protected $databaseName, $createResult;

        public function CreateDB($databaseName = null) {
            if (!is_null($databaseName)) {
                $this->setDatabaseName($databaseName);
            }
        }

        public function setDatabaseName ($databaseName) {
            $this->databaseName = $databaseName;
        }

        public function getDatabaseName () {
            return $this->databaseName;
        }

        public function create() {
            if (!is_null($this->databaseName)) {
                return $this->createQuery($this->getBindingQueryString("Create Database If Not Exists ? Default Character Set utf8 Collate utf8_general_ci", ["i", $this->databaseName]));
            }
            else {
                return false;
            }
        }

        private function createQuery($sql) {
            $this->createResult = parent::query($sql);
            return $this->createResult;
        }
    }
?>