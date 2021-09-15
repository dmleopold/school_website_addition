<?php
	if (!isset($_COOKIE['id'])) {
		exit();
	}
	$id = $_COOKIE['id'];
	$file_to_delete = $_POST['delete-text'];
	if (!$file_to_delete || $file_to_delete == "." || $file_to_delete == "..") {
		$file_to_delete = "nofile";  // just do nothing
	} else {
		if (file_exists("../files/".$id)) {
			$files_allow_to_delete = scandir("../files/".$id);
			if (in_array($file_to_delete, $files_allow_to_delete)) {
				unlink("../files/".$id."/".$file_to_delete);
			}
		}
	}

	header("Location: /#my-work-section__title");
?>