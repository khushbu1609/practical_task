<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Users List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Registered Users</h4>
      <div>
        <a href="<?= base_url('backend/admin/users/export/excel') ?>" class="btn btn-success btn-sm">Export Excel</a>
        <a href="<?= base_url('backend/admin/users/export/pdf') ?>" class="btn btn-danger btn-sm">Export PDF</a>
      </div>
    </div>
    <div class="card-body">
      <table id="usersTable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>DOB</th><th>Gender</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= esc($u['first_name'].' '.$u['last_name']) ?></td>
            <td><?= esc($u['email']) ?></td>
            <td><?= esc($u['dob']) ?></td>
            <td><?= esc($u['gender']) ?></td>
            <td>
              <a href="<?= base_url('backend/admin/users/view/'.$u['id']) ?>" class="btn btn-sm btn-info">View</a>
              <a href="<?= base_url('backend/admin/users/edit/'.$u['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="<?= base_url('backend/admin/users/delete/'.$u['id']) ?>" onclick="return confirm('Delete this user?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
$(function(){ $('#usersTable').DataTable(); });
</script>
</body>
</html>
