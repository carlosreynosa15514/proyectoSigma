<?php
    // opens a new file to write
	$data_file = fopen("example.txt", "a");
    $name = "";
    $age = "";

    $name = $_POST["nombre"];
	$age = $_POST["age"];
	$text_to_write = $name . "," . $age . "\n";

	// Write data to server side file;
	fwrite($data_file, $text_to_write);
	fclose($data_file);
?>
