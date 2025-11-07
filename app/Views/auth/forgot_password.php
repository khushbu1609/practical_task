<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
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
          <h5>Forgot Password</h5>
        </div>
        <div class="card-body">
          
          <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
          <?php elseif(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>

          <form id="forgotForm" method="post" action="<?= base_url('forgot-password') ?>">
            <div class="mb-3">
              <label for="email" class="form-label">Enter Your Registered Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>

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
  $("#forgotForm").validate({
    rules: {
      email: { required: true, email: true }
    },
    messages: {
      email: { required: "Please enter your registered email" }
    },
    errorClass: 'text-danger'
  });
});
</script>

</body>
</html>
