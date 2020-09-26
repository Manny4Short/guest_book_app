
<?php 
	 include 'header.php';
	 include 'database.php';

?>
			
		<form method="post" action="admin.php" class="database-form">
			<?php if (isset($errors)) { ?>
				<p><?php echo $errors; ?></p>
			<?php } ?>
			
			<input type="text" name="firstname" class="input_guest" placeholder='Enter name'><span>
			<input type="text" name="surname" class="input_guest" placeholder='Enter surname'>			
			<input type="text" name="mobile_no" class="input_guest" placeholder='Enter Mobile Number'>
			<select name="gender" id="" class='input_sex'>
				<OPTION Value="Male">Male</OPTION>
				<OPTION Value="Female">Female</OPTION>
			</select>		
			<button type="submit" name="submit" id="add_btn" class="add_btn"> Add guest</button>
			</span>
		</form>

		<?php 
		$sql = "SELECT id, firstname, surname , logged_in, gender, mobile_no
		FROM guestlist  ";
		$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		
		?>
		<table>
			<tr>
				<th>Index</th>
				<th>Firstname</th>
				<th>Surname</th>
				<th>Log-in Time</th>
				<th>gender</th>				
				<th>mobile_no</th>
				<th>Cancel attendance</th>
			</tr>
		<?php  
		while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){ 			
		?>
			<?php echo '<tr>'?>	
					<?php echo '<td>'. $row['id']. '</td>' ?> 
					<?php echo '<td>'.  $row['firstname'].'</td>' ?> 
					<?php echo '<td>'.  $row['surname'] .'</td>' ?> 
					<?php echo '<td>'.  $row['logged_in'] .'</td>'?> 
					<?php echo '<td>'.  $row['gender'] .'</td>'?> 
					<?php echo '<td>'.  $row['mobile_no'] .'</td>'?> 

				   <td>
						<span class="delete">
							<a href="admin.php?del_guest=
							<?php echo $row['id'] ?>">x</a> 
						</span>
			  		</td>
			 <?php echo '</tr>'?>							
			 <?php }  ?> 
		</table>
		
	
	</body>
</html>