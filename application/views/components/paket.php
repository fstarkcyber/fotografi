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
				<button type="button" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
