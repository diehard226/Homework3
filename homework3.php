<?php



error_reporting(-1);

ini_set('display_errors', 'On');

$hostname = 'mysql:host=localhost; dbname=employees';
$user = 'root';
$pass = 'alexhong';
$connect = new PDO ($hostname,$user,$pass);


$sql = 'Select * from employees left join salaries on employees.emp_no=salaries.emp_no order by salary DESC limit 5';

foreach($connect->query($sql) as $row) {

print_r($row);



}

print_r($connect);




?>
