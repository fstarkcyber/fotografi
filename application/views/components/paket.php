<div class="row" id="list-packets">

</div>

<div class="modal fade" id="modal-add-packet" tabindex="-1" role="dialog" aria-labelledby="modal-add-packet" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-add-packet">Modal Add Packet</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-add-packet">
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

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_name">Packet Name</label>
								<input type="text" name="packet_name" class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_duration">Packet Duration</label>
								<input type="text" name="packet_duration" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_price">Packet Price</label>
								<input type="text" name="packet_price" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_name">Membership ?</label>
								<select name="membership" class="form-control">
									<option value="no">No</option>
									<option value="yes">Yes</option>
									<select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="packet_name">Packet Description</label>
								<textarea name="packet_description" class="form-control" cols="30" rows="10"></textarea>
							</div>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" form="form-add-packet">Save</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-update-packet" tabindex="-1" role="dialog" aria-labelledby="modal-update-packet" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-update-packet">Modal Update Packet</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-update-packet">
					<input type="hidden" name="id_packet">
					<div class="col-md-12">
						<div class="form-group">
							<label for="imageUpload">Image</label>
							<div class="row">
								<div class="image-upload col-md text-center">
									<label for="imageUpdate1">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="imageUpdate1" type="file" name="image1" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md text-center">
									<label for="imageUpdate2">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="imageUpdate2" type="file" name="image2" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md text-center">
									<label for="imageUpdate3">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="imageUpdate3" type="file" name="image3" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md text-center">
									<label for="imageUpdate4">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="imageUpdate4" type="file" name="image4" onchange="previewImage(this);">
								</div>

								<div class="image-upload col-md text-center">
									<label for="imageUpdate5">
										<img width="100" height="100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png" />
									</label>

									<input id="imageUpdate5" type="file" name="image5" onchange="previewImage(this);">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_name">Packet Name</label>
								<input type="text" name="packet_name" class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_duration">Packet Duration</label>
								<input type="text" name="packet_duration" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_price">Packet Price</label>
								<input type="text" name="packet_price" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="packet_name">Membership ?</label>
								<select name="membership" class="form-control">
									<option value="no">No</option>
									<option value="yes">Yes</option>
									<select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="packet_name">Packet Description</label>
								<textarea name="packet_description" class="form-control" cols="30" rows="10"></textarea>
							</div>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="form-update-packet" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-delete-packet" tabindex="-1" role="dialog" aria-labelledby="modal-delete-packet" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h6 class="modal-title text-white" id="modal-title-delete-packet">Modal Delete Packet</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-delete-packet">
					<input type="hidden" name="id_packet">
					<p>Apakah anda yakin ingin menghapus paket ini ?</p>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="form-delete-packet" class="btn btn-danger">Hapus</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>