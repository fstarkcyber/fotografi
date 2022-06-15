<script src="<?= base_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<script>
	$(document).ready(function() {
		table = $('#table-user').DataTable({
			"processing": true,
			"serverSide": true,
			// "scrollX": true,
			// "fixedColumns": {
			// 	 "leftColumns": 1,
			// 	 "rightColumns": 1
			// },
			"responsive": true,
			"lengthChange": false,
			"order": [],
			"bInfo": false,
			"autoWidth": true,
			"ajax": {
				"url": "<?= base_url('users/all') ?>",
				"type": "POST"
			},

			"language": {
				"paginate": {
					"previous": '<i class="ri-arrow-left-line"></i>',
					"next": '<i class="ri-arrow-right-line"></i>'
				},
				"aria": {
					"paginate": {
						"previous": 'Previous',
						"next": 'Next'
					}
				}
			},

			"columnDefs": [{
				"targets": [0],
				"orderable": false,
				"className": "text-center"
			}, ],
		});

		function reload_table() {
			table.ajax.reload();
		}
	});
</script>
