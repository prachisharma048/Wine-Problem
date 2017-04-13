<?php
	require_once("solve_wine_puzzle.php");

	if(isset($_POST['get_result']))
	{
		//print_r($_FILES['file']); die('working');
		echo "Start reading file from here </br></br>";

		$puz_obj = new WinePuzzleSolution("data.txt");
		$puz_obj = new WinePuzzleSolution($_FILES['file']['tmp_name']);


		$puz_obj->getWineList();

		echo "Result is saved in result.txt in same folder";
	}
	else{
?>


<html>
	<head>
		<title>Wine Shop Problem Solution</title>		
	</head>
	<body>
		<form action=" " method="post" enctype="multipart/form-data">
			Select File (Only txt file allow): <input type="file" name="file" accept=".txt" /><br/>
			<input type="submit" name="get_result" value="Get Result" />
		</form>
	</body>
</html>
<?php
	    }

?>