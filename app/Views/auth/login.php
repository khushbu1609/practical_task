<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card col-md-6 offset-md-3">
    <div class="card-header">Login</div>
    <div class="card-body">
      <form id="loginForm" method="post" action="<?= base_url('login') ?>">
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Login</button>
      </form>
      
      <!-- Links Section -->
      <div class="mt-3 text-center">
        <a href="<?= base_url('backend/admin/users') ?>" class="me-3">Admin</a>
        <a href="<?= base_url('forgot-password') ?>" class="me-3">Forgot Password?</a>
        <!-- Added Registration Link -->
        <a href="<?= base_url('register') ?>">Register Now</a> 
      </div>

    </div>
  </div>
</div>

<script>
  $("#loginForm").validate();
</script>
</body>
</html>
