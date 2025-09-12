

<nav class="navbar  navbar-expand-lg navbar-white  <?php if(defined('_INDEX_')) { ?> mainpage fixed-top <? } ?>">
  <div class="container">
	<a class="navbar-brand  me-5 pe-5" href="<?php echo G5_URL?>" class="logo">
		<img src="/0813/img/ys_logo.png" class="<?php if(defined('_INDEX_')) { ?> filteri <? } ?> img-fluid" alt="logo">
	</a>
	<button class="navbar-toggler navbar-dark navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse ms-5 ps-5" id="navbarResponsive" data-hover="dropdown" data-animations="fadeIn fadeIn fadeInUp fadeInRight">
	  <ul class="navbar-nav ml-auto">
	  <?php
$sql = " select *
        from {$g5['menu_table']}
        where me_use = '1'
          and length(me_code) = '2'
        order by me_order, me_id ";
$result = sql_query($sql, false);
$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
$menu_datas = array();

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $menu_datas[$i] = $row;

    $sql2 = " select *
                from {$g5['menu_table']}
                where me_use = '1'
                  and length(me_code) = '4'
                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                order by me_order, me_id ";
    $result2 = sql_query($sql2);
    while ($row2 = sql_fetch_array($result2)) {
        $menu_datas[$i]['sub'][] = $row2;
    }
}

$i = 0;
foreach ($menu_datas as $row) {
    if (empty($row)) continue;

    // 서브메뉴가 있는 경우
    if (!empty($row['sub']) && count($row['sub']) > 0) {
?>
        <li class="nav-item dropdown megamenu-li">
            <a class="nav-link dropdown-toggle ks4 f16 "
               href="<?php echo $row['me_link']; ?>"
               id="navbarDropdownBlog"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false"
               target="_<?php echo $row['me_target']; ?>">
                <?php echo $row['me_name'] ?>
            </a>
            <!-- 서브 -->
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <?php foreach ($row['sub'] as $row2) { ?>
                    <a class="dropdown-item ks4 fw4"
                       href="<?php echo $row2['me_link']; ?>"
                       target="_<?php echo $row2['me_target']; ?>">
                        <?php echo $row2['me_name'] ?>
                    </a>
                <?php } ?>
            </ul>
        </li>
<?php
    } else {
        // 서브메뉴가 없는 경우
?>
        <li class="nav-item">
            <a class="nav-link ks4 f16"
               href="<?php echo $row['me_link']; ?>"
               target="_<?php echo $row['me_target']; ?>">
                <?php echo $row['me_name'] ?>
            </a>
        </li>
<?php
    }
    $i++;
} // end foreach

if ($i == 0) { ?>
    <li class="gnb_empty">
        메뉴 준비 중입니다.
        <?php if ($is_admin) { ?>
            <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.
        <?php } ?>
    </li>
<?php } ?>

		<li class="nav-item dropdown login">
		  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			LOGIN
		  </a>
		  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
			
			<?php if($is_admin) { ?><a class="dropdown-item" href="<?php echo G5_URL?>/adm">관리자</a><?php } ?>
			<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/new.php">새글</a>
			<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a>
			<?php if($is_member) { ?>
			<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=<?php echo G5_BBS_URL; ?>/register_form.php">정보수정</a>
			<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a>
			<?php }else{ ?>
			<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/login.php">로그인</a>
			<a class="dropdown-item" href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a>
			<?php } ?>
		  </div>
		</li>
	  </ul>
	</div>
  </div>
</nav>