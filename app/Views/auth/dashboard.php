<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>"> <!-- optional -->
</head>
<body>

    <h1>Welcome to Your Dashboard</h1>

    <?php if (session()->has('user')): ?>
        <p>Hello, <strong><?= esc(session('user')['first_name'] ?? 'User') ?></strong> 👋</p>
        <p>Email: <?= esc(session('user')['email']) ?></p>
        <p><a href="<?= base_url('/logout') ?>">Logout</a></p>
    <?php else: ?>
        <p>You are not logged in.</p>
        <a href="<?= base_url('/login') ?>">Go to Login</a>
    <?php endif; ?>

</body>
</html>
