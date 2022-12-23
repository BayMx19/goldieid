<?php
error_reporting(0);
session_start();
include 'dbconnect.php';

if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
	
};
	
	$uid = $_SESSION['id'];
	$caricart = mysqli_query($conn,"select * from cart where userid='$uid' and status='Cart'");
	$fetc = mysqli_fetch_array($caricart);
	$orderidd = $fetc['orderid'];
	$itungtrans = mysqli_query($conn,"select count(detailid) as jumlahtrans from detailorder where orderid='$orderidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
if(isset($_POST["update"])){
	$kode = $_POST['idproduknya'];
	$jumlah = $_POST['jumlah'];
	$q1 = mysqli_query($conn, "update detailorder set qty='$jumlah' where idproduk='$kode' and orderid='$orderidd'");
	if($q1){
		echo "Berhasil Update Cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	} else {
		echo "Gagal update cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
	}
} else if(isset($_POST["hapus"])){
	$kode = $_POST['idproduknya'];
	$q2 = mysqli_query($conn, "delete from detailorder where idproduk='$kode' and orderid='$orderidd'");
	if($q2){
		echo "Berhasil Hapus";
	} else {
		echo "Gagal Hapus";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Keranjang | Goldie.id</title>
<link rel="icon" href=".\logo\Logo Kotak 2.png">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Goldie" />
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
	
	<!-- navigation -->
	
		
<!-- //navigation -->

<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h2>Dalam keranjangmu ada : <span><?php echo $itungtrans3 ?> barang</span></h2>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>No.</th>	
							<th>Produk</th>
							<th>Nama Produk</th>
							<th>Jumlah</th>
							
						
							<th>Harga Satuan</th>
							<th>Hapus</th>
						</tr>
					</thead>
					
					<?php 
						$brg=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
						$no=1;
						while($b=mysqli_fetch_array($brg)){

					?>
					<tr class="rem1"><form method="post">
						<td class="invert"><?php echo $no++ ?></td>
						<td class="invert"><a href="product.php?idproduk=<?php echo $b['idproduk'] ?>"><img src="<?php echo $b['gambar'] ?>" width="100px" height="100px" /></a></td>
						<td class="invert"><?php echo $b['namaproduk'] ?></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                     
									<input type="number" name="jumlah" class="form-control" height="100px" value="<?php echo $b['qty'] ?>" \>
								</div>
							</div>
						</td>
				
						<td class="invert">Rp<?php echo number_format($b['hargaafter']) ?></td>
						<td class="invert">
							<div class="rem">
							
								<input type="submit" name="update" class="form-control" value="Update" \>
								<input type="hidden" name="idproduknya" value="<?php echo $b['idproduk'] ?>" \>
								<input type="submit" name="hapus" class="form-control" value="Hapus" \>
							</form>
							</div>
							<script>$(document).ready(function(c) {
								$('.close1').on('click', function(c){
									$('.rem1').fadeOut('slow', function(c){
										$('.rem1').remove();
									});
									});	  
								});
						   </script>
						</td>
					</tr>
					<?php
						}
					?>
					
								<!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
				</table>
			</div>
			<div class="checkout-left">	
				<div class="checkout-left-basket">
					<h4>Total Harga</h4>
					<ul>
						<?php 
						$brg=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
						$no=1;
						$subtotal = 10000;
						while($b=mysqli_fetch_array($brg)){
						$hrg = $b['hargaafter'];
						$qtyy = $b['qty'];
						$totalharga = $hrg * $qtyy;
						$subtotal += $totalharga
						?>
						<li><?php echo $b['namaproduk']?><i> - </i> <span>Rp<?php echo number_format($totalharga) ?> </span></li>
						<?php
						}
						?>
						<li>Total (inc. 10k Ongkir)<i> - </i> <span>Rp<?php echo number_format($subtotal) ?></span></li>
					</ul>
				</div>
				<div class="checkout-right-basket">
					<a href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
					<a href="checkout.php"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>Checkout</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //checkout -->
<!-- //footer -->
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
<!-- //main slider-banner --> 
</body>
</html>