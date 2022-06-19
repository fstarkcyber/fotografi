<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header">
				<h3 class="mb-0">Datatable</h3>
				<p class="text-sm mb-0">
					dibawah ini adalah data user yang ada pada sistem ini, mohon untuk perhatikan setiap yang di lakukan agar tidak menghapus data yang masih di butuhkan.</p>
			</div>
			<div class="table-responsive py-4">
				<table class="table align-items-center table-flush" id="table-user">
					<thead class="thead-light">
						<tr>
							<th>Images</th>
							<th>Nama</th>
							<th>Email</th>
							<th>HP</th>
							<th>Nama Akses</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="modal-add-user" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-add-user">Modal Add User</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-add-user">
					<div class="row align-items-center text-center">
						<div class="col-lg-3">
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
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label for="Email">Email</label>
								<input type="email" name="email" class="form-control">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="hp">HP</label>
								<input type="text" name="hp" class="form-control">
							</div>
							<div class="form-group">
								<label for="role_id">Role</label>
								<select name="role_id" class="form-control">
									<option value="1">Administrator</option>
									<option value="2">Fotografer</option>
								</select>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="name">Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="Email">Konfirmasi Password</label>
								<input type="password" name="password_confirm" class="form-control">
							</div>
						</div>

					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="form-add-user">Save</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-update-user" tabindex="-1" role="dialog" aria-labelledby="modal-update-user" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-update-user">Modal Update User</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-update-user">
					<input type="hidden" name="id">
					<div class="row align-items-center text-center">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="imageUpload">Image</label>
								<div class="row">
									<div class="image-upload col-md">
										<label for="images-update">
											<img width="150" height="150" src="<?= base_url('assets/img/users/default.png') ?>" />
										</label>

										<input id="images-update" type="file" name="images" onchange="previewImage(this);">
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label for="Email">Email</label>
								<input type="email" name="email" class="form-control">
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label for="hp">HP</label>
								<input type="text" name="hp" class="form-control">
							</div>
							<div class="form-group">
								<label for="role_id">Role</label>
								<select name="role_id" class="form-control">
									<option value="1">Administrator</option>
									<option value="2">Fotografer</option>
								</select>
							</div>
						</div>

					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="form-update-user">Save</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-delete-user" tabindex="-1" role="dialog" aria-labelledby="modal-delete-user" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title text-white" id="modal-title-delete-user">Modal Delete User</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-delete-user">
					<input type="hidden" name="id">
					<p>Apakah anda yakin ingin menghapus user ini ?</p>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="form-delete-user" class="btn btn-danger">Hapus</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-status-user" tabindex="-1" role="dialog" aria-labelledby="modal-status-user" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h6 class="modal-title text-white" id="modal-title-status-user">Modal Status User</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-status-user">
					<input type="hidden" name="id">
					<p>Apakah anda yakin ingin mengganti status user ini ?</p>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="form-status-user" class="btn btn-warning">Ubah</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>