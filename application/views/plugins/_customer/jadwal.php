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
  				url: base_url + '_Customer/Jadwal/GetJadwal',
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
  							'</tr>';
  					});

  					$('#table-body-transaction').html(html);
  				}
  			});
  		}

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