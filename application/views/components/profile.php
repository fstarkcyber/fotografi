<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">Edit profile </h3>
					</div>
					<div class="col-4 text-right">
						<button type="submit" form="form-update-user" href="#!" class="btn btn-sm btn-primary">Update</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form id="form-update-user" method="POST" enctype="multipart/form-data">
					<div class="align-items-center text-center">
						<div class="form-group">
							<label for="imageUpload">Image</label>
							<div class="row">
								<div class="image-upload col-md">
									<label for="images">
										<img width="150" height="150" src="<?= base_url('assets/img/users/default.png') ?>" />
									</label>

									<input id="images" type="file" name="images" onchange="previewImage(this);">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="Email">Email</label>
							<input type="email" name="email" class="form-control">
						</div>

						<div class="form-group">
							<label for="hp">HP</label>
							<input type="text" name="hp" class="form-control">
						</div>

						<hr class="mt-6">
						<small class="text-muted"> * Kosongkan jika tidak ingin mengganti password</small>

						<div class="row">
							<div class="col-md">
								<div class="form-group">
									<label for="name">Password</label>
									<input type="password" name="password" class="form-control">
								</div>
							</div>

							<div class="col-md">
								<div class="form-group">
									<label for="Email">Konfirmasi Password</label>
									<input type="password" name="password_confirm" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
