<?php
/*
	we need to solve php puzzle for wine list. one person can get as much as 3 wine bottles and wine id should be unique
*/

class WinePuzzleSolution{
	
	/* declare a public variable for accpet wine txt file */
	
	public $wineFileName;

	function __construct($data){
		$this->wineFileName = $data;
	}

	/* select wine id and person id and assign him bottels and write out put in a file */
	
	public function getWineList(){
		
		$personWineList			= array();
		$uniqueWineIdList 		= array();
		$countSoldWine 			= 0;
		$finalWineData 			= array();
		
		/*open txt file for reading data from it*/
		
		$file = fopen($this->wineFileName,"r");
		
		/* get all wine id in a single array */
		
		while (($line = fgets($file)) !== false) {
			$wineDataSingleLine = explode("\t", $line);
			$person_name = trim($wineDataSingleLine[0]);
			$wine_id = trim($wineDataSingleLine[1]);
			if(!array_key_exists($wine_id, $personWineList)){
				$personWineList[$wine_id] = [];
			}
			$personWineList[$wine_id][] = $person_name;
			$uniqueWineIdList[] = $wine_id;
		}
		
		/* close data file after reading data*/
		
		fclose($file);
		
		/* get only id which are unique in list */
		
		$uniqueWineIdList = array_unique($uniqueWineIdList);
		
		/* assign list of wines to person */
		
		foreach ($uniqueWineIdList as $key => $wine) {
			$maxSize = count($wine);
			$counter = 0;

			while($counter<10){
				
				$i = intval(floatval(rand()/(float)getrandmax()) * $maxSize);
				
				$person_name = $personWineList[$wine][$i];
				if(!array_key_exists($person_name, $finalWineData)){
					$finalWineData[$person_name] = [];
				}
				if(count($finalWineData[$person_name])<3){
					$finalWineData[$person_name][] = $wine;
					$countSoldWine++;
					break;
				}
				$counter++;
			}
		}

		$fileToPutData = fopen("result.txt", "w");
		
		foreach (array_keys($finalWineData) as $key => $value) {
			foreach ($finalWineData[$value] as $key1 => $value1) {
				fwrite($fileToPutData, $value." ".$value1."\n");
			}
		}
		fwrite($fileToPutData, "Total wine bottles sold ".$countSoldWine."\n");
		fclose($fileToPutData);
	}
}

?>