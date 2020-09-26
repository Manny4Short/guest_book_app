
	
	<body>
		<?php 
		include 'header.php';
		include 'database.php';
		?>
        
        
		<?php 
		$sql = "SELECT id, firstname, surname , logged_in, gender, mobile_no FROM guestlist  ";
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
			 <?php echo '</tr>'?>							
		<?php }  ?> 
		</table>				
		<?php include 'footer.php';  ?>
		
	</body>
</html>
