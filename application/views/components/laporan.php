<form method="GET" id="form-filter" action="<?= site_url('Laporan/export') ?>">
	<div class="row">
		<div class="col-md">

			<div class="card">
				<!-- Card header -->
				<div class="card-header">
					<h3 class="mb-0">Filter Tanggal</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md">
							<div class="form-group">
								<label for="start_date">Start Date</label>
								<input type="date" class="form-control" name="start_date">
							</div>
						</div>

						<div class="col-md">
							<div class="form-group">
								<label for="start_date">End Date</label>
								<input type="date" class="form-control" name="end_date">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
				<!-- Card header -->
				<div class="card-header">
					<h3 class="mb-0">Filter Fotografer</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md">
							<div class="form-group">
								<label for="photographer_id">Fotografer</label>
								<select name="photographer_id" class="form-control">
								</select>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header border-0">
					<div class="row align-items-center">
						<div class="col text-right">
							<button class="btn btn-sm btn-primary" type="submit" form="form-filter" id="btn-export"><span class="ni ni-single-copy-04"></span> Export To Excel</button>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-flush" id="table-transaction">
						<thead class="thead-light">
							<tr>
								<th>Booking Code</th>
								<th>Packet Name</th>
								<th>Costumer Name</th>
								<th>Packet Price</th>
								<th>Date & Time</th>
								<th>Photographer Name</th>
								<th>Created At</th>
								<th>Finish At</th>
							</tr>
						</thead>

						<tbody id="table-body-transaction"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>