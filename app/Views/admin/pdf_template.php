<!DOCTYPE html>
<html>
<head>
  <style>
    table { width:100%; border-collapse:collapse; }
    th,td { border:1px solid #333; padding:8px; font-size:12px; text-align:left; }
    th { background:#f2f2f2; }
  </style>
</head>
<body>
<h3>Registered Users</h3>
<table>
  <thead>
    <tr>
      <th>ID</th><th>Name</th><th>Email</th><th>DOB</th><th>Gender</th><th>Address</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($users as $u): ?>
    <tr>
      <td><?= $u['id'] ?></td>
      <td><?= $u['first_name'].' '.$u['last_name'] ?></td>
      <td><?= $u['email'] ?></td>
      <td><?= $u['dob'] ?></td>
      <td><?= $u['gender'] ?></td>
      <td><?= $u['address'] ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>
