<?php

require_once "modelo/Medico.php";
require_once "modelo/MedicoDao.php";
class MedicoController
{
    private $dao;
    // CONSTRUCTOR
    public function __construct($dao)
    {
        $this->dao = $dao;
    }
    // LISTAR
    public function index()
    {
        $medicos = $this->dao->listar();
        require "vista/medicos/index.php";
    }
    // NUEVO
    public function nuevo()
    {
        $medico = new Medico();

        require "vista/medicos/formulario.php";
    }
    // GUARDAR
    public function guardar()
    {
        $medico = new Medico();
        $medico->setNombres($_POST["nombres"]);
        $medico->setApellidos($_POST["apellidos"]);
        $medico->setEspecialidad($_POST["especialidad"]);
        $medico->setTelefono($_POST["telefono"]);
        $medico->setFoto($this->subirFoto());
        $this->dao->insertar($medico);
        header("Location: index.php");
        exit;
    }
    // EDITAR
    public function editar()
    {
        $id = $_GET["id"];
        $medico = $this->dao->buscarPorId($id);
        require "vista/medicos/formulario.php";
    }
    // ACTUALIZAR
    public function actualizar()
    {
        $actual = $this->dao->buscarPorId($_POST["id"]);
        $foto = $this->subirFoto();

        if ($foto === null) {
            $foto = $actual->getFoto();
        } else {
            $this->borrarFoto($actual->getFoto());
        }
        $medico = new Medico();
        $medico->setId($_POST["id"]);
        $medico->setNombres($_POST["nombres"]);
        $medico->setApellidos($_POST["apellidos"]);
        $medico->setEspecialidad($_POST["especialidad"]);
        $medico->setTelefono($_POST["telefono"]);
        $medico->setFoto($foto);
        $this->dao->actualizar($medico);
        header("Location: index.php");
        exit;
    }
    // ELIMINAR
    public function eliminar()
    {
        $id = $_GET["id"];
        $medico = $this->dao->buscarPorId($id);

        if ($medico !== null) {
            $this->borrarFoto($medico->getFoto());
        }
        $this->dao->eliminar($id);
        header("Location: index.php");
        exit;
    }
    // SUBIR FOTO
    private function subirFoto()
    {
        if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
            return null;
        }
        $extension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        $permitidas = ["jpg", "jpeg", "png", "webp"];

        if (!in_array($extension, $permitidas)) {
            return null;
        }
        $nombre = "medico_" . uniqid() . "." . $extension;
        move_uploaded_file($_FILES["foto"]["tmp_name"], "public/img/medicos/" . $nombre);
        return $nombre;
    }
    // BORRAR FOTO
    private function borrarFoto($foto)
    {
        $ruta = "public/img/medicos/" . $foto;

        if ($foto && file_exists($ruta)) {
            unlink($ruta);
        }
    }
}
