<?php
include('../config/configuration.php');
include('../style/sidebar.php');

$kode = "";
$nama = "";
$tanggal = "";
$judul = "";
$materi = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

// edit
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "select * from modul where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    // $r1 = mysqli_fetch_array($q1);
    $r1 = mysqli_fetch_assoc($q1);
    $kode = $r1['kode'];
    $nama = $r1['nama'];
    $tanggal = $r1['tanggal'];
    $judul = $r1['judul'];
    $materi = $r1['materi'];

    if ($kode == '') {
        $error = "Data Tidak Ditemukan";
    }
}

// delete
if ($op == 'delete') {
    $id = $_GET['id'];

    $queryShow = "select * from modul where id = '$id'";
    $sqlShow = mysqli_query($koneksi, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    unlink("../file_materi/" . $result['materi']);

    $sql1 = "delete from modul where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal menghapus data";
    }
}



// create from name
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $materi = $_FILES['materi']['name'];

    $dir = "../file_materi/";
    $tmpFile = $_FILES['materi']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $materi);

    if ($kode && $nama && $tanggal && $judul && $materi) {
        if ($op == 'edit') { // update
            $sql1 = "update modul set kode = '$kode', nama = '$nama', tanggal = '$tanggal', judul = '$judul', materi = '$materi' where id = '$id';";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil Diupdate!";
            } else {
                $error = "Data Gagal Diupdate";
            }
        } else { //insert
            $sql1 = "insert into modul(kode, nama, tanggal, judul, materi) values ('$kode', '$nama', '$tanggal', '$judul', '$materi')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan Masukkan Semua Data!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Perkuliahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .mx-auto {
            max-width: 1100px;
        }

        .card {
            margin-top: 10px;
            left: 10%;
        }

        body {
            background-color: #eaebed;
        }
    </style>
</head>

<body>
    <div class="container mx-auto">
        <div class="sidebar">
            <a href="../index.php"><i class="fa fa-fw fa-home"></i> Mata Kuliah</a>
            <a class="active" href="#"><i class="fa fa-address-book-o"></i> Materi Pertemuan</a>
        </div>
        <div class="card">
            <h5 class="card-header text-white bg-primary bg-opacity-75">Aplikasi Upload Materi Kuliah</h5>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php"); //5 detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:3;url=index.php"); //3 detik
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id ?>">
                    <div class="mb-3 row">
                        <label for="kode" class="col-sm-2 col-form-label">Kode Mata Kuliah</label>
                        <div class="col-sm-10">
                            <select type="text" class="form-select" id="nama" name="kode">
                                <?php
                                $kdl = 'select * from matakuliah';
                                $kodematkul = mysqli_query($koneksi, $kdl);
                                while ($km = mysqli_fetch_array($kodematkul)) {
                                    echo "<option value='$km[kd_mk]'>$km[kd_mk]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Mata Kuliah</label>
                        <div class="col-sm-10">
                            <select type="text" class="form-select" id="nama" name="nama">
                                <?php
                                $mkl = 'select * from matakuliah';
                                $namamatkul = mysqli_query($koneksi, $mkl);
                                while ($matkul = mysqli_fetch_array($namamatkul)) {
                                    echo "<option value='$matkul[nm_mk]'>$matkul[nm_mk]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Pertemuan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="materi" class="col-sm-2 col-form-label">Materi Pertemuan</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="materi" name="materi"><?php echo $materi ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Upload" name="simpan" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header text-white bg-success bg-opacity-50">View PDF</h5>
            <div class="card-body">
                <?php
                if (isset($_GET['op'])) {
                    if ($_GET['op'] == 'view') {
                        $id = $_GET['id'];
                        $queryShow = "select * from modul where id = '$id'";
                        $sqlShow = mysqli_query($koneksi, $queryShow);
                        $result = mysqli_fetch_assoc($sqlShow);
                ?>
                        <!-- <object data="../file_materi/<?php echo $result['materi']; ?>" width="100%" height="500px"></object> -->
                        <!-- Atau -->
                        <embed src="../file_materi/<?php echo $result['materi']; ?>" type="application/pdf" width="100%" height="500px">
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header text-white bg-dark bg-opacity-50">Data Materi Pertemuan</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 3%;">No.</th>
                            <th scope="col" style="width: 3%;">Kode</th>
                            <th scope="col" style="width: 5%;">Mata Kuliah</th>
                            <th scope="col" style="width: 5%;">Tanggal</th>
                            <th scope="col" style="width: 5%;">Judul</th>
                            <th scope="col" style="width: 10%;">Materi Pertemuan</th>
                            <th scope="col" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql2 = "select * from modul order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $kode = $r2['kode'];
                            $nama = $r2['nama'];
                            $tanggal = $r2['tanggal'];
                            $judul = $r2['judul'];
                            $materi = $r2['materi'];

                        ?>
                            <tr>
                                <td scope="row"><?php echo $no; ?></td>
                                <td scope="row"><?php echo $kode ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $tanggal ?></td>
                                <td scope="row"><?php echo $judul ?></td>
                                <td scope="row"><?php echo $materi ?></td>
                                <td scope="row">
                                    <a href="index.php?op=view&id=<?php echo $id ?>"><button type="button" class="btn btn-success">View</button></a>
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin Mau Delete Data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>