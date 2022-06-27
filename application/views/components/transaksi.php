<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header">
				<h3 class="mb-0">Datatable</h3>
				<p class="text-sm mb-0">
					Jika status sudah tervalidasi, silahkan lihat pada halaman jadwal untuk melihat jadwal yang sudah di konfirmasi oleh fotografer, dan perhatikan pada <b>tanggal & waktu</b> yang ada pada tabel ini.
				</p>
			</div>
			<div class="table-responsive py-4">
				<table class="table table-flush" id="table-transaction">
					<thead class="thead-light">
						<tr>
							<th>Booking Code</th>
							<th>Packet Name</th>
							<th>Costumer Name</th>
							<th>Packet Price</th>
							<th>Date & Time</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody id="table-body-transaction"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-payment-validation" tabindex="-1" role="dialog" aria-labelledby="modal-payment-validation" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<h6 class="modal-title text-white" id="modal-title-payment-validation">Payment Validation</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-payment-validation">
					<input type="hidden" name="id_transaction">

					<div class="form-group">
						<label for="">Tanggal & Waktu</label>
						<input type="datetime-local" name="datetime_fix" class="form-control" required>
					</div>
				</form>
				<p>Apakah anda yakin ingin memvalidasi transaksi ini ?</p>
			</div>

			<div class="modal-footer">
				<button type="submit" form="form-payment-validation" class="btn btn-primary">Yes</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>


<div class="modal fade" id="modal-payment-cancel" tabindex="-1" role="dialog" aria-labelledby="modal-payment-cancel" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
		<div class="modal-content">

			<div class="modal-header bg-danger">
				<h6 class="modal-title text-white" id="modal-title-payment-cancel">Payment Cancel</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" id="form-payment-cancel">
					<input type="hidden" name="id_transaction">
				</form>
				<p>Apakah anda yakin ingin cancel pembayaran transaksi ini ?</p>
			</div>

			<div class="modal-footer">
				<button type="submit" form="form-payment-cancel" class="btn btn-danger">Yes</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>