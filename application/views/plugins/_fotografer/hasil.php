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

  		GetJadwal();

  		function GetJadwal() {
  			$.ajax({
  				type: "GET",
  				url: base_url + '_Fotografer/Hasil/GetJadwal',
  				dataType: "JSON",
  				success: function(data) {
  					var html = '';

  					$.each(data, function(i, val) {
  						html += '<tr>' +
  							'<td>' + val.booking_code + '</td>' +
  							'<td>' + val.packet_name + '</td>' +
  							'<td>' + val.name + '</td>' +
  							'<td>' + val.packet_price + '</td>' +
  							'<td>' + val.datetime + '</td>' +
  							'<td>' + val.photographer_name + '</td>' +
  							'<td class="table-actions">' + val.action + '</td>' +
  							'</tr>';
  					});

  					$('#table-body-transaction').html(html);
  				}
  			});
  		}

  		$('#form-upload-hasil').submit(function() {
  			var data = new FormData(this);
  			$.ajax({
  				url: base_url + '_Fotografer/Hasil/add',
  				type: 'POST',
  				data: data,
  				contentType: false,
  				cache: false,
  				processData: false,
  				dataType: 'JSON',
  				success: function(response) {
  					notification(response.type, response.message);

  					$('#modal-upload-hasil').modal('hide');
  					$('#form-upload-hasil')[0].reset();

  					GetJadwal();
  				}
  			});

  			return false;
  		});

  		$('#form-delete-hasil').submit(function() {
  			var data = new FormData(this);
  			$.ajax({
  				url: base_url + '_Fotografer/Hasil/delete',
  				type: 'POST',
  				data: data,
  				contentType: false,
  				cache: false,
  				processData: false,
  				dataType: 'JSON',
  				success: function(response) {
  					notification(response.type, response.message);

  					$('#modal-delete-hasil').modal('hide');
  					$('#form-delete-hasil')[0].reset();

  					GetJadwal();
  				}
  			});

  			return false;
  		});

  		$('#table-body-transaction').on('click', '.btn-upload', function() {
  			var id = $(this).attr('data-id');

  			$('[name="id_transaction"]').val(id);

  			$('#modal-upload-hasil').modal('show');
  		});

  		$('#table-body-transaction').on('click', '.btn-hapus-hasil', function() {
  			var id = $(this).attr('data-id');
  			$('[name="transaction_id"]').val(id);

  			$('#modal-delete-hasil').modal('show');
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