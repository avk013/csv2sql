function import_csv(
		$table, 		// Имя таблицы для импорта
		$afields, 		// Массив строк - имен полей таблицы
		$filename, 	 	// Имя CSV файла, откуда берется информация 
					// (путь от корня web-сервера)
		$delim=',',  		// Разделитель полей в CSV файле
		$enclosed='"',  	// Кавычки для содержимого полей
		$escaped='\\', 	 	// Ставится перед специальными символами
		$lineend='\\r\\n',   	// Чем заканчивается строка в файле CSV
		$hasheader=FALSE){  	// Пропускать ли заголовок CSV

	if($hasheader) $ignore = "IGNORE 1 LINES ";
	else $ignore = "";
	$q_import = 
	"LOAD DATA INFILE '".
		$_SERVER['DOCUMENT_ROOT'].$filename."' INTO TABLE ".$table." ".
	"FIELDS TERMINATED BY '".$delim."' ENCLOSED BY '".$enclosed."' ".
	"    ESCAPED BY '".$escaped."' ".
	"LINES TERMINATED BY '".$lineend."' ".
	$ignore.
	"(".implode(',', $afields).")"
	;
		return mysql_query($q_import);
	}
