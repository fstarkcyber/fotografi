<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header">
				<h3 class="mb-0">Datatable</h3>
				<p class="text-sm mb-0">
					Anda dapat upload hasil foto pada transaksi yang tersedia di bawah ini, untuk dijadikan galeri pada dashboard
				</p>
			</div>
			<div class="table-responsive py-4">
				<table class="table table-flush" id="table-transaction">
					<thead class="thead-light">
						<tr>
							<th>Booking Code</th>
							<th>Packet Name</th>
							<th>Nama Customer</th>
							<th>Packet Price</th>
							<th>Date & Time</th>
							<th>Fotografer</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody id="table-body-transaction"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-take-timetable" tabindex="-1" role="dialog" aria-labelledby="modal-take-timetable" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<h6 class="modal-title text-white" id="modal-title-take-timetable">Ambil Jadwal</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<h4 class="mt-3">Apakah anda yakin ingin ambil jadwal pada <span class="datetime"></span> ini ?</h4>

				<form method="POST" enctype="multipart/form-data" id="form-take-timetable">
					<input type="hidden" name="id_transaction">
				</form>

			</div>

			<div class="modal-footer">
				<button type="submit" form="form-take-timetable" class="btn btn-primary">Confirm</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-upload-hasil" tabindex="-1" role="dialog" aria-labelledby="modal-upload-hasil" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-upload-hasil">Modal Upload Hasil</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-upload-hasil">
					<input type="hidden" name="id_transaction">

					<div class="col-md-12">
						<div class="form-group">
							<label for="imageUpload">Image</label>
							<div class="row">
								<div class="image-upload col-md">
									<label for="image1">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="image1" type="file" name="image1" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md">
									<label for="image2">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="image2" type="file" name="image2" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md">
									<label for="image3">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="image3" type="file" name="image3" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md">
									<label for="image4">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="image4" type="file" name="image4" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md">
									<label for="image5">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="image5" type="file" name="image5" onchange="previewImage(this);">
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="form-upload-hasil">Save</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-delete-hasil" tabindex="-1" role="dialog" aria-labelledby="modal-delete-hasil" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title text-white" id="modal-title-delete-hasil">Modal Delete Hasil</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-delete-hasil">
					<input type="hidden" name="transaction_id">
					<p>Apakah anda yakin ingin menghapus hasil foto ini ?</p>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="form-delete-hasil" class="btn btn-danger">Hapus</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>