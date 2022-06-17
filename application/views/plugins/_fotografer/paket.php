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
						var images = '';

						$.each(val.packet_images, function(im, img) {
							images += '<div><img src="' + base_url + 'assets/img/packets/' + img.image_name + '"></div>';
						});

						html += '<div class="col-lg-6 col-md-6">' +
							'	<div class="card card-pricing border-0 text-center mb-4">' +
							'		<div class="card-header bg-transparent">' +
							'			<h4 class="text-uppercase ls-1 text-primary py-3 mb-0">' + val.packet_name + '</h4>' +
							'		</div>' +
							'		<div class="card-body px-lg-7">' +
							'			<div class="display-2">' + val.packet_price_slug + '</div>' +
							'			<span class=" text-muted">' + val.packet_duration + '</span>' +
							'			<p>' + val.packet_description + '</p>' +
							'			<div class="images">' + images + '</div>' +
							'		</div>' +
							// '		<div class="card-footer">' +
							// '			<button type="button" data-id="' + val.id_packet + '" class="btn btn-icon btn-sm btn-primary btn-booking"><span class="btn-inner--icon"><i class="ni ni-settings-gear-65"></i></span> Booking</button>' +
							// '		</div>' +
							'	</div>' +
							'</div>'
					});

					$('#list-packets').html(html);
					$('.images').slick({
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 4
					});
					console.log(data);
				}
			});
		}


	});
</script>
