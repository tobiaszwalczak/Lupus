<?php

class Database
{
	public static function create($tablename, $fields)
	{
		$fieldsnum = count($fields);
		$sql 	   = "CREATE TABLE $tablename(id int(11) NOT NULL AUTO_INCREMENT, ";

		foreach($fields as $field)
		{
			$fieldsnum --;
			$field = explode(":", $field);
			$name  = $field[0];
			$type  = $field[1];
			$sql  .= "$name $type";
			
			if ($fieldsnum > 0) $sql .= ", ";
		}

		$sql  .= ", created_at datetime, updated_at datetime, PRIMARY KEY(id))";
		$query = mysql_query($sql);

		if ($query) echo "\n Migration successful.\n\n";
	}

	public static function drop($tablename)
	{
		$query = mysql_query("DROP TABLE $tablename");

		if ($query) echo "\n Rollback successful.\n\n";
	}

	public static function query($sql)
	{
		$query = mysql_query($sql);

		return $query;
	}
}

?>