<!DOCTYPE html>
<html lang = "en-US">
 <head>
 <meta charset = "UTF-8">
 <title>homework3.php</title>
 <style type = "text/css">
  table, th, td {border: 5px solid green};
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
	$sql = array();
	array_push($sql,'Select employees.emp_no, employees.first_name, employees.last_name, salaries.salary from employees left join salaries on employees.emp_no=salaries.emp_no order by salary DESC limit 5');
	array_push($sql,'Select * from employees left join salaries on employees.emp_no=salaries.emp_no where from_date between \'1981-01-01\' and \'1985-12-31\' order by salary DESC limit 5');
        array_push($sql,'select dept_manager.*,salaries.salary, employees.first_name, employees.last_name, departments.dept_name from dept_manager join departments on departments.dept_no=dept_manager.dept_no join employees on dept_manager.emp_no=employees.emp_no join salaries on salaries.emp_no=employees.emp_no where dept_manager.to_date =\'9999-01-01\' order by salary desc limit 5');
	array_push($sql,'Select * from departments');
	array_push($sql,'Select dept_manager.dept_no, dept_manager.emp_no, employees.first_name, employees.last_name, dept_manager.to_date from dept_manager left join employees on dept_manager.emp_no=employees.emp_no where to_date = \'9999-01-01\'');
	array_push($sql,'select employees.first_name, employees.last_name, salaries.salary from dept_emp left join dept_manager on dept_emp.emp_no =dept_manager.emp_no, employees, salaries where dept_emp.emp_no = employees.emp_no and dept_emp.emp_no=salaries.emp_no and dept_manager.emp_no is NULL and dept_emp.to_date = \'9999-01-01\' order by salary DESC limit 5');
	array_push($sql,'Select * from employees left join salaries on employees.emp_no=salaries.emp_no where to_date=\'9999-01-01\' order by salary ASC limit 5');
	array_push($sql,'Select count(*) from employees left join salaries on employees.emp_no=salaries.emp_no where to_date = \'9999-01-01\'');
	array_push($sql,'select departments.dept_name, sum(salary) from dept_emp join employees on dept_emp.emp_no=employees.emp_no join salaries on employees.emp_no=salaries.emp_no join departments on departments.dept_no=dept_emp.dept_no where dept_emp.to_date =\'9999-01-01\' group by dept_name');
	array_push($sql,'Select sum(salary) from salaries where to_date=\'9999-01-01\'');	
	
	$x = count($sql);
	$indexNum =0;
	While ($indexNum<$x)
	{
		echo 'question ';
		echo $indexNum+1;
		print "<table> \n";
		$result = $connect->query($sql[$indexNum]);

		$row = $result->fetch(PDO::FETCH_ASSOC);
			print " <tr> \n";
				foreach ($row as $columnName => $value)
			{
				print " <th>$columnName</th> \n";
			} 
		print " </tr> \n";

		$data = $connect->query($sql[$indexNum]);
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
		echo '<br>';
		$indexNum++;
	}
}
catch(PDOException $e) 
{
   echo 'ERROR: ' . $e->getMessage();
}
 ?>
 </p>
 </body>
</html>

