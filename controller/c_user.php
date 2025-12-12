<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../model/m_user.php";

$userModel = new m_user();
$aksi = $_GET['aksi'] ?? '';

// ----------------- EDIT USER (PETUGAS) -----------------
if ($aksi === "edit") {
    $id = $_GET['id_user'] ?? null;
    if (!$id) {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=pengguna&msg=ID pengguna tidak ditemukan");
        exit;
    }

    $user = $userModel->get_user_by_id($id);
    if (!$user) {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=pengguna&msg=Data pengguna tidak ditemukan");
        exit;
    }

    include __DIR__ . "/../views/PETUGAS/v_form_ubah_pengguna.php";
    exit;
}

// ----------------- UPDATE USER (PETUGAS) -----------------
if ($aksi === "update") {
    $id       = $_POST['id_user'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    if (empty($password)) {
        $userModel->update_user_no_password($id, $username, $email, $role);
    } else {
        $userModel->update_user($id, $username, $email, $password, $role);
    }

    echo "<script>alert('Data pengguna berhasil diupdate!'); 
          window.location='/PERPUSTAKAAN_kel6/index.php?page=pengguna';</script>";
    exit;
}

// ----------------- HAPUS USER (PETUGAS) -----------------
if ($aksi === "hapus") {
    $id = $_GET['id_user'] ?? null;
    if ($id) {
        $userModel->hapus_user($id);
        echo "<script>alert('Data pengguna berhasil dihapus!'); 
              window.location='/PERPUSTAKAAN_kel6/index.php?page=pengguna';</script>";
    } else {
        header("Location: /PERPUSTAKAAN_kel6/index.php?page=pengguna&msg=ID pengguna tidak ditemukan");
    }
    exit;
}

// ----------------- UPDATE PROFIL (PENGGUNA) -----------------
if ($aksi === "update_profil") {
    $id       = $_POST['id_user'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Role tetap dari session (pengguna tidak boleh ubah role sendiri)
    $role = $_SESSION['role'];

    if (empty($password)) {
        $userModel->update_user_no_password($id, $username, $email, $role);
    } else {
        $userModel->update_user($id, $username, $email, $password, $role);
    }

    // Update session supaya data terbaru langsung dipakai
    $_SESSION['username'] = $username;

    echo "<script>alert('Profil berhasil diperbarui!'); 
          window.location='/PERPUSTAKAAN_kel6/index.php?page=profil';</script>";
    exit;
}
