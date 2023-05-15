<?php
 include_once 'header_user.php';
?>

<?php
//including the database connection file
include_once("database.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['id']." ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="add.html">Add New Data</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<table width='80%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>title</td>
			<td>content</td>
			<td>date</td>
		</tr>
		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr>";
			echo "<td>".$res['title']."</td>";
			echo "<td>".$res['content']."</td>";
			echo "<td>".$res['date']."</td>";	
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		}
		?>
	</table>	
</body>
</html>