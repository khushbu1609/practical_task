<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
          <h5>Reset Password</h5>
        </div>
        <div class="card-body">

          <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
          <?php elseif(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>

          <form id="resetForm" method="post" action="<?= base_url('reset-password') ?>">
            <input type="hidden" name="token" value="<?= esc($token) ?>">

            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <input type="password" name="password" id="password" class="form-control" required minlength="6">
            </div>

            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" required minlength="6">
            </div>

            <button type="submit" class="btn btn-primary w-100">Reset Password</button>

            <div class="text-center mt-3">
              <a href="<?= base_url('login') ?>">Back to Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#resetForm").validate({
    rules: {
      password: { required: true, minlength: 6 },
      confirm_password: { required: true, equalTo: "#password" }
    },
    messages: {
      password: { required: "Enter a new password", minlength: "Minimum 6 characters" },
      confirm_password: { required: "Confirm your password", equalTo: "Passwords must match" }
    },
    errorClass: 'text-danger'
  });
});
</script>

</body>
</html>
