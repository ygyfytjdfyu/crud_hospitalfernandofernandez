<?php
require_once "modelo/Medico.php";
class MedicoDao
{
    private $conexion;
    // CONSTRUCTOR
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    // LISTAR MEDICOS
    public function listar()
    {
        $sql = "SELECT id, nombres, apellidos, especialidad, telefono, foto
                FROM medico
                ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $medicos = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $medico = new Medico($fila["id"], $fila["nombres"], $fila["apellidos"], $fila["especialidad"], $fila["telefono"], $fila["foto"]);
            $medicos[] = $medico;
        }
        return $medicos;
    }
    // BUSCAR POR ID
    public function buscarPorId($id)
    {
        $sql = "SELECT id, nombres, apellidos, especialidad, telefono, foto
                FROM medico
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["id" => $id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($fila) {
            return new Medico($fila["id"], $fila["nombres"], $fila["apellidos"], $fila["especialidad"], $fila["telefono"], $fila["foto"]);
        }
        return null;
    }
    // INSERTAR
    public function insertar(Medico $medico)
    {
        $sql = "INSERT INTO medico
                (nombres, apellidos, especialidad, telefono, foto)
                VALUES
                (:nombres, :apellidos, :especialidad, :telefono, :foto)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            "nombres" => $medico->getNombres(),
            "apellidos" => $medico->getApellidos(),
            "especialidad" => $medico->getEspecialidad(),
            "telefono" => $medico->getTelefono(),
            "foto" => $medico->getFoto()
        ]);
    }
    // ACTUALIZAR
    public function actualizar(Medico $medico)
    {
        $sql = "UPDATE medico
                SET nombres = :nombres,
                    apellidos = :apellidos,
                    especialidad = :especialidad,
                    telefono = :telefono,
                    foto = :foto
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            "id" => $medico->getId(),
            "nombres" => $medico->getNombres(),
            "apellidos" => $medico->getApellidos(),
            "especialidad" => $medico->getEspecialidad(),
            "telefono" => $medico->getTelefono(),
            "foto" => $medico->getFoto()
        ]);
    }
    // ELIMINAR
    public function eliminar($id)
    {
        $sql = "DELETE FROM medico
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            "id" => $id
        ]);
    }
}
