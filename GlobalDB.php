<?php
    class GlobalDB extends CreateDB {
        private $server_path, $globalDatabasePath;


        public function GlobalDB($databaseName = null) {
            parent::CreateDB($databaseName);

            $file_server_path = realpath(__FILE__);
            $this->server_path = str_replace(basename(__FILE__), "", $file_server_path);
            $this->globalDatabasePath = $this->server_path . '../config/globalDBInfo.xml';
        }

        public function setGlobalDatabaseInfo() {
            if (!is_null($this->databaseName) && !file_exists($this->globalDatabasePath)) {
                $arraySetText = array();
                $arraySetText[] = "<root>";
                $arraySetText[] = chr(9) . "<host>$this->db_host</host>";
                $arraySetText[] = chr(9) . "<name>$this->databaseName</name>";
                $arraySetText[] = chr(9) . "<user>$this->db_user</user>";
                $arraySetText[] = chr(9) . "<pass>$this->db_pass</pass>";
                $arraySetText[] = "</root>";

                if ($file_write = fopen($this->globalDatabasePath, "w")) {
                    fwrite($file_write, implode(chr(13), $arraySetText));
                    fclose($file_write);
                    return true;
                }
                else {
                    return false;
                }
            }
        }

        protected function getGlobalDatabaseInfo($infoType = "name") {
            if (!file_exists($this->globalDatabasePath)) {
                return false;
            }
            else {
                $response   = file_get_contents($this->globalDatabasePath, false);
                $object     = simplexml_load_string($response);

                return $object->{$infoType};
            }
        }

        public function getGlobalDataBaseHost() {
            return $this->getGlobalDatabaseInfo('host');
        }

        public function getGlobalDataBaseName() {
            return $this->getGlobalDatabaseInfo();
        }

        public function getGlobalDataBaseUser() {
            return $this->getGlobalDatabaseInfo('user');
        }

        public function getGlobalDataBasePass() {
            return $this->getGlobalDatabaseInfo('pass');
        }
    }


?>
