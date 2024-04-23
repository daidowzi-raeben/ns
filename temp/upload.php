<?php
	
	echo $_POST['pdf'];
	/*
	move_uploaded_file(
		$_FILES['pdf']['tmp_name'], 
		$_SERVER['DOCUMENT_ROOT'] . "/temp/test.pdf"
	);
	*/
	
	//$fdata = $_POST['pdf'];
	//echo $data = base64_decode($fdata);
	
	/*
	if($fdata)){
		$data = base64_decode($fdata);
		$file = $_SERVER['DOCUMENT_ROOT'] . '/temp/test.pdf';
		file_put_contents($file, $data);
		
		$fname = "test.pdf"; // name the file
		$file = fopen($_SERVER['DOCUMENT_ROOT']. "/temp/" . $fname, 'w'); // open the file path
		fwrite($file, $data); //save data
		fclose($file);
		
		echo $file;
	} else {
		echo "No Data Sent";
	}
	*/
?>