<?php
require_once('init_pdo.php');

function get_users($pdo) {
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function get_user_by_id($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function set_headers() {
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
}

switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if (isset($_GET['id'])) {
            $user = get_user_by_id($pdo, $_GET['id']);
            if ($user) {
                set_headers();
                echo json_encode($user);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'User not found']);
            }
        } else {
            $users = get_users($pdo);
            set_headers();
            echo json_encode($users);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if ($data && isset($data->name) && isset($data->email)) {
            $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $stmt->execute(['name' => $data->name, 'email' => $data->email]);
            http_response_code(201); // Created
            echo json_encode(['id' => $pdo->lastInsertId()]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid input']);
        }
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents("php://input"));
            if ($data && isset($data->name) && isset($data->email)) {
                $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
                $stmt->execute(['name' => $data->name, 'email' => $data->email, 'id' => $_GET['id']]);
                if ($stmt->rowCount()) {
                    http_response_code(200); // OK
                    echo json_encode(['message' => 'User updated successfully']);
                } else {
                    http_response_code(404); // Not Found
                    echo json_encode(['error' => 'User not found or no changes made']);
                }
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['error' => 'Invalid input']);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'User ID not provided']);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $_GET['id']]);
            if ($stmt->rowCount()) {
                http_response_code(200); // OK
                echo json_encode(['message' => 'User deleted successfully']);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'User not found']);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'User ID not provided']);
        }
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed']);
}
