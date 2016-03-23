<?php
	
	if (isset($_FILES['myimage']['tmp_name']))
		{						
			$upload = "../media/catalog/product/". $_FILES['myimage']['name'];
			move_uploaded_file($_FILES['myimage']['tmp_name'], $upload);
		}
		/*cobadong*/
		//echo 'hallo';
?>

<!-- End of file receiver.php -->
<!-- Location: ./htdocs/coba/receiver.php -->