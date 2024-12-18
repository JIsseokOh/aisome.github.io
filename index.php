<!DOCTYPE html>
<html lang="ko">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AI SOME - AI 감성분석</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- 유튜브용 녹색: #3fb9ad  /  빨간색:#e94c4b -->
<style>
    /* 긍정 */
    .badge-success {
        background-color: #3fb9ad;
    }
    /* 부정 */
    .badge-danger {
        background-color: #e94c4b;
    }
    /* 중립 */
    .badge-warning {
        background-color: #DCDCDC; 
    }
    .card-select {
        background-color: #FFFFFF;
        color: #000; /* 텍스트 색상 설정 (검정색으로 설정) */
    }
    .card-total {
        background-color: #DCDCDC; /* 연한 회색 */
        color: #000; 
    }
    .card-posi {
        background-color: #3fb9ad; /* 연한 라임 색상 */
        color: #000; 
    }
    .card-nega {
        background-color: #e94c4b; /* 연한 라임 색상 */
        color: #000; 
    }
</style>
<style>
/* 기본 상태: 정렬 가능한 헤더를 표시 */
.sortable {
    cursor: pointer; /* 클릭 가능 아이콘 표시 */
    transition: background-color 0.3s; /* 배경색 전환 효과 */
}

/* 마우스를 올렸을 때 스타일 변경 */
.sortable:hover {
    background-color: #f8f9fa; /* 밝은 회색 배경 */
    color: #007bff; /* 파란색 텍스트 */
}
.table-primary {
        background-color: #cfe2ff !important; /* 강조된 배경색 */
        color: #084298 !important; /* 강조된 텍스트 색상 */
}
</style>

<style>
/* 새로 추가되는 스타일 */
.table-container {
    max-height: 500px;  /* 8개 행이 보이는 적절한 높이 */
    overflow-y: auto;   /* 세로 스크롤 활성화 */
}
/* 테이블 헤더 고정 */
.table-container table {
    border-collapse: separate;
    border-spacing: 0;
}
.table-container thead th {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 1;
    border-bottom: 2px solid #dee2e6;
}
/* 스크롤바 스타일링 */
.table-container::-webkit-scrollbar {
    width: 8px;
}
.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}
.table-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}
.table-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.table-container .title-column {
    width: 500px; /* 열 너비 제한 */
    white-space: normal; /* 줄바꿈 허용 */
    overflow: hidden; /* 넘치는 텍스트 숨김 */
    text-overflow: ellipsis; /* 넘치는 텍스트에 ... 추가 */
    display: -webkit-box; /* 웹킷 기반 브라우저에서 줄 수 제한 */
    -webkit-line-clamp: 2; /* 2줄로 제한 */
    -webkit-box-orient: vertical; /* 줄 방향 설정 */
}

</style>

<style>
  .table-responsive .title-column {
    width: 360px; /* 열 너비 제한 */
    white-space: normal; /* 줄바꿈 허용 */
    overflow: hidden; /* 넘치는 텍스트 숨김 */
    text-overflow: ellipsis; /* 넘치는 텍스트에 ... 추가 */
    display: -webkit-box; /* 웹킷 기반 브라우저에서 줄 수 제한 */
    -webkit-line-clamp: 2; /* 2줄로 제한 */
    -webkit-box-orient: vertical; /* 줄 방향 설정 */
}

</style>
<!-- 유튜브용 -->



  <style>
    .page-body-wrapper {
        min-height: calc(100vh - 60px);
        padding-top: 60px;
        padding-left: 0 !important;  /* 왼쪽 패딩 제거 */
        padding-right: 0 !important; /* 오른쪽 패딩 제거 */
    }
    
    .page-body-wrapper.full-page-wrapper {
        min-height: 100vh;
    }

    /* 전체 배경색 #F5F7FF */
    .container-fluid.page-body-wrapper {
      background-color: #F5F7FF;
    }
    
    .main-panel {
        float: none !important;     /* float 제거 */
        margin: 0 auto !important;  /* 중앙 정렬 */
        max-width: 1920px;         /* 최대 너비 설정 */
        width: 100% !important;    /* 전체 너비 사용 */
        padding: 0 20px;          /* 좌우 여백 추가 */
        transition: none;          /* 트랜지션 효과 제거 */
    }
    
    @media (max-width: 991px) {
        .main-panel {
            padding: 0 15px;     /* 모바일에서는 좌우 여백 줄임 */
        }
    }

    /* 한글폰트 적용 */
    body {
    font-family: 'Noto Sans KR', sans-serif;
    }

    .tale-bg {
    background-color: #F5F7FF !important;
    background-image: none !important;
    border-radius: 15px; /* 카드에 둥근 모서리 적용 */
    overflow: hidden;    /* 자식 요소들이 부모 요소의 경계를 벗어나지 않도록 함 */
    }
    .tale-image {
        display: flex;
        justify-content: flex-start;  /* 이미지가 상단에 위치하도록 설정 */
        align-items: flex-start;
        padding-top: 0;               /* 상단 여백 제거 */
        padding-bottom: 0;            /* 하단 여백 제거 */
        position: relative;
        width: 100%;                  /* 이미지를 카드 너비에 맞춤 (필요시 제거) */
        object-fit: cover;            /* 이미지 비율 유지하며 상단에 맞춤 */
        border-radius: 15px;          /* 이미지에 둥근 모서리 적용 (값을 조정 가능) */
    }

    .tale-image img {
        width: 100%;                  /* 이미지를 카드 너비에 맞춤 (필요시 제거) */
        object-fit: cover;            /* 이미지 비율 유지하며 상단에 맞춤 */
    }


    /* 애니메이션 슬라이드 */
    .fade-image {
    position: absolute;
    opacity: 0;
    transition: opacity 3s ease-in-out; /* 페이드 시간 */
    }

    .image1, .image2 {
        width: 100%;
        height: auto;
    }

    .fade-in {
        opacity: 1;
    }

    </style>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".fade-image");
    let currentIndex = 0;

    function showNextImage() {
        // Remove fade-in class from all images
        images.forEach((img) => img.classList.remove("fade-in"));

        // Add fade-in class to the current image
        images[currentIndex].classList.add("fade-in");

        // Update index for next image
        currentIndex = (currentIndex + 1) % images.length;
    }

    // Initially show the first image
    showNextImage();

    // Set interval to loop images
    setInterval(showNextImage, 5000); // Change every 3 seconds
});
</script>


    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Chart.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

   

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <!-- 로고 영역 ggg -->
     <!--
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      -->

      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="img3/aisome-logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="img3/aisome-logo.png" alt="logo"/></a>
      </div>

    <!-- 로고 영영 ggg -->  
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <!--
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        -->
        <!--
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        -->

<!--
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Guide</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">사용 방법</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Guide
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">설정</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Setting
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">사용자 등록</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Register
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              < !-- 로그인 사용자 이미지 -- > 
              <img src="images/faces/face00.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
-->



        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html  설정 아이콘 -->
       <!--
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
    -->


    <!--
      
    -->




      <!-- partial -->
      <!-- partial:partials/_sidebar.html  좌측 메뉴 -->
       <!--
    -->
      <!-- partial  메인 시작 @@-->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">AI 기반 소셜 미디어 감성분석</h3>
                  <!-- <h6 class="font-weight-normal mb-0"><span class="text-primary">- Youtube 컨텐츠에 대한 AI 감성 분석 플랫폼</span></h6> -->
                </div>

                <div class="col-12 col-xl-4">

                 <div class="justify-content-end d-flex">
                  <!--
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                -->

                 </div>

                </div>
              </div>
            </div>
          </div>
          <div class="row">

          <!-- 메인 이미지 -->
<!--
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto"> 
                  < !-- <img src="images/dashboard/people.svg" alt="people"> -- >
                  <img src="images/dashboard/main.png" alt="people">                
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Bangalore</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  -->
            <!--
            <div class="col-md-6 grid-margin stretch-card">
                  <div class="card tale-bg">
                      <div class="tale-image">
                          <img src="images/dashboard/main.png" alt="people">
                      </div>
                  </div>
            </div>
            -->


            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="tale-image">
                        <img src="img3/new-main.png" alt="main" class="fade-image image1">
                        <img src="img3/new-main2.png" alt="main2" class="fade-image image2">
                    </div>
                </div>
            </div>


            <!-- 메인 이미지 -->
            
            <!--
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <video src="img2/movie-01.mp4" autoplay loop muted class="w-100 h-100">
                      Your browser does not support the video tag.
                    </video>
                  </div>
                </div>
              </div>
            -->
<!--
              <div class="col-md-6">
              <div class="card tale-bg" style="border-radius: 15px; overflow: hidden;">
                <div class="card-people mt-auto">
                  <video src="img2/movie-01.mp4" autoplay loop muted class="w-100 h-100" style="border-radius: 15px;">
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>

  -->

  
<?php
// MariaDB 연결
$host = 'localhost';
$db = 'test';
$user = 'root';

$pass = 'pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // company_list 테이블에서 회사 목록 가져오기
    $company_stmt = $pdo->query("SELECT company_id, company_name FROM company_list ORDER BY company_id");
    $companies = $company_stmt->fetchAll(PDO::FETCH_ASSOC);

    // 기본적으로 첫 번째 company_id의 레코드 가져오기 (옵션)
    $default_company_id = $companies[0]['company_id'] ?? null;

    // company_id 필터링 (GET 파라미터로 받음)
    $selected_company_id = isset($_GET['company_id']) ? $_GET['company_id'] : $default_company_id;

    // 동적으로 테이블 이름 생성
    $table_name = "youtube_title_" . $selected_company_id;

    // 선택된 company_id의 레코드 가져오기 (동적 테이블) @@@@
    
    
    //$stmt = $pdo->prepare("SELECT t_id, title, date, impact_factor, sentiment, video_url FROM `" . $table_name . "`");
    
    $stmt = $pdo->prepare("SELECT t_id, title, date, impact_factor, sentiment, video_url FROM `" . $table_name . "`ORDER BY t_id DESC LIMIT 200");

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 1. 총 레코드 수 계산
    $total_records_stmt = $pdo->prepare("SELECT COUNT(*) as total_records FROM `" . $table_name . "`");
    $total_records_stmt->execute();
    $total_records = $total_records_stmt->fetch(PDO::FETCH_ASSOC)['total_records'];

    // 2. 긍정적 sentiment의 갯수 계산
    $positive_count_stmt = $pdo->prepare("SELECT COUNT(*) as positive_count FROM `" . $table_name . "` WHERE sentiment = '긍정적'");
    $positive_count_stmt->execute();
    $positive_count = $positive_count_stmt->fetch(PDO::FETCH_ASSOC)['positive_count'];

    // 3. 부정적 sentiment의 갯수 계산
    $negative_count_stmt = $pdo->prepare("SELECT COUNT(*) as negative_count FROM `" . $table_name . "` WHERE sentiment = '부정적'");
    $negative_count_stmt->execute();
    $negative_count = $negative_count_stmt->fetch(PDO::FETCH_ASSOC)['negative_count'];

} catch (PDOException $e) {
    die("DB 연결 실패: " . $e->getMessage());
}
?>




            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">

                  <!-- <div class="card card-tale"> -->
                  <div class="card card-select">
                    <div class="card-body text-center">                   
                      <p style="font-size: 20px;" class="mb-2">선택</p> 
                      <br>

                       <!--
                      <div class="form-group">
                          <select id="companySelect" class="form-control" onchange="filterCompany()">
                              <?php foreach ($companies as $company): ?>
                                  <option value="<?= htmlspecialchars($company['company_id']) ?>" 
                                          <?= ($company['company_id'] == $selected_company_id ? 'selected' : '') ?>>
                                      <?= htmlspecialchars($company['company_name'] . ' (' . $company['company_id'] . ')') ?>
                                  </option>
                              <?php endforeach; ?>
                          </select>
                      </div> 
                              -->
                        <div class="form-group">
                            <select id="companySelect" class="form-control" onchange="filterCompany()">
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?= htmlspecialchars($company['company_id']) ?>" 
                                            <?= ($company['company_id'] == $selected_company_id ? 'selected' : '') ?>>
                                        <?= htmlspecialchars($company['company_name'] . ' (' . $company['company_id'] . ')') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>                     


                    </div>
                  </div>                
    
                </div>


                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-total">
                      <div class="card-body text-center">
                            <p style="font-size: 20px;" class="mb-2">총 게시물 수</p>
                            <br>                  
                            <p class="fs-30 mb-2"><?php echo $total_records; ?></p>
                            <br>          
                      </div>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-posi">
                        <div class="card-body text-center">
                            <p style="font-size: 20px;" class="mb-2">총 긍정 개수</p>
                            <br>   
                            <p class="fs-30 mb-2"><?php echo $positive_count; ?></p>
                            <br>
                          </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-nega">
                  <div class="card-body text-center">
                      <p style="font-size: 20px;" class="mb-2">총 부정 개수</p>
                      <br>   
                      <p class="fs-30 mb-2"><?php echo $negative_count; ?></p>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- new 슬라이드  01 kkk-->


          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">게시물 리스트</p>

                  <!-- <div class="table-responsive"> -->
                    <div class="table-container">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                        <th class="text-center sortable" data-column="t_id">No.</th>                    
                          <th class="text-center sortable" data-column="title">제목</th>
                          <th class="text-center sortable" data-column="date">날짜</th>
                          <th class="text-center sortable" data-column="impact_factor">IF 지수</th>
                          <th class="text-center sortable" data-column="sentiment">감성분석</th>
                        </tr>  
                      </thead>
                      <tbody>
                      <?php foreach ($rows as $row): ?>
                            <tr class="title-row" 
                                data-tid="<?= htmlspecialchars($row['t_id']) ?>"
                                data-video-url="<?= htmlspecialchars($row['video_url']) ?>"
                                sentiment="<?= htmlspecialchars($row['sentiment']) ?>"
                                impact_factor="<?= htmlspecialchars($row['impact_factor']) ?>"                                
                                >  


                                <td class="text-center"><?= htmlspecialchars($row['t_id']) ?></td> 
                                <td class="title-column"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="text-center"><?= date("Y-m-d", strtotime($row['date'])) ?></td>
                                <td class="text-center font-weight-bold"><?= htmlspecialchars($row['impact_factor']) ?></td>
                                <td class="text-center">
                                    <?php
                                    // Sentiment에 따른 배지 스타일 적용
                                    $badgeClass = 'badge-secondary'; // 기본 배지
                                    $sentiment = $row['sentiment'];

                                    if ($sentiment === '긍정적') {
                                        $badgeClass = 'badge-success';
                                    } elseif ($sentiment === '부정적') {
                                        $badgeClass = 'badge-danger';
                                    } elseif ($sentiment === '중립적') {
                                        $badgeClass = 'badge-warning';
                                    }
                                    ?>
                                    <div class="badge <?= $badgeClass ?>">
                                        <?= htmlspecialchars($sentiment) ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
  
                      </tbody>
                    </table>

                     <!-- 데이터 없을 때 -->
                     <?php if (empty($rows)): ?>
                        <div class="alert alert-info text-center mt-3">
                            선택된 회사의 데이터가 없습니다.
                        </div>
                    <?php endif; ?>


                  </div>
                </div>
              </div>
            </div>

            


  <!-- 댓글  -->         
            <div class="col-md-5 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">

									<h4 class="card-title">감성분석/IF지수/관련댓글</h4>

                  <h7 id="selectedSentiment"><i class="fa-regular fa-lightbulb"></i>&nbsp; 감성분석 결과: <span>좌측에서 제목을 선택 해 주세요</span></h7>

                  <br>
                  <br>

                  <div id="videoContainer" class="mb-4" style="max-width: 300px; margin: 0 auto;">
                      <div class="embed-responsive embed-responsive-16by9">
                          <iframe id="youtubePlayer" 
                                  class="embed-responsive-item" 
                                  src="https://www.youtube.com/embed/pwD4UGhDiyc?si=g3ETw7FOo730jwuJ"                            
                                  allowfullscreen>
                          </iframe>
                      </div>
                  </div>

                  <!-- <p class="card-title mb-0"> * IF 지수 : 2.1 (좋아요/조회수)</p> -->
                  <!-- <p class="card-title mb-0"> * IF 지수 : <span id="impactFactorValue">N/A</span> (좋아요/조회수)</p> -->

                  <h7> 
                  <i class="fa-solid fa-circle-info"></i>&nbsp; IF 지수 : 
                      <span id="impactFactorValue" style="font-size: 1rem; font-weight: bold; color: black;">N/A</span> 
                      (좋아요/조회수)
                  </h7>

                  <br><br>

                  <h7> <i class="fa-solid fa-circle-info"></i>&nbsp; 관련 댓글</h7>

                  <!-- <div class="table-responsive"> -->
                  <div class="table-container">
                      <table class="table table-striped table-borderless comments-table"> <!-- @@@ --> 
                          <thead>
                          <tr>                           
                              <th class="text-center">No.</th>
                              <th class="text-center">댓글</th>                            
                              <th class="text-center">좋아요</th>                            
                          </tr>
                          </thead>

                          <tbody>
                          <!-- AJAX로 동적 로드 -->

                          </tbody>
                          
                      </table>
                  </div>							



								</div>
							</div>
            </div>
          </div>
<!-- TP -->

<!-- new row 월별 분포 -->

    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">


                    <!-- <p class="card-title mb-0">Top YouTube Titles</p> -->                  
                    <div id="chart"></div>
                    
                </div>
            </div>
        </div>

        <!--
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top YouTube Titles</p>

                    
                </div>
            </div>
        </div>
          -->

    </div>




<!-- new 슬라이드 end 01 kkk-->


           
<!-- 그래프  end kkk 9999  -->           

        

       
         
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.  AiSome All rights reserved.</span>            
          </div>          
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js  @@ -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  
  <script src="js/order-chart.js"></script>


  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page kkk -->


  <!-- icore 그래프용  kkk 9999  -->   
 
  <!-- icore 그래프용  kkk 9999  -->   

  <script>
    /*
  function filterCompany() {
      var selectedCompanyId = document.getElementById('companySelect').value;
      // 현재 페이지에 company_id 파라미터를 추가하여 리다이렉트
      window.location.href = window.location.pathname + '?company_id=' + selectedCompanyId;
  }
  */
  </script>
  <script>
    /*
  function filterCompany() {
      var selectedCompanyId = document.getElementById('companySelect').value;
      // 현재 페이지에 company_id 파라미터를 추가한 URL 생성
      var newUrl = window.location.pathname + '?company_id=' + selectedCompanyId;

      // 새 URL로 이동 후 새로 고침
      window.location.href = newUrl;
      //window.location.reload(); // 명시적으로 새로 고침
  }
  */
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentSortColumn = null;
    let currentSortOrder = 'ASC';
    let selectedRow = null;

    // YouTube 비디오 ID 추출 함수
    function extractVideoId(url) {
        if (!url) return null;
        const match = url.match(/[?&]v=([^&]+)/);
        return match ? match[1] : null;
    }

    // YouTube 플레이어 업데이트 함수
    function updateYouTubePlayer(videoId) {
        const player = document.getElementById('youtubePlayer');
        const defaultMessage = document.getElementById('defaultMessage');
        
        if (player && videoId) {
            // 기본 메시지 숨기기
            if (defaultMessage) {
                defaultMessage.style.display = 'none';
            }
            // 플레이어 표시 및 URL 업데이트
            player.style.display = 'block';
            player.src = `https://www.youtube.com/embed/${videoId}`;
        } else {
            // 비디오 ID가 없는 경우 기본 메시지 표시
            if (defaultMessage) {
                defaultMessage.style.display = 'flex';
            }
            if (player) {
                player.style.display = 'none';
                player.src = 'about:blank';
            }
        }
    }

    // 댓글 로딩 함수
    function loadComments(t_id) {
        const commentsTableBody = document.querySelector('.comments-table tbody');
        commentsTableBody.innerHTML = '<tr><td colspan="3" class="text-center">Loading comments...</td></tr>';

        fetch('205-*.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ t_id: t_id })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            commentsTableBody.innerHTML = '';
            
            if (!Array.isArray(data) || data.length === 0) {
                commentsTableBody.innerHTML = '<tr><td colspan="3" class="text-center">댓글 없음</td></tr>';
                return;
            }

            data.forEach(comment => {
                const text = comment.text ? comment.text.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                commentsTableBody.innerHTML += `
                    <tr>
                        <td class="text-center">${comment.t_id}</td>
                        <td class="title-column">${text}</td>
                        <td class="text-center">${comment.likes}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Error:', error);
            commentsTableBody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center text-danger">
                        Failed to load comments. Please try again later.
                    </td>
                </tr>
            `;
        });
    }

    // 행 클릭 이벤트 처리 함수 수정
    function handleRowClick(row, t_id) {
        if (selectedRow === row) return;

        if (selectedRow) selectedRow.classList.remove('table-primary');
        
        selectedRow = row;
        row.classList.add('table-primary');

        // 비디오 URL 처리 추가  @@@
        const videoUrl = row.getAttribute('data-video-url');

        // sentiment 값 업데이트
        const sentiment = row.getAttribute('sentiment');
        const sentimentElement = document.getElementById('selectedSentiment');
        if (sentimentElement) {
            // sentiment에 따른 배지 스타일 적용
            let badgeClass = 'badge-secondary';
            if (sentiment === '긍정적') {
                badgeClass = 'badge-success';
            } else if (sentiment === '부정적') {
                badgeClass = 'badge-danger';
            } else if (sentiment === '중립적') {
                badgeClass = 'badge-warning';
            }
            
            //sentimentElement.innerHTML = `* 해당 게시물의 감성분석 결과: <span class="badge ${badgeClass}">${sentiment}</span>`;
            sentimentElement.innerHTML = `<i class="fa-solid fa-lightbulb"></i>&nbsp; 해당 게시물의 감성분석 결과: <span class="badge ${badgeClass}" style="font-size: 1.1rem; font-weight: bold; padding: 10px;">${sentiment}</span>`;
        }

        // 선택한 레코드의 impact_factor 업데이트
        const impactFactor = row.getAttribute('impact_factor');
        const impactFactorElement = document.getElementById('impactFactorValue');
        if (impactFactorElement) {
            impactFactorElement.textContent = impactFactor || 'N/A';
        }


        const videoId = extractVideoId(videoUrl);
        if (videoId) {
            updateYouTubePlayer(videoId);
        }

        loadComments(t_id);
    }

    // 정렬 후 테이블 업데이트 함수 수정
    function updateTableWithSortedData(data) {
        const tableBody = document.querySelector('.table tbody');
        tableBody.innerHTML = '';

          // sentiment 초기화
        const sentimentElement = document.getElementById('selectedSentiment');
        if (sentimentElement) {
            sentimentElement.innerHTML = '* 해당 게시물의 감성분석 결과 : <span>선택된 게시물이 없습니다</span>';
        }

        data.forEach(row => {
            let badgeClass = 'badge-secondary';
            if (row.sentiment === '긍정적') badgeClass = 'badge-success';
            else if (row.sentiment === '부정적') badgeClass = 'badge-danger';
            else if (row.sentiment === '중립적') badgeClass = 'badge-warning';

            const date = new Date(row.date).toISOString().split('T')[0];

            // 정렬후 데이터 업데이트 @@@
            tableBody.innerHTML += `
                <tr class="title-row" 
                    data-tid="${row.t_id}"
                    data-video-url="${row.video_url}"

                    sentiment="${row.sentiment}"
                    impact_factor="${row.impact_factor}"                   
                    
                    >


                    <td class="text-center">${row.t_id}</td>
                    <td class="title-column">${row.title}</td>
                    <td class="text-center">${date}</td>
                    <td class="text-center">${row.impact_factor}</td>
                    <td class="text-center">
                        <div class="badge ${badgeClass}">
                            ${row.sentiment}
                        </div>
                    </td>
                </tr>
            `;
        });

        selectedRow = null;
    }

   
    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.getAttribute('data-column');
            currentSortOrder = (currentSortColumn === column && currentSortOrder === 'ASC') ? 'DESC' : 'ASC';
            currentSortColumn = column;

            // Get the currently selected company_id  @@@@
            const companySelect = document.getElementById('companySelect');
            const selectedCompanyId = companySelect ? companySelect.value : null;

            fetch('205-*.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    column: column, 
                    order: currentSortOrder,
                    company_id: selectedCompanyId
                })
            })
            .then(response => response.json())
            .then(data => {
                updateTableWithSortedData(data);
            })
            .catch(error => {
                console.error('Error fetching sorted data:', error);
            });
        });
    });

    // 테이블 행 클릭 이벤트
    document.querySelector('.table').addEventListener('click', function(e) {
        const row = e.target.closest('.title-row');
        if (row) {
            const t_id = row.getAttribute('data-tid');
            handleRowClick(row, t_id);
        }
    });
});
</script>



<script>
  // ApexCharts 설정
  // PHP에서 데이터 가져오기
// 페이지 로드 시 기본 company_id로 차트 렌더링
document.addEventListener('DOMContentLoaded', function () {
    // URL에서 company_id 파라미터 읽기
    const params = new URLSearchParams(window.location.search);
    const defaultCompanyId = params.get('company_id') || '100'; // URL에 없으면 기본값 '100'

    // 초기 차트 렌더링
    fetchAndRenderChart(defaultCompanyId);
});

// 차트 데이터 가져와서 렌더링하는 함수
function fetchAndRenderChart(companyId) {
    fetch(`206-*?company_id=${companyId}`)
        .then(response => response.json())
        .then(data => {
            // 데이터가 없는 경우 처리
            if (data.length === 0) {
                document.querySelector("#chart").innerHTML = '<p>해당 기간의 데이터가 없습니다.</p>';
                return;
            }

            // 데이터 분리
            const categories = data.map(row => row.y_month); // x축: y_month
            const positiveData = data.map(row => row.positive_count); // 긍정
            const negativeData = data.map(row => row.negative_count); // 부정
            const neutralData = data.map(row => row.neutral_count);  // 중립

            // ApexCharts 옵션 설정
            const options = {
                series: [
                    { name: "긍정", data: positiveData },
                    { name: "중립", data: neutralData },
                    { name: "부정", data: negativeData }
                ],
                chart: {
                    type: 'bar',
                    height: 450,
                    stacked: true,
                    stackType: '100%'
                },
                plotOptions: {
                    bar: {
                        horizontal: false
                    }
                },
                xaxis: {
                    categories: categories,
                    labels: {
                    show: false // x축 레이블(글자)을 숨김
                }
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'center'
                },
                title: {
                    text: '월별 분포',
                    align: 'center'
                },
                dataLabels: {
                    enabled: false // 각 막대에 표시되는 % 값 숨기기
                },
                colors: ['#3fb9ad', '#DCDCDC', '#e94c4b'] // 긍정 중립 
            };

            // 기존 차트 제거
            const chartElement = document.querySelector("#chart");
            chartElement.innerHTML = '';

            // 차트 렌더링
            const chart = new ApexCharts(chartElement, options);
            chart.render();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.querySelector("#chart").innerHTML = '<p>차트 데이터를 불러오는 중 오류가 발생했습니다.</p>';
        });
}


</script>
<script>

function filterCompany() {
    var selectedCompanyId = document.getElementById('companySelect').value;
    if (selectedCompanyId) {
        var newUrl = 'https://aisome.wemeetnow.net/index.php?company_id=' + selectedCompanyId;
        window.location.href = newUrl;
     
    }
}

</script>

</body>

</html>

