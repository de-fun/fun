<?php
require SYSDIR.COFDIR.'conn.php';
class funModel
{
	function __construct()
	{
	
	}
	
	/*按照给定的表和查询条件，返回所有符合条件的行*/
	function fetchAll($table, $sql='', $para='*')
	{
		$result = mysql_query('SELECT '.$para.' FROM '.$table.' '.$sql);
		while($row = mysql_fetch_array($result))
			$data[] = $row;
		return $data;
	}
	
	/*按照给定的表和查询条件，返回符合条件的第一行*/
	function fetchRow($table, $sql='', $para='*')
	{
		$result = mysql_query('SELECT '.$para.' FROM '.$table.' '.$sql.' LIMIT 1');
		$row = mysql_fetch_array($result);
			return $row;
	}
	
	/*插入数据*/
	function insert($table, $array_insert)
	{
		
		$columns = '';
		$values = '';
		$i = 0;
		
		foreach($array_insert as $key=>$value)
		{
			$i++;
			if($i == 1)
			{	
				$columns = $columns.$key;
				$values = $values.'\''.$value.'\'';
			}
			else
			{
				$columns = $columns.','.$key;
				$values = $values.',\''.$value.'\'';
			}	
		}
		
		mysql_query('INSERT INTO '.$table.' ('.$columns.') VALUES ('.$values.')');
	}
	
	/*删除符合条件的数据*/
	function delete($table, $array_delete)
	{
		$sql = '';
		$i = 0;
		foreach($array_delete as $where=>$value)
		{
			$i++;
			if($i == 1)
				$sql = $sql.$where.'=\''.$value.'\'';
			else
				$sql = $sql.' AND '.$where.'=\''.$value.'\'';
		}

		mysql_query('DELETE FROM '.$table.' WHERE '.$sql);
	}
	
	/*更新符合条件的已有的数据*/
	function update($table,$col,$sql)
	{	foreach($col as $key=>$value)
			mysql_query('UPDATE '.$table.' SET '.$key.' = \''.$value.'\' WHERE '.$sql);
	}
}