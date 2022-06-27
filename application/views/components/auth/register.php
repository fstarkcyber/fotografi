<!-- Page content -->
<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-7">
			<div class="card bg-secondary border-0 mb-0">
				<div class="card-body px-lg-5 py-lg-5">
					<div class="text-center text-muted mb-4">
						<img class="img-fluid" src="<?= site_url('assets/img/brand/logo-caffeine.png') ?>" alt="">
					</div>
					<form role="form" id="form-register" method="POST">
						<div class="form-group mb-3">
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-email-83"></i></span>
								</div>
								<input class="form-control" placeholder="Email" type="email" name="email">
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-circle-08"></i></span>
								</div>
								<input class="form-control" placeholder="Nama" type="text" name="name">
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
								</div>
								<input class="form-control" placeholder="HP" type="number" name="hp">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
								</div>
								<input class="form-control" placeholder="Password" type="password" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group input-group-merge input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
								</div>
								<input class="form-control" placeholder="Password Confirmation" type="password" name="password_confirm">
							</div>
						</div>

						<div class="text-center">
							<button type="submit" class="btn btn-primary my-4">Register</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-6">
					<a href="<?= site_url('login') ?>" class="text-light"><small>Sudah punya akun ?</small></a>
				</div>
			</div>
		</div>
	</div>
</div>