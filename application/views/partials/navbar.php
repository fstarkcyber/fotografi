 <!-- Topnav -->
 <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
 	<div class="container-fluid">
 		<div class="collapse navbar-collapse" id="navbarSupportedContent">
 			<!-- Search form -->
 			<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
 				<div class="form-group mb-0">
 					<div class="input-group input-group-alternative input-group-merge">
 						<div class="input-group-prepend">
 							<span class="input-group-text"><i class="fas fa-search"></i></span>
 						</div>
 						<input class="form-control" placeholder="Search" type="text">
 					</div>
 				</div>
 				<button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
 					<span aria-hidden="true">×</span>
 				</button>
 			</form>
 			<!-- Navbar links -->
 			<ul class="navbar-nav align-items-center ml-md-auto">
 				<li class="nav-item d-xl-none">
 					<!-- Sidenav toggler -->
 					<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
 						<div class="sidenav-toggler-inner">
 							<i class="sidenav-toggler-line"></i>
 							<i class="sidenav-toggler-line"></i>
 							<i class="sidenav-toggler-line"></i>
 						</div>
 					</div>
 				</li>
 				<li class="nav-item d-sm-none">
 					<a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
 						<i class="ni ni-zoom-split-in"></i>
 					</a>
 				</li>
 				<li class="nav-item dropdown">
 					<a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 						<i class="ni ni-bell-55"></i>
 					</a>
 					<div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
 						<!-- Dropdown header -->
 						<div class="px-3 py-3">
 							<h6 class="text-sm text-muted m-0">You have <strong class="text-primary" id="total-trx"></strong> transactions.</h6>
 						</div>
 						<!-- List group -->
 						<div class="list-group list-group-flush" id="notif-trx">
 						</div>
 						<!-- View all -->
 						<?php
							$role_id = $this->session->userdata('role_id');
							if ($role_id == 3) {
								echo '<a href="' . base_url('transaksi-c') . '" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>';
							} else {
								echo '<a href="' . base_url('transaksi') . '" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>';
							}
							?>
 					</div>
 				</li>
 			</ul>
 			<ul class="navbar-nav align-items-center ml-auto ml-md-0">
 				<li class="nav-item dropdown">
 					<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 						<div class="media align-items-center">
 							<span class="avatar avatar-sm rounded-circle">
 								<img alt="Image placeholder" src="<?= base_url() ?>assets/img/users/<?= $this->session->userdata('images') ?>">
 							</span>
 							<div class="media-body ml-2 d-none d-lg-block">
 								<span class="mb-0 text-sm  font-weight-bold"><?= $this->session->userdata('name'); ?></span>
 							</div>
 						</div>
 					</a>
 					<div class="dropdown-menu dropdown-menu-right">
 						<div class="dropdown-header noti-title">
 							<h6 class="text-overflow m-0">Welcome!</h6>
 						</div>
 						<a href="<?= site_url('Profile') ?>" class="dropdown-item">
 							<i class="ni ni-single-02"></i>
 							<span>My profile</span>
 						</a>

 						<div class="dropdown-divider"></div>
 						<a href="<?= site_url('_Auth/Login/logout') ?>" class="dropdown-item">
 							<i class="ni ni-user-run"></i>
 							<span>Logout</span>
 						</a>
 					</div>
 				</li>
 			</ul>
 		</div>
 	</div>
 </nav>