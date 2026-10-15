<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Médicos</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

<div class="contenedor">

    <div class="encabezado">
        <h1>Gestión de Médicos</h1>
        <button type="button" class="btn btn-nuevo" onclick="abrirModal()">
            + Nuevo médico
        </button>
    </div>

    <p class="total">Total de médicos: <?= count($medicos) ?></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Especialidad</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($medicos)): ?>
                <tr>
                    <td colspan="7" class="sin-medicos">
                        No existen médicos registrados.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($medicos as $medico): ?>
                    <tr>
                        <td><?= $medico->getId() ?></td>
                        <td>
                            <?php if ($medico->getFoto()): ?>
                                <img src="public/img/medicos/<?= htmlspecialchars($medico->getFoto()) ?>"
                                     alt="Foto del médico"
                                     class="foto">
                            <?php else: ?>
                                Sin foto
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($medico->getNombres()) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($medico->getApellidos()) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($medico->getEspecialidad()) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($medico->getTelefono()) ?>
                        </td>
                        <td>
                            <a href="index.php?accion=editar&id=<?= $medico->getId() ?>"
                               class="btn btn-editar">
                                Editar
                            </a>
                            <a href="index.php?accion=eliminar&id=<?= $medico->getId() ?>"
                               class="btn btn-eliminar"
                               onclick="return confirm('¿Está seguro de eliminar este médico?');">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- =====================================================
     VENTANA MODAL: NUEVO MÉDICO
     ===================================================== -->
<div id="modalMedico" class="modal">

    <div class="modal-contenido">

        <div class="modal-encabezado">
            <h2>Nuevo médico</h2>
            <button type="button" class="cerrar" onclick="cerrarModal()">&times;</button>
        </div>

        <form method="POST" action="index.php?accion=guardar" enctype="multipart/form-data">

            <label for="nombres">Nombres:</label>
            <input type="text"
                   id="nombres"
                   name="nombres"
                   maxlength="100"
                   required
                   placeholder="Ingrese los nombres">

            <label for="apellidos">Apellidos:</label>
            <input type="text"
                   id="apellidos"
                   name="apellidos"
                   maxlength="100"
                   required
                   placeholder="Ingrese los apellidos">

            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad">
                <option value="Medicina General">Medicina General</option>
                <option value="Pediatría">Pediatría</option>
                <option value="Ginecología">Ginecología</option>
                <option value="Cardiología">Cardiología</option>
                <option value="Traumatología">Traumatología</option>
            </select>

            <label for="telefono">Teléfono:</label>
            <input type="text"
                   id="telefono"
                   name="telefono"
                   maxlength="20"
                   required
                   placeholder="Ej: 70123456">

            <label for="foto">Foto:</label>
            <input type="file"
                   id="foto"
                   name="foto"
                   accept="image/jpeg,image/png,image/webp">

            <div class="acciones-formulario">
                <button type="button" class="btn btn-cancelar" onclick="cerrarModal()">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-guardar">
                    Guardar médico
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Abrir la ventana modal
    function abrirModal() {
        document.getElementById("modalMedico").style.display = "flex";
        document.getElementById("nombres").focus();
    }

    // Cerrar la ventana modal
    function cerrarModal() {
        document.getElementById("modalMedico").style.display = "none";
    }

    // Cerrar al hacer clic fuera del contenido
    window.onclick = function(event) {
        const modal = document.getElementById("modalMedico");
        if (event.target === modal) {
            cerrarModal();
        }
    };
</script>

</body>
</html>
