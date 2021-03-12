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
		function usernames(){
			if (!document.getElementById('username').value) {
				alert('Enter your username');
			}else{
				$.ajax({
					method: "POST",
					url: "php/getForgetPass.php",
					data: {
						username : $('#username').val()
					},
					success: function(data){
						if (data === 'username not found') {
							alert('username does not exist');
						}else if (data === 'You dont have any security question.') {
							alert('You dont have any security question.');
						}else{
							document.getElementById('user').style.display = 'none';
							document.getElementById('sec').style.display = 'inline';
							var result = jQuery.parseJSON(data);
							var stringOne = "<option value="+result[0]['ques1']+">"+result[0]['ques1']+"</option>";
							var stringTwo = "<option value="+result[0]['ques2']+">"+result[0]['ques2']+"</option>";
							document.getElementById('userID').innerHTML = result[0]['userID'];
							$('#secques').append(stringOne);
							$('#secques').append(stringTwo);

						}
					}
				})
			}	
		};
		function chckQues(){
			alert($('#userID').text());
			if (document.getElementById('secques').selectedIndex == 0) {
				alert('Pick a question and answer it.');
			}else{
				if (!document.getElementById('answer').value) {
					alert('Pick a question and answer it.');
				}else{
					$.ajax({
						method: "POST",
						url: "php/chckSecQues.php",
						data: {
							ques: $("#secques option:selected" ).text(),
							ans: $('#answer').val(),
							userID : $('#userID').text()
						},
						success: function(data) {
							if (data === 'good') {
								window.location.href = "php/emailSecQues.php?u="+$('#userID').text();
							}else if (data === 'not good') {
								alert('not good');
							}else{
								alert(data);
							}			
						}
					})
				}
			}
		};
		$(document).ready(function(){

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
		#sec{
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
					<a class="btn btnMenu" id="btnLogout" href="#">Login</a>
				
					</div>
				</div>
			</div>
		</div>
	</nav>
	<span id="userID">asdasdsa</span>
	<div class="container-fluid p-5">
		<div class="container p-5" id="user">
			<div class="row justify-content-center">

				Before resetting your account.
			You need to enter your username first.
			</div>
			<div class="row justify-content-center mt-5">
				<form>
					<input type="text" class="form-control" name="username" id="username">
				</form>
				<button class="btn" id="btnNext" onclick="usernames()">Next</button>
			</div>
		</div>
		<div class="container p-5" id="sec">
			<div class="row justify-content-center">
				<h3>Pick a question to answer.</h3>
				<p>This will help us to recover your account.</p>
			</div>
			<div class="row justify-content-center">
				<form>
					<div class="form-group">
						<select class="form-control ml-2 mr-2" id="secques">
							<option selected="selected">Select a question</option>
						</select>
					</div>
					<input type="text" name="answer" id="answer">
				</form>
			</div>
			<div class="row justify-content-center">
				<button class="btn btn-menu" id="btnSave" onclick="chckQues()">Save</button>
			</div>
		</div>
	</div>
</body>
</html>
