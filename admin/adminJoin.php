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
        <section id="join" class="container admin">
            <h2>관리자 회원 가입</h2>
            <div class="join__inner">
                <form action="adminjoinSave.php" name="join" method="post" onsubmit="return joinChecks()">
                    <fieldset>
                        <legend>관리자 회원가입</legend>
                        <div class="join__box">
                            <div class="list">
                                <h3>개인정보 수집 및 이용에 대한 안내</h3>
                                <ul>
                                    <li>목적 : 가입자 개인 식별, 가입 의사 확인, 가입자와의 원활한 의사소통, 가입자와의 교육 커뮤니케이션</li>
                                    <li>항목 : 아이디(이메일주소), 비밀번호, 이름, 생년월일, 휴대폰 번호</li>
                                    <li>보유기간 : 회원 탈퇴 시까지 보유(탈퇴일로부터 즉시 파기합니다.)</li>
                                    <li>개인정보 수집에 대한 동의를 거부할 권리가 있으며, 회원 가입시 개인정보 수집을 동의함으로 간주합니다.</li>
                                </ul>
                                <span>
                                    <input type="checkbox" name="joinCheck" id="joinCheck">
                                    <label for="joinCheck">약관에 동의합니다.</label>
                                </span>
                            </div>
                            <div class="overlap">
                                <label for="youEmail">이메일</label>
                                <input
                                    type="email"
                                    id="youEmail"
                                    name="youEmail"
                                    placeholder="이메일을 입력해 주세요."
                                    autocomplete="off"
                                    required
                                />
                                <a href="#c" class="check" onclick="emailChecking()">중복확인</a>
                                <p class="msg" id="youEmailComment"><!-- * 이미 동일한 이메일이 존재합니다. --></p>
                            </div>
                            <div class="overlap">
                                <label for="youNickName">닉네임</label>
                                <input
                                    type="text"
                                    id="youNickName"
                                    name="youNickName"
                                    placeholder="닉네임을 입력해 주세요."
                                    autocomplete="off"
                                    required
                                />
                                <a href="#c" class="check" onclick="nickChecking()">중복확인</a>
                                <p class="msg" id="youNickNameComment"><!-- * 이미 동일한 닉네임이 존재합니다. --></p>
                            </div>
                            <div>
                                <label for="youName">이름</label>
                                <input
                                    type="text"
                                    id="youName"
                                    name="youName"
                                    placeholder="이름을 입력해 주세요."
                                    maxlength="5"
                                    autocomplete="off"
                                    required
                                />
                                <p class="msg" id="youNameComment"><!-- * 이름은 한글로만 작성해 주세요. --></p>
                            </div>
                            <div>
                                <label for="youPass">비밀번호</label>
                                <input
                                    type="password"
                                    id="youPass"
                                    name="youPass"
                                    placeholder="비밀번호를 입력해 주세요."
                                    autocomplete="off"
                                    required
                                />
                                <p class="msg" id="youPassComment"><!-- * 비밀번호는 특수기호, 숫자가 들어가게 작성해 주세요. --></p>
                            </div>
                            <div>
                                <label for="youPassC">비밀번호 확인</label>
                                <input
                                    type="password"
                                    id="youPassC"
                                    name="youPassC"
                                    placeholder="비밀번호를 한 번 더 입력해 주세요."
                                    autocomplete="off"
                                    required
                                />
                                <p class="msg" id="youPassCComment"><!-- * 비밀번호가 일치하지 않습니다. --></p>
                            </div>
                            <div>
                                <label for="youBirth">생년월일</label>
                                <input
                                    type="text"
                                    id="youBirth"
                                    name="youBirth"
                                    placeholder="YYYY-MM-DD"
                                    maxlength="15"
                                    autocomplete="off"
                                    required
                                />
                                <p class="msg" id="youBirthComment"><!-- * 비밀번호가 일치하지 않습니다. --></p>
                            </div>
                            <div>
                                <label for="youPhone">연락처</label>
                                <input
                                    type="text"
                                    id="youPhone"
                                    name="youPhone"
                                    placeholder="000-0000-0000"
                                    maxlength="15"
                                    autocomplete="off"
                                    required
                                />
                                <p class="msg" id="youPhoneComment"><!-- * 비밀번호가 일치하지 않습니다. --></p>
                            </div>
                        </div>
                        <button class="join__btn" type="submit">가입하기</button>
                    </fieldset>
                </form>
            </div>
        </section>
        <!-- //join -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let emailCheck = false;
        let nickCheck = false;

        function emailChecking() {
            let youEmail = $("#youEmail").val();

            if(youEmail == null || youEmail == '') {
                $("#youEmailComment").text("이메일을 입력해 주세요.");
            } else {
                $.ajax({
                    type: "POST",
                    url: "adminJoinCheck.php",
                    data: {"youEmail": youEmail, "type": "emailCheck"},
                    dataType: "json",

                    success: function(data){
                        if(data.result == "good"){
                            $("#youEmailComment").text("사용 가능한 이메일입니다.");
                            emailCheck = true;
                        } else {
                            $("#youEmailComment").text("이미 동일한 이메일이 존재합니다.");
                            emailCheck = false;
                        }
                    },

                    error : function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        }
        function nickChecking(){
            let youNickName = $("#youNickName").val();
            if(youNickName == null || youNickName == ''){
                $("#youNickNameComment").text("닉네임을 입력해 주세요.")
            }else {
                $.ajax({
                    type : "POST",
                    url : "adminJoinCheck.php",
                    data : {"youNickName" : youNickName, "type" : "nickCheck"},
                    dataType : "json",
                    success : function(data){
                        if(data.result == "good"){
                            $("#youNickNameComment").text("사용 가능한 닉네임입니다.");
                            nickCheck = true;
                        }else {
                            $("#youNickNameComment").text("이미 동일한 닉네임이 존재합니다.");
                            nickCheck = false;
                        }
                    },
                    error : function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        }
        function joinChecks(){
            // 개인정보 동의 체크
            let joinCheck = $("#joinCheck").is(":checked");

            if(joinCheck == false){
                alert("개인정보 수집 및 이용에 동의해 주세요.");
                return false; // = break
            }
            // is = 자바스크립트 contains

            // 이메일 공백 검사
            if($("#youEmail").val() == ""){
                $("#youEmailComment").text("이메일을 입력해 주세요.");
                return false;
            }

            // 이메일 유효성 검사
            let getYouEmail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            if(!getYouEmail.test($("#youEmail").val())){
                $("#youEmailComment").text("이메일 형식에 맞게 작성해 주세요.");
                $("#youEmail").val("");
                return false;
            }

            // 이메일 중복 검사
            if(emailCheck == false){
                $("#youEmailComment").text("이메일 중복확인을 해주세요.");
                return false;
            }

            // 닉네임 중복 검사
            if($("#youNickName").val() == ""){
                $("#youNickNameComment").text("닉네임을 입력해 주세요.");
                return false;
            }

            // 닉네임 유효성 검사
            let getYouNickName = RegExp(/^[가-힣|0-9]+$/);
            if(!getYouNickName.test($("#youNickName").val())){
                $("#youNickNameComment").text("닉네임은 한글과 숫자로만 사용 가능합니다.");
                $("#youNickName").val("");
                return false;
            }

            // 닉네임 중복 검사
            if(nickCheck == false){
                $("#youNickNameComment").text("닉네임 중복확인을 해주세요.");
                return false;
            }

            // 비밀번호 공백 검사
            if($("#youPass").val() == ""){
                $("#youPassComment").text("비밀번호를 입력해 주세요.");
                return false;
            }

            // 비밀번호 유효성 검사
            let getYouPass = $("#youPass").val();
            let getYouPassNum = getYouPass.search(/[0-9]/g);
            let getYouPassEng = getYouPass.search(/[a-z]/ig);
            /* i: 대/소문자 구별x */
            let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

            if(getYouPass.length < 8 || getYouPass.length > 20){
                $("#youPassComment").text("비밀번호는 8자리에서 20자리 이내로 입력해 주세요.");
                return false;
            } else if (getYouPass.search(/\s/) != -1){
                $("#youPassComment").text("비밀번호는 공백 없이 입력해 주세요.");
                return false;
            } else if(getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0){
                $("#youPassComment").text("영문, 숫자, 특수문자를 혼합하여 입력해 주세요.");
                return false;
            }

            // 비밀번호 확인 공백 검사
            if($("#youPassC").val() == ""){
                $("#youPassCComment".text("비밀번호를 한 번 더 입력해 주세요."));
                return false;
            }

            // 비밀번호 확인 동일 체크
            if($("#youPass").val() !== $("#youPassC").val()){
                $("#youPassCComment").text("비밀번호가 일치하지 않습니다.");
                return false;
            }

            // 이름 공백 확인
            if($("#youName").val() == ""){
                $("#youNameComment").text("이름을 입력해 주세요.");
                return false;
            }

            // 이름 유효성 검사
            let getYouName = RegExp(/^[가-힣]+$/);
            if(!getYouName.test($("#youName").val())){
                $("#youNameComment").text("이름은 한글로만 입력해 주세요.");
                $("#youName").val("");
                return false;
            }

            // 생년월일 공백 확인
            if($("#youBirth").val() == ""){
                $("#youBirthComment").text("생년월일(YYYY-MM-DD)을 올바르게 입력해 주세요.");
                return false;
            }

            // 생년월일 유효성 검사
            let getyouBirth = RegExp(/^(19[0-9][0-9]|20\d{2})-(0[0-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/);
            if(!getyouBirth.test($("#youBirth").val())){
                $("#youBirthComment").text("생년월일(YYYY-MM-DD)을 올바르게 입력해 주세요.");
                return false;
            }

            // 휴대폰 번호 공백 확인
            if($("#youPhone").val() == ""){
                $("#youPhoneComment").text("휴대폰 번호(000-0000-0000)를 올바르게 입력해 주세요.");
                return false;
            }

            // 휴대폰 번호 유효성 검사
            let getyouPhone = RegExp(/01[016789]-[^0][0-9]{2,3}-[0-9]{3,4}/);
            if(!getyouPhone.test($("#youPhone").val())){
                $("#youPhoneComment").text("휴대폰 번호(000-0000-0000)를 올바르게 입력해 주세요.");
                $("#youPhone").val("");
                return false;
            }
        }
    </script>
</body>
</html>