<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 회원가입</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">콘텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main">
        <section id="banner">
            <h2>관리자 회원가입 완료 페이지입니다.</h2>
            <div class="banner__inner2 container">
                <div class="img">
                    <img src="../assets/img/banner_img03.svg" alt="배너 이미지" />
                </div>
                <div class="desc">
                <?php
                    include "../connect/connect.php";

                    $youEmail = $_POST['youEmail'];
                    $youNickName = $_POST['youNickName'];
                    $youName = $_POST['youName'];
                    $youPass = $_POST['youPass'];
                    $youBirth = $_POST['youBirth'];
                    $youPhone = $_POST['youPhone'];
                    $regTime = time();

                    $youEmail = $connect -> real_escape_string(trim($youEmail));
                    $youNickName = $connect -> real_escape_string(trim($youNickName));
                    $youName = $connect -> real_escape_string(trim($youName));
                    $youPass = $connect -> real_escape_string(trim($youPass));
                    $youBirth = $connect -> real_escape_string(trim($youBirth));
                    $youPhone = $connect -> real_escape_string(trim($youPhone));
                    
                    $youPass = sha1("web".$youPass);

                    // 회원가입
                    $sql = "INSERT INTO myAdminMember(youEmail, youNickName, youName, youPass, youBirth, youPhone, regTime) VALUES('$youEmail', '$youNickName', '$youName', '$youPass', '$youBirth', '$youPhone', '$regTime')";
                    $result = $connect -> query($sql);

                    // msg는 태그가 안먹어
                    if($result){
                        echo "회원가입을 축하합니다. 로그인을 해주세요.";
                    } else {
                        echo "에러발생 -- 관리자에게 문의하세요.";
                    }
                ?>
                </div>
                <a href="../main/main.php">메인으로</a>
            </div>
        </section>
        <!-- //banner -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>