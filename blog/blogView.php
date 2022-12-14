<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    $myBlogID = $_GET['blogID'];
    // blog만의 sql 생성
    $blogSql = "SELECT * FROM myBlog WHERE myBlogID = {$myBlogID}";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);
    $commentSql = "SELECT * FROM myComment WHERE myBlogID = {$myBlogID} ORDER BY myCommentID DESC";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);
    // blogInfo, commentInfo에 데이터 저장
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>
    <link rel="stylesheet" href="..">

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
        <section id="blog" class="container">
            <div class="blog__inner">
                <div class="blog__title" style="background-image:url(../assets/img/blog/<?=$blogInfo['blogImgFile']?>)">
                    <span class="blog__title__cate"><?=$blogInfo['blogCategory']?></span>
                    <h2 class="blog__title__h1">
                        <?=$blogInfo['blogTitle']?>
                    </h2>
                    <div class="blog__title__info">
                        <div>
                            <span class="author"><?=$blogInfo['blogAuthor']?></span>
                            <span class="date"><?=date('Y-m-d', $blogInfo['blogRegTime'])?></span>
                        </div>
                        <div>
                            <a href="#" class="modify">수정</a>
                            <a href="#" class="delete">삭제</a>
                        </div>
                    </div>
                </div>
                <div class="blog__contents">
                    <div class="blog__contents__ad">
                        <div>광고지롱!</div>
                    </div>
                    <!-- //blog__contents__ad -->
                    <div class="blog__contents__cont">
                        <?=$blogInfo['blogContents']?>
                    </div>
                    <!-- //blog__contents__cont-->
                    <div class="blog__contents__comment">
                        <h3>댓글 쓰기</h3>
<?php foreach($commentResult as $comment){ ?>
        <div class="comment" id="comment<?=$comment['myCommentID']?>">
            <div class="comment__view">
                <div class="comment__view__img">
                    <img src="../assets/img/icon_256.png" alt="icon">
                </div>
                <div class="comment__view__data">
                    <span class="name"><?=$comment['commentName']?></span>
                    <span class="date"><?=date('Y-m-d', $comment['regTime'])?></span>
                </div>
                <div class="comment__view__msg">
                   <?=$comment['commentMsg']?>
                </div>
            </div>
            <div class="comment__del">
                <a href="#" class="comment__del__del">댓글 삭제</a>
                <a href="#" class="comment__del__mod">댓글 수정</a>
            </div>
        </div>
<?php } ?>
                        <div class="comment__delete" style="display: none;">
                            <label for="commentDeletePass">비밀번호</label>
                            <input type="text" id="commentDeletePass" name="commentDeletePass">
                            <button id="commentDeleteCancel">취소</button>
                            <button id="commentDeleteButton">삭제</button>
                        </div>
                        <div class="comment__modify" style="display: none;">
                            <label for="commentModifyMsg">수정 내용</label>
                            <input type="text" id="commentModifyMsg" name="commentModifyMsg">
                            <label for="commentModifyPass">비밀번호</label>
                            <input type="text" id="commentModifyPass" name="commentModifyPass">
                            <button id="commentModifyCancel">취소</button>
                            <button id="commentModifyButton">수정</button>
                        </div>
                        <div class="comment__write">
                            <div class="comment__write__info">
                                <label for="commentName">이름</label>
                                <input type="text" id="commentName" name="commentName" placeholder="이름">
                                <label for="commentPass">비밀번호</label>
                                <input type="text" id="commentPass" name="commentPass" placeholder="비밀번호">
                                <button type="submit" id="commentBtn">댓글 쓰기</button>
                            </div>
                            <div class="comment__write__msg">
                                <label for="commentWrite">댓글 쓰기</label>
                                <input type="text" id="commentWrite" name="commentWrite" placeholder="댓글을 작성해 주세요.">
                            </div>
                        </div>
                    </div>
                    <!-- //blog__contents__comment -->
                </div>
                <!-- //blog__contents-->
                <div class="blog__aside">
                    <div class="blog__aside__intro">
                        <div class="img">
                            <img src="../assets/img/banner_bg01.jpg" alt="나">
                        </div>
                        <p class="intro">
                            어떤 일이라도 노력하고 즐기면 그 결과는 빛을 발한다고 생각합니다.
                        </p>
                    </div>
                    <div class="blog__aside__cate">
                        <h3>카테고리</h3>
                        <?php include "../include/category.php" ?>
                    </div>
                    <div class="blog__aside__new">
                        <h3>최신글</h3>
                        <ul>
                            <?php include "../include/blogNew.php" ?>
                        </ul>
                    </div>
                    <div class="blog__aside__pop">
                        <h3>인기글</h3>
                        <ul>
                            <li><a href="#"><span><img src="../assets/img/icon_256.png"></span><em>배고파</em></a></li>
                            <li><a href="#"><span><img src="../assets/img/icon_256.png"></span><em>배고파</em></a></li>
                            <li><a href="#"><span><img src="../assets/img/icon_256.png"></span><em>배고파</em></a></li>
                            <li><a href="#"><span><img src="../assets/img/icon_256.png"></span><em>배고파</em></a></li>
                        </ul>
                    </div>
                    <div class="blog__aside__comment">
                        <h3>최신 댓글</h3>
                        <ul>
                            <li><a href="#"><em>배고파</em></a></li>
                            <li><a href="#"><em>배고파</em></a></li>
                            <li><a href="#"><em>배고파</em></a></li>
                            <li><a href="#"><em>배고파</em></a></li>
                        </ul>
                    </div>
                </div>
                <div class="blog__relation"></div>
            </div>
        </section>
    </main>
        <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>

        const commentName = $("#commentName"); // 댓글 이름
        const commentPass = $("#commentPass"); // 댓글 비밀번호
        const commentWrite = $("#commentWrite"); // 댓글 내용

        let commentID = "";

        // 댓글 삭제 버튼 클릭
        $(".comment__del__del").click(function(e) {
            e.preventDefault();
            $(".comment__delete").fadeIn(500);

            commentID = $(this).parent().parent().attr("id");
            //comment__del__del의 부모요소의 부모요소의 id값을 가져옴(commentID)
        })
        // 댓글 삭제 버튼 클릭 --> 취소 버튼 클릭
        $("#commentDeleteCancel").click(function() {
            $(".comment__delete").fadeOut(500);
        })
        // 댓글 삭제 버튼 클릭 --> 삭제 버튼 클릭
        $("#commentDeleteButton").click(function() {

            let number = commentID.replace(/[^0-9]/g, "");

            if($("#commentDeletePass").val() == ''){
                alert("비밀번호를 입력해 주세요.")
                $("#commentDeletePass").focus();
            } else {
                $.ajax({
                    url: "blogCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "pass": $("#commentDeletePass").val(),
                        "commentID": number
                    },
                    success: function(data){
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + request);
                        console.log("error" + request);
                    }
                })
            }
        })

        // 댓글 수정 버튼 클릭
        $(".comment__del__mod").click(function(e) {
            e.preventDefault();
            $(".comment__modify").fadeIn(500) // 천천히 나타남

            commentID = $(this).parent().parent().attr("id");
        })
        // 댓글 수정 버튼 클릭 --> 취소 버튼 클릭
        $("#commentModifyCancel").click(function() {
            e.preventDefault();
            $(".comment__modify").fadeOut(500);
        })
        // 댓글 수정 버튼 --> 수정 버튼 클릭
        $("#commentModifyButton").click(function(e){
            e.preventDefault();
            let number = commentID.replace("comment", "");
            if($("#commentModifyMsg").val() == '' || $("#commentModifyPass").val() == ''){
                alert("수정 내용과 비밀번호를 입력해주세요!");
                $("#commentModifyMsg").focus();
            } else{
                $.ajax({
                    url: "blogCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "msg": $("#commentModifyMsg").val(),
                        "pass": $("#commentModifyMsg").val(),
                        "commentID": number
                    },
                    success: function(data){
                        console.log(data);
                        alert("댓글이 수정되었습니다.")
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + request);
                        console.log("error" + request);
                    }
                });
            }
        });
        // 댓글 쓰기 버튼
        $("#commentBtn").click(function(){
            if($("#commentWrite").val() == ""){
                alert("댓글을 입력해 주세요.");
                $("#commentWrite").focus();
            } else {
                $.ajax({
                    url: "blogCommentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "blogID": <?=$myBlogID?>,
                        "name": commentName.val(),
                        "pass": commentPass.val(),
                        "msg": commentWrite.val(),
                    },
                    success: function(data){
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + request);
                        console.log("error" + request);
                    }
                });
            };
        });
    </script>
</body>
</html>