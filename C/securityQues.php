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
				url: "custGetUser.php",
				data: {
					userID : userID
				},
				success: function(data){
					var result = jQuery.parseJSON(data);
					document.getElementById('btnUser').value = result[0]['username'];
				}
			})
		};
		function securityQuesForm(){
			var formatTwo =  new RegExp(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/);

			if (document.getElementById('quesOne').selectedIndex == 0) {
				alert('Please select a question.');
				document.getElementById('quesOne').focus();
			}else{
				if (!document.getElementById('ansOne').value) {
					alert('Please answer the question.');
					document.getElementById('ansOne').focus();
				}else{
					if (formatTwo.test(document.getElementById('ansOne').value)==true) {
						alert('No Special Characters.');
						document.getElementById('quesOne').focus();
					}else{
						if (document.getElementById('quesTwo').selectedIndex == 0) {
							alert('Please select a question.');
							document.getElementById('quesTwo').focus();
						}else{
							if (!document.getElementById('ansTwo').value) {
								alert('Please answer the question.');
								document.getElementById('ansTwo').focus();
							}else{
								if (formatTwo.test(document.getElementById('ansTwo').value)==true) {
									alert('No Special Characters.');
									document.getElementById('ansTwo').focus();
								}else{
									ajaxSecQues();
								}
							}
						}
					}
				}
			}
			
		};
		function ajaxSecQues(){
			$.ajax({
				method: "POST",
				url: "php/registAddSecQues.php",
				data: {
					userID: $('#btnUser').text(),
					quesOne: $("#quesOne option:selected" ).text(),
					ansOne: $('#ansOne').val(),
					quesTwo: $("#quesTwo option:selected" ).text(),
					ansTwo: $('#ansTwo').val()
				},
				success: function(data){
					alert(data);
					window.location.href = "../index.php";
				}
			})
		}
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			getName(user);
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
					<div class="dropdown btn btnMenu">
						<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" id="btnUser" role="button" aria-pressed="true"></a>
						<div class="dropdown-menu">
							<a class="dropdown-item" id="btnLogout" href="#">Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid p-5">
		<div class="container p-5">
			<div class="row justify-content-center">
				
			</div>
			<div class="row justify-content-start">
				<h3>Please answer the security question</h3>
				<p>You need to pick two security question and answer it. This will help you for future verification and authentication. Thank you.</p>
			</div>
			<div class="row justify-content-start">
				<form class=>
					<div class="form-group">
						<label for="quesOne">Security Question # 1</label>
						<select class="form-control ml-2 mr-2" id="quesOne">
							<option selected="selected">Select your first security question</option>
							<option>What is your mother's maiden name?</option>
							<option>What is the name of your first pet?</option>
							<option>What was your first car?</option>
							<option>What elementary school did you attend?</option>
							<option>What is the name of the town where you were born?</option>
						</select>
					</div>
			</div>
			<div class="row justify-content-start">
					<div class="form-group">
						<label for="ansOne">Answer for question # 1</label>
						<input type="text" class="form-control" name="ansOne" id="ansOne">
					</div>
			</div>
			<div class="row justify-content-start">
					<div class="form-group">
						<label for="quesTwo">Security Question # 2</label>
						<select class="form-control ml-2 mr-2" id="quesTwo">
							<option selected="selected">Select your first security question</option>
							<option>What was your childhood nickname?</option>
							<option>In what city did you meet your spouse/significant other?</option>
							<option>What street did you live on in third grade?</option>
							<option>What is your oldest cousin's first and last name?</option>
							<option>What is the name of a college you applied to but didn't attend?</option>
						</select>
					</div>
			</div>
			<div class="row justify-content-start">
					<div class="form-group">
						<label for="ansTwo">Answer for question # 2</label>
						<input type="text" class="form-control" name="ansTwo" id="ansTwo">
					</div>
				</form>
			</div>
			<div class="row justify-content-start">
				<button class="btn btn-menu" id="btnSave" onclick="securityQuesForm()">Save</button>
			</div>
		</div>
	</div>
</body>
</html>
