<div class="row">
	<div class="col">
		<div class="card-wrapper">
			<!-- Custom form validation -->
			<div class="card">
				<!-- Card header -->
				<div class="card-header">
					<h3 class="mb-0">Formulir Booking</h3>
				</div>
				<!-- Card body -->
				<div class="card-body">
					<div class="row">
						<div class="col-lg-8">
							<p class="mb-0">
								halaman ini di gunakan untuk membuat permintaan booking, untuk melihat paket yang tersedia, silahkan lihat pada menu paket.
								<br><br>
								silahkan isi sesuai dengan keinginan anda, setelah melakukan permintaan booking silahkan untuk melakukan pembayaran pada menu transaksi, dan tunggu approve dari admin kami.
							</p>
						</div>
					</div>
					<hr>
					<form id="form-add-booking" method="POST">
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label class="form-control-label" for="validationCustom01">Paket</label>
								<select name="packet_id" id="" class="form-control" required></select>
							</div>

							<div class="col-md-6 mb-3">
								<label class="form-control-label">Tanggal & Waktu</label>
								<input type="datetime-local" name="datetime" class="form-control" required="">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md mb-3">
								<label class="form-control-label" for="validationCustom03">Catatan</label>
								<textarea name="note" class="form-control" id="" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox mb-3">
								<input class="custom-control-input" id="invalidCheck" type="checkbox" value="" required="">
								<label class="custom-control-label" for="invalidCheck">Agree to terms and conditions</label>
							</div>
						</div>
						<button class="btn btn-primary" type="submit">Booking</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
