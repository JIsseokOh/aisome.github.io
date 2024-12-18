<?php
header('Content-Type: application/json');

// MariaDB 연결
$host = 'localhost';
$db = 'test';
$user = 'root';

$pass = 'pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $data = json_decode(file_get_contents('php://input'), true);
    $column = $data['column'] ?? 't_id';
    $order = strtoupper($data['order'] ?? 'ASC');
    
    $validColumns = ['t_id', 'title', 'date', 'impact_factor', 'sentiment'];
    if (!in_array($column, $validColumns)) {
        $column = 't_id';
    }
    $order = ($order === 'DESC') ? 'DESC' : 'ASC';
    
    $orderBy = $column;
    if ($column === 'impact_factor') {
        $orderBy = "CAST(impact_factor AS DECIMAL(10,2))";
    }
    
    // video_url 컬럼 추가
    $stmt = $pdo->prepare("SELECT t_id, title, date, impact_factor, sentiment, video_url 
                          FROM youtube_title 
                          ORDER BY $orderBy $order");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($rows as &$row) {
        $row['badge_class'] = 'badge-secondary';
        if ($row['sentiment'] === '긍정적') {
            $row['badge_class'] = 'badge-success';
        } elseif ($row['sentiment'] === '부정적') {
            $row['badge_class'] = 'badge-danger';
        } elseif ($row['sentiment'] === '중립적') {
            $row['badge_class'] = 'badge-warning';
        }
    }
    
    echo json_encode($rows);
} catch (PDOException $e) {
    echo json_encode(['error' => 'DB 연결 실패: ' . $e->getMessage()]);
}
?>