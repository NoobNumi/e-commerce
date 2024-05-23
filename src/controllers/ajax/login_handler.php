<?php
include '../connection.php';

$response = array('success' => false, 'message' => '');

if (isset($_POST['email']) && isset($_POST['password'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $response['error'] = 'account_not_found';
            echo json_encode($response);
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($password, $user['password'])) {
            $response['error'] = 'credentials_incorrect';
            echo json_encode($response);
            exit();
        }

        $response['success'] = true;

    } catch (PDOException $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid input!';
}

echo json_encode($response);
?>