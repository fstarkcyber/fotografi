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

<div class="modal fade" id="modal-payment-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-payment-confirm" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<h6 class="modal-title text-white" id="modal-title-payment-confirm">Payment Confirmation</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body">
				<h4 class="mb-4">Silahkan lakukan pembayaran sejumlah <span class="packet_price text-danger"></span> ke rekening yang tertera di bawah ini</h4>

				<div class="row">
					<div class="col-md">
						<img src="https://dashboard.xendit.co/assets/images/bca-logo.svg" alt="" class="img-fluid">
						<h5 for="" class="d-block text-muted">BCA 123123123</h5>
					</div>

					<div class="col-md">
						<img src="https://dashboard.xendit.co/assets/images/bni-logo.svg" alt="" class="img-fluid">
						<h5 for="" class="d-block text-muted">BNI 123123123</h5>
					</div>

					<div class="col-md">
						<img src="https://dashboard.xendit.co/assets/images/mandiri-logo.svg" alt="" class="img-fluid">
						<h5 for="" class="d-block text-muted">MANDIRI 123123123</h5>
					</div>
				</div>

				<h4 class="mt-3">Terima kasih sudah melakukan pembayaran, silahkan upload bukti pembayaran pada form dibawah ini agar bisa di validasi oleh pihak kami.</h4>

				<form method="POST" enctype="multipart/form-data" id="form-payment-confirm">
					<input type="hidden" name="id_transaction">
					<input type="hidden" name="booking_code">

					<div class="row text-center">
						<div class="image-upload col-md">
							<label for="payment_image">
								<img width="250" height="150" src="https://icons-for-free.com/iconfiles/png/512/box+document+outline+share+top+upload+icon-1320195323221671611.png" />
							</label>
							<input id="payment_image" type="file" name="payment_image" onchange="previewImage(this);">
						</div>
					</div>
				</form>

			</div>

			<div class="modal-footer">
				<button type="submit" form="form-payment-confirm" class="btn btn-primary">Confirm</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>


<div class="modal fade" id="modal-preview-invoice" tabindex="-1" role="dialog" aria-labelledby="modal-preview-invoice" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<h6 class="modal-title text-white" id="modal-title-payment-confirm">Preview Invoice</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body" id="image-container">
				<h1 class="mb-2">Invoice #</h1>
				<div class="row font-weight-bold">

					<div class="col-md">
						<label for="">Nama : <span class="name"></span></label>
					</div>

					<div class="col-md">
						<label for="">Kode Booking : <span class="booking-code"></span></label>

					</div>
				</div>

				<div class="row font-weight-bold">

					<div class="col-md">
						<label for="">Email : <span class="email"></span></label>
					</div>

					<div class="col-md">
						<label for="">Tanggal Booking : <span class="created_at"></span></label>
					</div>
				</div>

				<table class="table table-sm my-3">
					<thead class="table-dark">
						<th>Packet Name</th>
						<th>Packet Price</th>
						<th>Packet Duration</th>
					</thead>
					<tbody>
						<tr>
							<td class="packet_name"></td>
							<td class="packet_price"></td>
							<td class="packet_duration"></td>
						</tr>
					</tbody>
				</table>

				<small class="note"></small>
				<div id="preview-image"></div>
			</div>

			<div class="modal-footer">
				<a href="#" id="btn-download" class="btn btn-primary text-white">Generate</a>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>