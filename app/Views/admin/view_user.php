<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>View User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card">
    <div class="card-header">User Details</div>
    <div class="card-body">
      <p><strong>Name:</strong> <?= esc($user['first_name'].' '.$user['last_name']) ?></p>
      <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
      <p><strong>DOB:</strong> <?= esc($user['dob']) ?></p>
      <p><strong>Gender:</strong> <?= esc($user['gender']) ?></p>
      <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
      <p><strong>Profile Picture:</strong><br>
        <img src="<?= base_url('uploads/profiles/'.$user['profile_picture']) ?>" width="120" class="rounded-circle">
      </p>
      <?php if ($user['signature']): ?>
      <p><strong>Signature:</strong><br>
        <img src="<?= $user['signature'] ?>" alt="User Signature" style="border: 1px solid #000; max-width: 400px; height: auto;">
</p>
      <?php endif; ?>
      <a href="<?= base_url('backend/admin/users') ?>" class="btn btn-secondary mt-3">Back</a>
    </div>
  </div>
</div>
</body>
</html>
