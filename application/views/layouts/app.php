<!DOCTYPE html>
<html>

<?php
$this->load->view('partials/head');
?>

<body>

	<?php
	$this->load->view('partials/sidenav');
	?>

	<!-- Main content -->
	<div class="main-content" id="panel">

		<?php
		$this->load->view('partials/navbar');
		$this->load->view('partials/header');
		?>

		<div class="container-fluid mt--6">
			<?php
			if (!empty($content)) {
				$this->load->view($content);
			} else {
				$this->load->view('partials/main');
			}

			$this->load->view('partials/footer');

			?>
		</div>

	</div>

	<?php
	$this->load->view('partials/plugins');
	?>
</body>
<html>
