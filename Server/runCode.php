<?php

$code = $_POST['code'];

$file_name1 = rand(1000,10000000).".c";
$file_name="./exe/".$file_name1;

$file = fopen($file_name,"w");
fwrite($file,$code);
fclose($file);

while (1) {
		if (file_exists($file_name)) {
			break;
		}
	}
	$fname = rand(0,100000000);
	$exe_path = "./exe/exe_".$fname;
	$result_path = "./result/output_".$file_name1.".txt";


  // Compile the uploaded code
  $command = "gcc -o $exe_path $file_name";
  exec($command);

	while (1) {
		if (file_exists($exe_path.".exe")) {
			break;
		}
		sleep(1);
	}  
	$exe_path = str_replace("./", "", $exe_path);
	$exe_path = str_replace("/", "\\", $exe_path);
  // Run the code
  $command = "$exe_path.exe > $result_path";
  exec($command);

  while (1) {

		if (file_exists($result_path)) {
			break;
		}
		sleep(1);
	}

	$myfile = fopen($result_path, "r") or die("Unable to open file!");
	echo fread($myfile,1000);
	fclose($myfile);

