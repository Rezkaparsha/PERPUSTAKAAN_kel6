<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hanya pengguna yang boleh akses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: /PERPUSTAKAAN_kel6/index.php?page=login&msg=Akses ditolak");
    exit;
}

include_once __DIR__ . "/../../template/navbar_pengguna.php"; 
include_once __DIR__ . "/../../model/m_user.php";

$userModel = new m_user();
$id_user   = $_SESSION['id_user'];
$user      = $userModel->get_user_by_id($id_user); // gunakan fungsi get_user_by_id
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Saya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f7fc; font-family: 'Segoe UI', sans-serif; }
    .form-container {
      max-width: 600px; margin: 40px auto; background: white;
      padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h4 class="mb-4">👤 Profil Saya</h4>
    <form method="POST" action="/PERPUSTAKAAN_kel6/controller/c_user.php?aksi=update_profil">
      <input type="hidden" name="id_user" value="<?= htmlspecialchars($user->id_user) ?>">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" 
               value="<?= htmlspecialchars($user->username) ?>" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" 
               value="<?= htmlspecialchars($user->email) ?>" required>
      </div>
      <div class="mb-3">
        <label>Password Baru</label>
        <input type="password" name="password" class="form-control" 
               placeholder="Kosongkan jika tidak ingin mengubah">
      </div>
      <div class="mb-3">
        <label>Role</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($user->role) ?>" readonly>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</body>
</html>
