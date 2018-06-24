<?php
class db{
    private $servername = "localhost";
    private $username = "sibw";
    private $password = "sibw";
    private $dbname = "museo";
    private $conexion = "";
    private $resultado = false;
    private $num_rows = 0;

    public function conexion(){
        $this->conexion=new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conexion->connect_error) {
            return null;
        }
        if (!$this->conexion->set_charset("utf8")) {
            return null;
        }
        return $this->conexion;
    }

    public function affected_rows () {
        return $this->num_rows;
    }

    public function getConexion () {
        return $this->conexion;
    }

    public function query ($sql, $type, $param) {

        $a_params = array();

        $param_type = '';
        $n = count($type);
        for($i = 0; $i < $n; $i++) {
            $param_type .= $type[$i];
        }

        $a_params[] = &$param_type;

        for($i = 0; $i < $n; $i++) {
            $a_params[] = & $param[$i];
        }

        //"SELECT * FROM usuarios WHERE id = ?"
        $this->resultado = false;
        if(!$sentencia = $this->conexion->prepare($sql))
        {
            var_dump(mysqli_error($this->conexion));
            print "Falló la preparación de la sentencia: ". $this->conexion->errno ."\n";
        }
        else {
            if ($n > 0) {
                call_user_func_array(array($sentencia, 'bind_param'), $a_params);
            }

            /*for ($i=0; $i<=(count($param)-2); $i+=2) {
                //$sentencia->bind_param("i", $param[$i+1] );
                //$sentencia->bind_param("s", $param[$i+1] );
                $sentencia->bind_param($param[$i], $param[$i+1] );
            }*/
            if($sentencia->execute()) {
                $this->resultado = $sentencia->get_result();
                $this->num_rows = $sentencia->affected_rows;
            }

        }


        return $this->resultado;
    }

    public function desconectar(){
        $this->conexion->close();
    }
}