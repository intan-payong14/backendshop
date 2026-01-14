<?php
include 'dbconnect.php'; 

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
$no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : '';

if(empty($email) || empty($password) || empty($alamat) || empty($no_hp)){
    echo json_encode(['success'=>false,'message'=>'Semua kolom wajib diisi!']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0){
    echo json_encode(['success'=>false,'message'=>'Email sudah digunakan']);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert = $conn->prepare("INSERT INTO users (email,password,alamat,no_hp) VALUES (?,?,?,?)");
if (!$insert) {
    echo json_encode(['success'=>false,'message'=>'Prepare gagal: '.$conn->error]);
    exit;
}

$insert->bind_param("ssss",$email,$hashed_password,$alamat,$no_hp);

if($insert->execute()){
    echo json_encode(['success'=>true,'message'=>'Registrasi berhasil']);
}else{
    echo json_encode(['success'=>false,'message'=>'Gagal registrasi: '.$insert->error]);
}

?>
