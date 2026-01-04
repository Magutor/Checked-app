USE checked_db;

-- Insertar usuarios de prueba
INSERT INTO users (name, email, password, phone, birth_date)
VALUES 
('Miguel Ruiz', 'miguel@example.com', '123', '626272890', '1995-05-12'),
('Maria Agüera', 'maria@example.com', '123', '626272891', '1998-09-23');

-- Insertar categorías de tareas
INSERT INTO categories (name)
VALUES 
('Salud'),
('Citas'),
('Compras'),
('Ocio');

-- Insertar tareas de prueba para Miguel (ID usuario 1)
-- Categorías: 1 = Salud, 2 = Citas
INSERT INTO todos (user_id, category_id, title, description, due_date, completed)
VALUES
(1, 1, 'Tomar medicina', 'Tomar la pastilla de la tensión a las 21.00', '2025-06-14', 0),
(1, 2, 'Llamar al médico', 'Revisar los resultados de la analítica', '2025-06-15', 0);

-- Insertar tareas de prueba para Maria (ID usuario 2)
-- Categoría: 3 = Compras
INSERT INTO todos (user_id, category_id, title, description, due_date, completed)
VALUES
(2, 3, 'Ir al supermercado', 'Comprar pan, leche y frutas', '2025-06-14', 0);

-- Insertar alertas para tareas
-- Asumimos que las tareas tienen IDs 1, 2, y 3, en ese orden
INSERT INTO reminders (todo_id, reminder_time, method)
VALUES
(1, '2025-06-14 20:30:00', 'popup'), -- Recordatorio para tomar medicina
(2, '2025-06-15 09:00:00', 'popup'), -- Llamar al médico
(3, '2025-06-14 10:00:00', 'popup'); -- Ir al supermercado
