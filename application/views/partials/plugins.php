<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="<?= base_url() ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="<?= base_url() ?>assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

<?php
if (!empty($plugin)) {
	$this->load->view($plugin);
}
?>

<!-- Argon JS -->
<script src="<?= base_url() ?>assets/js/argon.js?v=1.1.0"></script>
<!-- Demo JS - remove this in your project -->
<script src="<?= base_url() ?>assets/js/demo.min.js"></script>

<script>
	$('.btn-neutral').hide();
	GetTransaction();

	function notification(type, message) {
		swal({
			title: type.toUpperCase(),
			text: message,
			type: type,
			showConfirmButton: false,
			timer: 2000,
		});
	}

	function GetTransaction() {
		$.ajax({
			type: "GET",
			url: base_url + 'Transaksi/GetTransactionFilter',
			dataType: "JSON",
			success: function(response) {
				var html = '';
				var images = '';
				$.each(response, function(i, v) {

					if (v.images == null) {
						images = 'default.png';
					} else {
						images = v.images;
					}

					html += '<a href="#!" class="list-group-item list-group-item-action">' +
						'		<div class="row align-items-center">' +
						'			<div class="col-auto">' +
						'				<img alt="Image placeholder" src="' + base_url + 'assets/img/users/' + images + '" class="avatar rounded-circle">' +
						'			</div>' +
						'			<div class="col ml--2">' +
						'				<div class="d-flex justify-content-between align-items-center">' +
						'					<div>' +
						'						<h4 class="mb-0 text-sm">' + v.name + '</h4>' +
						'					</div>' +
						'					<div class="text-right text-muted">' +
						'						<small>' + v.created_at + '</small>' +
						'					</div>' +
						'				</div>' +
						'				<p class="text-sm mb-0">' + v.packet_name + ' | ' + v.packet_price + ' | ' + v.status + '</p>' +
						'			</div>' +
						'		</div>' +
						'	</a>';
				});

				$('#total-trx').html(response.length);
				$('#notif-trx').html(html);
			}
		});
	}
</script>