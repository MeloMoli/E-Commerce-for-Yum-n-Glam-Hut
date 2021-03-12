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
		function getUserName(userID){
			$.ajax({
				method: "POST",
				url: "php/custGetAddr.php",
				data: {
					userID : userID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);

					document.getElementById('userName').textContent = result[0]['firstName'] + " " + result[0]['lastName'] + " " + result[0]['cellphone'];
					document.getElementById('userAddr').textContent = result[0]['houseNum'] + " " + result[0]['streetName'] + ", " + result[0]['baranggay'] + ", " + result[0]['city'] + ", " + result[0]['postalCode'];
				}
			})
		};
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
		function getCartList(userID){
			$.ajax({
				method: "POST",
				url: "php/custChckout.php",
				data: {
					userID: userID
				},
				success: function(data){
					
					var result = jQuery.parseJSON(data);
					var m = 0 ;
					var sum = 0;
					for (var i = 0; i <= result.length; i++) {
						var q = parseInt(result[i]['prodPrice']);
						var w = parseInt(result[i]['qtyProd']);
						m = q * w;
						
						sum = sum + m;
					var string = "<tr><td class='hide'>"+result[i]['prodID']+"</td><td><img width='150' height='100' src='"+result[i]['prodPicture']+"'></td><td>"+result[i]['prodName']+"</td><td>"+result[i]['prodPrice']+"</td><td><span>x</span><label>"+result[i]['qtyProd']+"</label></td><td id='amt'>"+m+"</td></tr>";
						$('#chckoutlist').append(string);
						document.getElementById('subtotal').innerHTML = sum;
					}
				}
			})
		};
		function subTotal(){
			var m = document.getElementById('deliveryCharge').textContent;
			var q = document.getElementById('subtotal').textContent;
			var b = 0;
			var a = parseInt(m);
			var b = parseInt(q);
			var sum = a+b;
			var w = sum.toString();

			document.getElementById('Total').textContent = w;
		};
		function deliveryCharge(userID){
			$.ajax({
				method: "POST",
				url: "php/custDeliveryCharge.php",
				data: {
					userID : userID
				},
				success: function(data){
					if (data === 'clbrzn') {
						document.getElementById('deliveryCharge').innerHTML = 70;
					}else if (data === 'ncr') {
						document.getElementById('deliveryCharge').innerHTML = 40;
					}
					subTotal();	
				}
			})
		};
		function getOrderNum(userID){
			$.ajax({
				method: "POST",
				url: "php/placeOrderThree.php",
				data:{
					userID: userID
				},
				success: function(data){
					
					if (data === 'no orders') {
						document.getElementById('orderNum').innerHTML = 1;
					}else{
						var substring = data.slice(13);
						var m = parseInt(substring);
						var sum = m + 1;
						document.getElementById('orderNum').innerHTML = sum;
					}
				}			
			})
		};
		function addOrderDetails(userID, orderID){
			var prodTable = document.getElementById('chckoutlist');
			var m = document.getElementById('chckoutlist').rows.length;
			for (var i = 1; i <= m; i++) {
				
				var prodID = prodTable.rows[i].cells[0].textContent;
				var qty = prodTable.rows[i].cells[4].querySelector('label').textContent;
				$.ajax({
					method: "POST",
					url: "php/placeOrderTwo.php",
					data: {
						orderID: orderID,
						userID: userID,
						prodID:prodID,
						qty:qty
					}
				})

			};
		};
		function paymentMethod(){
			var pm = document.getElementById('paymentMethod').value;
			if (pm === 'GCash') {
				var string = "<div>Send Money to 09508961418. Kindly save the reference number or screenshot of the payment. To be submit after you click 'Place Order'</div>";
				$('#paymentDetails').html(string);
			}else if (pm === 'BPI') {
				var string = "<div class='row'>Bank Name : BPI <br> Account Name: Gelaine Esteves Arenas<br> Account # 0899070747<br>Kindly save the reference number or screenshot of the payment. To be submitted after you click 'Place Order'</div>";
				$('#paymentDetails').html(string);
			}else{
				var string = " ";
				$('#paymentDetails').html(string);
			}
		}
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			document.getElementById('user').textContent = user;
			getCartList(user);
			getName(user);
			getUserName(user);
			deliveryCharge(user);
			getOrderNum(user);
			$('#placeOrder').click(function(){
				var or = document.getElementById('orderNum').textContent;
				var today = new Date();
				var date = today.getFullYear()+''+(today.getMonth()+1)+''+today.getDate();
				var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds();
				var orderNum = date+time+"000"+or;
				$.ajax({
					method: "POST",
					url: "php/placeOrder.php",
					data: {
						orderID:orderNum,
						userID: user,
						amt:$('#Total').text(),
						pm:$('#paymentMethod').val()
					},
					success: function(data){
						window.location.href = "orderConfirm.php?u="+user+"&o="+orderNum;
						addOrderDetails(user,orderNum);
						
						
					}
				});
			})
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
				<a href="#" class="navbar-brand">Yum n' Glam Hut</a><span id="orderNum" class="hide"></span><span id="user" class="hide"></span>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="" class="btn btnMenu active" role="button" aria-pressed="true" id="Home">Home</a>
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
			</div>
		</nav>
	</div>
	<div class="container-fluid">
		<div class="container mt-2" id="cart">
			<div class="row">
				<h5>Delivery Address</h5>
			</div>
			<div class="row">
				<div class="col-2">
					<label id="userName"></label>
				</div>
				<div class="col-8">
					<p id="userAddr"></p>
				</div>
				<div class="col-2">
					<button class="btn" id="btnChangeAddr">Change</button>
				</div>
			</div>
			<div class="row">
				<table class="table table-borderless  table-responsive-sm table-responsive-md table-responsive-lg" id="chckoutlist">
					<tr>
						<th></th>
						<th></th>
						<th>Unit Price</th>
						<th>Quantity</th>
						<th>Subtotal</th>
					</tr>
				</table>
			</div>
			<div class="row justify-content-start">
				<div class="col-sm-10 col-md-8 col-lg-5">
					<h5>Payment Method</h5>
				</div>
				<div class="col-sm-8 col-md-4 col-lg-3">
					<select class="form-control" id="paymentMethod" onchange="paymentMethod()">
						<option value="Cash on Delivery">Cash on Delivery</option>
						<option value="GCash">GCash</option>
						<option value="BPI">BPI</option>
					</select>
				</div>
			</div>
			<div class="row justify-content-center" id="paymentDetails">
				
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-8 col-md-4 col-lg-2">
					<h5>Subtotal</h5>
				</div>
				<div class="col-sm-8 col-md-4 col-lg-2">
					<label id="subtotal"></label>
				</div>
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-8 col-md-4 col-lg-2">
					<h5>Delivery Charge</h5>
				</div>
				<div class="col-sm-8 col-md-4 col-lg-2">
					<label id="deliveryCharge"></label>
				</div>
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-8 col-md-4 col-lg-2">
					<h5>Total</h5>
				</div>
				<div class="col-sm-8 col-md-4 col-lg-2">
					<label id="Total"></label>
				</div>
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-8 col-md-4 col-lg-2">
					<button class="btn btn-danger" id="placeOrder">Place Order</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
