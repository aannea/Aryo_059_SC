<?php
include "koneksi.php";
include "create_message.php";

$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];

if (!preg_match("/^[a-zA-Z0-9\s]+$/", $nama_lengkap)) {
  create_message("Error: " . $nama_lengkap . " gagal disimpan, disarankan tidak ada simbol", "danger", "warning");
  header("location:index.php");
  exit();
}

if (!preg_match("/^[a-zA-Z0-9\s]+$/", $alamat)) {
  create_message("Error: " . $alamat . " gagal disimpan, disarankan tidak ada simbol", "danger", "warning");
  header("location:index.php");
  exit();
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$error = false;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["foto"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $error = false;
  } else {
    echo "File is not an image.";
    $error = false;
  }
}

if ($_FILES["foto"]["size"] > 1000000) {
  echo "Sorry, your file is too large.";
  $error = true;
  create_message("Error: Ukuran File Terlalu Besar", "danger", "warning");
  header("location:index.php");
  exit();
}

if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $error = true;
  create_message("Error: " . $target_file . " gagal disimpan, file Sudah Ada", "danger", "warning");
  header("location:index.php");
  exit();
}

if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $error = true;
}

if ($error == true) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["foto"]["name"]) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

  $foto = $_FILES['foto']['name'];
  $foto_extension = pathinfo($foto, PATHINFO_EXTENSION);

  $allowed_extensions = array("jpg", "jpeg", "png", "gif");

  if (!in_array(strtolower($foto_extension), $allowed_extensions)) {
    create_message("Error: Foto tidak valid. Hanya file dengan ekstensi JPG, JPEG, PNG, dan GIF diperbolehkan.", "danger", "warning");
    header("location:index.php");
    exit();
  }

  $sql = "INSERT INTO mahasiswa (nama_lengkap, kelas_id, alamat, foto) VALUES ('$nama_lengkap', " . (int) $_POST['kelas_id'] . ", '$alamat', '$target_file')";

  if ($conn->query($sql) === TRUE) {
    $conn->close();
    create_message("Simpan Data Berhasil", "success", "check");
    header("location:index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close();
    create_message("Error: ", "danger", "warning");
    header("location:index.php");
    exit();
  }
} else {
  create_message("Error: Foto tidak terupload", "danger", "warning");
  header("location:index.php");
  exit();
}
?>