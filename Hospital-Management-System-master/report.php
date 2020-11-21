<?php 
include('func1.php');
$con=mysqli_connect("localhost","root","","myhmsdb");
$doctor = $_SESSION['dname'];
if(isset($_GET['cancel']))
  {
    $query=mysqli_query($con,"update appointmenttb set doctorStatus='0' where ID = '".$_GET['ID']."'");
    if($query)
    {
      echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
  }

?>
<?php
$pid = $_GET['pid'];
$sql= "SELECT * FROM testtb WHERE id = '$pid'";
$run = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($run);
?>
<?php echo $data['disease']; ?>
<?php echo $data['allergy']; ?>
<?php echo $data['prescription']; ?>
<!--form method="post" action="booknow.php" enctype="multipart/form-data">
	<table>
<tr>
			<td> Train name</td> <td><input type="text" readonly="readonly" name="Tname" value= <?php echo $data['Tname']; ?> required></td>
		</tr>

		<tr>
			<td> Name</td> <td><input type="text" name="name" placeholder="Enter Name" required></td>
		</tr>


		<tr>
			<td>Age</td> <td><input type="text" name="age" placeholder="Enter Age" required></td>
		</tr>


		<tr>
			<td>Gender</td> <td><select name="gender" required>
				<option selected> Gender</option>
				<option>Male</option>
				<option>Female</option>
				<option>Others</option>
							</select></td>
		</tr>


			<tr><td colspan="2">
					<input type="hidden" name="sid" value="<?php echo $data['id']; ?>">
			<input type="submit" name="submit" value="submit"></td></tr>




	</table>
	

</form>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
	include('dbcon.php');
	
	$name = $_POST['name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$tname = $_POST['Tname'];
	

$qry = " INSERT INTO passenger (name, age, gender, Tname) VALUES ('$name','$age','$gender','$tname') ";

$run = mysqli_query($con,$qry);

if($run == true){
	?>

	<script>
				alert('Passenger added Successfuly');
	</script>

	<?php
}
else
{
	echo "there is some error!!";
}
}
?>

<table>
	<tr>
		<th>No</th>
		<th>Train No</th>
		<th>Train Name</th>
		<th>Source</th>
		<th>Destination</th>
		<th>Action</th>
	</tr>


	<?php

if (isset($_POST['submit'])) {

include('dbcon.php');

$name = $_POST['name'];
$Tname = $_POST['Tname']; 

$sql = "SELECT * FROM passenger WHERE name = '$name' &&  Tname LIKE '%$Tname%'";
$run = mysqli_query($con,$sql);
$row = mysqli_num_rows($run);

	if ($row<1) {
		# code...
		echo "<tr><td colspan='4'>No Record found</td></tr>";
	}
		else 
		{
			$count = 0;
			while ($data = mysqli_fetch_assoc($run)) {
				$count++;
			?>
					<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $data['name']; ?></td>
		<td><?php echo $data['Tname']; ?></td>
		<td><?php echo $data['age']; ?></td>
		<td><?php echo $data['gender']; ?></td>
		<td><a href="bookprint.php?sid=<?php echo $data['id'];?>">Pay</a></td>
	</tr>
			<?php
			}
		}
}

?>
</table>




