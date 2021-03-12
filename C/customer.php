<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" user-scalable=no>
	<title>Yum n'Glam Hut</title>
	<link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function getName(userID){
			$.ajax({
				method: "POST",
				url: "php/custGetName.php",
				data: {
					userID : userID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);
					document.getElementById('btnUser').textContent = result[0]['username'];
				}
			})
		};
		function getProd(prodID){
			
			var id = prodID.querySelector('span').textContent;
			var user = document.getElementById('user').textContent;
			window.location.href = "indiProds.php?p="+id+"&u="+user;
		};
		function getCartBadge(userID){
			$.ajax({
				method: "POST",
				url: "php/custGetCart.php",
				data: {
					userID : userID
				},
				success: function(data){
					if (data === 'no badge') {
						document.getElementById('badge').textContent = "0";
					}else{
						var result = jQuery.parseJSON(data);
						document.getElementById('badge').textContent = result[0]['cartNum'];
					}
				}
			})
		};
		function getData(){
			$.ajax({
				method: "GET",
				url: "../O/php/foodInvOne.php"
			}).done(function(data){
				var result = jQuery.parseJSON(data);
				for (var i = 0; i <= result.length; i++) {
					document.getElementById('prodPic'+i).src = result[i]['prodPicture'];
					document.getElementById('prodInfo'+i).innerHTML = result[i]['prodName']+" "+result[i]['prodPrice'];
					document.getElementById('prodPic'+i).src = result[i]['prodPicture'];
					document.getElementById('idProd'+i).innerHTML = result[i]['prodID'];

				}
			})
		};
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			getName(user);getCartBadge(user);
			getData();
			document.getElementById('user').innerHTML=user;
			$('#btnDessert').click(function(){
				window.location.href = "foodDessert.php?u="+user;
			});
			$('#divCart').click(function(){
				window.location.href = 'cart.php?u=' + user;
			});
			document.getElementById('Home').href = "customer.php?u="+user;
			document.getElementById('btnDessert').href = "foodDessert.php?u="+user;
			//document.getElementById('btnFrozenFood').href = "foodFrozenFood.php?u="+user;
			//document.getElementById('btnShorts').href = "clothesShort.php?u="+user;
			//document.getElementById('btnPJs').href = "clothesPJs.php?u="+user;
			//document.getElementById('btnMatte').href = "cosmeticsMatte.php?u="+user;
			//document.getElementById('btnGel').href = "cosmeticsGel.php?u="+user;
			//document.getElementById('btnCreamy').href = "cosmeticsCreamy.php?u="+user;
			//document.getElementById('btnRejuv').href = "cosmeticsRejuv.php?u="+user;
			document.getElementById('mypurchasedorder').href = "mypurchased.php?u="+user;
			document.getElementById('btnLogout').href = "../index.php";
		})
	</script>
	<style type="text/css">
		@media(min-width: 480px){
			#divCart{
				margin-left: 10px;
			}
			#searchbar{
				width: 480px;
				height: 50px;
			}
		}
		@media(min-width: 1280px){
			#divCart{
				margin-left: 70px;
			}
			#searchbar{
				width: 600px;
				height: 50px;
			}
		}
		body{
			background-color: #fef8fa;
		}
		.navbar{
			background-color: #000C20;
		}
		#toggleIcon{
			color: #fff;
		}
		#search{
			width: 300px;
			min-width: 100px;
			height: 50px;
			background-color: #E9AA5C;
		}
		.notification {
			color: #000;
			text-decoration: none;
			padding: 2px 7px;
			position: relative;
			display: inline-block;
			border-radius: 50px;
		}

		.notification:hover {
			background-color: #dda8b8;
		}

		.notification #badge {
			position: absolute;
			top: -3px;
			right: -10px;
			padding: 1px 10px;
			border-radius: 40%;
			background-color: #dda8b8;
			color: #fff;
		}
		.jumbotron{
			height: 480px;
			background-color: #FFFAE0;
			box-shadow: 1px 3px 10px #D9D4B6;
		}
		.navbar-nav a{
			font-size: 15px;
		}
		a{
			text-decoration: none;
			color: white;
		}
		a:hover{
			color: #F6BBCD;
		}
		h1{
			text-align: center;
		}
		#lblOne{
			border-bottom: 1px solid;
		}
		.products{
			border-right: 1px solid #FFFAE0;
			height: 300px;
		}
		.products img{
			box-shadow: 0px 15px 10px -15px #111;
		}
		.hide{
			display: none;
		}
	</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<span id="toggleIcon"><img src="../Images/menu.png" width="20" height="20"></span>
				</button>
				<a href="#" class="navbar-brand">Yum n' Glam Hut</a>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="#" class="btn btnMenu active" id="Home" role="button" aria-pressed="true" >Home</a>
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true" id="btnFood">Food</a>
							<div class="dropdown-menu">
								<button class="dropdown-item btn" id="btnDessert">Dessert</button>
								<a class="dropdown-item" id="btnFrozenFood" href="#">Frozen Food</a>
							</div>
						</div>
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true">Clothes</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" id="btnShorts" href="#">Shorts</a>
								<a class="dropdown-item" id="btnPJs" href="#">PJs</a>
							</div>
						</div>
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true">Cosmetics</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" id="btnMatte" href="#">Matte Stain</a>
								<a class="dropdown-item" id="btnGel" href="#">Gel Stain</a>
								<a class="dropdown-item" id="btnCreamy" href="#">Creamy Stain</a>
								<a class="dropdown-item" id="btnRejuv" href="#">Rejuvenating Set</a>
							</div>
						</div>
					</div>
					<div class="nav navbar-nav ml-auto">
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" id="btnUser" role="button" aria-pressed="true"></a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Profile</a>
								<a class="dropdown-item" href="#" id="mypurchasedorder">My Purchased</a>
								<a class="dropdown-item" id="btnLogout" href="#">Logout</a>
							</div>
						</div>
		            </div>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-2 mr-5 ml-3 mt-1">
						<a href="#" class="navbar-brand">Yum n' Glam Hut</a><span id="user" class="hide"></span>
					</div>
					<form >
					<input type="text" class="form-control col-xs-8 col-sm-12 col-lg-12 mt-1" id="searchbar" name="searchbar">
					</form>
					<button class="btn btn-lg ml-1 mr-4 mt-1 col-1" id="search">Search</button>
					<div class="col-2 mb-4 mt-1" id="divCart">
						<a class="notification">
						<img src="../Images/addCart.png" height="45" width="45">
						<span id="badge">0</span>
						</a>
					</div>	
				</div>
			</div>    
		</nav>
		<div class="jumbotron jumbotron-fluid p-0">
			<img class="img-responsive" id="frontImg" src="Images/example.png" width="100%" height="100%">
		</div>
		<div id="demo" class="carousel slide" data-ride="carousel">
			<h1><span id="lblOne">Featured Products</span></h1>
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
			</ul>
			<div class="carousel-inner ml-4">
				<div class="carousel-item active">
					<div class="row mt-5 mb-5">
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic0"  width="80%" height="80%"><span class='hide' id='idProd0'></span>
							<p id="prodInfo0"></p>
						</div>
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic1"  width="80%" height="80%"><span class='hide' id='idProd1'></span>
							<p id="prodInfo1"></p>
						</div>
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic2"  width="80%" height="80%"><span class='hide' id='idProd2'></span>
							<p id="prodInfo2"></p>
						</div>
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic3"  width="80%" height="80%"><span class='hide' id='idProd3'></span>
							<p id="prodInfo3"></p>
						</div>
					</div>
				</div>
				<div class="carousel-item">
					<div class="row mt-5 mb-5">
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic4"  width="80%" height="80%"><span class='hide' id='idProd4'></span>
							<p id="prodInfo4"></p>
						</div>
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic5"  width="80%" height="80%"><span class='hide' id='idProd5'></span>
							<p id="prodInfo5"></p>
						</div>
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic6"  width="80%" height="80%"><span class='hide' id='idProd6'></span>
							<p id="prodInfo6"></p>
						</div>
						<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
							<img id="prodPic7"  width="80%" height="80%"><span class='hide' id='idProd7'></span>
							<p id="prodInfo7"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<h1><span id="lblOne">Top Products</span></h1>
			<div class="row mt-5 mb-5 ml-4">
				<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
					<img id="prodPic8" width="80%" height="80%"><span class='hide' id='idProd8'></span>
					<p id="prodInfo8"></p>
				</div>
				<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
					<img id="prodPic9" width="80%" height="80%"><span class='hide' id='idProd9'></span>
					<p id="prodInfo9"></p>
				</div>
				<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
					<img id="prodPic10" width="80%" height="80%"><span class='hide' id='idProd10'></span>
					<p id="prodInfo10"></p>
				</div>
				<div class="products col-md-6 col-lg-4 col-xl-3" onclick="getProd(this)">
					<img id="prodPic11" width="80%" height="80%"><span class='hide' id='idProd11'></span>
					<p id="prodInfo11"></p>
				</div>
			</div>
		</div>
		<hr>
		<footer>
			<div class="row">
				<div class="col-md-6">
					<p>Copyright © 2019 Tutorial Republic</p>
				</div>
				<div class="col-md-6 text-md-right">
					<a href="#" class="text-dark">Terms of Use</a> 
					<span class="text-muted mx-2">|</span> 
					<a href="#" class="text-dark">Privacy Policy</a>
				</div>
			</div>
		</footer>
	</body>
</html>