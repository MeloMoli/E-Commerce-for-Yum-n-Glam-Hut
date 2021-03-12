<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" user-scalable=no>
	<title>Yum n'Glam Hut</title>
	<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function showPass() {
			if (document.getElementById('showPassword').checked == true){
				document.getElementById("password").type = "text";
			} else {
				document.getElementById("password").type = "password";
			}
		};
		function showPassRegist() {
			if (document.getElementById('showPassRegists').checked == true){
				document.getElementById("registPassword").type = "text";
				document.getElementById("confirmPassword").type = "text";
			} else {
				document.getElementById("registPassword").type = "password";
				document.getElementById("confirmPassword").type = "password";
			}
		};
		function login(){

			if (!document.getElementById('username').value) {
				alert('Enter your username');
				document.getElementById('username').focus();
			}else{
				if (document.getElementById('username').value.length<= 2) {
					alert('Username should be a minimum of 3 characters and maximum of 20 characters');
					document.getElementById('username').focus();
				}else{
					if (document.getElementById('username').value.length>= 21) {
						alert('Username should be a minimum of 3 characters and maximum of 20 characters');
						document.getElementById('username').focus();
					}else{
						if (!document.getElementById('password').value) {
							alert('Enter your password');
							document.getElementById('password').focus();
						}else{
							if (document.getElementById('password').value.length <= 7) {
								alert('Password should be atleast 8 characters long');
								document.getElementById('password').focus();
							}else{
								if (document.getElementById('password').value.length >= 31) {
									alert('Password should be atleast 8 characters long');
									document.getElementById('password').focus();
								}else{
									ajaxLogin();
								}
							}
						}
					}
				}
			}
		};
		function ajaxLogin(){
			var attempt = 3;
			$.ajax({
				method: "POST",
				url: "C/php/login.php",
				data: {
					username: $('#username').val(),
					password: $('#password').val()
				},
				success: function(data){
					if (data === 'match') {
						window.location.href = "C/php/postlogin.php?user="+$('#username').val();
					}else if (data === 'does not match') {
						attempt--;
						alert('Username and Password didn\'t match');
						if (attempt == 0) {
							alert('Having trouble logging in? Click forget password.');
						}
					}else if (data === 'username does not exist') {
						alert('Username does not exist.');
					}else{
						alert(data);
					}
				}
			})
		};
		function regist(){
			var letters = new RegExp(/[a-zA-Z]+/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);

			if (!document.getElementById('firstName').value) {
				alert('Enter your First Name.');
				document.getElementById('firstName').focus();
			}else{
				if (letters.test(document.getElementById('firstName').value)==true) {
					if (formatTwo.test(document.getElementById('firstName').value)==true) {
						alert('Letters only.');
						document.getElementById('firstName').focus();
					}else{
						if (nums.test(document.getElementById('firstName').value)==true) {
							alert('Letters only.');
							document.getElementById('firstName').focus();
						}else{
							if (!document.getElementById('lastName').value) {
								alert('Enter your Last Name.');
								document.getElementById('lastName').focus();
							}else{
								if (letters.test(document.getElementById('lastName').value)==true) {
									if (formatTwo.test(document.getElementById('lastName').value)==true) {
										alert('Letters only');
										document.getElementById('lastName').focus();
									}else{
										if (nums.test(document.getElementById('lastName').value)==true) {
											alert('Letters only');
											document.getElementById('lastName').focus();
										}else{
											if (!document.getElementById('registUsername').value) {
												alert('Enter your preferred username');
												document.getElementById('registUsername').focus();
											}else{
												registFormTwo();
											}
										}
									}
								}else{
									alert('Letters only');
									document.getElementById('lastName').focus();
								}
							}
						}
					}
				}else{
					alert('Letters only.');
					document.getElementById('firstName').focus();
				}
			}
		};
		function registFormTwo(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var emailShit = new RegExp(/[@_.\-]/);

			if (format.test(document.getElementById('registUsername').value)==true) {
				alert('No special characters. Only "_.-@" is allowed.');
				document.getElementById('registUsername').focus();
			}else{
				if (!document.getElementById('emailAddress').value) {
					alert('Enter your email address');
					document.getElementById('emailAddress').focus();
				}else{
					if (emailShit.test(document.getElementById('emailAddress').value)==true) {
						registEmailShit();
					}else{
						registEmailShit();
					}
				}
			}
		};
		function registEmailShit(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[@_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (format.test(document.getElementById('emailAddress').value)==true) {
				alert('Invalid Email Address');
				document.getElementById('emailAddress').focus();
			}else{
				if (at.test(document.getElementById('emailAddress').value)==true) {
					if (document.getElementById('emailAddress').value.includes(com)==true) {
						if (!document.getElementById('registPassword').value) {
							alert('Enter your preferred password.');
							document.getElementById('registPassword').focus();
						}else{
							if (document.getElementById('registPassword').value<=7) {
								alert('Password should be atleast 8 characters long and no more than 50 characters.');
								document.getElementById('registPassword').focus();
							}else{
								if (document.getElementById('registPassword').value>=51) {
									alert('Password should be atleast 8 characters long and no more than 50 characters.');
									document.getElementById('registPassword').focus();
								}else{
									registFormThree();
								}
							}
						}
					}else{
						alert('Invalid Email Address');
						document.getElementById('emailAddress').focus();
					}
				}else{
					alert('Invalid Email Address');
					document.getElementById('emailAddress').focus();
				}
			}
			
		}
		function registFormThree(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[@_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (formatTwo.test(document.getElementById('registPassword').value)==false) {
				alert('Password should have a least one Upper case, one lower case, one digit number and one special characters');
				document.getElementById('registPassword').focus();
			}else{
				if (letters.test(document.getElementById('registPassword').value)==false) {
					alert('Password should have a least one Upper case, one lower case, one digit number and one special characters');
					document.getElementById('registPassword').focus();
				}else{
					if (nums.test(document.getElementById('registPassword').value)==false) {
						alert('Password should have a least one Upper case, one lower case, one digit number and one special characters');
						document.getElementById('registPassword').focus();
					}else{
						if (document.getElementById('registPassword').value === document.getElementById('confirmPassword').value) {

							$.ajax({
								method: "POST",
								url: "C/php/registCheckAccount.php", 
								data: {
									username : $('#registUsername').val(),
									emailAddress : $('#emailAddress').val()
								},
								success: function(data){
									if (data === 'username') {
										alert('The username already exist');
										document.getElementById('registUsername').focus();
									}else if (data === 'emailAddress') {
										alert('The email address already exist');
										document.getElementById('emailAddress').focus();
									}else{
										sessionStorage.setItem("firstName", document.getElementById('firstName').value);
										sessionStorage.setItem("lastName", document.getElementById('lastName').value);
										sessionStorage.setItem("registUsername", document.getElementById('registUsername').value);
										sessionStorage.setItem("emailAddress", document.getElementById('emailAddress').value);
										sessionStorage.setItem("confirmPassword", document.getElementById('confirmPassword').value);
										window.location.href = "C/registration.php";
									}
								}
							})
							
							
						}else{
							alert('Please confirm your password.');
							document.getElementById('confirmPassword').focus();
						}
					}
				}
			}
		};
		function search(){
			var searchText = document.getElementById('searchbar').value;

			$.ajax({
				method: "POST",
				url: "php/search.php",
				data:{
					searchText : searchText
				},
				success: function(data){
					if (data === 'no match') {
						alert('Your search did not match to any of our products');
					}else{
						window.location.href = "";
					}
				}
			})
		}
		$(document).ready(function(){
			getData();
			$('#btnRegist').click(function(){
				regist();
			});
			$('#btnLogin').click(function(){
				login();
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
			border-right: 1px solid #FFFAE0;
			height: 300px;
		}
		.products img{
			box-shadow: 0px 15px 10px -15px #111;
		}
	</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<span id="toggleIcon"><img src="Images/menu.png" width="20" height="20"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="#" class="btn btnMenu active" role="button" aria-pressed="true">Home</a>
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true" id="btnFood">Food</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" id="btnDessert" href="#">Dessert</a>
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
						<a href="#" class="btn btnMenu" role="button" aria-pressed="true">About</a>
						<a href="#" class="btn btnMenu" role="button" aria-pressed="true" data-toggle='modal' data-target='#registModal'>Register</a>
						<a href="#" class="btn btnMenu" role="button" aria-pressed="true" data-toggle='modal' data-target='#loginModal'>Login</a>
					</div>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-2 mr-5 ml-3 mt-1">
						<a href="#" class="navbar-brand">Yum n' Glam Hut</a>
					</div>
					<form >
					<input type="text" class="form-control col-xs-8 col-sm-12 col-lg-12 mt-1" id="searchbar" name="searchbar">
					</form>
					<button class="btn btn-lg ml-1 mr-4 mt-1 col-1" id="search">Search</button>
					<div class="col-2 mb-4 mt-1" id="divCart">
						<a class="notification">
						<img src="Images/addCart.png" height="45" width="45">
						<span id="badge">0</span>
						</a>
					</div>	
				</div>
			</div>    
		</nav>
		<div class="container-fluid">
			<h5><span id="lblOne">Top Products</span></h5>
			<div class="container p-3" id="searchs">
				
			</div>
			<!---Login--->
			<div class="modal" id="loginModal">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-body" id="contLogin">
							<div class="row">
								<div class="col-10">
									<h4>Login</h4>
								</div>
								<div class="col-2">
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
							</div>
							<div class="container-fluid">
								<div class="ml-2 mr-3 p-5">
									<form>
										<div class="form-group">
											<label for="username">Username</label>
											<input class="form-control" type="text" name="username" id="username">
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input class="form-control" type="password" name="password" id="password">
										</div>
										<div class="form-check-inline">
											<input type="checkbox" class="form-check-input" name="showPassword" id="showPassword" onclick="showPass()">
											<label class="form-check-label">Show Password</label>
										</div>
									</form>
								</div>
							</div>
							<hr>
							<div class="row justify-content-center">
								<div class="btn-group">
									<button class="btn btn-sm btn-outline-dark" id="btnLogin">Login</button>
									<button class="btn btn-sm btn-outline-dark" id="btnForPass">Forget Password</button>
									<button class="btn btn-sm btn-outline-dark" id="btnLoginGuest">Login as Guest</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!---Registration-->
			<div class="modal" id="registModal">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-body" id="contRegist">
							<div class="row">
								<div class="col-10">
									<h4>Registration</h4>
								</div>
								<div class="col-2">
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
							</div>
							<div class="container-fluid">
								<div class="ml-2 mr-3 p-5">
									<form>
										<div class="form-group">
											<label for="firstName">First Name</label>
											<input class="form-control" type="text" name="firstName" id="firstName">
										</div>
										<div class="form-group">
											<label for="lastName">Last Name</label>
											<input class="form-control" type="text" name="lastName" id="lastName">
										</div>
										<div class="form-group">
											<label for="registUsername">Username</label>
											<input class="form-control" type="text" name="registUsername" id="registUsername">
										</div>
										<div class="form-group">
											<label for="emailAddress">Email Address</label>
											<input class="form-control" type="text" name="emailAddress" id="emailAddress">
										</div>
										<div class="form-group">
											<label for="registPassword">Password</label>
											<input class="form-control" type="password" name="registPassword" id="registPassword">
										</div>
										<div class="form-group">
											<label for="confirmPassword">Confirm Password</label>
											<input class="form-control" type="password" name="confirmPassword" id="confirmPassword">
										</div>
										<div class="form-check-inline">
											<input type="checkbox" class="form-check-input" name="showPassRegists" id="showPassRegists" onclick="showPassRegist()">
											<label class="form-check-label">Show Password</label>
										</div>
									</form>
								</div>
							</div>
							<hr>
							<div class="row justify-content-center">
								<div class="btn-group">
									<button class="btn btn-sm btn-outline-dark" id="btnRegist">Submit</button>
									<button class="btn btn-sm btn-outline-dark">Cancel</button>
								</div>
							</div>
						</div>
					</div>
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