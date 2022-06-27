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
  				url: base_url + '_Fotografer/Jadwal/GetJadwal',
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
  							'<td>' + val.status + '</td>' +
  							'<td class="table-actions">' + val.action + '</td>' +
  							'</tr>';
  					});

  					$('#table-body-transaction').html(html);
  				}
  			});
  		}

  		$('#form-take-timetable').submit(function() {
  			var data = $(this).serialize();

  			$.ajax({
  				type: "POST",
  				url: base_url + '_Fotografer/Jadwal/TakeTimetable',
  				data: data,
  				dataType: "JSON",
  				success: function(response) {
  					// console.log(response);
  					notification(response.type, response.message);
  					$('#modal-take-timetable').modal('hide');
  					$('#form-take-timetable')[0].reset();
  					GetJadwal();
  				}
  			});

  			return false;
  		});

  		$('#form-finish-confirm').submit(function() {
  			var data = $(this).serialize();

  			$.ajax({
  				type: "POST",
  				url: base_url + '_Fotografer/Jadwal/FinishConfirm',
  				data: data,
  				dataType: "JSON",
  				success: function(response) {
  					// console.log(response);
  					notification(response.type, response.message);
  					$('#modal-finish-confirm').modal('hide');
  					$('#form-finish-confirm')[0].reset();
  					GetJadwal();
  				}
  			});

  			return false;
  		});

  		$('#table-body-transaction').on('click', '.btn-take', function() {
  			var id = $(this).attr('data-id');
  			var date = $(this).attr('data-date');

  			$('[name="id_transaction"]').val(id);
  			$('.datetime').html(date);

  			$('#modal-take-timetable').modal('show');
  		});

  		$('#table-body-transaction').on('click', '.btn-finish', function() {
  			var id = $(this).attr('data-id');

  			$('[name="id_transaction"]').val(id);

  			$('#modal-finish-confirm').modal('show');
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