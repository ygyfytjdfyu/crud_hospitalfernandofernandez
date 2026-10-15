<?php
$editar = $medico->getId() !== null;

$especialidades = [
    "Medicina General",
    "Pediatría",
    "Ginecología",
    "Cardiología",
    "Traumatología"
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editar ? "Editar médico" : "Nuevo médico" ?></title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

<div class="contenedor formulario">

    <h1><?= $editar ? "Editar médico" : "Nuevo médico" ?></h1>

    <form method="POST"
          action="index.php?accion=<?= $editar ? "actualizar" : "guardar" ?>"
          enctype="multipart/form-data">

        <?php if ($editar): ?>
            <input type="hidden" name="id" value="<?= $medico->getId() ?>">
        <?php endif; ?>

        <label for="nombres">Nombres:</label>
        <input type="text"
               id="nombres"
               name="nombres"
               maxlength="100"
               required
               value="<?= htmlspecialchars($medico->getNombres()) ?>">

        <label for="apellidos">Apellidos:</label>
        <input type="text"
               id="apellidos"
               name="apellidos"
               maxlength="100"
               required
               value="<?= htmlspecialchars($medico->getApellidos()) ?>">

        <label for="especialidad">Especialidad:</label>
        <select id="especialidad" name="especialidad">
            <?php foreach ($especialidades as $especialidad): ?>
                <option value="<?= $especialidad ?>"
                    <?= $medico->getEspecialidad() === $especialidad ? "selected" : "" ?>>
                    <?= $especialidad ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="telefono">Teléfono:</label>
        <input type="text"
               id="telefono"
               name="telefono"
               maxlength="20"
               required
               value="<?= htmlspecialchars($medico->getTelefono()) ?>">

        <label for="foto">Foto:</label>
        <?php if ($medico->getFoto()): ?>
            <img src="public/img/medicos/<?= htmlspecialchars($medico->getFoto()) ?>"
                 alt="Foto del médico"
                 class="foto">
            <p class="aviso">Si no elige otra foto, se mantiene la actual.</p>
        <?php endif; ?>
        <input type="file"
               id="foto"
               name="foto"
               accept="image/jpeg,image/png,image/webp">

        <div class="acciones-formulario">
            <a href="index.php" class="btn btn-cancelar">Cancelar</a>

            <button type="submit" class="btn btn-guardar">
                <?= $editar ? "Actualizar" : "Guardar" ?>
            </button>
        </div>

    </form>
</div>

</body>
</html>
