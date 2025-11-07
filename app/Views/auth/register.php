<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/3.0.0-beta.4/signature_pad.umd.min.js"></script> -->
    <!-- Include Signature Pad library from a reliable CDN -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-primary text-white">Register</div>
    <div class="card-body">
      <form id="registerForm" action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-6">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
        </div>

        <div class="mt-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mt-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required minlength="6">
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Gender</label>
            <select name="gender" class="form-select" required>
              <option value="">Select</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
          </div>
        </div>

        <div class="mt-3">
          <label>Address</label>
          <textarea name="address" class="form-control" required></textarea>
        </div>

        <!-- Profile Picture Cropping -->
        <div class="mt-3">
          <label>Profile Picture</label>
          <input type="file" id="upload" accept="image/*" class="form-control">
          <input type="hidden" name="profile_picture" id="profile_picture">
          <div id="preview-area" class="mt-3 text-center"></div>
        </div>

        <!-- Signature Section -->
        <div class="mt-3">
          <label>Signature</label>
          <canvas id="signature-pad" class="border" width="400" height="150"></canvas><br>
          <button type="button" id="clear-signature" class="btn btn-sm btn-warning mt-2">Clear</button>
          <input type="hidden" name="signature" id="signature">
        </div>

        <button type="submit" class="btn btn-primary mt-4">Register</button>
      </form>
    </div>
  </div>
</div>

<!-- Croppie Modal -->
<div class="modal fade" id="cropModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div id="croppie-container"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="cropImageBtn" class="btn btn-success">Crop & Save</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){

  // === jQuery Validation ===
  $("#registerForm").validate({
    rules: {
      first_name: {
        required: true,
        minlength: 2
      },
      last_name: {
        required: true,
        minlength: 2
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
      dob: {
        required: true,
        date: true
      },
      gender: {
        required: true
      },
      address: {
        required: true,
        minlength: 5
      },
      profile_picture: {
        required: true
      },
      signature: {
        required: true
      }
    },
    messages: {
      first_name: {
        required: "Please enter your first name",
        minlength: "First name must be at least 2 characters"
      },
      last_name: {
        required: "Please enter your last name",
        minlength: "Last name must be at least 2 characters"
      },
      email: {
        required: "Please enter your email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Password must be at least 6 characters"
      },
      dob: {
        required: "Please enter your date of birth"
      },
      gender: {
        required: "Please select your gender"
      },
      address: {
        required: "Please enter your address",
        minlength: "Address must be at least 5 characters"
      },
      profile_picture: {
        required: "Please upload and crop your profile picture"
      },
      signature: {
        required: "Please provide your signature"
      }
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
      error.addClass("text-danger mt-1");
      if (element.prop("type") === "file" || element.prop("type") === "hidden") {
        error.insertAfter(element.closest("div"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },
    submitHandler: function (form) { 

      form.submit();
    }
  });
});


  // === Signature ===
  const canvas = document.getElementById('signature-pad');
  const signaturePad = new SignaturePad(canvas);
  $('#clear-signature').click(() => signaturePad.clear());
  $('form').on('submit', function(){
    if (!signaturePad.isEmpty()) {
      $('#signature').val(signaturePad.toDataURL());
    }
  });

  // === Croppie setup ===
  let croppieInstance;
  let cropModal = new bootstrap.Modal(document.getElementById('cropModal'), {});

  $('#upload').on('change', function(){
    const reader = new FileReader();
    reader.onload = function(e) {
      $('#croppie-container').html('');
      croppieInstance = $('#croppie-container').croppie({
        viewport: { width: 200, height: 200, type: 'circle' },
        boundary: { width: 300, height: 300 },
        enableExif: true
      });
      croppieInstance.croppie('bind', { url: e.target.result });
      cropModal.show();
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('#cropImageBtn').on('click', function(){
    croppieInstance.croppie('result', { type: 'base64', size: 'viewport' }).then(function(base64){
      $('#preview-area').html('<img src="'+base64+'" class="rounded-circle shadow" width="150">');
      $('#profile_picture').val(base64);
      cropModal.hide();
    });
  });
});
</script>
</body>
</html>
