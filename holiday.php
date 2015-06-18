<?php
	include 'connection.php';
	$columnString = "";
	
	//first line extract columnNames
	function setColumnNames($string,$array){
		//firstLine from where we will get the columns name
			global $columnString;
			$columnString = createString1($array);
		}
		
	//data
	//loop it for every line in CSV file
	function insertIntoDatabase($string,$array){
			global $columnString,$tableName;

			$QueryString = createString($array);

			$Query = "Insert into ".$tableName." ".$columnString." values ".$QueryString;
			$result = mysql_query($Query) or die( " asdlhfa ".mysql_error() );
			
			if($result){
				echo "query run successfully\n";
			}
			echo $Query;
		}


	function createString($column){
		$QueryString = "";
		
		foreach ($column as $value) {
			# code...
			$QueryString = $QueryString."'".$value."',";
		}

		$QueryString = rtrim($QueryString,",");
		$QueryString = "(".$QueryString.")";
		
		return $QueryString;
	}

	function createString1($column){
		$QueryString = "";
		
		foreach ($column as $value) {
			# code...
			$QueryString = $QueryString."`".$value."`,";
		}

		$QueryString = rtrim($QueryString, ",");
		$QueryString = "(".$QueryString.")";
		
		return $QueryString;
	}


	function readCSVfile($filename){	
			$column = array();	
			$file = fopen($filename,"r");
			
			$i=0;
			while(! feof($file))
			  {	global $column;
				$column[$i]=fgetcsv($file);
				$i++;
			  }

			$i=0;
			foreach ($column as $array) {
				# code...
				
				if($i!=0){
					
					insertIntoDatabase($string,$array);
					$i++;
				}

				//data line
				else{
					
					setColumnNames($string,$array);
					$i++;
				}
				
			}
	}
$filename = 'test.csv';
readCSVfile($filename);
?>
