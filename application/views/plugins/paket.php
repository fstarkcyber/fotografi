<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
	$(document).ready(function() {
		$('.btn-neutral').show();
		$('.btn-neutral').html('New Packet');
		$('.btn-neutral').attr({
			"data-target": "#modal-add-packet",
			"data-toggle": "modal",
		});

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
							'		<div class="card-footer">' +
							'			<button type="button" data-id="' + val.id_packet + '" class="btn btn-icon btn-sm btn-primary btn-update"><span class="btn-inner--icon"><i class="ni ni-settings-gear-65"></i></span></button>' +
							'			<button type="button" data-id="' + val.id_packet + '" class="btn btn-icon btn-danger btn-sm btn-delete"><span class="btn-inner--icon"><i class="ni ni-fat-delete"></i></span></button>' +
							'		</div>' +
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

		$('#list-packets').on('click', '.btn-update', function() {
			var id = $(this).attr('data-id');
			$('.removeImage').remove();
			$('.image-upload image').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png');

			$.ajax({
				url: base_url + 'Paket/GetPaketById/' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(data) {
					// console.log(data);
					if (data.packet_images != '') {
						const d = new Date();
						let time = d.getTime();

						$.each(data.packet_images, function(i, val) {
							no = i + 1;
							$('#imageUpdate' + no).parent().find('img').attr({
								'src': base_url + 'assets/img/packets/' + val.image_name + '?time=' + time,
								'class': 'preview' + val.id_packet_images
							});
							$('#imageUpdate' + no).parent().append('<a href="#" class="removeImage" data-id="' + val.id_packet_images + '">Remove</a>');
							$('#imageUpdate' + no).prop('disabled', true);
							no++;
						});
					}

					$('#form-update-packet [name="id_packet"]').val(data.id_packet);
					$('#form-update-packet [name="packet_name"]').val(data.packet_name);
					$('#form-update-packet [name="packet_duration"]').val(data.packet_duration);
					$('#form-update-packet [name="packet_price"]').val(data.packet_price);
					$('#form-update-packet [name="membership"]').val(data.membership).trigger('change');
					$('#form-update-packet [name="packet_description"]').html(data.packet_description);

					$('#modal-update-packet').modal('show');
				}
			});
		});

		$('#list-packets').on('click', '.btn-delete', function() {
			var id = $(this).attr('data-id');
			$('#form-delete-packet [name="id_packet"]').val(id);
			$('#modal-delete-packet').modal('show');
		});

		$('.image-upload').on('click', '.removeImage', function() {
			var tag = this;
			var id = $(this).attr('data-id');
			$.ajax({
				type: "POST",
				url: base_url + 'Paket/removeImage',
				data: {
					id: id
				},
				dataType: "JSON",
				success: function(response) {
					if (response.type == 'success') {
						notification(response.type, response.message);
						$('.preview' + id).attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png');
						$(tag).parent().find('input').prop('disabled', false);
						$(tag).remove();
						// console.log(this);
					} else {
						notification(response.type, response.message);
					}
				}
			});
		});

		$('#form-add-packet').submit(function() {
			var data = new FormData(this);
			$.ajax({
				url: base_url + 'Paket/add',
				type: 'POST',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'JSON',
				success: function(response) {
					notification(response.type, response.message);

					$('#modal-add-packet').modal('hide');
					$('#form-add-packet')[0].reset();

					GetPaket();
				}
			});

			return false;
		});

		$('#form-update-packet').submit(function() {
			var data = new FormData(this);
			$.ajax({
				url: base_url + 'Paket/update',
				type: 'POST',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'JSON',
				success: function(response) {
					notification(response.type, response.message);

					$('#modal-update-packet').modal('hide');
					$('#form-update-packet')[0].reset();

					GetPaket();

				}
			});

			return false;
		});

		$('#form-delete-packet').submit(function() {
			var data = new FormData(this);
			$.ajax({
				url: base_url + 'Paket/delete',
				type: 'POST',
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'JSON',
				success: function(response) {
					notification(response.type, response.message);

					$('#modal-delete-packet').modal('hide');
					$('#form-delete-packet')[0].reset();

					GetPaket();
				}
			});

			return false;
		});
	});
</script>