<?php 
require_once 'koneksi.php';

function register($data) {
	global $conn;
	$nama = htmlspecialchars($data['nama']);
	$username = $conn->real_escape_string($_POST['username']);
	$password = $conn->real_escape_string($_POST['password']);
	$password2 = $conn->real_escape_string($_POST['password2']);


	if($password != $password2) {
		echo "<script>alert('konfirmasi password salah.');</script>";
		return false;
	}

	if(strlen($username) < 6 ) {
		echo "<script>alert('Password terlalu pendek, maksimal 6 digit');window.location='register.php';</script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	$conn->query("INSERT INTO tb_user VALUES (null, '$username', '$password', '$nama')") or die(mysqli_error($conn));
	return $conn->affected_rows;
}

