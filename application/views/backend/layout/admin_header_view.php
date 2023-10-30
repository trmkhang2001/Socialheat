<!-- -------------- Header  -------------- -->
<?php
/**
 * @var $userInfo
 */
?>
<header class="navbar navbar-fixed-top bg-system">
	<div class="navbar-logo-wrapper dark bg-system">
		<a class="navbar-logo-text" href="/" style="max-width: 200px">
			<img src="/assets/images/logo.png" width="100%" alt="datalytis">
		</a>
		<span id="sidebar_left_toggle" class="ad ad-lines"></span>
	</div>

	<ul class="nav navbar-nav navbar-right">

		<li class="dropdown dropdown-fuse">
			<a href="#" class="dropdown-toggle fw600" data-toggle="dropdown">
				<span class="hidden-xs"><name><?= $userInfo['name']?></name> </span>
				<span class="fa fa-caret-down hidden-xs mr15"></span>
				<img src="<?= $userInfo['avatar']?>" alt="avatar" class="mw55">
			</a>
			<ul class="dropdown-menu list-group keep-dropdown w250" role="menu">

				<li class="dropdown-footer text-center">
					<a href="/backend/auth/logOut" class="btn btn-primary btn-sm btn-bordered">
						<span class="fa fa-power-off pr5"></span> Logout </a>
				</li>
			</ul>
		</li>
	</ul>
</header>
<!-- -------------- /Header  -------------- -->