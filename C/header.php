<?php session_start(); include 'db.php';?>

<!-- 로그인모달 -->
    <div id="login" class="gap-1" popover="manual">
	    <div class="login-left">
	        <h2>스킬스북<br>도서관</h2>
	        <p>지식과 기술이 만나는<br>특별한 공간</p>
	    </div>
	    <div class="login-right">
	        <div class="f jsb aic">
	            <h3>로그인</h3>
	            <button class="close" popovertarget="login">x</button>
	        </div>
	        <form action="login.php" method="post" class="w-100 h-100 f-c jsa">
	            <div class="f-c gap-05">
	                <label for="id">아이디</label>
	                <input id="id" type="text" name="user_id">
	            </div>
	            <div class="f-c gap-05">
	                <label for="password">비밀번호</label>
	                <input id="password" type="password" name="password">
	            </div>
	            <input type="submit" value="로그인">
	        </form>
	    </div>
	</div>

	<!-- 회원가입모달 -->
    <div id="signup" class="gap-1" popover="manual">
	    <div class="login-left signup-left">
	        <h2>스킬스북<br>도서관</h2>
	        <p>지식과 기술이 만나는<br>특별한 공간</p>
	    </div>
	    <div class="login-right signup-right">
	        <div class="f jsb aic">
	            <h3>회원가입</h3>
	            <button class="close" popovertarget="signup">x</button>
	        </div>
	        <form action="signup.php" method="post" class="w-100 h-100 f-c jsa">
	            <div class="f-c gap-05">
	                <label for="id">아이디</label>
	                <input id="id" type="text" name="user_id">
	            </div>
	            <div class="f-c gap-05">
	                <label for="password">비밀번호</label>
	                <input id="password" type="password" name="password">
	            </div>
				<div class="f-c gap-05">
	                <label for="name">이름</label>
	                <input id="name" type="text" name="user_name">
	            </div>
	            <input type="submit" value="회원가입">
	        </form>
	    </div>
	</div>
	
    <header class="w-100">
        <input type="checkbox" id="hamburger">
        <div class="header-inner w-100 h-100 f jsb aic m0a">
            <!-- 로고 -->
            <a href="index.php" class="logo tac acc"><img src="images/logo.png" alt=""></a>

            <!-- 네비게이션 -->
            <ul class="main f h-100">
                <input type="checkbox" name="mainmenu1" id="mainmenu1">
                <li class="h-100 f jcc aic">
                    <label for="mainmenu1">도서관소개
                        <div></div>
                        <div></div>
                    </label>
                    <ul class="sub">
                        <li><a href="intro.php">도서관소개</a></li>
                        <li><a href="map.php">도서관현황</a></li>
                    </ul>
               </li>
               <input type="checkbox" name="mainmenu2" id="mainmenu2">
               <li class="h-100 f jcc aic">
                    <label for="mainmenu2">도서자료실
                        <div></div>
                        <div></div>
                    </label>
                    <ul class="sub">
                        <li><a href="library.php">자료실</a></li>
                        <li><a href="reserve.php">열람실예약</a></li>
                    </ul>
               </li>
               <input type="checkbox" name="mainmenu3" id="mainmenu3">
               <li class="h-100 f jcc aic">
                    <label for="mainmenu3">회원서비스
                        <div></div>
                        <div></div>
                    </label>
                    <ul class="sub">
                        <li><a href="#" onclick="openSignup()">회원가입</a></li>
                        <li><a href="mypage.php">마이페이지</a></li>
                    </ul>
               </li>
			   <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']==='admin'): ?>
               <input type="checkbox" name="mainmenu4" id="mainmenu4">
               <li class="h-100 f jcc aic">
                    <label for="mainmenu4">도서관리자
                        <div></div>
                        <div></div>
                    </label>
                    <ul class="sub">
                        <li><a href="book_register.php">신규도서등록</a></li>
                        <li><a href="check.php">대출/열람실<br>업무조회</a></li>
                        <li><a href="popup.php">팝업관리</a></li>
                    </ul>
               </li>
			   <?php endif; ?>
            </ul>

            <!-- 유틸메뉴 -->
            <div class="util f gap-1 aic">
                <div class="search">
                    <input type="text" placeholder="검색">
                    <i class="fa fa-search"></i>
                </div>
				<?php if(isset($_SESSION['user_id'])): ?>
					<span><?= $_SESSION['user_name'] ?>님 (<?= $_SESSION['user_id'] ?>)</span>
					<button class="login" onclick="location.href='logout.php'">로그아웃</button>
				<!-- 로그인상태 -->
				
				<?php else: ?>
                <button class="login" onclick="openLogin()">로그인</button>
                <button class="signup" onclick="openSignup()">회원가입</button>
				<?php endif;?>

                <!-- 햄버거 -->
                <label for="hamburger" class="hamburger-btn f-c gap-05">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
        </div>
    </header>