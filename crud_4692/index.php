<?php
include('config/configuration.php');
include('style/sidebar.php');

$kode = "";
$nama = "";
$desc = "";
$sukses = "";
$error = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op = "";
}

// delete
if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "delete from matakuliah where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal menghapus data";
    }
}

// edit
if($op == 'edit'){
    $id = $_GET['id'];
    $sql1 = "select * from matakuliah where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kode = $r1['kd_mk'];
    $nama = $r1['nm_mk'];
    $desc = $r1['ds_mk'];

    if($kode == ''){
        $error = "Data Tidak Ditemukan";
    }
}

// CREATE
if(isset($_POST['simpan'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $desc = $_POST['desc'];

    if($kode && $nama && $desc) {
        if($op == 'edit'){ // update
            $sql1 = "update matakuliah set kd_mk = '$kode', nm_mk = '$nama', ds_mk = '$desc' where id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if($q1){
                $sukses = "Data Berhasil Diupdate!";
            } else {
                $error = "Data Gagal Diupdate";
            }
        } else { //insert
            $sql1 = "insert into matakuliah (kd_mk, nm_mk, ds_mk) values ('$kode', '$nama', '$desc')";
            $q1 = mysqli_query($koneksi, $sql1);
            if($q1) {
                $sukses = "Berhasil Memasukkan Data Baru";
            } else {
                $error = "Gagal Memasukkan Data"; 
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
    <title>Data Akademik D3 AMIKOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .mx-auto {
            max-width: 1100px;
        }

        .card {
            margin: 10px;
            left: 10%;
        }
        
        body{
            background-color: #eaebed;
        }
    </style>
</head>
<body>
    <div class="mx-auto ">
        <!-- Untuk memasukkan data -->
        <div class="card">
            <h5 class="card-header bg-warning bg-opacity-75">Add / Edit Data Mata Kuliah</h5>
            <div class="card-body">
                <?php 
                if($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php
                        header("refresh:5;url=index.php"); //5 detik
                }
                ?>
                <?php 
                if($sukses) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses ?>
                        </div>
                    <?php
                        header("refresh:3;url=index.php"); //3 detik
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="kode" class="col-sm-2 col-form-label">Kode Mata Kuliah</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="kode" name="kode" value="<?php echo $kode ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Mata Kuliah</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="desc" class="col-sm-2 col-form-label">Deskripsi Mata Kuliah</label>
                        <div class="col-sm-10">
                            <textarea  required type="text" class="form-control" id="desc" name="desc"><?php echo $desc ?></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Simpan Data" name="simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- Untuk Mengeluarkan Data -->
        <div class="card">
            <h5 class="card-header text-white bg-secondary">Data Mata Kuliah</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Mata Kuliah</th>
                            <th scope="col">Nama Mata Kuliah</th>
                            <th scope="col">Deskripsi Mata Kuliah</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql2 = "select * from matakuliah order by id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while($r2 = mysqli_fetch_array($q2)){
                            $id = $r2['id'];
                            $kode = $r2['kd_mk'];
                            $nama = $r2['nm_mk'];
                            $desc = $r2['ds_mk'];

                            ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kode ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $desc ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin Mau Delete Data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            <?php
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
