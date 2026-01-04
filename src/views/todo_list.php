<?php if (session_status() === PHP_SESSION_NONE) {
    session_start(); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="../public/styles/index.css">
</head>
<body>

<div class="container my-5">

    <?php if (!empty($message)): ?>
        <div class="alert <?= strpos($message, 'Error') === false ? 'alert-success' : 'alert-danger' ?>" role="alert">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <h2 class="mb-4">Mis Tareas</h2>

    <?php if (empty($todos)): ?>
        <p>No tienes tareas todavía.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha límite</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todos as $todo): ?>
                    <tr>
                        <td><?= htmlspecialchars($todo['title']) ?></td>
                        <td><?= nl2br(htmlspecialchars($todo['description'])) ?></td>
                        <td><?= htmlspecialchars($todo['due_date']) ?></td>
                        <td><?= htmlspecialchars($todo['category_name'] ?? 'Sin categoría') ?></td>
                        <td>
                            <?php if ($todo['completed']): ?>
                                <span class="badge bg-success">Completada</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h2 class="mt-5 mb-3">Añadir nueva tarea</h2>

    <form method="POST" action="" novalidate id="todoForm">
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" id="title" name="title" class="form-control" required>
        <div class="invalid-feedback">Por favor, introduce un título válido.</div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Fecha límite</label>
        <input type="date" id="due_date" name="due_date" class="form-control" required>
        <div class="invalid-feedback">Por favor, selecciona una fecha límite.</div>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Categoría</label>
        <select id="category_id" name="category_id" class="form-select" required>
            <option value="">Selecciona una categoría</option> <!-- Mejor un placeholder -->
            <option value="1">Salud</option>
            <option value="2">Citas</option>
            <option value="3">Compras</option>
        </select>
        <div class="invalid-feedback">Por favor, selecciona una categoría.</div>
    </div>

    <button type="submit" name="todo_add" class="btn btn-primary">Añadir tarea</button>
</form>

</div>

<!-- Bootstrap JS Bundle (Popper + Bootstrap JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Tu JS personalizado -->
<script src="../public/js/toadd_list.js"></script>

</body>
</html>
