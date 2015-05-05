<!DOCTYPE html>
<html lang = "en-US">
 <head>
 <meta charset = "UTF-8">
 <title>contact.php</title>
 <style type = "text/css">
  table, th, td {border: 1px solid black};
 </style>
 </head>
 <body>
 <p>
 <?php
$hostname ='mysql:host=localhost; dbname=employees';
$user = 'root';
$pass = 'alexhong';
try {
	$connect= new PDO($hostname, $user, $pass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT employees.emp_no, employees.first_name, employees.last_name, salaries.salary from employees left join salaries on employees.emp_no=salaries.emp_no order by salary DESC limit 5";
 
  
	print "<table> \n";
	$result = $connect->query($sql);

	$row = $result->fetch(PDO::FETCH_ASSOC);
		print " <tr> \n";
			foreach ($row as $columnName => $value)
		{
			print " <th>$columnName</th> \n";
		} 
	print " </tr> \n";

	$data = $connect->query($sql);
	$data->setFetchMode(PDO::FETCH_ASSOC);
	foreach($data as $row)
		{
			print " <tr> \n";
			foreach ($row as $name=>$value)
				{
					print " <td>$value</td> \n";
				} 
			print " </tr> \n";
		}
	print "</table> \n";
}
catch(PDOException $e) 
{
   echo 'ERROR: ' . $e->getMessage();
}
 ?>
 </p>
 </body>
</html>

