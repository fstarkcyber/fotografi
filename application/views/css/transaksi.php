  <!-- Page plugins -->
  <link rel="stylesheet" href="<?= site_url() ?>assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  <style>
  	.images {
  		width: 100%;
  		margin: 0px auto;
  		margin-top: 50px;
  	}

  	.slick-slide {
  		margin: 1px;
  	}

  	.slick-slide img {
  		width: 100%;
  		border: 0px solid #fff;
  	}

  	.image-upload>input {
  		display: none;
  	}

  	.image-upload>label {
  		cursor: pointer;
  		border: 1px dashed gray;
  	}
  </style>
  <script>
  	function previewImage(input) {
  		// console.log(input);
  		var id = $(input).attr('id');

  		var img = $('#' + id).parent().find('img');
  		// console.log(id);
  		var file = $('#' + id).get(0).files[0];

  		if (file) {
  			var reader = new FileReader();

  			reader.onload = function() {
  				$(img).attr("src", reader.result);
  			}

  			reader.readAsDataURL(file);
  		}
  	}
  </script>