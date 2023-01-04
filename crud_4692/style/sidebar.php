<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS | Ratif Cahyadi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .sidebar {
    margin: 0;
    padding: 0;
    left: 10px;
    width: 200px;
    background-color: rgb(182, 182, 186);
    position: fixed;
    height: 500px;
    overflow: auto;
    border-radius: 15px;
    border: 3px solid #fff;
}

.sidebar a {
    display: block;
    color: #484852;
    padding: 10px;
    text-decoration: none;
    margin: 15px 10px;
    border-radius: 10px;
    border: 2px solid #484852;
}

.sidebar a.active {
    background-color: #4141cd;
    color: white;
    margin: 15px 10px;
    border: 2px solid #4141cd;
    
}

.sidebar a:hover:not(.active) {
    background-color: #484852;
    margin: 15px 10px;
    color: white;
}

div.content {
    margin-left: 200px;
    padding: 1px 16px;
    height: 1000px;
}

@media screen and (max-width: 700px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    .sidebar a {float: left;}
    div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
    .sidebar a {
        text-align: center;
        float: none;
    }
}
    </style>
</head>
<body>
    <div class="sidebar">
		<a class="active" href="#"><i class="fa fa-fw fa-home"></i> Mata Kuliah</a>
		<a  href="fileUpload/index.php"><i class="fa fa-address-book-o"></i> Materi Pertemuan</a>
	</div>
</body>
</html>