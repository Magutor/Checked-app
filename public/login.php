<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<?php
require_once __DIR__ . '/../config/database.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscar usuario por email
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute(params: [$email]);
    $user = $stmt->fetch();
    echo $user;

    if ($user && password_verify($password, hash: $user['password'])) {
        // Login correcto
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php'); 
        exit;
    } else {
        // Login incorrecto
        $_SESSION['login_error'] = 'Email o contraseña incorrectos';
        header('Location: login.php');
        exit;
    }
}
?>
<?php 
    include_once __DIR__ . '/../public/header.php'; 
?>



<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8" /><title>Login</title></head>
<body>
<h2>Login</h2>
<form method="post" action="login.php">
    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <button type="submit">Entrar</button>
</form>
<?php
if (isset($_SESSION['login_error'])) {
    echo '<p style="color:red;">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']);
}
?>
</body>
</html>