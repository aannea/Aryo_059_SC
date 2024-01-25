<?php
include "koneksi.php";
session_start();


$qkelas = "select * from kelas";
$data_kelas = $conn->query($qkelas);
$qmahasiswa = "select * from mahasiswa";
$data_mahasiswa = $conn->query($qmahasiswa);

$qmahasiswa = "select * from mahasiswa left join kelas on kelas.kelas_id = mahasiswa.kelas_id";
$data_mahasiswa = $conn->query($qmahasiswa);

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Form Mahasiswa</title>

  <!-- Bootstrap core CSS -->
  <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">

  <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container">
    <div class="py-5 text-center">
      <h2>Form Mahasiswa</h2>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <!-- Konten Data -->
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Data Mahasiswa</span>

          <span class="badge badge-secondary badge-pill text-white bg-black rounded-circle">
            <?php
            echo ($data_mahasiswa->num_rows == 0) ? 0 : $data_mahasiswa->num_rows; ?>

            <!-- foreach ($data_mahasiswa as $index => $value) {
            $jumlah_mahasiswa = $index + 1;
            }
            echo ($jumlah_mahasiswa == 0) ? 0 : $jumlah_mahasiswa; ?> -->
          </span>

        </h4>
        <?php
        echo ($data_mahasiswa->num_rows == 0) ? "Data Kosong" : "";
        foreach ($data_mahasiswa as $index => $value) {
          ?>

          <ul class="list-group mb-3">

            <li class="list-group-item d-flex justify-content-between">
              <div class="me-2">
                <img class="object-fit-contain" src="<?php echo $value['foto']; ?>" alt="<?php echo $value['foto']; ?>"
                  width="50px" height="50px">
              </div>

              <div class="me-2 d-flex flex-column">
                <h6 class="my-0">
                  <?php echo $value['nama_lengkap'] ?>
                </h6>
                <small class="text-muted my-0">
                  <?php echo $value['alamat'] ?>
                </small>
                <span class="text-muted my-0">

                  <?php
                  if ($value['kelas_id'] == 1) {
                    echo "IF-06-MM1";
                  } else if ($value['kelas_id'] == 2) {
                    echo "IF-06-MM2";
                  } else if ($value['kelas_id'] == 3) {
                    echo "IF-06-MM3";
                  } else if ($value['kelas_id'] == 4) {
                    echo "IF06SC1";
                  } else if ($value['kelas_id'] == 5) {
                    echo "IF06SC2";
                  } else if ($value['kelas_id'] == 6) {
                    echo "IF06TI1";
                  } else if ($value['kelas_id'] == 7) {
                    echo "IF06TI2";
                  } else if ($value['kelas_id'] == 8) {
                    echo "IF06TI3";
                  }
                  ?>
                </span>
              </div>

              <div>
                <a href="update_form.php?mahasiswa_id=<?php echo $value['mahasiswa_id'] ?>" type="button"
                  class="close text-success">
                  <span class="fa fa-pencil"></span>
                </a>
                <a href="hapus_data.php?mahasiswa_id=<?php echo $value['mahasiswa_id'] ?>" type="button"
                  class="close text-danger">
                  <span class="fa fa-trash"></span>
                </a>
              </div>

            </li>
          </ul>
          <?php
        }
        ?>

      </div>
      <div class="col-md-8 order-md-1">
        <!-- Konten Input -->
        <h4 class="mb-3">Input Data</h4>
        <div>
          <?php include "read_message.php" ?>
        </div>

        <form action="simpan_mahasiswa.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3 d-flex flex-column">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
          </div>
          <div class="mb-3 d-flex flex-column">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
          </div>
          <div class="mb-3 d-flex flex-column">
            <label for="kelas">Kelas</label>
            <select class="custom-select d-block w-100 form-control" id="Kelas" name="kelas_id" required>
              <option value="">Pilih...</option>
              <?php
              foreach ($data_kelas as $index => $value) {
                ?>
                <option value="<?php echo $value['kelas_id'] ?>">
                  <?php echo $value['nama'] ?>
                </option>
                <?php
              }
              ?>

            </select>
          </div>

          <div class="mb-3 d-flex flex-column">
            <label for="foto">Upload Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" required>
          </div>

          <div class="row">
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan Data</button>
        </form>

      </div>
    </div>

  </div>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-
      <script>
        document.write(/\d{4}/.exec(Date())[0])
      </script> Company Name
    </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
  </div>
  <script src="node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>