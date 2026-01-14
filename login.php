<?php
include 'dbconnect.php'; 

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if(empty($email) || empty($password)){
    echo json_encode([
        'success' => false,
        'message' => 'Email dan Password wajib diisi!'
    ]);
    exit;
}

$stmt = $conn->prepare("SELECT id, email, password, alamat, no_hp FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if($user && password_verify($password, $user['password'])){
    echo json_encode([
        'success' => true,
        'data' => [
            'id' => $user['id'],
            'email' => $user['email'],
            'alamat' => $user['alamat'],
            'no_hp' => $user['no_hp']
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Email atau Password salah!'
    ]);
}
?>
