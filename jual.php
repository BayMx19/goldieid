<?php 
	session_start();
			include 'dbconnect.php';
	// if(!isset($_SESSION['log'])){
	
	// } else {
	// 	header('location:index.php');
	// };
	
	
	if(isset($_POST["addproduct"])) {
		$namaproduk=$_POST['namaproduk'];
		$idkategori=$_POST['idkategori'];
		$deskripsi=$_POST['deskripsi'];
		$rate=$_POST['rate'];
		$hargabefore=$_POST['hargabefore'];
		$hargaafter=$_POST['hargaafter'];
		
		$nama_file = $_FILES['uploadgambar']['name'];
		
		$target_dir = "produk/";
		$random = crypt($nama_file, time());
		$ext = pathinfo($nama_file,PATHINFO_EXTENSION);
		$target_file = $target_dir . $random . "." . $ext;
		$uploadOk = 1;
		$imageFileType = strtolower($ext);

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["uploadgambar"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["uploadgambar"]["size"] > 5000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		if (move_uploaded_file($_FILES["uploadgambar"]["tmp_name"], $target_file)) {
			$query = "insert into produk (idkategori, namaproduk, gambar, deskripsi, rate, hargabefore, hargaafter)
			  values('$idkategori','$namaproduk','$target_file','$deskripsi','$rate','$hargabefore','$hargaafter')";
			  $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
			  
			  if($sql){ 
				
				echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
					
			  }else{
				// Jika Gagal, Lakukan :
				echo "Sorry, there's a problem while submitting.";
				echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
			  }
			// echo "The file ". htmlspecialchars( basename( $_FILES["uploadgambar"]["name"])). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
		}
		
		// $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		// $random = crypt($nama_file, time());
		// $ukuran_file = $_FILES['uploadgambar']['size'];
		// $tipe_file = $_FILES['uploadgambar']['type'];
		// $tmp_file = $_FILES['uploadgambar']['tmp_name'];
		// $path = "./produk/".$random.'.'.$ext;
		// $pathdb = "produk/".$random.'.'.$ext;
		// var_dump($tmp_file);


		// if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
		//   if($ukuran_file <= 5000000){ 
		// 	if(!move_uploaded_file($tmp_file, $path)){ 
			
			//   $query = "insert into produk (idkategori, namaproduk, gambar, deskripsi, rate, hargabefore, hargaafter)
			//   values('$idkategori','$namaproduk','$pathdb','$deskripsi','$rate','$hargabefore','$hargaafter')";
			//   $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
			  
			//   if($sql){ 
				
			// 	echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
					
			//   }else{
			// 	// Jika Gagal, Lakukan :
			// 	echo "Sorry, there's a problem while submitting.";
			// 	echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
			//   }
		// 	}else{
		// 	  // Jika gambar gagal diupload, Lakukan :
		// 	  echo "Sorry, there's a problem while uploading the file.";
		// 	  echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
		// 	}
		//   }else{
		// 	// Jika ukuran file lebih dari 1MB, lakukan :
		// 	echo "Sorry, the file size is not allowed to more than 1mb";
		// 	echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
		//   }
		// }else{
		//   // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
		//   echo "Sorry, the image format should be JPG/PNG.";
		//   echo "<br><meta http-equiv='refresh' content='5; URL=jual.php'> You will be redirected to the form in 5 seconds";
		// }
	
	};
	?>

<!DOCTYPE html>
<html>
<head>
<title>Jual Barangmu | Goldie.id</title>
<link rel="icon" href=".\logo\Logo Kotak 2.png">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->

<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>

<style>

	</style>
<!-- start-smoth-scrolling -->
</head>
	
<body>



<!-- header -->	
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="logo_products" style="overflow:hidden; background : #ffffff; padding:0px;  !important " >
		<div class="container-fluids">
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<h1><a href="index.php"><img src=".\logo\Logo Panjang 2.png" alt="logo.png" height="75" width="230px" /></a></h1></ul>
			</div>
		<div class="w3l_search" style="margin: 20px 0px 20px 0px;  !important">
			<form action="search.php" method="post">
				<input type="search" name="Search" placeholder="Cari produk..">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
			
				<div class="clearfix"></div>
			</form> 
		</div>
	</div>
	
	
						
	<div class="navbar-header nav_2">
		<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
</button>
							</div> 
	<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
	<ul class="nav navbar-nav" style="color:black; margin:20px; font-size:16px; !important">
		<li class="active"><a href="index.php" class="act">Home</a></li>	
		<li><a href="cart.php">Keranjang Saya</a></li>	
		<li><a href="jual.php"><u style="margin-top:5px;">Jual Barang</u></a></li>

									<li><?php
				if(!isset($_SESSION['log'])){
					echo '
					<li><a href="login.php">Login</a></li>
					';
				} else {
					
					if($_SESSION['role']=='Member'){
					echo '
					
					<li><a href="logout.php">Keluar?</a></li>
					';
					} else {
					echo '
					
					<li><a href="admin">Admin Panel</a></li>
					<li><a href="logout.php">Keluar?</a></li>
					';
					};
					
				}
				?></li>		

								</ul>
			
			<div class="clearfix"> </div>
		</div>
		<div class="navigation-agileits">
		
							</div>
	</nav>				

	<div class="login">
				<div class="container">
						<div class="login-form-grids">
							<h2>Jual Barang</h2>
					
						
						
						<form action="jual.php" method="post" enctype="multipart/form-data" >
							<input type="text" name="namaproduk" placeholder="Nama Produk" style="margin-top:20px;"required autofocus>
									<select name="idkategori" style="margin-top:10px; border-radius:10px;" class="form-control" style="border-radius:10px;">
									<option selected>Pilih Kategori</option>
									<?php
									$det=mysqli_query($conn,"select * from kategori order by namakategori ASC")or die(mysqli_error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
										<?php
								}
								?>		
									</select>
									
								
								<input type="text" name="deskripsi" style="margin-top:10px; padding-bottom: 100px; " placeholder="Deskripsi Produk" required autofocus>
								<input type="text" name="rate" placeholder="Rating Produk (1 - 5)" style="margin-top:10px;" required autofocus>
								<input type="text" name="hargabefore" placeholder="Harga Sebelum Diskon" style="margin-top:10px;" required autofocus>
								<input type="text" name="hargaafter" placeholder="Harga Setelah Diskon" style="margin-top:10px;" required autofocus>
								<label style="font-size:smaller; font-weight:lighter; color:#999; margin-top:10px;" !important>&nbsp;&nbsp;&nbsp;Gambar Produk</label>
									<input name="uploadgambar" type="file" class="form-control" style="padding-right:130px; border-radius:10px;">
								


							<div class="modal-footer">
								<a href="index.php"><button type="button" class="btn btn-default">Batal</button></a>
								<input name="addproduct" type="submit" class="btn btn-primary" value="Jual Produk">
							</div>
						</form>
					</div>
				</div>
			</div>

	</div>
			<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-4 w3_footer_grid">
					<h3>Hubungi Kami</h3>
					
					<ul class="address">
					<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="https://goo.gl/maps/na5jZRBB95UmS3h6A">Surabaya</a></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:goldie.id22@gmail.com">Email Kami</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i><a href="wa.me/+6281249296449">(+62) 81249296449</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Tentang Kami</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.php">About Us</a></li>
					</ul>
				</div>
                <div class="about-right" style="float:right;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.4738071077!2d112.6704068147751!3d-7.300543794730916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb7a806b1ce1%3A0x571f4546e898d79a!2sUniversitas%20Negeri%20Surabaya!5e0!3m2!1sid!2sid!4v1658762395753!5m2!1sid!2sid" width="400" height="300" style="border:0; float:right;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="footer-copy">
			
			<div class="container">
			<p>© 2022 <a href="index.php">Goldie.id</a>, All rights reserved</p>
			</div>
		</div>
		
        
	</div>	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 4000,
				easingType: 'linear' 
				};
			
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
	<script>
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>

	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
</body>
</html>