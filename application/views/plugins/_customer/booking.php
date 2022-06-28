<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
	$(document).ready(function() {
		// $('.btn-neutral').show();
		// $('.btn-neutral').html('New Packet');
		// $('.btn-neutral').attr({
		// 	"data-target": "#modal-add-packet",
		// 	"data-toggle": "modal",
		// });

		GetPaket();

		function GetPaket() {
			$.ajax({
				type: "GET",
				url: base_url + 'Paket/GetPaket',
				dataType: "JSON",
				success: function(data) {
					var html = '';

					$.each(data, function(i, val) {
						html += '<option value="' + val.id_packet + '">Nama Paket : ' + val.packet_name + ' | Durasi : ' + val.packet_duration + ' | Harga Paket : ' + val.packet_price + '</option>';
					});

					$('[name="packet_id"]').html(html);
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

					setTimeout(() => {
						window.location.href = base_url + 'transaksi-c';
					}, 1000);
				}
			});

			return false;
		})
	});
</script>