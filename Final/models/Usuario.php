<?php
class Usuario{
    private $nombreUsuario;
    private $permiso;
    private $email;
    private $nombre;
    private $conectado;

    public function Usuario($nombreUsuario="anonimo", $aPermiso="externo", $aconectado=false)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->permiso = $aPermiso;
        $this->conectado = $aconectado;
    }

    public function setNombre($aNombre)
    {
        $this->nombre = $aNombre;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setPermiso($aPermiso)
    {
        $this->permiso = $aPermiso;
    }

    public function setConectado($aConectado)
    {
        $this->conectado = $aConectado;
    }

    public function setEmail($aEmail)
    {
        $this->email = $aEmail;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPermiso()
    {
        return $this->permiso;
    }

    public function isConectado()
    {
        return $this->conectado;
    }
}