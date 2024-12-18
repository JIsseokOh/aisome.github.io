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
    $company_id = $data['company_id'] ?? null;
    
    // 유효한 컬럼 확인
    $validColumns = ['t_id', 'title', 'date', 'impact_factor', 'sentiment'];
    if (!in_array($column, $validColumns)) {
        $column = 't_id';
    }
    $order = ($order === 'DESC') ? 'DESC' : 'ASC';
    
    // 테이블 이름 동적 생성
    $table_name = "youtube_title_" . $company_id;
    
    // 정렬 컬럼 처리
    $orderBy = $column;
    if ($column === 'impact_factor') {
        $orderBy = "CAST(impact_factor AS DECIMAL(10,2))";
    }
    
    // 쿼리 준비 및 실행 (200개 레코드로 제한)
    //$stmt = $pdo->prepare("SELECT t_id, title, date, impact_factor, sentiment, video_url 
    //                      FROM $table_name 
    //                      ORDER BY $orderBy $order 
    //                      LIMIT 200");

    // 쿼리 준비 및 실행 (200개 레코드로 제한) and 2024년 자료만 
    $stmt = $pdo->prepare("SELECT t_id, title, date, impact_factor, sentiment, video_url 
                      FROM $table_name 
                      WHERE YEAR(date) = 2024
                      ORDER BY $orderBy $order 
                      LIMIT 200");    


    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // 감성에 따른 배지 클래스 추가
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