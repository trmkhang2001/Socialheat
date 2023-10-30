<?php
/**
 * @var $userInfo
 */
?>

<aside id="sidebar_left" class="nano nano-light sidebar-default sidebar-light">

	<!-- -------------- Sidebar Left Wrapper  -------------- -->
	<div class="sidebar-left-content nano-content" style="">

		<!-- -------------- Sidebar Header -------------- -->
		<header class="sidebar-header">

			<!-- -------------- Sidebar - Author -------------- -->
			<!--			<div class="sidebar-widget author-widget">-->
			<!--				<div class="media">-->
			<!--					<a class="media-left" href="#">-->
			<!--						<img src="<>" class="img-responsive">-->
			<!--					</a>-->
			<!---->
			<!--					<div class="media-body">-->
			<!--						<div class="media-links">-->
			<!--							<a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="utility-login.html">Logout</a>-->
			<!--						</div>-->
			<!--						<div class="media-author">Douglas Adams</div>-->
			<!--					</div>-->
			<!--				</div>-->
			<!--			</div>-->

			<!-- -------------- Sidebar - Author Menu  -------------- -->


		</header>
		<!-- -------------- /Sidebar Header -------------- -->

		<!-- -------------- Sidebar Menu  -------------- -->
		<ul class="nav sidebar-menu">
			<?php if ($userInfo['role_id'] === ROLE_ADMIN): ?>
				<li>
					<a href="/backend/users" data-action="users">
						<span class="fa fa-user"></span>
						<span class="sidebar-title">Users</span>
					</a>
				</li>
				<li>
					<a class="accordion-toggle" href="#">
						<span class="fa fa-list"></span>
						<span class="sidebar-title">Items</span>
						<span class="caret"></span>
					</a>
					<ul class="nav sub-nav" style="">
						<li>
							<a href="/backend/items" data-action="items">
								<span class="fa fa-file-text-o"></span> List </a>
						</li>
						<li class="">
							<a href="/backend/items/clear_cache">
								<span class="fa fa-file-text-o"></span>Clear cache</a>
						</li>
					</ul>

				</li>
				<li>
					<a href="/backend/keywords" data-action="keywords">
						<span class="fa fa-key"></span>
						<span class="sidebar-title">Keywords</span>
					</a>
				</li>
				<li>
					<a href="/backend/clients" data-action="clients">
						<span class="fa fa-list"></span>
						<span class="sidebar-title">Items list</span>
					</a>
				</li>
				<li>
					<a href="/backend/socialItems" data-action="socialItems">
						<span class="fa fa-list"></span>
						<span class="sidebar-title">Social Items</span>
					</a>
				</li>
				<li>
					<a href="/backend/socialItems/linkApi" data-action="linkApi">
						<span class="fa fa-list"></span>
						<span class="sidebar-title">Api Social Items</span>
					</a>
				</li>
				<li>
					<a href="/backend/xpath" data-action="xpath">
						<span class="fa fa-list"></span>
						<span class="sidebar-title">Xpath</span>
					</a>
				</li>
				<li>
					<a href="/backend/xpath/token" data-action="token">
						<span class="fa fa-list"></span>
						<span class="sidebar-title">Fb token</span>
					</a>
				</li>
				<li>
					<a href="/backend/comments" data-action="comments">
						<span class="fa fa-comment"></span>
						<span class="sidebar-title">Comments</span>
					</a>
				</li>
				<li>
					<a href="/backend/config" data-action="config">
						<span class="fa fa-link"></span>
						<span class="sidebar-title">Link Api</span>
					</a>
				</li>
			<?php endif ?>
			<!-- -------------- Sidebar Progress Bars -------------- -->
		</ul>
		<!-- -------------- /Sidebar Menu  -------------- -->

		<!-- -------------- Sidebar Hide Button -------------- -->
		<div class="sidebar-toggler">
			<a href="#">
				<span class="fa fa-arrow-circle-o-left"></span>
			</a>
		</div>
		<!-- -------------- /Sidebar Hide Button -------------- -->

	</div>
	<!-- -------------- /Sidebar Left Wrapper  -------------- -->

</aside>