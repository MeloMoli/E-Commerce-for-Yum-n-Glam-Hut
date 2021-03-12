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
		function getProd(prodID){
			$.ajax({
				method: "POST",
				url: "php/getProdIndi.php",
				data: {
					prodID : prodID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);
					var stat = result[0]['remarks'];
					if (stat === 'Marked') {
						document.getElementById('foodTitle').innerHTML = result[0]['prodName'];
						document.getElementById('foodPrice').innerHTML = result[0]['prodPrice'];
						document.getElementById('foodPic').src = result[0]['prodPicture'];
						document.getElementById('prodID').innerHTML = result[0]['prodID'];
						document.getElementById('btnAddCart').disabled.true;
						document.getElementById('stocks').innerHTML = "x";
					}else{
						document.getElementById('foodTitle').innerHTML = result[0]['prodName'];
						document.getElementById('foodPrice').innerHTML = result[0]['prodPrice'];
						document.getElementById('foodPic').src = result[0]['prodPicture'];
						document.getElementById('prodID').innerHTML = result[0]['prodID'];
						document.getElementById('stocks').innerHTML = result[0]['totalStocks'];
					}
				}
			})
		};
		function addQty(){
			var qty = document.getElementById('qty').value;
			var s =parseInt(document.getElementById('stocks').textContent);
			var q = parseInt(qty);
			if (q==s) {
				document.getElementById('btnAdd').disabled = true;
			}else if (q<=s) {
				document.getElementById('btnAdd').disabled = false;
				document.getElementById('btnMinus').disabled = false;
				q=q+1;
			}
			
			document.getElementById('qty').value = q;
		};
		function minusQty(){
			var qty = document.getElementById('qty').value;
			
			var q = parseInt(qty);
			if (q <= 1) {
				document.getElementById('btnMinus').disabled = true;
				
			}else{
				document.getElementById('btnAdd').disabled = false;
				q=q-1;
			}
			
			document.getElementById('qty').value = q;
		};
		function addCart(){
			var prodID = document.getElementById('prodID').textContent;
			var qty = document.getElementById('qty').value;
			var userID = document.getElementById('user').textContent;
			var stocks = document.getElementById('stocks').textContent;
			

			if (stocks === 'x') {
				alert('This product is not for sale.');
			}else if (stocks <=0) {
				alert('Out of Stocks');
			}else{
				$.ajax({
					method: "POST",
					url: "php/custAddUptCart.php",
					data: {
						userID : userID,
						prodID : prodID,
						qty : qty
					},
					success: function(data){
						if (data === 'updated') {
							alert('Save product changes.');
							window.location.reload();
						}else if (data === 'added') {
							alert('Product has been added to your cart list. To see the list, click the Cart button on the upper right corner.');
							window.location.reload();
						}else{
							alert(data);
						}
					}
				})
			}
			
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
			const prodId = urlParams.get('p');
			document.getElementById('user').textContent = user;
			getName(user);
			getProd(prodId);
			getCartBadge(user);
			$('.notification').click(function(){
				window.location.href = "cart.php?u="+user;
			});
			$('#btnDessert').click(function(){
				window.location.href = "foodDessert.php?u="+user;
			})
			
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
			a{
				text-decoration: none;
				color: white;
			}
			a:hover{
				color: #F6BBCD;
			}
			.products{
				background-color: #fff;
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
	<div class="topnav">
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<span id="toggleIcon"><img src="Images/menu.png" width="20" height="20"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="#" class="btn btnMenu active" role="button" aria-pressed="true">Home</a>
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true">Food</a>
							<div class="dropdown-menu">
								<button class="dropdown-item" id="btnDessert">Dessert</button>
								
							</div>
						</div>
						<div class="dropdown btn-Menu">
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
						<a href="#" class="btn btnMenu" role="button" aria-pressed="true">About</a>
					</div>
					<div class="nav navbar-nav ml-auto">
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" id="btnUser" data-toggle="dropdown" role="button" aria-pressed="true"></a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">My Account</a>
								<a class="dropdown-item" href="#">My Purchased</a>
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
						<a  class="notification">
						<img src="../Images/addCart.png" height="45" width="45">
						<span id="badge">0</span>
						</a>
					</div>	
				</div>
			</div>    
		</nav>
	</div>
	<div class="container-fluid p-5">
		<div class="container" id="prodIndi">
			<div class="row mt-5 justify-content-center">
				<div class="col-md-6 col-lg-4 col-xl-3">
					<img id="foodPic" width="100%" height="350">
				</div>
				<div class="col-1">
					
				</div>
				<div class="col-md-6 col-lg-4 col-xl-3">
					<div class="row">
						<h4 id="foodTitle"></h4><span id="prodID" class="hide"></span>
					</div>
					<div class="row">
						<label id="foodPrice"></label>
					</div>
					<div class="row">
						<p id="scks"><span id="stocks"></span> Stocks </p>
					</div>
					<div class="row">
						<div class="btn-group">
							<button class="btn" id="btnMinus" onclick="minusQty()" disabled>-</button>
							<input type="text" name="qty" id="qty" value="1" style="width: 50px; text-align: center;">
							<button class="btn" id="btnAdd" onclick="addQty()">+</button>
						</div>
					</div>
					<div class="row mt-5">
						<div class="btn-group">
							<button class="btn btn-danger" id="btnAddCart" onclick="addCart()"><img src="../Images/addBasket.png" width="30" height="30"></button>
							<button class="btn btn-warning" id="btnBuyNow">Buy Now</button>
							<button class="btn btn-dark" id="btnBack">Back</button>
						</div>
					</div>
				</div>
				<br>
				
				
			</div>						
		</div>
	</div>
</body>
</html>
