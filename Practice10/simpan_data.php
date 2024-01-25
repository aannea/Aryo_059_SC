<?php
include "koneksi.php";
include "create_message.php";

$sql = "UPDATE mahasiswa SET nama_lengkap = '" . $_POST['nama_lengkap'] . "', alamat = '" . $_POST['alamat'] . "', kelas_id = '" . $_POST['kelas_id'] . "' WHERE (mahasiswa_id = '" . $_POST['mahasiswa_id'] . "');";
if (!preg_match("/^[a-zA-Z ]*$/", $_POST['nama_lengkap'])) {
  create_message("Error: Nama hanya boleh mengandung huruf dan spasi", "danger", "warning");
  header("location:" . $_SERVER['HTTP_REFERER']);
  exit();
}

if (!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['alamat'])) {
  create_message("Error: Alamat hanya boleh mengandung huruf, angka, dan spasi", "danger", "warning");
  header("location:" . $_SERVER['HTTP_REFERER']);
  exit();
}

if (isset($_POST['mahasiswa_id'])) {
  // Kondisi Update
  $sql_select = "SELECT * FROM mahasiswa WHERE mahasiswa_id = " . $_POST['mahasiswa_id'];
  $result_select = $conn->query($sql_select);

  if ($result_select->num_rows > 0) {
    $row = $result_select->fetch_assoc();

    // Delete the existing photo file
    if (!empty($row['foto'])) {
      unlink($row['foto']);
    }

    // Handle photo upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!empty($_FILES["foto"]["tmp_name"])) {
      $check = getimagesize($_FILES["foto"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        create_message("Error: File is not an image.", "danger", "warning");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
      }

      if ($_FILES["foto"]["size"] > 1000000) {
        create_message("Error: Sorry, your file is too large.", "danger", "warning");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
      }

      $allowed_file_types = array("jpg", "jpeg", "png", "gif");
      if (!in_array($imageFileType, $allowed_file_types)) {
        create_message("Error: Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "danger", "warning");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
      }

      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        create_message("The file " . basename($_FILES["foto"]["name"]) . " has been uploaded.", "success", "check");
      } else {
        create_message("Error: Sorry, there was an error uploading your file.", "danger", "warning");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
      }
    }
  }

  $sql_update = "UPDATE mahasiswa SET nama_lengkap = '" . $_POST['nama_lengkap'] . "', alamat = '" . $_POST['alamat'] . "', kelas_id = '" . $_POST['kelas_id'] . "', foto = '" . $target_file . "' WHERE (mahasiswa_id = '" . $_POST['mahasiswa_id'] . "');";

  if ($conn->query($sql_update) === TRUE) {
    $conn->close();
    create_message("Ubah Data Berhasil", "success", "check");
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    $conn->close();
    create_message("Error: " . $sql_update . "<br>" . $conn->error, "danger", "warning");
    header("location:" . $_SERVER['HTTP_REFERER']);
    exit();
  }
} else {
  $sql = "INSERT INTO mahasiswa (nama_lengkap, kelas_id, alamat) VALUES ('" . $_POST['nama_lengkap'] . "', " . $_POST['kelas_id'] . ", '" . $_POST['alamat'] . "')";

  if ($conn->query($sql) === TRUE) {
    $conn->close();
    create_message("Simpan Data Berhasil", "success", "check");
    header("location:index.php");
    exit();
  } else {
    $conn->close();
    create_message("Error: " . $sql . "<br>" . $conn->error, "danger", "warning");
    header("location:index.php");
    exit();
  }
}
?>