<?php
// 데이터베이스 연결 설정
$host = 'localhost';
$dbname = 'test'; // 데이터베이스 이름
$username = 'root';    // 데이터베이스 사용자 이름

$password = 'pass';

try {
    // PDO 객체 생성
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 월별 데이터 계산 쿼리
    $query = "
        INSERT INTO chart_01 (y_month, positive_count, negative_count, neutral_count)
        SELECT 
            DATE_FORMAT(STR_TO_DATE(date, '%Y-%m-%dT%H:%i:%sZ'), '%Y-%m') AS y_month,
            SUM(CASE WHEN sentiment = '긍정적' THEN 1 ELSE 0 END) AS positive_count,
            SUM(CASE WHEN sentiment = '부정적' THEN 1 ELSE 0 END) AS negative_count,
            SUM(CASE WHEN sentiment = '중립적' THEN 1 ELSE 0 END) AS neutral_count
        FROM 
            youtube_title
        GROUP BY 
            y_month
        ON DUPLICATE KEY UPDATE 
            positive_count = VALUES(positive_count),
            negative_count = VALUES(negative_count),
            neutral_count = VALUES(neutral_count),
            updated_at = CURRENT_TIMESTAMP;
    ";

    // 쿼리 실행
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // 성공 메시지 출력
    echo "Chart data updated successfully!";
} catch (PDOException $e) {
    // 에러 메시지 출력
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // 일반 예외 처리
    echo "An unexpected error occurred: " . $e->getMessage();
}
?>
