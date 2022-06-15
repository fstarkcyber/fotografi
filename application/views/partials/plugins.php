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

<!-- Argon JS -->
<script src="<?= base_url() ?>assets/js/argon.js?v=1.1.0"></script>
<!-- Demo JS - remove this in your project -->
<script src="<?= base_url() ?>assets/js/demo.min.js"></script>

<?php
if (!empty($plugin)) {
	$this->load->view($plugin);
}
?>

<script>
	$('.btn-neutral').hide();

	function notification(type, message) {
		swal({
			title: type.toUpperCase(),
			text: message,
			type: type,
			showConfirmButton: false,
			timer: 2000,
		});
	}
</script>
