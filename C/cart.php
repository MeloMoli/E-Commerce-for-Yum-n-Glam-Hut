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
		function getCartList(userID){
			$.ajax({
				method: "POST",
				url: "php/custGetCartList.php",
				data: {
					userID: userID
				},
				success: function(data){
					if (data === 'No Shopping List') {
						var msg = "<h4>You have not added a product in your cart.</h4>";
						$('#cart').html(msg);
						
					}else{
						var result = jQuery.parseJSON(data);
						for (var i = 0; i <= result.length; i++) {
						var string = "<tr><td class='hide'>"+result[i]['prodID']+"</td><td><input type='checkbox' class='prod' onclick='getProd(this)'></td><td><img width='150' height='100' src='"+result[i]['prodPicture']+"'></td><td>"+result[i]['prodName']+"</td><td>"+result[i]['prodPrice']+"</td><td class='btn-group'><button class='btn' id='minus' onclick='minusQty(this)'>-</button><input type='text' id='qty' value='"+result[i]['qtyProd']+"'><button class='btn' id='add' onclick='addQty(this)'>+</button></td><td><button class='btn' onclick='deleteProd(this)'>Delete</button></td><td class='stocks'>"+result[i]['totalStocks']+"</td><td class='stocks'>Stocks left</tr>";
						
						$('#cartList').append(string);
						}
						
					}
				}
			})
		};
		
		function getProd(prodCell){
			var prodTable = document.getElementById('cartList');
			var index = prodCell.parentNode.parentNode.rowIndex;
			var price = prodTable.rows[index].cells[4].textContent;
			var qty = prodTable.rows[index].cells[5].querySelector('input#qty').value;
			var p = parseInt(price);
			var q = parseInt(qty);
			var prduct = p * q;
			if(prodCell.checked == true){
				
				addProdAmt(prduct);
			}else if (prodCell.checked == false) {
				minusProdAmt(prduct);
			}
		};
		const total = new Array();
		function addProdAmt(amt){
			
			var sum = document.getElementById('amount').textContent;
			var m = parseInt(sum);
			
			var diff = m + amt;
				
			
			document.getElementById('amount').textContent = diff;
			//totalAmt(sum);

		};
		function minusProdAmt(amt){
			
			
			var sum = document.getElementById('amount').textContent;
			var m = parseInt(sum);
			
			var diff = m - amt;
				
			
			document.getElementById('amount').textContent = diff;
			//totalAmt(sum);

		};
		function totalAmt(intOne){
			var delChrg = document.getElementById('deliveryCharge').textContent;
			var dc = parseInt(delChrg);
			var sum = intOne + dc;

			document.getElementById('totalAmount').textContent = sum;
		};
		function deleteProd(prodCell){
			var userID = document.getElementById('user').textContent;
			var prodTable = document.getElementById('cartList');
			var index = prodCell.parentNode.parentNode.rowIndex;
			var prodID = prodTable.rows[index].cells[0].textContent;
			var chckbx = prodTable.rows[index].cells[1].querySelector('input.prod');
			var price = prodTable.rows[index].cells[4].textContent;
			var stocks = prodTable.rows[index].cells[7].textContent;
			var btnAdd = prodTable.rows[index].cells[5].querySelector('button#add');
			var btnMinus = prodTable.rows[index].cells[5].querySelector('button#minus');
			var qty = prodTable.rows[index].cells[5].querySelector('input').value;
			var s =parseInt(price);
			var q = parseInt(qty);
			var a = q*s;
			var sum = document.getElementById('amount').textContent;
			var m = parseInt(sum);
			
			var diff = m - a;
				
			
			

			$.ajax({
				method: "POST",
				url: "php/custDelUptCart.php",
				data: {
					userID: userID,
					prodID: prodID
				},
				success: function(data){
					if (data === 'updated') {
						alert('The product is removed to your cart list');
						prodTable.deleteRow(index);
						document.getElementById('amount').textContent = diff;
					}
				}
			})

		}
		function addQty(prodCell){
			var userID = document.getElementById('user').textContent;
			var prodTable = document.getElementById('cartList');
			var index = prodCell.parentNode.parentNode.rowIndex;
			var prodID = prodTable.rows[index].cells[0].textContent;
			var chckbx = prodTable.rows[index].cells[1].querySelector('input.prod');
			var price = prodTable.rows[index].cells[4].textContent;
			var stocks = prodTable.rows[index].cells[7].textContent;
			var btnAdd = prodTable.rows[index].cells[5].querySelector('button#add');
			var btnMinus = prodTable.rows[index].cells[5].querySelector('button#minus');
			var qty = prodTable.rows[index].cells[5].querySelector('input').value;
			var s =parseInt(stocks);
			var q = parseInt(qty);
			if (q==s) {
				btnAdd.disabled = true;
				btnMinus.disabled=false;
				alert('You have selected all the stocks');
			}else if (q<=s) {
				btnAdd.disabled = false;
				btnMinus.disabled = false;
				q=q+1;
				prodTable.rows[index].cells[5].querySelector('input#qty').value = q;
				if (chckbx.checked == true) {
					var sum = document.getElementById('amount').textContent;
					var m = parseInt(sum);
					var p = parseInt(price);
					var s = m+p;
					document.getElementById('amount').textContent = s;
				}
			}
			
			
			
			
			$.ajax({
				method: "POST",
				url: "php/custAddUptCart.php",
				data: {
					userID : userID,
					prodID : prodID,
					qty : q
				}
			})
		};
		function minusQty(prodCell){
			var userID = document.getElementById('user').textContent;
			var prodTable = document.getElementById('cartList');
			var index = prodCell.parentNode.parentNode.rowIndex;
			var prodID = prodTable.rows[index].cells[0].textContent;
			var chckbx = prodTable.rows[index].cells[1].querySelector('input.prod');
			var price = prodTable.rows[index].cells[4].textContent;
			var stocks = prodTable.rows[index].cells[7].textContent;
			var btnAdd = prodTable.rows[index].cells[5].querySelector('button#add');
			var btnMinus = prodTable.rows[index].cells[5].querySelector('button#minus');
			var qty = prodTable.rows[index].cells[5].querySelector('input').value;
			var s =parseInt(stocks);
			var q = parseInt(qty);
			if (q < 2) {
				btnMinus.disabled = true;
				btnAdd.disabled=false;
				
			}else{
				btnMinus.disabled = false;
				btnAdd.disabled=false;
				q=q-1;
				prodTable.rows[index].cells[5].querySelector('input#qty').value = q;
				if (chckbx.checked == true) {
					var sum = document.getElementById('amount').textContent;
					var m = parseInt(sum);
					var p = parseInt(price);
					var s = m-p;
					document.getElementById('amount').textContent = s;
				}
			}
			
			

			$.ajax({
				method: "POST",
				url: "php/custMinusUptCart.php",
				data: {
					userID : userID,
					prodID : prodID,
					qty : q
				}
			})
		};
		
		function limitPagging(){
		  // alert($('.pagination li').length)

		  if($('.pagination li').length > 7 ){
		      if( $('.pagination li.active').attr('data-page') <= 3 ){
		      $('.pagination li:gt(5)').hide();
		      $('.pagination li:lt(5)').show();
		      $('.pagination [data-page="next"]').show();
		    }if ($('.pagination li.active').attr('data-page') > 3){
		      $('.pagination li:gt(0)').hide();
		      $('.pagination [data-page="next"]').show();
		      for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
		        $('.pagination [data-page="'+i+'"]').show();
		      }
		    }
		  }
		};
		function getPagination(table) {
		  var lastPage = 1;

		  $('#maxRows')
		    .on('change', function(evt) {
		      //$('.paginationprev').html('');            // reset pagination

		     lastPage = 1;
		      $('.pagination')
		        .find('li')
		        .slice(1, -1)
		        .remove();
		      var trnum = 0; // reset tr counter
		      var maxRows = parseInt($(this).val()); // get Max Rows from select option

		      if (maxRows == 15) {
		        $('.pagination').hide();
		      } else {
		        $('.pagination').show();
		      }

		      var totalRows = $(table + ' tbody tr').length; // numbers of rows
		      $(table + ' tr:gt(0)').each(function() {
		        // each TR in  table and not the header
		        trnum++; // Start Counter
		        if (trnum > maxRows) {
		          // if tr number gt maxRows

		          $(this).hide(); // fade it out
		        }
		        if (trnum <= maxRows) {
		          $(this).show();
		        } // else fade in Important in case if it ..
		      }); //  was fade out to fade it in
		      if (totalRows > maxRows) {
		        // if tr total rows gt max rows option
		        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
		        //  numbers of pages
		        for (var i = 1; i <= pagenum; ) {
		          // for each page append pagination li
		          $('.pagination #prev')
		            .before(
		              '<li class="page-item" data-page="' +
		                i +
		                '">\
		                  <span class="page-link">' +
		                i++ +
		                '<span class="sr-only">(current)</span></span>\
		                </li>'
		            )
		            .show();
		        } // end for i
		      } // end if row count > max rows
		      $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
		      $('.pagination li').on('click', function(evt) {
		        // on click each page
		        evt.stopImmediatePropagation();
		        evt.preventDefault();
		        var pageNum = $(this).attr('data-page'); // get it's number

		        var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

		        if (pageNum == 'prev') {
		          if (lastPage == 1) {
		            return;
		          }
		          pageNum = --lastPage;
		        }
		        if (pageNum == 'next') {
		          if (lastPage == $('.pagination li').length - 2) {
		            return;
		          }
		          pageNum = ++lastPage;
		        }

		        lastPage = pageNum;
		        var trIndex = 0; // reset tr counter
		        $('.pagination li').removeClass('active'); // remove active class from all li
		        $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
		        // $(this).addClass('active');          // add active class to the clicked
		      limitPagging();
		        $(table + ' tr:gt(0)').each(function() {
		          // each tr in table not the header
		          trIndex++; // tr index counter
		          // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
		          if (
		            trIndex > maxRows * pageNum ||
		            trIndex <= maxRows * pageNum - maxRows
		          ) {
		            $(this).hide();
		          } else {
		            $(this).show();
		          } 
		        }); 
		      }); 
		    limitPagging();
		    })
		    .val(15)
		    .change();
		};
		$(document).ready(function(){
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			const user = urlParams.get('u');
			document.getElementById('user').textContent = user;
			getCartList(user);
			getName(user);
			getPagination('#cartList');
			document.getElementById('Home').href = "customer.php?u="+user;
			$('#btnDessert').click(function(){
				window.location.href = "foodDessert.php?u="+user;
			});
			$('#chckOut').click(function(){
				if ($('.prod').is(":checked")) {
					window.location.href = 'checkout.php?u='+user;
					$('.prod:checked').each(function(){
						var prodTable = document.getElementById('cartList');
						var index = this.parentNode.parentNode.rowIndex;
						var prodID = prodTable.rows[index].cells[0].textContent;

						$.ajax({
							method: "POST",
							url: "php/custCartStatusChckout.php",
							data: {
								prodID : prodID,
								userID : user
							}
						})
					})
				}else{
					alert("Select a product that you want to order.");
				}
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
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="#" class="btn btnMenu active" role="button" aria-pressed="true" id="Home">Home</a>
						<div class="dropdown">
							<a href="#" class="btn btnMenu dropdown-toggle" data-toggle="dropdown" role="button" aria-pressed="true">Food</a>
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
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-2 mr-5 ml-3 mt-1">
						<a href="#" class="navbar-brand">Yum n' Glam Hut</a><span id="user" class="hide"></span>
					</div>
					<form >
					<input type="text" class="form-control col-xs-8 col-sm-12 col-lg-12 mt-1" id="searchbar" name="searchbar">
					</form>
					<button class="btn btn-lg ml-1 mr-4 mt-1 mb-2 col-1" id="search">Search</button>
				</div>
			</div>    
		</nav>
	</div>
	<div class="container-fluid">
		<div class="container" id="cart">
			<div class="row justify-content-start">
				<div class="col-4">
					<select class="form-control ml-1" name="state" id="maxRows">
						<option value="15">Show ALL Rows</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col-4">
					<ul class="pagination ml-1">
						<li class="page-item" data-page="prev" >
							<span class="page-link"> < <span class="sr-only">(current)</span></span>
						</li>
						<li class="page-item" data-page="next" id="prev">
							<span class="page-link"> > <span class="sr-only">(current)</span></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<table class="table table-borderless  table-responsive-sm table-responsive-md table-responsive-lg" id="cartList">
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</table>
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-8 col-md-4 col-lg-2">
					<h5>Amount</h5>
				</div>
				<div class="col-sm-8 col-md-4 col-lg-2">
					<label id="amount">0</label>
				</div>
			</div>
			<div class="row justify-content-end">
				<div class="col-sm-8 col-md-4 col-lg-2">
					<button class="btn btn-danger" id="chckOut">Check Out</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
