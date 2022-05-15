<?php


	class sendDataToDB
	{
		public function send()
		{
			if(isset($_GET['send']))
			{
				$name = $_GET['name'];
				$count = $_GET['thing'];
				$mysqli = new mysqli('localhost', 'root', '', 'shop');
				$name = '"'.$mysqli->real_escape_string("$name").'"';
				$count = '"'.$mysqli->real_escape_string("$count").'"';
				$result = $mysqli->query("INSERT INTO `orders` (Name, Count) VALUES($name, $count)");
				if($result)
				{
					header('location: http://localhost/');
					exit();
				}
				$mysqli->close();
			}
		}
	}

	$result = new sendDataToDB();
	$result->send();

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title></title>
	<style type="text/css">
		#aboutSoftToyBear
		{
			display: none;
		}

		.buy
		{
			text-align: center;
		}

		.toy
		{
			margin: 20px 50px;
			text-align: center;
		}

	</style>
</head>
<body>

	<div class="toy">
		<h1>Плюшевая игрушка "Медведь"</h1>
		<div class="toy_bear">
			<product></product>
		</div>
	</div>

	<!-- Modal window for soft bear-->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Карточка заказа</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	        <div id="aboutSoftToyBear">
				<p>Плюшевая игрушка "Медведь"</p>
				<form method="GET">
					<input type="text" name="name" placeholder="Ваше имя:"> <br /><br />
					<input type="number" name="thing" placeholder="1"> <br /><br /><br />
					<input type="submit" class="btn btn-secondary" data-bs-dismiss="modal" name="send" value="Отправить">
				</form>
			</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" onclick="сloseToyBear()">Отмена</button>
	      </div>
	    </div>
	  </div>
	</div>


<script type="text/javascript">
	
		function showToyBear()
		{
			let bear = document.getElementById("aboutSoftToyBear");
			bear.style.display = 'block';
		}

		function сloseToyBear()
		{
			let bear = document.getElementById("aboutSoftToyBear");
			bear.style.display = 'none';
			window.location = 'http://localhost/';
		}
		
		Vue.component('product', 
		{
			template:
			`
				<div class="product">
					<img :src="image"> <br />
					<button v-for="elem in things" v-on:click="toggleActive(elem)" onclick="showToyBear()" class="buy" >Купить</button> <br /><br />
					<button class="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Корзина ({{total()}})</button>
				</div>
			`,
			data()
			{
				return {
					things:
					[
						{
							active: false,
						}
					],
					image: 'https://www.buildabear.co.uk/dw/image/v2/BBNG_PRD/on/demandware.static/-/Sites-buildabear-master/default/dw58615879/24640x.jpg?sw=600&sh=600&sm=fit&q=70',
				}
			},
			methods:
			{
				toggleActive: function(elem)
				{
					elem.active = !elem.active;
				},
				total: function()
				{
					let total = 0;
					this.things.forEach(function(elem)
					{
						if(elem.active)
						{
							total++;
						}
					});
					return total;
				}
			},
		})

		let vue = new Vue(
		{
			el: ".toy_bear",
		});
</script>


</body>
</html>