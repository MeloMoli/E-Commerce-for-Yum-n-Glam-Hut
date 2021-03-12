<!DOCTYPE html>
<html>
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
		function getDataOne(){
			$.ajax({
				method: "GET",
				url: "php/foodDessert.php"
			}).done(function(data){
				var result = jQuery.parseJSON(data);
					for (var i = 0; i <= result.length; i=i+3) {
						 var stringOne = "<div class='products row p-5 mt-2 mb-4' onclick='getProd(this)'><span class='hide' id='idProd'>"+result[i]['prodID']+"</span><span class='hide' id='totalStocks'>"+result[i]['totalStocks']+"</span><img src='"+result[i]['prodPicture']+"' width='200' height='150'><label>"+result[i]['prodName']+"</label><p>"+result[i]['prodPrice']+"</p></div>";

						$('#foodOne').append(stringOne);

					};
			})
		};
		function getDataTwo(){
			$.ajax({
				method: "GET",
				url: "php/foodDessert.php"
			}).done(function(data){
				var result = jQuery.parseJSON(data);
					for (var i = 1; i <= result.length; i=i+3) {
						  var stringTwo = "<div class='products row p-5 mt-2 mb-4' onclick='getProd(this)'><span class='hide' id='idProd'>"+result[i]['prodID']+"</span><span class='hide' id='totalStocks'>"+result[i]['totalStocks']+"</span><img src='"+result[i]['prodPicture']+"' width='200' height='150'><label>"+result[i]['prodName']+"</label><p>"+result[i]['prodPrice']+"</div>";
						$('#foodTwo').append(stringTwo);
					};
			})
		};
		function getDataThree(){
			$.ajax({
				method: "GET",
				url: "php/foodDessert.php"
			}).done(function(data){
				var result = jQuery.parseJSON(data);
					for (var i = 2; i <= result.length; i=i+3) {
						  var stringThree = "<div class='products row p-5 mt-2 mb-4' onclick='getProd(this)'><span class='hide' id='idProd'>"+result[i]['prodID']+"</span><span class='hide' id='totalStocks'>"+result[i]['totalStocks']+"</span><img src='"+result[i]['prodPicture']+"' width='200' height='150'><label>"+result[i]['prodName']+"</label><p>"+result[i]['prodPrice']+"</div>";


						$('#foodThree').append(stringThree);
					};				
			})
		};
		function getProd(prodID){
			var id = prodID.querySelector('span#idProd').textContent;
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
						
						document.getElementById('badge').textContent = data;
					}
				}
			})
		};
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			getName(user);
			getCartBadge(user);
			getDataOne();
			getDataTwo();
			getDataThree();
			document.getElementById('user').textContent = user;
			$('#divCart').click(function(){
				window.location.href = 'cart.php?u=' + user;
			});
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
			background-color: #fff;
			border: 2px solid #000;
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
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<div class="navbar-nav">
					<a href="#" class="btn btnMenu active" role="button" aria-pressed="true">Home</a>
					<div class="dropdown">
						<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true" id="btnFood">Food</a>
						<div class="dropdown-menu">
							<button class="dropdown-item btn" id="btnDessert" onclick="goDessert()">Dessert</button>
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
							<a class="dropdown-item" id="btnLogout" href="#">Matte Stain</a>
							<a class="dropdown-item" id="btnLogout" href="#">Gel Stain</a>
							<a class="dropdown-item" id="btnLogout" href="#">Creamy Stain</a>
							<a class="dropdown-item" id="btnLogout" href="#">Rejuvenating Set</a>
						</div>
					</div>
				</div>
				<div class="nav navbar-nav ml-auto">
					<div class="dropdown">
						<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" id="btnUser" role="button" aria-pressed="true"></a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Profile</a>
							<a class="dropdown-item" href="#">My Purchased Order</a>
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
					<a href="#" class="navbar-brand">Yum n' Glam Hut</a><span class="hide" id="user"></span>
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
	<div class="container-fluid p-5">
		<a href="Food.php" class="btn btnMenu active" role="button" aria-pressed="true">Food</a><span>></span><a href="foodDessert.php" class="btn btnMenu active" role="button" aria-pressed="true">Dessert</a>
		<div class="container-fluid p-5">
			<div class="row">
				<div class="col-3" id="foodOne">
					
				</div>
				<div class="col-1">
					
				</div>
				<div class="col-3" id="foodTwo">
					
				</div>
				<div class="col-1">
					
				</div>
				<div class="col-3" id="foodThree">
					
				</div>
			</div>						
		</div>
	</div>
</body>
</html>
