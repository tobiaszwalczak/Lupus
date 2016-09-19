<?php

class BaseModel
{
	public static function insert($values)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else $table = str_replace("_", "", get_called_class());

		$db 			= DB_NAME;
		$column_query 	= mysql_query("SELECT COUNT( * ) AS COLUMNS FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '$db' AND table_name =  '$table'"); 
		$column_num 	= mysql_fetch_row($column_query)[0] - 3; 

		$date 		= new DateTime();
		$datetime 	= $date->format('Y-m-d H:i:s');

		$sql = "INSERT INTO $table VALUES(''";

		for($i = 0; $i < $column_num; $i++)
		{
			$sql .= ", '". $values[$i] ."'";
		}

		$sql  .= ", '$datetime', '$datetime');";
		$query = mysql_query($sql);

		if($query) return true;
	}

	public static function all($orderby = false, $order = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$sql = "SELECT * FROM $table";

		if ($orderby) $sql .= " ORDER BY $orderby";
		if ($order)   $sql .= strtoupper(" $order");

		$query  = mysql_query($sql);
		$result = array();

		while ($row = mysql_fetch_object($query))
		{
			$result[] = $row;
		}

		return $result;
	}

	public static function find($args, $orderby = false, $order = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$result = array();

		if (!is_array($args))
		{
			$sql = "SELECT * FROM $table WHERE id = $args";

			if ($orderby) $sql .= " ORDER BY $orderby";
			if ($order)   $sql .= strtoupper(" $order");

			$sql   .= " LIMIT 1";
			$query 	= mysql_query($sql);
			$object = mysql_fetch_object($query);
			return $object;
		}
		else
		{
			$itemnum 	= count($args);
			$sql 		= "SELECT * FROM $table WHERE ";

			foreach ($args as $key => $value)
			{
				$itemnum --;
				$sql .= "$key = '$value'";

				if ($itemnum > 0) $sql .= " AND ";
			}
		}

		if ($orderby) $sql .= " ORDER BY $orderby";
		if ($order)   $sql .= strtoupper(" $order");

		$query = mysql_query($sql);

		while ($row = mysql_fetch_object($query))
		{
			$result[] = $row;
		}

		return $result;	
	}

	public static function first($args, $orderby = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$result = array();

		if (!is_array($args))
		{
			$sql 	= "SELECT * FROM $table WHERE id = $args";

			if ($orderby) $sql .= " ORDER BY $orderby";
			else 		  $sql .= " ORDER BY id";

			$sql   .= " ASC LIMIT 1";
			$query 	= mysql_query($sql);
			$object = mysql_fetch_object($query);
			return $object;
		}
		else
		{
			$itemnum 	= count($args);
			$sql 		= "SELECT * FROM $table WHERE ";

			foreach ($args as $key => $value)
			{
				$itemnum --;
				$sql .= "$key = '$value'";

				if ($itemnum > 0) $sql .= " AND ";
			}
		}

		if ($orderby) $sql .= " ORDER BY $orderby";
		else 		  $sql .= " ORDER BY id";

		$sql  .= " ASC LIMIT 1";
		$query = mysql_query($sql);

		while ($row = mysql_fetch_object($query))
		{
			$result[] = $row;
		}

		foreach ($result as $result){}

		return $result;
	}

	public static function last($args, $orderby = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$result = array();

		if (!is_array($args))
		{
			$sql = "SELECT * FROM $table WHERE id = $args";

			if ($orderby) $sql .= " ORDER BY $orderby";
			else 		  $sql .= " ORDER BY id";

			$sql   .= " DESC LIMIT 1";
			$query 	= mysql_query($sql);
			$object = mysql_fetch_object($query);
			return $object;
		}
		else
		{
			$itemnum 	= count($args);
			$sql 		= "SELECT * FROM $table WHERE ";

			foreach ($args as $key => $value)
			{
				$itemnum --;
				$sql .= "$key = '$value'";

				if ($itemnum > 0) $sql .= " AND ";
			}
		}

		if ($orderby) $sql .= " ORDER BY $orderby";
		else 		  $sql .= " ORDER BY id";

		$sql  .= " DESC LIMIT 1";
		$query = mysql_query($sql);

		while ($row = mysql_fetch_object($query))
		{
			$result[] = $row;
		}

		foreach ($result as $result){}

		return $result;
	}

	public static function like($args, $orderby = false, $order = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$result  = array();
		$itemnum = count($args);
		$sql 	 = "SELECT * FROM $table WHERE ";

		foreach ($args as $key => $value)
		{
			$itemnum --;
			$sql .= "$key LIKE '%$value%'";

			if ($itemnum > 0) $sql .= " AND ";
		}

		if ($orderby) $sql .= " ORDER BY $orderby";
		if ($order)   $sql .= strtoupper(" $order");

		$query = mysql_query($sql);

		while ($row = mysql_fetch_object($query))
		{
			$result[] = $row;
		}

		return $result;	
	}

	public static function num($args = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$result = array();

		if (!$args)
		{
			$sql 	= "SELECT * FROM $table";
			$query 	= mysql_query($sql);
			$num 	= mysql_num_rows($query);
			return $num;
		}
		elseif (!is_array($args))
		{
			$sql 	= "SELECT * FROM $table WHERE id = $args LIMIT 1";
			$query 	= mysql_query($sql);
			$num 	= mysql_num_rows($query);
			return $num;
		}
		else
		{
			$itemnum 	= count($args);
			$sql 		= "SELECT * FROM $table WHERE ";

			foreach ($args as $key => $value)
			{
				$itemnum --;
				$sql .= "$key = '$value'";

				if ($itemnum > 0) $sql .= " AND ";
			}
		}

		$query = mysql_query($sql);
		$num   = mysql_num_rows($query);

		return $num;	
	}

	public static function update($args, $values)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$sql 	  = "UPDATE $table SET ";
		$argsnum  = count($args);
		$itemnum  = count($values);

		$date 	  = new DateTime();
		$datetime = $date->format('Y-m-d H:i:s');

		foreach ($values as $key => $value)
		{
			$itemnum --;
			$sql .= "$key = '$value'";

			if ($itemnum > 0) $sql .= ", ";
		}

		$sql  .= ", updated_at = '$datetime' WHERE ";

		if (!is_array($args))
		{
			$sql 	.= "id = $args";
		}
		else
		{
			foreach ($args as $key => $value)
			{
				$argsnum --;
				$sql .= "$key = '$value'";

				if ($argsnum > 0) $sql .= " AND ";
			}
		}

		$query = mysql_query($sql);

		if ($query) return true;
	}

	public static function delete($args = false)
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		if (!$args)
		{
			$sql = "DELETE FROM $table";
		}
		elseif (!is_array($args))
		{
			$sql = "DELETE FROM $table WHERE id = $args LIMIT 1";
		}
		else
		{
			$itemnum 	= count($args);
			$sql 		= "DELETE FROM $table WHERE ";

			foreach ($args as $key => $value)
			{
				$itemnum --;
				$sql .= "$key = '$value'";

				if ($itemnum > 0) $sql .= " AND ";
			}
		}

		$query = mysql_query($sql);

		if ($query) return true;
	}

	public static function truncate()
	{
		if (strpos(get_called_class(), "_") === false) $table = strtolower(get_called_class()) ."s";
		else 										   $table = str_replace("_", "", get_called_class());

		$query = mysql_query("TRUNCATE TABLE $table");
	}
}

?>