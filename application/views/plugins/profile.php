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
		getProfil();

		function getProfil() {
			$.ajax({
				type: "GET",
				url: base_url + 'Profile/GetUserById',
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
		}

		$('#form-update-user').submit(function() {
			var data = new FormData(this);

			$.ajax({
				type: "POST",
				url: base_url + 'Profile/update',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(response) {
					notification(response.type, response.message);
					// reload_table();
					getProfil();
					// console.log(response);
				}
			});

			return false;
		});
	});
</script>
