<?php
	$i2 = 1;
	$corpus = "id,title,abstract,doi,year,language,chemicals,\n";
	$filepath = "C:/Users/lrjoh/Downloads/PubMed/";
	for($i = 1; $i <= 1114; $i++) {
		$filename = "pubmed22n" . sprintf("%04d", $i) . ".xml.gz";
		$file_contents = gzdecode(file_get_contents($filepath . $filename));
		$xml_array = simplexml_load_string($file_contents);
		foreach($xml_array as $xml_element) {
			$doi = ''; // Reset
			$chemicals = ''; // Reset
			foreach($xml_element->PubmedData->ArticleIdList->ArticleId as $meta_value) {
				if($meta_value['IdType'] == "doi") {
					$doi = $meta_value; 
				}
			}
			if($xml_element->MedlineCitation->ChemicalList->Chemical) {
				foreach($xml_element->MedlineCitation->ChemicalList->Chemical as $chemical) {
					$chemicals .= $chemical->NameOfSubstance . ";";
				}
			}
			$chemicals = rtrim($chemicals, ";");
			$corpus .= 
				$i2 . "," . 
				"\"" . str_replace(["[", "]", ".", "\"", "'"], "", $xml_element->MedlineCitation->Article->ArticleTitle) . "\"," . 
				"\"" . str_replace(["[", "]", ".", "\"", "'"], "", $xml_element->MedlineCitation->Article->Abstract->AbstractText) . "\"," . 
				"\"" . $doi . "\"," . 
				"\"" . $xml_element->MedlineCitation->DateCompleted->Year . "\"," . 
				"\"" . $xml_element->MedlineCitation->Article->Language . "\"," . 
				"\"" . $chemicals . "\"" . 
				"\n";
			$i2++; // Increment
		}
		echo $filename . "," . $i2 . "<br>";
	}
	// file_put_contents($filepath . "test_xml/corpus.csv", $corpus); // Debugging
	// echo "corpus = " . $corpus; // Debugging
	file_put_contents($filepath . "/processed/corpus.csv", $corpus);
	
	
	
	
	
	
	
	
	
	
	/* // Debugging
	$str_xml = '
	<mydata>
	<PubmedArticle>
    <MedlineCitation Status="MEDLINE" Owner="NLM">
      <PMID Version="1">96</PMID>
      <DateCompleted>
        <Year>1976</Year>
        <Month>02</Month>
        <Day>09</Day>
      </DateCompleted>
      <DateRevised>
        <Year>2019</Year>
        <Month>08</Month>
        <Day>27</Day>
      </DateRevised>
      <Article PubModel="Print">
        <Journal>
          <ISSN IssnType="Print">0301-4622</ISSN>
          <JournalIssue CitedMedium="Print">
            <Volume>3</Volume>
            <Issue>4</Issue>
            <PubDate>
              <Year>1975</Year>
              <Month>Oct</Month>
            </PubDate>
          </JournalIssue>
          <Title>Biophysical chemistry</Title>
          <ISOAbbreviation>Biophys Chem</ISOAbbreviation>
        </Journal>
        <ArticleTitle>Polymer concentration dependence of the helix to random coil transition of a charged polypeptide in aqueous salt solution.</ArticleTitle>
        <Pagination>
          <MedlinePgn>323-9</MedlinePgn>
        </Pagination>
        <Abstract>
          <AbstractText>The helix to coil transition of poly(L-glutamic acid) was investigated in 0.05 and 0.005 M aqueous potassium chloride solutions by use of potentiometric titration and circular dichroism measurement. Polymer concentration dependence of the transition was observed in the range from 0.006 to 0.04 monomol/e in 0.005 M KG1 solution. The polymer concentration dependence can be interpreted by current theories of the transition of charged polypeptides and of titration curves of linear weak polyelectrolytes taking the effect of polymer concentration into consideration.</AbstractText>
        </Abstract>
        <AuthorList CompleteYN="Y">
          <Author ValidYN="Y">
            <LastName>Nitta</LastName>
            <ForeName>K</ForeName>
            <Initials>K</Initials>
          </Author>
          <Author ValidYN="Y">
            <LastName>Yoneyama</LastName>
            <ForeName>M</ForeName>
            <Initials>M</Initials>
          </Author>
        </AuthorList>
        <Language>eng</Language>
        <PublicationTypeList>
          <PublicationType UI="D016428">Journal Article</PublicationType>
        </PublicationTypeList>
      </Article>
      <MedlineJournalInfo>
        <Country>Netherlands</Country>
        <MedlineTA>Biophys Chem</MedlineTA>
        <NlmUniqueID>0403171</NlmUniqueID>
        <ISSNLinking>0301-4622</ISSNLinking>
      </MedlineJournalInfo>
      <ChemicalList>
        <Chemical>
          <RegistryNumber>0</RegistryNumber>
          <NameOfSubstance UI="D005971">Glutamates</NameOfSubstance>
        </Chemical>
        <Chemical>
          <RegistryNumber>0</RegistryNumber>
          <NameOfSubstance UI="D010455">Peptides</NameOfSubstance>
        </Chemical>
        <Chemical>
          <RegistryNumber>0</RegistryNumber>
          <NameOfSubstance UI="D012996">Solutions</NameOfSubstance>
        </Chemical>
        <Chemical>
          <RegistryNumber>660YQ98I10</RegistryNumber>
          <NameOfSubstance UI="D011189">Potassium Chloride</NameOfSubstance>
        </Chemical>
      </ChemicalList>
      <CitationSubset>IM</CitationSubset>
      <MeshHeadingList>
        <MeshHeading>
          <DescriptorName UI="D005971" MajorTopicYN="N">Glutamates</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D006863" MajorTopicYN="N">Hydrogen-Ion Concentration</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D008433" MajorTopicYN="N">Mathematics</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D009994" MajorTopicYN="N">Osmolar Concentration</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D010455" MajorTopicYN="Y">Peptides</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D011189" MajorTopicYN="N">Potassium Chloride</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D011199" MajorTopicYN="N">Potentiometry</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D011487" MajorTopicYN="N">Protein Conformation</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D012996" MajorTopicYN="N">Solutions</DescriptorName>
        </MeshHeading>
        <MeshHeading>
          <DescriptorName UI="D013816" MajorTopicYN="N">Thermodynamics</DescriptorName>
        </MeshHeading>
      </MeshHeadingList>
    </MedlineCitation>
    <PubmedData>
      <History>
        <PubMedPubDate PubStatus="pubmed">
          <Year>1975</Year>
          <Month>10</Month>
          <Day>1</Day>
        </PubMedPubDate>
        <PubMedPubDate PubStatus="medline">
          <Year>1975</Year>
          <Month>10</Month>
          <Day>1</Day>
          <Hour>0</Hour>
          <Minute>1</Minute>
        </PubMedPubDate>
        <PubMedPubDate PubStatus="entrez">
          <Year>1975</Year>
          <Month>10</Month>
          <Day>1</Day>
          <Hour>0</Hour>
          <Minute>0</Minute>
        </PubMedPubDate>
      </History>
      <PublicationStatus>ppublish</PublicationStatus>
      <ArticleIdList>
        <ArticleId IdType="pubmed">96</ArticleId>
        <ArticleId IdType="pii">0301-4622(75)80025-1</ArticleId>
        <ArticleId IdType="doi">10.1016/0301-4622(75)80025-1</ArticleId>
      </ArticleIdList>
    </PubmedData>
  </PubmedArticle>
  </mydata>
  ';
  
	$array_xml = simplexml_load_string($str_xml);
	foreach($array_xml as $xml_element) {
		echo "title = " . $xml_element->MedlineCitation->Article->ArticleTitle;
		foreach($xml_element->PubmedData->ArticleIdList->ArticleId as $type) {
			if($type['IdType'] == "doi") {
				echo "doi = " . $type; 
			}
		}
	}*/ // Debugging
?>