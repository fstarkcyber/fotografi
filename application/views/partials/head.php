<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
	<meta name="author" content="Creative Tim">
	<title>Caffeine Studio Tomang</title>
	<!-- Favicon -->
	<link rel="icon" href="<?= base_url() ?>assets/img/brand/logo-caffeine-mini.png" type="image/png">
	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<!-- Icons -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
	<!-- Page plugins -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/sweetalert2/dist/sweetalert2.min.css">
	<!-- Argon CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/argon.css?v=1.1.0" type="text/css">

	<?php
	if (!empty($css)) {
		$this->load->view($css);
	}
	?>

	<script>
		var base_url = '<?= site_url(); ?>';
	</script>
</head>