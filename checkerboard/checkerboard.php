<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP fundamentals - Advanced 2</title>

	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		td{
			padding: 10px;
			background-color: red;
		}
		.alt{
			background-color: black;
		}
		.slider{
			width: 60px;
		}
		fieldset{
			width: 160px;
		}
		ul{
			float: left;
		}
		li{
			margin: 10px;
			list-style: none;
		}
		#red .ui-slider-range{
			background: red;
		}
		#blue .ui-slider-range{
			background: blue;
		}
		#green .ui-slider-range{
			background: green;
		}
	</style>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

	<script type="text/javascript">
		$(document).ready(function(){
			$('.slider').slider({
				range: "min",
				max: 255,
				value: 0,
				slide: function(event, ui){
					update_color($(this).parent().attr("class"));
				}
			});
			function update_color (which_cells) {
				which_cells = "."+which_cells;
				var r = $(which_cells+' #red').slider("value");
				var g = $(which_cells+' #green').slider("value");
				var b = $(which_cells+' #blue').slider("value");
				// console.log(r+" "+g+" "+b);
				if (which_cells == ".main_color_slider"){
					$('td').css("background-color", "rgb("+r+","+g+","+b+")");
					r += 50;
					g += 50;
					b += 50;
					$('.alt').css("background-color", "rgb("+r+","+g+","+b+")");
				}else{
					$('.alt').css("background-color", "rgb("+r+","+g+","+b+")");
				}
			}

			$('form').on('submit', function(){
				var r = Math.floor(Math.random()*255);
				var g = Math.floor(Math.random()*255);
				var b = Math.floor(Math.random()*255);

				$('td').css("background-color", $('#main_color').val() == "random" ? "rgb("+r+","+g+","+b+")" : $('#main_color').val());
				if ($('#alt_color').val() == "random"){
					r = Math.floor(Math.random()*255);
					g = Math.floor(Math.random()*255);
					b = Math.floor(Math.random()*255);
					$('.alt').css("background-color", "rgb("+r+","+g+","+b+")");
				}else if ($('#alt_color').val() == ""){
					r += 50;
					g += 50;
					b += 50;
					$('.alt').css("background-color", "rgb("+r+","+g+","+b+")");
				}else{
					$('.alt').css("background-color", $('#alt_color').val());
				}

				return false;
			});
		});
	</script>
</head>
<body>
	<table>
<?php for ($row=0; $row < 8; $row++): ?>
		<tr>
<?php 	for ($col=0; $col < 8; $col++): ?>
			<td <?= ($row+$col)%2 ? "class= 'alt'" : "" ?>></td>
<?php 	endfor; ?>
		</tr>
<?php endfor; ?>
	</table>
	<form id="color_form">
		<fieldset>
			<legend>main color</legend>
			<input type="text" name="main_color" id="main_color" placeholder="#ff0000" />
			<ul class="main_color_slider">
				<li class="slider" id="red"></li>
				<li class="slider" id="green"></li>
				<li class="slider" id="blue"></li>
			</ul>
		</fieldset>
		<fieldset>
			<legend>alt color</legend>
			<input type="text" name="alt_color" id="alt_color" placeholder="#000000" />
			<ul class="alt_color_slider">
				<li class="slider" id="red"></li>
				<li class="slider" id="green"></li>
				<li class="slider" id="blue"></li>
			</ul>
		</fieldset>
		
		<input type="submit" value="Change Colors" />
	</form>
</body>
</html>