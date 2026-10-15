<?php
class Medico
{
    private $id;
    private $nombres;
    private $apellidos;
    private $especialidad;
    private $telefono;
    private $foto;
    // ========================================
    // CONSTRUCTOR
    // ========================================
    public function __construct(
        $id = null,
        $nombres = "",
        $apellidos = "",
        $especialidad = "",
        $telefono = "",
        $foto = null
    ) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->especialidad = $especialidad;
        $this->telefono = $telefono;
        $this->foto = $foto;
    }
    // ========================================
    // GETTERS
    // ========================================
    public function getId()
    {
        return $this->id;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    // ========================================
    // SETTERS
    // ========================================
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
}
