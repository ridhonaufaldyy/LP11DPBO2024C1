<?php

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");

$tp = new TampilPasien();

// Memanggil fungsi deleteController jika parameter 'delete' ada dalam URL
if (isset($_GET['delete'])) {
    $tp->deleteToPresenter($_GET['delete']);
}
else if(isset($_GET['add'])){
    $tp->toForm();
}

// Menampilkan data pasien
$tp->tampil();


