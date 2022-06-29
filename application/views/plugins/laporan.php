<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
	$(document).ready(function() {
		GetPhotografer();
		GetTransaction();

		function GetPhotografer() {
			$.ajax({
				type: "GET",
				url: base_url + 'User/GetAllFotografer',
				dataType: "JSON",
				success: function(response) {
					var html = '<option value="">Pilih Fotografer</option>';
					$.each(response, function(i, v) {
						html += '<option value="' + v.id + '">' + v.name + '</option>';
					});

					$('[name="photographer_id"]').html(html);
				}
			});
		}

		function GetTransaction() {
			var start_date = $('[name="start_date"]').val();
			var end_date = $('[name="end_date"]').val();
			var photographer_id = $('[name="photographer_id"]').val();

			$.ajax({
				type: "GET",
				url: base_url + 'Laporan/GetTransaction',
				data: {
					start_date: start_date,
					end_date: end_date,
					photographer_id: photographer_id
				},

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
							'<td>' + val.photographer_name + '</td>' +
							'<td>' + val.created_at + '</td>' +
							'<td>' + val.photographer_finish_confirm + '</td>' +
							'</tr>';
					});

					$('#table-body-transaction').html(html);
				}
			});
		}

		$('[name="start_date"]').on('change', function() {
			var val = $(this).val();
			GetTransaction();
		});

		$('[name="photographer_id"]').on('change', function() {
			var val = $(this).val();
			GetTransaction();
		});

		$('[name="end_date"]').on('change', function() {
			var val = $(this).val();
			GetTransaction();
		});
	});
</script>