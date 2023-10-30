<style>
	.m-aside-left--minimize .m-menu__link {
		table-layout: initial !important;
	}
</style>
<?php
$last = $last = $this->uri->total_segments();
/**
 * @var $userInfo
 */
?>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">

	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
		 m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<?php if ($userInfo['role_id'] === ROLE_ADMIN || $userInfo['role_id'] === ROLE_CLIENTS || $userInfo['role_id'] === ROLE_DOWNLOAD): ?>
				<li class="m-menu__item" aria-haspopup="true" data-segment="clients">
					<a href="<?= site_url('/backend/clients') ?>" class="m-menu__link ">
						<i class="m-menu__link-icon  ">
							<svg width="21" height="22" viewBox="0 0 21 22" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1.5H8.38889V11H1V1.5Z" stroke="white" stroke-opacity="0.6" stroke-width="2"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M12.6111 1.5H20V6.77778H12.6111V1.5Z" stroke="white" stroke-opacity="0.6"
									  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M12.6111 11H20V20.5H12.6111V11Z" stroke="white" stroke-opacity="0.6"
									  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M1 15.2222H8.38889V20.5H1V15.2222Z" stroke="white" stroke-opacity="0.6"
									  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</i>
						<span class="m-menu__link-title">
                   		  <span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
							  Dashboard
							</span>
						 </span
					</span>
					</a>
				</li>
				<li class="m-menu__item  m-menu__item--submenu " aria-haspopup="true" m-menu-submenu-toggle="hover">
					<a href="javascript:void()" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon  m-menu__link-icon ">
							<svg width="21" height="23" viewBox="0 0 21 23" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M12.1765 22C14.4118 22 15.5294 20.8947 15.5294 18.6842C15.5294 17.2109 16.2749 15.7365 17.7647 14.2632C19.1808 12.8628 20 10.8733 20 8.73684C20 6.6849 19.1757 4.71701 17.7085 3.26607C16.2413 1.81513 14.2514 1 12.1765 1C10.1015 1 8.1116 1.81513 6.6444 3.26607C5.1772 4.71701 4.35294 6.6849 4.35294 8.73684M16.6471 8.73684C16.6471 7.56431 16.1761 6.43979 15.3377 5.61069C14.4993 4.78158 13.3621 4.31579 12.1765 4.31579C10.9908 4.31579 9.85368 4.78158 9.01529 5.61069C8.17689 6.43979 7.70588 7.56431 7.70588 8.73684M1 19.7895L6.58824 13.1579L7.70588 17.5789L13.2941 10.9474"
									  stroke="white" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
									  stroke-linejoin="round"/>
							</svg>

						</i>
						<span class="m-menu__link-text">Listening</span>
						<i class="m-menu__ver-arrow la la-angle-right" style="color: #ffffff"></i>
					</a>
					<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
						<ul class="m-menu__subnav">
							<li class="m-menu__item  m-menu__item--submenu" data-segment="facebook">
								<a href="<?= site_url('/backend/clients/facebook') ?>" class="m-menu__link ">
									<i class="m-menu__link-icon"></i>
									<span class="m-menu__link-text">Facebook</span>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" data-segment="twitter">
								<a href="<?= site_url('/backend/clients/twitter') ?>" class="m-menu__link ">
									<i class="m-menu__link-icon"></i>
									<span class="m-menu__link-text">Twitter</span>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" data-segment="instagram">
								<a href="<?= site_url('/backend/clients/instagram') ?>" class="m-menu__link ">
									<i class="m-menu__link-icon"></i>
									<span class="m-menu__link-text">Instagram</span>
								</a>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" data-segment="instagram">
								<a href="<?= site_url('/backend/clients/tiktok') ?>" class="m-menu__link ">
									<i class="m-menu__link-icon"></i>
									<span class="m-menu__link-text">Tiktok</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="m-menu__item" aria-haspopup="true" data-segment="password">
					<a href="<?= site_url('/backend/clients/password') ?>" class="m-menu__link ">
						<i class="m-menu__link-icon  ">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M13 4.99422C13.5304 4.99422 14.0391 5.20493 14.4142 5.58C14.7893 5.95508 15 6.46378 15 6.99422L13 4.99422ZM19 6.99422C19.0003 7.93139 18.781 8.85559 18.3598 9.69276C17.9386 10.5299 17.3271 11.2568 16.5744 11.8151C15.8216 12.3734 14.9486 12.7476 14.0252 12.9077C13.1018 13.0679 12.1538 13.0095 11.257 12.7372L9 14.9942H7V16.9942H5V18.9942H2C1.73478 18.9942 1.48043 18.8889 1.29289 18.7013C1.10536 18.5138 1 18.2594 1 17.9942V15.4082C1.00006 15.143 1.10545 14.8887 1.293 14.7012L7.257 8.73722C7.00745 7.91223 6.93857 7.04316 7.05504 6.18916C7.17152 5.33516 7.47062 4.51629 7.93199 3.78826C8.39336 3.06024 9.00616 2.44016 9.72869 1.97024C10.4512 1.50031 11.2665 1.19157 12.1191 1.06502C12.9716 0.938476 13.8415 0.997099 14.6693 1.2369C15.4972 1.4767 16.2637 1.89205 16.9166 2.45468C17.5696 3.01731 18.0936 3.71401 18.4531 4.49736C18.8127 5.2807 18.9992 6.13231 19 6.99422V6.99422Z"
									  stroke="white" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"
									  stroke-linejoin="round"/>
							</svg>

						</i>
						<span class="m-menu__link-title">
                   		  <span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
							  Change password
							</span>
						 </span
					</span>
					</a>
				</li>
				<li class="m-menu__item" data-segment="interactions">
					<a href="<?= site_url('/backend/interactions') ?>" class="m-menu__link ">
						<i class="m-menu__link-icon">
							<span class="fa fa-file-export"></span>

						</i>
						<span class="m-menu__link-text">Export</span>
					</a>
				</li>
				<li class="m-menu__item" data-segment="reports">
					<a href="<?= site_url('/backend/clients/reports') ?>" class="m-menu__link ">
						<i class="m-menu__link-icon">
							<span class="fa fa-chart-bar"></span>

						</i>
						<span class="m-menu__link-text">Reports</span>
					</a>
				</li>
				<li class="m-menu__item" data-segment="comments">
					<a href="<?= site_url('/backend/comments') ?>" class="m-menu__link ">
						<i class="m-menu__link-icon">
							<span class="fa fa-comment"></span>

						</i>
						<span class="m-menu__link-text">Comments</span>
					</a>
				</li>
			<?php endif; ?>

		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>

<script>
  let segment = "<?=$this->uri->segment($last)?>";
  $('.m-menu__item').each(function() {
    let dataSegment = $(this).data('segment');
    if (dataSegment === segment) {
      $(this).addClass('m-menu__item--active');
      if ($(this).parents('.m-menu__item--submenu').length) {
        $(this).parents('.m-menu__item').addClass('m-menu__item--open');
      }
    }
  });
</script>