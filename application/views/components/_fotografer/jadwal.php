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
							<th>Nama Customer</th>
							<th>Packet Price</th>
							<th>Date & Time</th>
							<th>Fotografer</th>
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


<div class="modal fade" id="modal-finish-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-finish-confirm" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<h6 class="modal-title text-white" id="modal-title-finish-confirm">Konfirmasi Selesai</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<h4 class="mt-3">Apakah anda yakin ingin konfirmasi transaksi selesai ?</h4>

				<form method="POST" enctype="multipart/form-data" id="form-finish-confirm">
					<input type="hidden" name="id_transaction">
				</form>

			</div>

			<div class="modal-footer">
				<button type="submit" form="form-finish-confirm" class="btn btn-primary">Confirm</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>