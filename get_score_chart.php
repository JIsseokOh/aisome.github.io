<?php
// 데이터베이스 연결 정보 설정
$host = 'localhost';
$dbname = 'test'; // 실제 데이터베이스 이름으로 변경
$username = 'root';
$password = 'pass'; // 실제 비밀번호로 변경

// MySQL 연결 생성
$conn = new mysqli($host, $username, $password, $dbname);

// 연결 오류 검사
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 날짜 오름차순으로 데이터를 가져와 최신 항목이 마지막에 오도록 설정
$sql = "SELECT date, score FROM eye_score";
$result = $conn->query($sql);

// 데이터를 저장할 배열 초기화
$dates = [];
$scores = [];

// 쿼리 결과가 있는 경우 데이터 배열에 저장
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
        $scores[] = $row['score'];
    }
} else {
    // 결과가 없는 경우 기본 값 설정
    $dates[] = "No data";
    $scores[] = 0;
}

// JSON 형식으로 데이터 반환
echo json_encode(['dates' => $dates, 'scores' => $scores]);

// 연결 종료
$conn->close();
?>
