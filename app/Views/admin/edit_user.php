<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <div class="card">
    <div class="card-header">Edit User</div>
    <div class="card-body">
      <form method="post" action="<?= base_url('backend/admin/users/update/'.$user['id']) ?>">
        <div class="row">
          <div class="col-md-6">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?= esc($user['first_name']) ?>" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?= esc($user['last_name']) ?>" class="form-control" required>
          </div>
        </div>
        <div class="mt-3">
          <label>Email</label>
          <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <label>DOB</label>
            <input type="date" name="dob" value="<?= esc($user['dob']) ?>" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Gender</label>
            <select name="gender" class="form-select">
              <option <?= $user['gender']=='male'?'selected':'' ?>>Male</option>
              <option <?= $user['gender']=='female'?'selected':'' ?>>Female</option>
              <option <?= $user['gender']=='other'?'selected':'' ?>>Other</option>
            </select>
          </div>
        </div>
        <div class="mt-3">
          <label>Address</label>
          <textarea name="address" class="form-control"><?= esc($user['address']) ?></textarea>
        </div>
        <button class="btn btn-primary mt-3">Update</button>
        <a href="<?= base_url('backend/admin/users') ?>" class="btn btn-secondary mt-3">Cancel</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
