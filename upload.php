<?php
include 'Db.php';
$img_name = $_FILES['img']['name'];
$img_tmp = $_FILES['img']['tmp_name'];
$uid = $_POST['id'];

$upload = Db::upload_img($img_name,$img_tmp, $uid);
	if ($upload) {
		echo "
			<script>
					window.location.href = 'profile.php?id=".$uid."'
			</script>";
	}
	else{
		echo "Please upload image only";
	}

?>
