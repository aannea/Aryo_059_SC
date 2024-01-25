<?php
include "koneksi.php";
include "create_message.php";

// Function to delete a file
function deleteFile($filePath)
{
  if (file_exists($filePath)) {
    unlink($filePath);
    return true;
  } else {
    return false;
  }
}

$mahasiswa_id = $_GET['mahasiswa_id'];

// Retrieve the file name from the database before deleting the record
$sqlSelectFoto = "SELECT foto FROM mahasiswa WHERE mahasiswa_id = $mahasiswa_id";
$result = $conn->query($sqlSelectFoto);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $fotoToDelete = $row['foto'];

  // Construct the file path
  $filePath = "uploads/" . $fotoToDelete;
  deleteFile($filePath);
  $sqlDelete = "DELETE FROM mahasiswa WHERE mahasiswa_id = $mahasiswa_id";
  if ($conn->query($sqlDelete) === TRUE) {
    $conn->close();
    create_message("Hapus Data Berhasil", "success", "check");
    header("location:index.php");
    exit();
  } else {
    $conn->close();
    create_message("Error: " . $sqlDelete . "<br>" . $conn->error, "danger", "warning");
    header("location:index.php");
    exit();
  }

} else {
  // No record found with the specified mahasiswa_id
  $conn->close();
  create_message("Error: Record not found", "danger", "warning");
  header("location:index.php");
  exit();
}
?>