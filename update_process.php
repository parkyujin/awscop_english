<?php
	$conn=mysqli_connect('localhost','pj-user','1234','awscop');

	settype($_GET['id'], 'integer');

	$basic=$_POST['basic'];
	$extra=$_POST['extra'];

	if ($basic <= 2000000){
		$tax=0.01;
	}
	elseif ($basic <= 4000000) {
		$tax=0.02;
	}
	else {
		$tax=0.03;
	}

	$salary=($basic+$extra)*(1-$tax);

	$filtered=array(
		'id' => mysqli_real_escape_string($conn, $_GET['id']),
		'name' => mysqli_real_escape_string($conn, $_POST['name']),
		'position' => mysqli_real_escape_string($conn, $_POST['position']),
	);

	$sql="
		UPDATE employee_salary
		SET name='{$filtered['name']}',position='{$filtered['rank']}',base_pay=$basic,extra_pay=$extra,tax_rate=$tax,salary=$salary
		WHERE id='{$filtered['id']}';
		"
	;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>AWSCOP</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="page">
	<div id="header">
		<div id="logo">
			<a href="index.php"><img src="images/logo.png" alt="LOGO"></a>
		</div><!--logo-->
		<ul id="navigation">
			<li><a href="create.php">Resistration</a></li>
			<li><a href="print.php">View/Modify</a></li>
		</ul><!--navigation-->
	</div><!--header-->
	<div id="contents">
		<?php
			$result=mysqli_query($conn, $sql);
			if($result === false) {
				echo 'There was an error in editing the article. Please contact your administrator.';
				echo error_log(mysqli_error($conn));
			} else {
				header('Location: print.php');
			}
		?>
	</div><!--contents-->
	<div id="footer">
		<div id="links">
			<li>
				<h4>When Something Wrong</h4>
				<ul>
					<li>TEL : 0212345678</li>
					<li>E-MAIL : aws123@gmail.com</li>
				</ul>
			</li>
			<li>
				<h4>Social Links</h4>
				<ul id="connect">
					<li>
						<a href="https://twitter.com/" target="_blank">Twitter</a>
					</li>
					<li>
						<a href="https://www.facebook.com/" target="_blank">Facebook</a>
					</li>
				</ul><!--connect-->
			</li>
		</div><!--links-->
		<p class="footnote">
			© 2020. Hong Su Min all rights reserved.
		</p>
	</div><!--footer-->
	</div><!--page-->
</body>
</html>