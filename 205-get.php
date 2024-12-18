<?php
// 203-get.php
header('Content-Type: application/json');

// MariaDB 연결
$host = 'localhost';
$db = 'test';
$user = 'root';
$pass = 'pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POST 데이터 수신
    $data = json_decode(file_get_contents('php://input'), true);
    $t_id = $data['t_id'] ?? null;

    if ($t_id) {
        // 댓글 데이터 가져오기
        $stmt = $pdo->prepare("SELECT t_id, text, likes FROM comments WHERE t_id = ?");
        $stmt->execute([$t_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // 빈 배열이어도 성공으로 처리
        echo json_encode($comments);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid t_id']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>