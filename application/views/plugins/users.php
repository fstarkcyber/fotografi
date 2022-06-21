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
		$('.btn-neutral').show();
		$('.btn-neutral').html('New User');
		$('.btn-neutral').attr({
			"data-target": "#modal-add-user",
			"data-toggle": "modal",
		});

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

		$('#form-add-user').submit(function() {
			var data = new FormData(this);

			$.ajax({
				type: "POST",
				url: base_url + 'User/add',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(response) {
					notification(response.type, response.message);
					$('#modal-add-user').modal('hide');
					$('#form-add-user')[0].reset();
					reload_table();
				}
			});

			return false;
		});

		$('#form-update-user').submit(function() {
			var data = new FormData(this);

			$.ajax({
				type: "POST",
				url: base_url + 'User/update',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(response) {
					notification(response.type, response.message);
					$('#modal-update-user').modal('hide');
					$('#form-update-user')[0].reset();

					reload_table();
					// console.log(response);
				}
			});

			return false;
		});

		$('#form-delete-user').submit(function() {
			var data = new FormData(this);

			$.ajax({
				type: "POST",
				url: base_url + 'User/delete',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(response) {
					notification(response.type, response.message);
					$('#modal-delete-user').modal('hide');
					$('#form-delete-user')[0].reset();

					reload_table();
					// console.log(response);
				}
			});

			return false;
		});

		$('#form-status-user').submit(function() {
			var data = new FormData(this);

			$.ajax({
				type: "POST",
				url: base_url + 'User/updateStatus',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(response) {
					notification(response.type, response.message);
					$('#modal-status-user').modal('hide');
					$('#form-status-user')[0].reset();

					reload_table();
					// console.log(response);
				}
			});

			return false;
		});

		$('#table-user').on('click', '.btn-update', function() {
			$('#modal-update-user').modal('show');

			var id = $(this).attr('data-id');

			$.ajax({
				type: "GET",
				url: base_url + 'User/GetUserById/' + id,
				dataType: "JSON",
				success: function(data) {
					// console.log(data);
					var image = 'default.png';
					if (data.images != null) {
						image = data.images;
					}

					$('#form-update-user [name="id"]').val(data.id);
					$('#form-update-user [name="name"]').val(data.name);
					$('#form-update-user [name="email"]').val(data.email);
					$('#form-update-user [name="hp"]').val(data.hp);

					$('.image-upload img').attr('src', base_url + 'assets/img/users/' + image);
					$('#image-update').val(data.images);
				}
			});
		});

		$('#table-user').on('click', '.btn-delete', function() {
			var id = $(this).attr('data-id');
			$('#modal-delete-user').modal('show');

			$('#form-delete-user [name="id"]').val(id);
		});

		$('#table-user').on('click', '.update-status-user', function() {
			var id = $(this).attr('data-id');
			$('#modal-status-user').modal('show');

			$('#form-status-user [name="id"]').val(id);
		});
	});
</script>
