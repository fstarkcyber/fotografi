<script>
	$(document).ready(function() {
		$('#form-register').on('submit', function() {
			$.ajax({
				type: "POST",
				url: "<?= base_url('_register') ?>",
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
