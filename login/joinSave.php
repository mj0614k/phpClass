<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>

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
            <h2>회원가입 페이지입니다.</h2>
            <div class="banner__inner2 container">
                <div class="img">
                    <img src="../assets/img/banner_img03.svg" alt="배너 이미지" />
                </div>
                <div class="desc">
                    <?php 
                        include "../connect/connect.php";

                        $youEmail = $_POST['youEmail'];
                        $youName = $_POST['youName'];
                        $youPass = $_POST['youPass'];
                        $youPassC = $_POST['youPassC'];
                        $youNickName = $_POST['youNickName'];
                        $youPhone = $_POST['youPhone'];
                        $regTime = time();

                        // echo $youEmail, $youName, $youPass, $youNickName, $youPhone, $regTime;
                        // $sql = "INSERT INTO myMember(youEmail, youName, youPass, youNickName, youPhone, regTime) VALUES('$youEmail', '$youName', '$youPass', '$youNickName', '$youPhone', '$regTime')";
                        // $result = $connect -> query($sql);
                        // if($result){
                        //     echo "INSERT INTO TRUE";
                        // } else {
                        //     echo "INSERT INTO FALSE";
                        // }

                        // 데이터 가져오기 --> 유효성 검사 --> 데이터 중복 검사 --> X --> 회원가입
                        // 데이터 가져오기 --> 유효성 검사 --> 데이터 중복 검사 --> O --> 로그인 유도

                        // 메시지 출력
                        function msg($alert){
                            echo "<p class='alert'>{$alert}</p>";
                        }

                        // 메일 유효성 검사(내장 함수)
                        // $checkEmail = filter_var($youEmail, FILTER_VALIDATE_EMAIL);

                        // if($checkEmail == false) {
                        //     msg("이메일을 올바르게 작성해 주세요.");
                        //     exit;
                        // }

                        // 메일 유효성 검사(정규식 표현)
                        $checkEmail = preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $youEmail);

                        if($checkEmail == false) {
                            msg("이메일을 올바르게 작성해 주세요.");
                            exit;
                        }

                        // 비밀번호 확인 검사
                        if($youPass !== $youPassC){
                            msg("비밀번호가 일치하지 않습니다.");
                            exit;
                        }

                        // 비밀번호 암호화
                        // $youPass = sha1($youPass);

                        // 이름 검사
                        $checkName = preg_match("/^[가-힣]{1,}$/", $youName);

                        if($checkName == false) {
                            msg("이름을 한글로 정확하게 입력해 주세요.");
                            exit;
                        }

                        // 연락처 검사
                        $checkNumber = preg_match("/^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/", $youPhone);
                        if($checkNumber == false) {
                            msg("번호가 정확하지 않습니다. <br>올바른 핸드폰 번호(000-0000-0000)를 입력해 주세요.");
                            exit;
                        }

                        // 이메일 중복 검사(false, true 트리거변수)
                        $isEmailCheck = false;

                        $sql = "SELECT youEmail FROM myMember WHERE youEmail = '$youEmail'";
                        $result = $connect -> query($sql);

                        if($result){
                            $count = $result -> num_rows;

                            if($count == 0){
                                // 회원가입
                                $isEmailCheck = true;
                            } else {
                                // 로그인 유도
                                msg("이미 회원가입이 되어 있습니다. 로그인 해주세요.");
                                exit;
                            }
                        } else {
                            msg("에러발생1 - 관리자에게 문의하세요.");
                            exit; // break문
                        }

                        // 연락처 중복 검사
                        $isPhoneCheck = false;

                        $sql = "SELECT youPhone FROM myMember WHERE youPhone = '$youPhone'";
                        $result = $connect -> query($sql);

                        if($result){
                            $count = $result -> num_rows;

                            if($count == 0){
                                // 회원가입
                                $isPhoneCheck = true;
                            } else {
                                // 로그인 유도
                                msg("이미 회원가입이 되어 있습니다. 로그인 해주세요.");
                                exit;
                            }
                        } else {
                            msg("에러발생2 - 관리자에게 문의하세요.");
                            exit; // break문
                        }

                        // 회원가입
                        if($isEmailCheck == true && $isPhoneCheck == true){
                            $sql = "INSERT INTO myMember(youEmail, youName, youPass, youNickName, youPhone, regTime) VALUES('$youEmail', '$youName', '$youPass', '$youNickName', '$youPhone', '$regTime')";
                            $result = $connect -> query($sql);

                            if($result){
                                msg("축하합니다!! 회원가입이 완료되었습니다.<br>
                                <a href='../main/main.php'>메인으로</a>");
                                exit;
                            } else {
                                msg("에러발생3 - 관리자에게 문의하세요.");
                                exit;
                            }
                        } else {
                            msg("이메일 또는 연락처를 다시 한번 확인하세요.");
                            exit;
                        }
                    ?>
                </div>
                <a href="main.html">메인으로</a>
            </div>
        </section>
        <!-- //banner -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>