<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>



	<div class="jumbotron">

		<?php
		$email = $_GET['email'];
		$code = $_GET['code']; 
		?>
			<h3 class="text-center"><?php echo $email; ?></h3>
			<h3 class="text-center"><?php echo $code; ?></h3>

		<?php

		$query = "SELECT * FROM users WHERE email='$email'";

		$result = query($query);

		if($result){

			$row = fetch_array($result);

			$validation_code = $row['validation_code'];

			if($validation_code == $code){
				$status = "Account verification successfull";
				//update active status to 1

				
			}else{
				$status = "Account verification failed";
			}

		}
		?>
		<h1 class="text-center"><?php echo $status; ?></h1>
		

	</div>



<?php include "includes/footer.php"; ?>
