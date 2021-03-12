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
		function getStorage(){
			document.getElementById('firstName').value = sessionStorage.getItem("firstName");
			document.getElementById('lastName').value = sessionStorage.getItem("lastName");
			document.getElementById('username').value = sessionStorage.getItem("registUsername");
			document.getElementById('emailAddress').value = sessionStorage.getItem("emailAddress");
			document.getElementById('password').value = sessionStorage.getItem("confirmPassword");
		}
		function showPass() {
			if (document.getElementById('showPassword').checked == true){
				document.getElementById("password").type = "text";
				document.getElementById("confirmPassword").type = "text";
			} else {
				document.getElementById("password").type = "password";
				document.getElementById("confirmPassword").type = "password";
			}
		};
		function accountInfoForm(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			document.getElementById('fullname').value = document.getElementById('firstName').value + " " + document.getElementById('lastName').value;
			document.getElementById('emaAdd').value = document.getElementById('emailAddress').value;
			if (!document.getElementById('username').value) {
				alert('Enter your preferred username');
				document.getElementById('username').focus();
			}else{
				if (format.test(document.getElementById('username').value)==true) {
					alert('No special characters allowed. Only "_.-@" is allowed');
					document.getElementById('username').focus();
				}else{
					if (!document.getElementById('password').value) {
						alert('Enter your preferred password');
						document.getElementById('password').focus();
					}else{
						if (formatTwo.test(document.getElementById('password').value)==false) {
							alert('Password should have atleast One of uppercase, lowercase, number and a special characters');
							document.getElementById('password').focus();
						}else{
							if (letters.test(document.getElementById('password').value)==false) {
								alert('Password should have atleast One of uppercase, lowercase, number and a special characters');
								document.getElementById('password').focus();
							}else{
								if (nums.test(document.getElementById('password').value)==false) {
									alert('Password should have atleast One of uppercase, lowercase, number and a special characters');
									document.getElementById('password').focus();
								}else{
									if (document.getElementById('password').value.length <=7) {
										alert('Password should be atleast 8 characters long');
										document.getElementById('password').focus();
									}else{
										if (document.getElementById('password').value.length >=51) {
											alert('Password should be no morethan 50 characters');
											document.getElementById('password').focus();
										}else{
											if (!document.getElementById('emailAddress').value) {
												alert('Enter your email address. Please enter a valid email address.');
												document.getElementById('emailAddress').focus();
											}else{
												if (emailShit.test(document.getElementById('emailAddress').value)==true) {
														registEmailShit();
												}else{
														registEmailShit();
												}
											}
										}
									}
								}
							}
						}
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
						personalInfoFormOne();
					}else{
						alert('Invalid Email Address');
						document.getElementById('emailAddress').focus();
					}
				}else{
					alert('Invalid Email Address');
					document.getElementById('emailAddress').focus();
				}
			}
		};
		function personalInfoFormOne(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (!document.getElementById('firstName').value) {
				alert('Enter your First Name');
				document.getElementById('firstName').focus();
			}else{
				if (letters.test(document.getElementById('firstName').value)==true) {
					if (nums.test(document.getElementById('firstName').value)==true) {
						alert('Letters only.');
						document.getElementById('firstName').focus();
					}else{
						if (formatTwo.test(document.getElementById('firstName').value)==true) {
							alert('Letters only.');
							document.getElementById('firstName').focus();
						}else{
							if (!document.getElementById('lastName').value) {
								alert('Enter your Last Name');
								document.getElementById('lastName').focus();
							}else{
								if (letters.test(document.getElementById('lastName').value)==true) {
									if (nums.test(document.getElementById('lastName').value)==true) {
										alert('Letters only.');
										document.getElementById('lastName').focus();
									}else{
										if (formatTwo.test(document.getElementById('lastName').value)==true) {
											alert('Letters only.');
											document.getElementById('lastName').focus();
										}else{
											if (!document.getElementById('middleName').value) {
												personalInfoFormTwo();
											}else{
												if (letters.test(document.getElementById('middleName').value)==true) {
													if (nums.test(document.getElementById('middleName').value)==true) {
														alert('Letters only.');
														document.getElementById('middleName').focus();
													}else{
														if (formatTwo.test(document.getElementById('middleName').value)==true) {
															alert('Letters only.');
															document.getElementById('middleName').focus();	
														}else{
															personalInfoFormTwo();
														}
													}
												}
											}
										}
									}
								}else{
									alert('Letters only.');
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
		}
		function personalInfoFormTwo(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (document.getElementById('gender').selectedIndex == 0) {
				alert('Select a gender.');
				document.getElementById('gender').focus();
			}else{
				dateBirth();
			}
		}
		function dateBirth(){
			if (document.getElementById('month').selectedIndex==0) {
				alert('when is your Birth month');
				document.getElementById('month').focus();
			}else{
				if (document.getElementById('day').selectedIndex==0) {
					alert('when is your Birth day');
					document.getElementById('day').focus();
				}else{
					if (document.getElementById('year').selectedIndex==0) {
						alert('when is your Birth year');
						document.getElementById('year').focus();
					}else{
						phoneForm();

					}
				}
			}
		};
		function phoneForm(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (!document.getElementById('cellphone').value) {
				alert('Enter your cellphone number');
				document.getElementById('cellphone').focus();
			}else{
				if (nums.test(document.getElementById('cellphone').value)==true) {
					if (document.getElementById('cellphone').value.length ==11) {
						if (!document.getElementById('telephone').value) {
							addrForm();
						}else{
							if (nums.test(document.getElementById('telephone').value)==true) {
								if (document.getElementById('telephone').value.length == 7) {
									addrForm();
								}else{
									alert('Telephone numbers should be 7 digit numbers only.');
									document.getElementById('telephone').focus();
								}
							}else{
								alert('Numbers only');
								document.getElementById('telephone').focus();
							}
						}
					}else{
						alert('Cellphone number should be 11 digit numbers only.');
						document.getElementById('cellphone').focus();
					}
				}else{
					alert('Numbers only');
					document.getElementById('cellphone').focus();
				}
			}
		};
		function addrForm(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[@_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (!document.getElementById('street').value) {
				alert('Enter the street where you live.');
				document.getElementById('street').focus();
			}else{
				if (format.test(document.getElementById('street').value)==true) {
					alert('Only commas and dash is the allowed special characters');
					document.getElementById('street').focus();
				}else{
					if (!document.getElementById('baranggay').value) {
						alert('Enter the baranggay where you live.');
						document.getElementById('baranggay').focus();
					}else{
						if (letters.test(document.getElementById('baranggay').value)==true) {
							if (nums.test(document.getElementById('baranggay').value)==true) {
								cityPostalForm();
							}else{
								cityPostalForm();
							}
						}else{
							alert('Invalid input of baranggay');
							document.getElementById('baranggay').focus();
						}
					}
				}
			}
		};
		function cityPostalForm(){
			var format = new RegExp(/[!#$%^&*()+=\[\]{};':"\\|,<>\/?]/);
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);
			var nums = new RegExp(/[0-9]+/);
			var letters = new RegExp(/[a-zA-Z]+/);
			var period = new RegExp(/[.]/);
			var dash = new RegExp(/[\-]/);
			var emailShit = new RegExp(/[@_.\-]/);
			var at = new RegExp(/[@]/);
			var com = ".com";

			if (!document.getElementById('city').value) {
				alert('Enter the city where you live.');
				document.getElementById('city').focus();
			}else{
				if (letters.test(document.getElementById('city').value)==true) {
					if (!document.getElementById('postalCode').value) {
						alert('Enter the postal code where you live');
						document.getElementById('postalCode').focus();
					}else{
						if (nums.test(document.getElementById('postalCode').value)==true) {
							if (document.getElementById('postalCode').value.length ==4) {
								if (document.getElementById('hereby').checked == true) {
									if (document.getElementById('password').value === document.getElementById('confirmPassword').value) {
										ajaxRegist();
									}else{
										alert('Please confirm your password');
										document.getElementById('password').focus();
									}
								}else{
									alert('Please confirm that all the information above is true.');
									document.getElementById('hereby').focus();
								}
							}else{
								alert('Postal Code is 4 digit number only');
								document.getElementById('postalCode').focus();
							}
						}else{
							alert('Numbers only.');
							document.getElementById('postalCode').focus();
						}
					}
				}else{
					alert('Invalid input of city');
					document.getElementById('cityPostalForm').focus();
				}
			}
		};
		function ajaxRegist(){
			var dateBirth = document.getElementById('year').value + "-" + document.getElementById('month').value + "-" + document.getElementById('day').value;
			$.ajax({
				method: "POST",
				url: "php/registAddAccount.php",
				data: {
					userID : $('#userIDPic').val(),
					username: $('#username').val(),
					emailAddress: $('#emailAddress').val(),
					password: $('#confirmPassword').val(),
					firstName: $('#firstName').val(),
					lastName: $('#lastName').val(),
					middleName: $('#middleName').val(),
					suffix: $('#suffix').text(),
					gender: $('#gender').val(),
					dateBirth: dateBirth,
					cellphone: $('#cellphone').val(),
					telephone: $('#telephone').val(),
					houseNum: $('#houseNum').val(),
					street: $('#street').val(),
					baranggay: $('#baranggay').val(),
					city: $('#city').val(),
					postalCode: $('#postalCode').val()
				},
				success: function(data){
					if (data === 'cellphone') {
						alert('Cellphone already existed');
					}else if (data === 'emailAddress') {
						alert('Email address already existed');
					}else if (data === 'username') {
						alert('Username already existed');
					}else if (data==='good') {
						$('#btnUploads').click();
					}else{
						alert('Sorry there might have been an error. Please try again later.')
					}
				}
			})
		};

		function previewFile(input){
			var reader = new FileReader();
			var file = $("#addProfilePic").get(0).files[0];
			if(input.files[0].size > 30000000){
				alert("File is too big!");
				input.value = "";
			}else{
				if(file){
					reader.onload = function(){
						$("#profilePic").attr("src", reader.result);
					}
					reader.readAsDataURL(file);
				}
			}
		};
		function day(){
			for (var i = 1; i <=31 ; i++) {
				var days = "<option value='"+i+"'>"+i+"</option>";

				$('#day').append(days);
			}
		};
		function year(){
			var d = new Date();
  		var n = d.getFullYear();
			for (var i = 1920; i <= n; i++) {
				var years = "<option value='"+i+"'>"+i+"</option>";

				$('#year').append(years);
			}
		};
		function getUserID(){
			$.ajax({
				method: "GET",
				url: "php/registGetUserID.php"
			}).done(function(data){
				
				if (data === 'no cust') {
					var d = new Date();
			  		var n = d.getFullYear();
			  		var a= n+"0001";
	  				document.getElementById('userIDPic').value = a;
				}else{
					var result = jQuery.parseJSON(data);
					var userID = parseInt(result[0]['userID']);
					var idUser = userID +1;
					document.getElementById('userIDPic').value = idUser;
				}
			})
		};
		$(document).ready(function(){
			day();year();
			getUserID();
			getStorage();

		})
	</script>
	<style type="text/css">
		@media(min-width: 480px){

		}
		@media(min-width: 1280px){

		}
		body{
			background-color: #fcf1ef;
		}
		.navbar{
			background-color: #000C20;
		}
		a{
			text-decoration: none;
			color: white;
		}
		a:hover{
			color: #F1B420;
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
				<div class="nav navbar-nav ml-auto">
					<a href="#" class="btn btnMenu" role="button" aria-pressed="true" data-toggle='modal' data-target='#loginModal'>Help Centre</a>
					<a href="#" class="btn btnMenu" role="button" aria-pressed="true" data-toggle='modal' data-target='#loginModal'>Login</a>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid pl-5">
		<div class="container-fluid p-5">
			<div class="row justify-content-center">
				<form method="post" action="php/registAddPic.php" enctype='multipart/form-data'  id="profilePicForm">
					<center>
						<img id="profilePic" class="form-control p-1 mb-1" style="width: 150px; height: 200px">
					</center>
					<input type='file'class="form-control p-1" id="addProfilePic" name='file' onchange="previewFile(this);" accept="image/*">
					<input type="text" class="hide" id="userIDPic" name="userIDPic">
					<input type="text" class="hide"  id="fullname" name="fullname">
					<input type="text" class="hide" id="emaAdd" name="emaAdd">
					<input type="submit" class="hide" id="btnUploads" name="btnUploads">
				</form>
			</div>
			<hr>
			<div class="row justify-content-center mt-2 mb-2">
				<h4>Account Information</h4>
			</div>
			<div class="row justify-content-center">
				<form class="form-inline">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control ml-1 mr-1" name="username" id="username">
					</div>
					<div class="form-group">
						<label for="emailAddress">Email Address</label>
						<input type="text" class="form-control ml-1 mr-1" name="emailAddress" id="emailAddress">
					</div>
					<div class="form-group ">
						<label for="password">Password</label>
						<input type="password" class="form-control ml-1 mr-1" name="password" id="password">
					</div>
					<div class="form-group">
						<label for="confirmPassword">Confirm Password</label>
						<input type="password" class="form-control ml-1 mr-1" name="confirmPassword" id="confirmPassword">
					</div>
				</form>
			</div>
			<div class="row mt-2">
				<div class="col-7">
					
				</div>
				<div class="col-5">
					<div class="form-check-inline">
						<input type="checkbox" class="form-check-input" name="showPassword" id="showPassword" onclick="showPass()">
						<label class="form-check-label">Show Password</label>
					</div>
				</div>
			</div>
			<hr>
			<div class="row justify-content-center mt-2 mb-2">
				<h4>Personal Information</h4>
			</div>
			<div class="row justify-content-center">
				<form class="form-inline">
					<div class="form-group">
						<label for="firstName">First Name</label>
						<input type="text" class="form-control ml-2 mr-2" name="firstName" id="firstName">
					</div>
					<div class="form-group">
						<label for="middleName">Middle Name</label>
						<input type="text" class="form-control ml-2 mr-2" name="middleName" id="middleName">
					</div>
					<div class="form-group ">
						<label for="lastName">Last Name</label>
						<input type="lastName" class="form-control ml-2 mr-2" name="lastName" id="lastName">
					</div>
					<div class="form-group">
						<label for="suffix">Suffix</label>
						<select class="form-control ml-2 mr-2" id="suffix">
							<option selected="selected">Select your suffix</option>
							<option>Jr.</option>
							<option>Sr.</option>
							<option>II</option>
							<option>III</option>
						</select>
					</div>
				</form>
			</div>
			<div class="row justify-content-center mt-4">
				<form class="form-inline">
					<div class="form-group">
						<label for="gender">Gender</label>
						<select class="form-control ml-2 mr-2" id="gender">
							<option selected="selected">Select your Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div>
					Date of Birth
					<div class="form-group">
						<select class="form-control ml-2" id="month">
							<option selected="selected">Month</option>						
							<option value="1">Jan</option>
							<option value="2">Feb</option>
							<option value="3">Mar</option>
							<option value="4">Apr</option>
							<option value="5">May</option>
							<option value="6">Jun</option>
							<option value="7">Jul</option>
							<option value="8">Aug</option>
							<option value="9">Sep</option>
							<option value="10">Oct</option>
							<option value="11">Nov</option>
							<option value="12">Dec</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="day">
							<option selected="selected">Day</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control mr-2" id="year">					
							<option selected="selected">Year</option>							
						</select>
					</div>
					<div class="form-group">
						<label for="cellphone">Cellphone</label>
						<input type="text" class="form-control ml-2 mr-2" name="cellphone" id="cellphone">
					</div>
					<div class="form-group ">
						<label for="telephone">Telephone</label>
						<input type="text" class="form-control ml-2 mr-2" name="telephone" id="telephone">
					</div>
				</form>
			</div>
			<hr>
			<div class="row justify-content-center mt-2 mb-2">
				<h4>Address Information</h4>
			</div>
			<div class="row justify-content-center">
				<form class="form-inline">
					<div class="form-group">
						<label for="houseNum">House Num</label>
						<input type="text" class="form-control ml-2 mr-2" name="houseNum" id="houseNum">
					</div>
					<div class="form-group">
						<label for="street">Street</label>
						<input type="text" class="form-control ml-2 mr-2" name="street" id="street">
					</div>
					<div class="form-group ">
						<label for="baranggay">Baranggay</label>
						<input type="text" class="form-control ml-2 mr-2" name="baranggay" id="baranggay">
					</div>
					<div class="form-group ">
						<label for="city">City</label>
						<input type="text" class="form-control ml-2 mr-2" name="city" id="city">
					</div>
				</form>
			</div>
			<div class="row justify-content-center mt-4">
				<form class="form-inline">
					<div class="form-group ">
						<label for="country">Country</label>
						<input type="text" class="form-control ml-2 mr-2" name="country" id="country" value="Philippines" readonly>
					</div>
					<div class="form-group ">
						<label for="postalCode">Postal Code</label>
						<input type="text" class="form-control ml-2 mr-2" name="postalCode" id="postalCode">
					</div>
				</form>
			</div>
			<hr>
			<div class="row justify-content-center">
				<div class="form-check-inline">
					<input type="checkbox" class="form-check-input" name="hereby" id="hereby">
					<label class="form-check-label"> I hereby certify that, to the best of my knowledge, the provided information is true and accurate</label>
				</div>
			</div>
			<hr>
			<div class="row justify-content-center">
				<div class="btn-group">
					<button class="btn btn-menu" id="btnSave" onclick="accountInfoForm()">Save</button>
					<button class="btn btn-menu" id="btnCancel" onclick="window.history.back()">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
