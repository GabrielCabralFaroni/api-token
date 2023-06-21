<?php 

require_once 'conexao.php';

// Obter dados de login do frontend
$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = $data->password;

// Verificar as credenciais do usuário
$stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Credenciais válidas, gerar um token
    $token = bin2hex(random_bytes(32));

    // Atualizar o token do usuário no banco de dados
    $stmt2 = $conn->prepare("UPDATE users SET token = ? WHERE username = ?");
    $stmt2->bind_param("ss", $token, $username);
    $stmt2->execute();
    $stmt2->close();

    // Retornar o token como resposta
    echo json_encode(["token" => $token]);
} else {
    // Credenciais inválidas
    echo json_encode(["error" => "Credenciais inválidas"]);
}

$stmt->close();
$conn->close();

?>


