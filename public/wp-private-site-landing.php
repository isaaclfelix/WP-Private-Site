<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	
	<style>
		.wp-private-site {
			display: -moz-flex;
			display: -webkit-flex;
			display: flex;
			
			-moz-align-items: center;
			-webkit-align-items: center;
			align-items: center;
			
			-moz-justify-content: center;
			-webkit-justify-content: center;
			justify-content: center;
			
			text-align: center;
			
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			
			font-family: "Open Sans", sans-serif;
		}
		.column {
			display: -moz-flex;
			display: -webkit-flex;
			display: flex;
			
			-moz-flex-flow: column;
			-webkit-flex-flow: column;
			flex-flow: column;
		}
		h1 {
			margin: 0;
			padding: 0;
			font-weight: 400;
		}
		h3 {
			font-weight: 400;
			margin: 10px 0;
		}
	</style>
</head>
<body>
	<div class="wp-private-site">
		<div class="column">
		<h1><?php echo __('This website is <strong>private</strong>','wp-private-site'); ?></h1>
		<h3><?php echo __('But will become public soon','wp-private-site'); ?></h3>
		</div>
	</div>
</body>
</html>