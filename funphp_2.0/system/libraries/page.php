<?php
/**
 * 分页类
 */
 
 class page
 {
 	/*范围*/
 	private $pageRange;
	/*分页的总页数*/
	private $pageNumber;
	/*每页记录数*/
	private $perPage;
	/*当前页数*/
	private $current;
	/*显示页数超链接*/
	private $pageEcho;
	/*设置页数对应的URI，即将URI按“/”分成一段段中的第几段，默认第4段*/
	private $pageUri;
	
	private $autonomous;
	
	function __construct()
	{
		/*设置页数对应的URI，即将URI按“/”分成一段段中的第几段，默认第4段
		当更改时需在function getPageRange增加相应的$autonomous(即下面的$this->autonomous，记得加的时候要在最后加上"/"符号)*/
		$this->pageUri = '4';
		$this->autonomous = '';
	}
	
	/*得到总页数*/
	function getPageNumber($table,$perPage)
	{
		$num = 0;
		$query = mysql_query('SELECT * FROM '.$table);
		while($row=mysql_fetch_array($query))
			$num++;
		$this->pageNumber = ceil($num/$perPage);
	}
	
	/*得到页数对应的数组。其中键名为页数，键值为URI*/
	function getPageRange($controller, $method)
	{
		 $sub = SITE_URL.$controller.'/'.$method.'/'.$this->autonomous;
		 
		 for($i = 1; $i <= $this->pageNumber; $i++)
		 	$this->pageRange[$i] = $sub.$i;
	}
	
	/*通过URI得到当前的页数*/
	function getCurrent()
	{
		global $_fun_ch_uri;
		if(isset($_fun_ch_uri[$this->pageUri]))
			$this->current = $_fun_ch_uri[$this->pageUri];
	}
	
	/*得到所有页码的输出，并把其放进pageEcho数组*/
	function getUrl()
	{
		/*当从URI获得的查询页（即当前页）小于1时，为了系统的健壮性把查询页置为第一页*/
		if($this->current < 1)
			$this->current = '1';
		/*当从URI获得的查询页（即当前页）大于最后一页时，为了系统的健壮性把查询页置为最后一页*/
		if($this->current > $this->pageNumber)
			$this->current = $this->pageNumber;
		
		/*当页数超过一页时，输出页码超链接*/
		if($this->pageNumber > 1)
		{
			/*当前页不是首页时，就显示“首页”和“上一页”的超链接*/
			if($this->current != 1)
			{
				$this->pageEcho[] = '<a href = "'.$this->pageRange['1'].'">首页</a>'.' | ';
				$this->pageEcho[] = '<a href = "'.$this->pageRange[$this->current - 1].'">&lt; 上一页</a>'.' | ';
			}
			
			/*输出所有的页码超链接，从第一页开始到最后一页*/	
			foreach($this->pageRange as $key=>$url)
			{	
				/*非当前页时，输出超链接*/		
				if($this->current != $key)
					$this->pageEcho[] = '<a href = "'.$url.'">'.$key.'</a>'.' | ';
				/*当前页时，输出页码，无超链接*/
				else
					$this->pageEcho[] = $key.' | ';
			}
			
			/*当前页不是尾页时，就显示“尾页”和“上一页”的超链接*/
			if($this->current != $this->pageNumber)
			{
				$this->pageEcho[] = '<a href = "'.$this->pageRange[$this->current + 1].'">下一页 &gt;</a>'.' | ';
				$this->pageEcho[] = '<a href = "'.$this->pageRange[$this->pageNumber].'">尾页</a>';			
			}
		}
		else
			$this->pageEcho[] = '';
	}
	
	/*通过查询表名和每页的记录数，得到查询结果*/
	function getData($table,$perPage,$sql='')
	{
		$query = mysql_query('SELECT * FROM '.$table.$sql.' LIMIT '.$perPage.' OFFSET '.($this->current - 1)*$perPage);
		while($row=mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	
	/*调用以上方法，达到分页的效果*/
	function complex($controller, $method, $table, $perPage, $sql='')
	{
		$this->getPageNumber($table,$perPage);
		$this->getPageRange($controller, $method);
		$this->getCurrent();
		$this->getUrl();
		$data['pageEcho'] = $this->pageEcho;
		$data['result'] = $this->getData($table,$perPage,$sql);
		return $data;
	}

}