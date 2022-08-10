<?php

    class ConexionDb{
        private $db = "oci:dbname=orcl" . ";charset=UTF8";
        private $usuario = "ESTUDIANTE";
        private $password = "123";

        public function Conectar(){
            $conn = new PDO($this->db, $this->usuario, $this->password);

            try {
                if ($conn) {
                    echo "Conectado correctamente a ORACLE";
                    return $conn;
                }
            } catch (Exception $e) {
                echo "Erro de conexión: " . $e->getMessage();
            }
        }
    }
