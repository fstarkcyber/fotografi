 <!-- Header -->
 <div class="header bg-primary pb-6">
 	<div class="container-fluid">
 		<div class="header-body">
 			<div class="row align-items-center py-4">
 				<div class="col-lg-6 col-7">
 					<h6 class="h2 text-white d-inline-block mb-0"><?= ($this->session->userdata('sub_menu_active') == '') ? ucfirst($this->session->userdata('menu_active')) : ucfirst($this->session->userdata('sub_menu_active')) ?></h6>
 					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
 						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
 							<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
 							<li class="breadcrumb-item"><a href="#"><?= $this->session->userdata('menu_active') ?></a></li>
 							<?= ($this->session->userdata('sub_menu_active') != '') ? '<li class="breadcrumb-item"><a href="#">' . ($this->session->userdata('sub_menu_active')) . '</a></li>' : '' ?>
 						</ol>
 					</nav>
 				</div>
 				<div class="col-lg-6 col-5 text-right">
 					<a href="#" class="btn btn-sm btn-neutral">New</a>
 				</div>
 			</div>

 		</div>
 	</div>
 </div>
