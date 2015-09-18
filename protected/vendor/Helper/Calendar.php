<?php 

class Calendar
{
	private  $year,$month,$day;
	
	private $header = array(
			'日',
			'一',
			'二',
			'三',
			'四',
			'五',
			'六'
			);

	/**
	 * @return the $header
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * @param multitype:string  $header
	 */
	public function setHeader($header) {
		$this->header = $header;
	}

	/**
	 * @return the $year
	 */
	public function getYear() {
		return $this->year;
	}
	
	/**
	 * @return the $month
	 */
	public function getMonth() {
		return $this->month;
	}
	
	/**
	 * @return the $day
	 */
	public function getDay() {
		return $this->day;
	}
	
	/**
	 * @param field_type $year
	 */
	public function setYear($year) {
		$this->year = $year;
	}
	
	/**
	 * @param field_type $month
	 */
	public function setMonth($month) {
		$this->month = $month;
	}
	
	/**
	 * @param field_type $day
	 */
	public function setDay($day) {
		$this->day = $day;
	}
	
	
	//获得当月的总天数
	public function getDaysInMonth($month, $year)
	{
		return date('t', mktime(0, 0, 0, $month, 1, $year));
	}
	
	//获得当月的第一天是星期几
	public function getFirstDay($month, $year)
	{
		return date('w', mktime(0, 0, 0, $month, 1, $year));
	}
	
	//计算数组中的日历表格数
	public function getTempDays($month, $year)
	{
		return $this->getFirstDay($month, $year) + $this->getDaysInMonth($month, $year);
	}
	
	//计算出当月的周数
	public function getWeeksInMonth($month, $year)
	{
		return ceil($this->getTempDays($month, $year)/7);
	}
	
	//初始化日历数组
	public function initCalendarArray($month, $year, $days = array())
	{
		
		$counter = 0;
		
		$firstDay = $this->getFirstDay($month, $year);
		
		$daysInMonth = $this->getDaysInMonth($month, $year);
		
		$weeksInMonth = $this->getWeeksInMonth($month, $year);
		
		for($j = 0; $j < $weeksInMonth; $j++)
		{
			for($i = 0; $i < 7; $i++)
			{
				$counter++;
				$week[$j][$i] = $counter;
				
				//日期偏移量
				$week[$j][$i] = strval($week[$j][$i] - $firstDay );
				
				//因为不能直接在数组中使用Html Tags ，所有使用特殊标记"--link"
				if(in_array($week[$j][$i], $days))
				{
					$week[$j][$i] =$week[$j][$i].'--link';
				}
				
				if(($week[$j][$i] < 1) || ($week[$j][$i] > $daysInMonth))
				{
					$week[$j][$i] = '';
				}
			}			
		}
		
		return $week;
		
	}
	
	/**
	 * 
	 * @param unknown_type $month
	 * @param unknown_type $year
	 * @return string
	 */
	public function renderHeader($month, $year)
	{
		$html = "<table style='width:100%;text-align:center;'>";
		
		$html .= '<thead><tr>';
		
		$html .= '<td><a href="javascript:void();"><<</a></td>';
		
		$html .= '<td colspan="5"><a href="javascript:void();">'.$year.'</a>年<a href="javascript:void();">'.$month.'</a>月</td>';
		
		$html .= '<td><a href="javascript:void();">>></a></td>';
		
		$html .= '</tr><tr>';
		
		foreach ($this->header as $name)
		{
			$html .= '<th>'.$name.'</th>';
		}
		
		$html .= '</tr></thead>';
		
		return $html;
		
	}
	
	/**
	 * 
	 * @param unknown_type $value
	 * @param unknown_type $link
	 */
	public function renderCeil($value, $link=array(), $data = array())
	{
		$string = '';
		
		if(strpos($value, '--'))
		{
			$str = explode('--',$value);
			
			$value = CHtml::link($str[0], $link, array('style'=>' color:rgb(13,53,218);border-bottom:1px solid rgb(13,53,218);'));
		}
		
		
		return $value;

	}
	
	public function renderBody($month, $year, $data = array(), $link=array())
	{
		$html = '';
		
		$weeks = $this->getWeeksInMonth($month, $year);
		$days = $this->initCalendarArray($month, $year, $data);
		
		$html .= '<tbody>';
		
		foreach ($days as $week=>$day)
		{
			$html .= "<tr>";
				
			foreach ($day as $value)
			{
				$html .= "<td>".$this->renderCeil($value, $link, $data)."</td>";
			}				
				
			$html .=  "</tr>";
		}		
		
		$html .= '</tbody>';
		
		return $html;
	}
	
	public function renderFooter()
	{
		return '</table>';
	}	
	
	
	public function init($month , $year, $days=array())
	{
		
		$html = $this->renderHeader($month, $year);
		$html .= $this->renderBody($month, $year, $days);
		$html .= $this->renderFooter();

		return $html;
		
	}	
	
}
?>