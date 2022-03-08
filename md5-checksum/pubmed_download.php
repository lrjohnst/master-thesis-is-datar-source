<?php
	function pubmed_download($local_file, $server_file) {
		
		/* https://www.w3schools.com/php/func_ftp_get.asp */
		$ftp_server = "ftp.ncbi.nlm.nih.gov";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, "anonymous", "");
		ftp_pasv($ftp_conn, true);
		// download server file
		if(ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY)) {
			$result = "Successfully written to $local_file.";
		}
		else {
		  $result = "Error downloading $server_file.";
		}

		// Finish up
		ftp_close($ftp_conn);
		return $result;
	}
	
	//echo pubmed_download("C:/Users/lrjoh/Downloads/PubMed/pubmed22n0210.xml.gz", "/pubmed/baseline/pubmed22n0210.xml.gz"); // Debugging
?>