<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내집꾸미기</title>
    <link rel="stylesheet" href="resources/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <script src="resources/js/jquery-3.4.1.min.js"></script>
    <script src="resources/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
    <script src="resources/js/app.js"></script>
</head>
<body>
    <div id="wrap">
        <!-- 헤더 -->
        <header>
            <div id="user_area">
                <?php if(isset($_SESSION['user'])):?>
                    <p class="main_user">&lt;<?=$_SESSION['user']->user_name?>&gt;(&lt;<?=$_SESSION['user']->user_id?>&gt;)</p>
                    <a href="/logout" class="main_user">로그아웃</a>
                <?php else:?>
                    <a href="#" id="join_open" data-target="#join_popup" data-toggle="modal" class="main_user">회원가입</a>
                    <a href="#" id="login_open" data-target="#login_popup" data-toggle="modal" class="main_user">로그인</a>

                    <div id="join_popup" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-line"><div></div></div>
                                <div class="modal-header">
                                    <h3 class="modal-title text-center w-100 d-block">회원가입</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="/join" method="post" name="join_form" id="join_form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="user_id">아이디</label>
                                            <input type="text" id="user_id" name="user_id" placeholder="아이디를 입력해주세요." class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">비밀번호</label>
                                            <input type="password" id="password" name="password" placeholder="비밀번호를 입력해주세요." class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_name">이름</label>
                                            <input type="text" id="user_name" name="user_name" placeholder="이름을 입력해주세요." class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="img">사진</label>
                                            <input type="file" id="img" name="img" placeholder="사진을 넣어주세요." class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <canvas id="captcha"></canvas>
                                            <input type="text" id="captcha_word" name="captcha_word" placeholder="자동입력방지 문자를 입력해주세요." class="form-control">
                                        </div>
                                        <button class="close" id="join_send" type="button"></button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="footer_btn" id="join_btn">가입 완료</button>
                                    <button class="footer_btn" data-dismiss="modal">닫기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="login_popup" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-line"><div></div></div>
                                <div class="modal-header">
                                    <h3 class="modal-title text-center w-100 d-block">로그인</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="/login" method="post" name="login_form" id="login_form">
                                        <div class="form-group">
                                            <label for="user_id">아이디</label>
                                            <input type="text" id="user_id" name="user_id" placeholder="아이디를 입력해주세요." class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">비밀번호</label>
                                            <input type="password" id="password" name="password" placeholder="비밀번호를 입력해주세요." class="form-control">
                                        </div>
                                        <button class="close" id="login_send" type="button"></button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="footer_btn" id="login_btn">로그인</button>
                                    <button class="footer_btn" data-dismiss="modal">닫기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif;?>
            </div>
            <i class="fa fa-reorder main_480" id="menu_open"></i>
            <div id="logo"><img src="resources/image/logo.png" alt="logo" title="logo"></div>
            <!-- 네비게이션 -->
            <nav>
                <ul>
                    <li><a href="/">홈</a></li>
                    <li><a href="/housing">온라인 집들이</a></li>
                    <li><a href="/store">스토어</a></li>
                    <li><a href="/specialist">전문가</a></li>
                    <li><a href="/building">시공 견적</a></li>
                </ul>
            </nav>
        </header>
        <!-- 비쥬얼 -->
        <div id="visual">
            <div id="visual_back">
                <div id="visual_side"></div>
                <div id="visual_word">
                    <div id="visual_word_circle"></div>
                    <p>Every Design</p>
                    <h2 id="h21">Decorating</h2>
                    <h2 id="h22">House</h2>
                    <h5>집꾸미기의 모든것</h5>
                </div>
            </div>
            <!-- 슬라이드 -->
            <div id="slide">
                <img src="resources/image/slide1.jpg" title="slide" alt="slide">
                <img src="resources/image/slide2.jpg" title="slide" alt="slide">
                <img src="resources/image/slide3.jpg" title="slide" alt="slide">
            </div>

            <button class="slide_btn" id="left_btn"><i class="fa fa-angle-left text-white"></i></button>
            <button class="slide_btn" id="right_btn"><i class="fa fa-angle-right text-white"></i></button>

        </div>
        <div id="content">