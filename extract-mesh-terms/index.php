<?php
	$i = 0;
	$term_list = "";

	/* Read XML-file into memory */
	$filepath = "C:/Users/lrjoh/Downloads/MeSH/";
	$filename = "desc2022.xml";
	$file_contents = file_get_contents($filepath . $filename);
	
	/* Parse the XML */
	$xml_array = simplexml_load_string($file_contents);	
	foreach($xml_array as $xml_element) {
		// if($i < 11) {
			//file_put_contents($filepath . "term_" . $i . ".txt", print_r($xml_element, true));
			//file_put_contents($filepath . "term_" . $i . ".txt", $xml_element->DescriptorName->String);
			$term_list .= $xml_element->DescriptorName->String . "\n";
		// }
		// else {
			// exit('Ten elements reached.');
		// }
		// $i++;
	}
	file_put_contents($filepath . "term_list.txt", $term_list);