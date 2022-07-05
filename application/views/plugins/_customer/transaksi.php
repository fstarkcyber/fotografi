  <script src="<?= site_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?= site_url() ?>assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="https://apps.sistemit.com/tutorial/html2canvas/html2canvas.js"></script>
  <script>
  	$(document).ready(function() {
  		// $('.btn-neutral').show();
  		// $('.btn-neutral').html('New Packet');
  		// $('.btn-neutral').attr({
  		// 	"data-target": "#modal-add-packet",
  		// 	"data-toggle": "modal",
  		// });

  		GetTransaction();
  		var container = $('#image-container');
  		var getCanvas;

  		function GetTransaction() {
  			$.ajax({
  				type: "GET",
  				url: base_url + '_Customer/Booking/GetTransaction',
  				dataType: "JSON",
  				success: function(data) {
  					var html = '';

  					$.each(data, function(i, val) {
  						html += '<tr>' +
  							'<td>' + val.booking_code + '</td>' +
  							'<td>' + val.packet_name + '</td>' +
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

  		$('#form-add-booking').submit(function() {
  			var data = $(this).serialize();

  			$.ajax({
  				type: "POST",
  				url: base_url + '_Customer/Booking/add',
  				data: data,
  				dataType: "JSON",
  				success: function(response) {
  					// console.log(response);
  					notification(response.type, response.message);
  					$('#form-add-booking')[0].reset();

  					window.location.href = "";
  				}
  			});

  			return false;
  		});

  		$('#form-payment-confirm').submit(function() {
  			var data = new FormData(this);

  			$.ajax({
  				type: "POST",
  				url: base_url + '_Customer/Booking/payment_confirm',
  				data: data,
  				contentType: false,
  				cache: false,
  				processData: false,
  				dataType: "JSON",
  				success: function(response) {
  					// console.log(response);
  					notification(response.type, response.message);
  					$('#modal-payment-confirm').modal('hide');
  					$('#form-payment-confirm')[0].reset();
  					GetTransaction();
  				}
  			});

  			return false;
  		});

  		$('#table-body-transaction').on('click', '.btn-confirm', function() {
  			var id = $(this).attr('data-id');
  			var booking_code = $(this).attr('data-booking');
  			var packet_price = $(this).attr('data-price');

  			$('[name="id_transaction"]').val(id);
  			$('[name="booking_code"]').val(booking_code);
  			$('.packet_price').html(packet_price);

  			$('#modal-payment-confirm').modal('show');
  		});

  		$('#table-body-transaction').on('click', '.btn-preview', function() {
  			var id = $(this).attr('data-id');
  			var booking_code = $(this).attr('data-booking');
  			var packet_price = $(this).attr('data-price');
  			var packet_name = $(this).attr('data-packet-name');
  			var packet_duration = $(this).attr('data-packet-duration');
  			var name = $(this).attr('data-name');
  			var email = $(this).attr('data-email');
  			var note = $(this).attr('data-note');
  			var created_at = $(this).attr('data-created-at');

  			// console.log(name);

  			$('.name').html(name);
  			$('.email').html(email);
  			$('.booking-code').html(booking_code);
  			$('.note').html(note);
  			$('.created_at').html(created_at);
  			$('.packet_name').html(packet_name);
  			$('.packet_price').html(packet_price);
  			$('.packet_duration').html(packet_duration);

  			$('#modal-preview-invoice').modal('show');
  		});

  		$('#btn-download').on('click', function() {
  			if (getCanvas === undefined) {
  				html2canvas(container, {
  					onrendered: function(canvas) {
  						// $("#preview-image").append(canvas);
  						getCanvas = canvas;
  						$('#btn-download').html('Download');
  						var imgageData = getCanvas.toDataURL("image/png", 1);
  						var newData = imgageData.replace(
  							/^data:image\/png/, "data:application/octet-stream");

  						// window.location.href = newData;
  						$("#btn-download").attr("download", "invoice.png").attr("href", newData);
  					}
  				});

  			}
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
  				searching: true,
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