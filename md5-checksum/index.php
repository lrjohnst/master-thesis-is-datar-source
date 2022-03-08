<table>
<?php
	require_once("pubmed_download.php");
	for($i = 1; $i <= 1114; $i++) {
		$match = false;
		echo "<tr>";
		$filepath = "C:/Users/lrjoh/Downloads/PubMed/";
		$file = "pubmed22n" . sprintf("%04d", $i) . ".xml.gz";
		
		$md5_file_contents = file_get_contents($filepath . "pubmed22n" . sprintf("%04d", $i) . ".xml.gz.md5");
		$md5_file_contents_exploded = explode("= ", $md5_file_contents);
		$md5checksum = trim($md5_file_contents_exploded[1]);
		echo "<td>" . $md5_file_contents_exploded[0] . "</td>";
		echo "<td>" . $md5checksum . "</td>";
		
		$filename = $filepath . "pubmed22n" . sprintf("%04d", $i) . ".xml.gz";
		$md5file = trim(md5_file($filename));
		echo "<td>" . $md5file . "</td>";
		
		if(strcmp($md5checksum, $md5file) == 0) {
			echo "<td><span style='color:green;'>V</span></td>";
		}
		else {
			echo "<td><span style='color:red;'>X</span></td>";
			echo "<td>" . strcmp($md5checksum, $md5file) . "</td>";
			echo "<td>" . pubmed_download($filename, "/pubmed/baseline/" . $file) . "</td>";
		}
		echo "</tr>";
	}
?>
</table>