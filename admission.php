<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("location:login.php");
}
elseif($_SESSION['usertype'] === 'student'){
    header("location:login.php");
}

$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host,$user,$password,$db);

$sql ="SELECT * from admission";

$result = mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>

    <?php 
       
        include 'admin_css.php';
    ?>

</head>
<body>
    

	<?php 
       
        include 'admin_sidebar.php';
    ?>

	

	<div class="content">
      <Center>		
		<h1>Applied ForAdmission </h1>
        <br>

        <table border="1px">
            <tr>
                <th style="padding: 20px; font-size: 15px;">name</th>
                <th style="padding: 20px; font-size: 15px;">email</th>
                <th style="padding: 20px; font-size: 15px;">phone</th>
                <th style="padding: 20px; font-size: 15px;">message</th>
            </tr>

            <?php
              while($info = $result -> fetch_assoc())
              {
            ?>

            <tr>
                <td style="padding: 20px;"> <?php echo "{$info['name']}"; ?> </td>
                <td style="padding: 20px;"><?php echo "{$info['email']}"; ?></td>
                <td style="padding: 20px;"><?php echo "{$info['phone']}"; ?></td>
                <td style="padding: 20px;"><?php echo "{$info['message']}"; ?></td>
            </tr>

            <?php
              }

            ?>
            
        </table>
    </Center>
	</div>

</body>
</html>

