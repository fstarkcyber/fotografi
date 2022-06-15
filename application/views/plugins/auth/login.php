<script>
	$(document).ready(function() {
		$('#form-login').on('submit', function() {
			$.ajax({
				type: "POST",
				url: "<?= base_url('_login') ?>",
				data: $(this).serialize(),
				dataType: "JSON",
				success: function(response) {
					if (response.type == 'success') {
						window.location.href = response.redirect;
					}

					notification(response.type, response.message);
				}
			});

			return false;
		});
	});
</script>
