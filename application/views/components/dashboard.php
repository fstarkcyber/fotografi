<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-0">Total Costumer</h5>
						<span class="h2 font-weight-bold mb-0" id="total-customer"></span>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
							<i class="ni ni-active-40"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-0">Total Fotografer</h5>
						<span class="h2 font-weight-bold mb-0" id="total-fotografer"></span>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
							<i class="ni ni-chart-pie-35"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-0">Total Transaksi</h5>
						<span class="h2 font-weight-bold mb-0" id="total-transaksi"></span>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
							<i class="ni ni-money-coins"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-0">Total Booking</h5>
						<span class="h2 font-weight-bold mb-0" id="total-booking"></span>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
							<i class="ni ni-chart-bar-32"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl">
		<div class="card bg-default">
			<div class="card-header bg-transparent">
				<div class="row align-items-center">
					<div class="col">
						<h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
						<h5 class="h3 text-white mb-0">Transaction value</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<!-- Chart -->
				<div class="chart">
					<!-- Chart wrapper -->
					<canvas id="trx-value" class="chart-canvas"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl">
		<div class="card">
			<div class="card-header bg-transparent">
				<div class="row align-items-center">
					<div class="col">
						<h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
						<h5 class="h3 mb-0">Total orders</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<!-- Chart -->
				<div class="chart">
					<canvas id="total-order" class="chart-canvas"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md">
		<div class="card">
			<div class="card-header">
				<h5 class="h3 mb-0">About Us</h5>
			</div>
			<div class="card-header d-flex align-items-center">
				<div class="d-flex align-items-center">
					<a href="#">
						<img src="<?= base_url() ?>assets/img/brand/logo-caffeine-mini.png ?>" class="avatar">
					</a>
					<div class="mx-3">
						<a href="#" class="text-dark font-weight-600 text-sm">Caffeine</a>
						<small class="d-block text-muted">081996707087</small>
					</div>
				</div>
				<div class="text-right ml-auto">
					<a type="button" href="https://www.instagram.com/caffeinestudio_tomang/" class="btn btn-facebook btn-icon-only text-white">
						<span class="btn-inner--icon"><i class="fab fa-instagram"></i></span>
					</a>
				</div>
			</div>
			<div class="card-body text-center">
				<p class="mb-4 font-weight-bold">
					Jl. Mandala Raya No.11B, RT.1/RW.4, Tomang, Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11440
				</p>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl">
		<!-- Members list group card -->
		<div class="card">
			<!-- Card header -->
			<div class="card-header">
				<!-- Title -->
				<h5 class="h3 mb-0">Galeri</h5>
			</div>
			<!-- Card body -->
			<div class="card-body">
				<div class="row" id="display-gallery">
				</div>
			</div>
		</div>
	</div>
</div>