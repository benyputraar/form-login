<?php

//koneksi
$koneksi = mysqli_connect('localhost','root','','tutorial-login');

//daftar
if (isset($_POST['register'])){
    //jika tombol register dklik

    $username = $_POST['username'];
    $password = $_POST['password'];// pure inputan user belum di enksripsi

    //fungsi enksripsi 
    $epassword = password_hash($password, PASSWORD_DEFAULT);

    //insert to database 
    $insert = mysqli_query($koneksi,"INSERT INTO user (username,password)values ('$username','$epassword')");

    if ($insert){
        //jika berhasil
        header('location:index.php'); //redirect ke halaman login 
    }else{
        // jika gagal 
        echo '
        <script> 
        alert ("Registrasi gagal");
        window:location.href="register.php";
        </script>';
    }
}

//login
if (isset($_POST['login'])){
    //jika tombol register dklik

    $username = $_POST['username'];
    $password = $_POST['password'];// pure inputan user belum di enksripsi


    //insert to database 
    $cekdb = mysqli_query($koneksi,"SELECT*FROM user where username='$username'");
    $hitung = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_array($cekdb);
    $passwordsekarang = $pw ['password'];

    if ($hitung>0){
        //jika ada
        //verifikasi password
        if(password_verify($password,$passwordsekarang)){
        //jika passwordnya benar
            header('location:home.php'); //redirect ke halaman home
        }else {
            // jika password salah 
        echo '
        <script> 
        alert ("Password salah");
        window:location.href="register.php";
        </script>';
            
        }
    }else{
        // jika gagal 
        echo '
        <script> 
        alert ("login gagal");
        window:location.href="register.php";
        </script>';
    }
}



?>