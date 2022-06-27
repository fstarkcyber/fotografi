  <script src="<?= site_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script>
  	$(document).ready(function() {
  		// $('.btn-neutral').show();
  		// $('.btn-neutral').html('New Packet');
  		// $('.btn-neutral').attr({
  		// 	"data-target": "#modal-add-packet",
  		// 	"data-toggle": "modal",
  		// });

  		GetTransaction();

  		function GetTransaction() {
  			$.ajax({
  				type: "GET",
  				url: base_url + 'Transaksi/GetTransaction',
  				dataType: "JSON",
  				success: function(data) {
  					// console.log(data);
  					var html = '';

  					$.each(data, function(i, val) {
  						html += '<tr>' +
  							'<td>' + val.booking_code + '</td>' +
  							'<td>' + val.packet_name + '</td>' +
  							'<td>' + val.name + '</td>' +
  							'<td>' + val.packet_price + '</td>' +
  							'<td>' + val.datetime + '</td>' +
  							'<td>' + val.status + '</td>' +
  							'<td class="table-actions">' + val.action + '</td>' +
  							'</tr>';
  					});

  					$('#table-body-transaction').html(html);
  				}
  			});
  		}

  		$('#form-payment-validation').submit(function() {
  			var data = $(this).serialize();

  			$.ajax({
  				type: "POST",
  				url: base_url + 'Transaksi/payment_validation',
  				data: data,
  				dataType: "JSON",
  				success: function(response) {
  					// console.log(response);
  					notification(response.type, response.message);
  					$('#form-payment-validation')[0].reset();
  					$('#modal-payment-validation').modal('hide');
  					GetTransaction();
  				}
  			});

  			return false;
  		});

  		$('#form-payment-cancel').submit(function() {
  			var data = $(this).serialize();

  			$.ajax({
  				type: "POST",
  				url: base_url + 'Transaksi/payment_cancel',
  				data: data,
  				dataType: "JSON",
  				success: function(response) {
  					// console.log(response);
  					notification(response.type, response.message);
  					$('#form-payment-cancel')[0].reset();
  					$('#modal-payment-cancel').modal('hide');
  					GetTransaction();
  				}
  			});

  			return false;
  		});

  		$('#table-body-transaction').on('click', '.btn-validation', function() {
  			var id = $(this).attr('data-id');
  			var date = $(this).attr('data-date');

  			// console.log(date);
  			$('#form-payment-validation [name="id_transaction"]').val(id);
  			$('#form-payment-validation [name="datetime_fix"]').val(date);

  			$('#modal-payment-validation').modal('show');
  		});

  		$('#table-body-transaction').on('click', '.btn-cancel-payment', function() {
  			var id = $(this).attr('data-id');

  			// console.log(date);
  			$('#form-payment-cancel [name="id_transaction"]').val(id);

  			$('#modal-payment-cancel').modal('show');
  		});

  		var $dtBasic = $("#table-transaction");

  		// Methods

  		function init($this) {
  			// Basic options. For more options check out the Datatables Docs:
  			// https://datatables.net/manual/options

  			var options = {
  				keys: !0,
  				select: {
  					style: "multi",
  				},
  				"lengthChange": false,
  				"order": [],
  				"bInfo": false,
  				language: {
  					paginate: {
  						previous: "<i class='fas fa-angle-left'>",
  						next: "<i class='fas fa-angle-right'>",
  					},
  				},
  			};

  			// Init the datatable

  			var table = $this
  				.on("init.dt", function() {
  					$("div.dataTables_length select").removeClass(
  						"custom-select custom-select-sm"
  					);
  				})
  				.DataTable(options);
  		}

  		// Events

  		if ($dtBasic.length) {
  			init($dtBasic);
  		}
  	});
  </script>