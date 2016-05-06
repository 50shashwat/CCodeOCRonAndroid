<?php

//converting base64 string from android to image
$image = base64_decode($_POST['uploadedfile']);
                
$timestamp = "ocr".rand(100,2000000);
$fp = fopen('upload/'.$timestamp.'.jpg','wb+');
$filename = $timestamp.'.jpg';
fwrite($fp,$image);
fclose($fp);


//setting some path
$photo_upload_path = "./upload/";
$photo_upload_path = $photo_upload_path. $filename; 

$processed_photo_output_path = "./output/processed_";
$processed_photo_output_path = $processed_photo_output_path. $filename; 

$processed_code_output_path = "./output/code_";
$processed_code_output_path = $processed_code_output_path. $filename; 

$downloadFileName = 'code_' . $filename.".txt"; 


//setting php settings
ini_set('upload_max_filesize', '10M');  
ini_set('post_max_size', '10M');  
ini_set('max_input_time', 300);  
ini_set('max_execution_time', 300);  

	$command = "matlab -nojvm -nodesktop -nodisplay -r \"Preprocess('$photo_upload_path','$processed_photo_output_path');exit\"";

  exec($command);
  while (1) {
  	if(file_exists($processed_photo_output_path)){
  		break;
  	}
  }

  $command = "tesseract $processed_photo_output_path $processed_code_output_path -l eng";

  exec($command);

  $processed_code_output_path = $processed_code_output_path . ".txt";
  $post_processed_code = "./output/post_processed_". $filename;

    while (1) {
  	if(file_exists($processed_code_output_path)){
  		break;
  	}
  }
  $command = "py PostBeforeAdjust.py $processed_code_output_path $post_processed_code";
  exec($command);

	$myfile = fopen($processed_code_output_path, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($processed_code_output_path));
	fclose($myfile);


	//from above php 5.4 , thread concept was included so that all i/o operations would work as thread. 
	//but our task are dependent previous task 

	


?>



