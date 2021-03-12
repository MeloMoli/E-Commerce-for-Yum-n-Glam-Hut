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
		function getOrderNum(userID){
			
			$.ajax({
				method: "POST",
				url: "php/getMyOrder.php",
				data: {
					userID : userID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);
					for (var i = 0; i<=result.length; i++) {
						var string = " <tr><td>"+result[i]['orderID']+"</td><td><button class='btn' onclick='getProdList(this)' data-toggle='modal' data-target='#listProdModal'>List Ordered Products</button></td><td>"+result[i]['amt']+"</td><td>"+result[i]['status']+"</td><td>"+result[i]['statusPayment']+"</td><td><button class='btn btn-danger' onclick='paid("+result[0]['orderID']+")'>Already Paid</button></td></tr>";
						$('#mypurchased').append(string);
					}
					
					
				}
			})
		}
		function paid(orderID){
			var userID = document.getElementById('user').textContent;
			window.location.href = "paymentReference.php?u="+userID+"&o="+orderID;
		}
		function getProdList(prodCell){
			var userID = document.getElementById('user').textContent;
			var prodTable = document.getElementById('mypurchased');
			var index = prodCell.parentNode.parentNode.rowIndex;
			var orderID = prodTable.rows[index].cells[0].textContent;

			$.ajax({
				method: "POST",
				url: "php/getOrderedList.php",
				data:{
					orderID : orderID,
					userID : userID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);
					var string = "<tr><th></th><th>Name</th><th>Price</th><th>Qty</th></th>";
					for (var i = 0; i <=result.length; i++) {
						 string += "<tr><td><img src='"+result[i]['prodPicture']+"' width='60' height='70'></td><td>"+result[i]['prodName']+"</td><td>"+result[i]['prodPrice']+"</td><td>"+result[i]['qty']+"</td></tr>";

						$('#ProdList').html(string);
					}
				}

			})

		}
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			
			document.getElementById('user').textContent = user;
			getName(user);
			getOrderNum(user);
			document.getElementById('Home').href = "customer.php?u="+user;
			
			
					

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
		#qty{
			width: 50px; 
			text-align: center;
		}
		.stocks{
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
				<a href="#" class="navbar-brand">Yum n' Glam Hut</a><span id="user" class="hide"></span>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="#" class="btn btnMenu active" role="button" aria-pressed="true" id="Home">Home</a>
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
	</div>
	<div class="container-fluid">
		<div class="container mt-2 p-5" id="cart">
			<table class="table table-borderless table-responsive-sm table-responsive-md table-responsive-lg" id="mypurchased">
				<tr>
					<th>Order Number</th>
					<th>List of Products that you ordered</th>
					<th>Order Total</th>
					<th>Status of Shipment</th>
					<th>Status of payment</th>
					<th>Click if paid</th>
				</tr>
			</table>
			<div class="modal" id="listProdModal">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Ordered Products</h4>
							<button type="button" class="close" data-dismiss="modal">×</button>
						</div>
						<div class="modal-body" id="listProd">
							<table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-lg" id="ProdList">
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
</body>
</html>
