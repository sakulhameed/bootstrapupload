<?php
/*print_r($_POST);
exit;*/
if(isset($_POST['allsizeimages']))
{
	$allsizeimages = $_POST['allsizeimages'];

	$imgcount = 5;
	
	//Store all size image
	for($img = 0; $img < count($allsizeimages); $img++)
	{
		$imgcount = 5+$img;
		
		
		//echo $allsizeimages[$imgcount."x".$imgcount]."<br/>";
		
		$directory_name = $imgcount."x".$imgcount."/";
		
		$image_namee = $imgcount."x".$imgcount;
		
		$cropped_image = $allsizeimages[$image_namee];	
		
		store_crop_image($cropped_image,$directory_name,$image_namee);
		
	}
	
	//store crop image
	if(isset($_POST['crop_image']))
	{
		$crop_image = $_POST['crop_image'];
		
		store_crop_image($crop_image,'crop_image/','crop_image');
	}
	
	//store original image
	if(isset($_POST['original_image']))
	{
		$original_image = $_POST['original_image'];
		
		store_crop_image($original_image,'original_image/','org_img');
	}	
	
		
}

	//Store Crop image
	function store_crop_image($cropped_image,$directory_name,$image_namee)
	{
			if (!file_exists($directory_name)) {
				mkdir($directory_name, 0777, true);
			}									
				
			$pos  = strpos($cropped_image, ';');
			
			$image_type_array = explode(':', substr($cropped_image, 0, $pos));
			
			$image_ext = explode('/',$image_type_array[1]);				
			
			$img_string = strtotime(date('Y-m-d H:i:s'))."-".$image_namee; 	
			
			list($type, $cropped_image) = explode(';', $cropped_image);
			list(, $cropped_image)      = explode(',', $cropped_image);
			$data = base64_decode($cropped_image);
			
			file_put_contents($directory_name.$img_string.'.'.$image_ext[1], $data);
	}
?>