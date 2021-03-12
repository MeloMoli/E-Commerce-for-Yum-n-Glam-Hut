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
		function getOrderNum(userID,orderID){
			
			$.ajax({
				method: "POST",
				url: "php/getOrder.php",
				data: {
					userID : userID,
					orderID : orderID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);
					var dateRange = result[0]['deliveryDateRange'];
					var d = dateRange.toString()
					var dateBefore = dateRange.slice(0, -11);
					var pm = result[0]['paymentMethod'];
					if (pm == 'GCash') {
						var string = "<div class='row'><h4>Order # "+result[0]['orderID']+"</h4></div><div class='row'><p>Pay amounting P"+result[0]['amt']+" before "+dateBefore+". If you're already paid, kindly click 'Already Paid' button to enter the reference number. Failure to submit the reference number will delete the order.</p></div><div class='row'><label>Have question or concern? click <button class='btn' id='helpcentre'>Help Centre</button></label></div><div class='row'><button class='btn btn-danger' onclick='paid("+result[0]['orderID']+")'>Already Paid</button></div>";
						$('#cart').html(string);
					}else if (pm === 'BPI') {
						var string = "<div class='row'><h4>Order # "+result[0]['orderID']+"</h4></div><div class='row'><p>Pay amounting P"+result[0]['amt']+" before "+dateBefore+". If you're already paid, kindly click 'Already Paid' button below to upload the invoice transaction of your bank transfer. Failure to submit the invoice reference will delete the order.</p></div><div class='row'><label>Have question or concern? click <button class='btn' id='helpcentre'>Help Centre</button></label</div><div class='row'><button class='btn btn-danger' onclick='paid("+result[0]['orderID']+")'>Already Paid</button></div>";
						$('#cart').html(string);
					}else{
						var string = "<div class='row'><h4>Order # "+result[0]['orderID']+"</h4></div><div class='row'><p> The product will be delivered within "+result[0]['deliveryDateRange']+".</p></div><div class='row'><label>Have question or concern? click <button class='btn' id='helpcentre'>Help Centre</button></label></div>";
						$('#cart').html(string);
					}
					
					
				}
			})
		}
		
		function paid(orderID){
			var userID = document.getElementById('user').textContent;
			window.location.href = "paymentReference.php?u="+userID+"&o="+orderID;
		}
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			const order = urlParams.get('o');
			document.getElementById('user').textContent = user;
			getName(user);
			getOrderNum(user, order);
			document.getElementById('Home').href = "customer.php?u="+user;
			document.getElementById('Purchased').href = "mypurchased.php?u="+user;
			
					

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
					</div>
					<div class="nav navbar-nav ml-auto">
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" id="btnUser" data-toggle="dropdown" role="button" aria-pressed="true"></a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">My Account</a>
								<a class="dropdown-item" href="#" id="Purchased">My Purchased</a>
								<a class="dropdown-item" id="btnLogout" href="#">Logout</a>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</nav>
	</div>
	<div class="container-fluid">
		<div class="container mt-2 p-5" id="cart">

		</div>			
	</div>
</body>
</html>
