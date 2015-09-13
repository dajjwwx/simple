<?php 
/**
 * @author freebirdy E-mail:freebirdy0815@163.com QQ:447959415;
 * @copyright 仅供学习参考,可任意修改,请务用于商业用途!
 * @version 1.0
 * @name myClendar.php
 */
class UtilCalendar{

 private $dayRow = array("",31,28,31,30,31,30,31,31,30,31,30,31);
 private $weekRow = array("chinese"=>array("<span style='color:red'>日</span>","一","二","三","四","五","六"),
        "english"=>array("<span style='color:red'>SUN</span>","MON","TUE","WEN","SUR","FRI","SAT"));
 private $str = "";
 private $language = "chinese";
 private $preYear;
 private $preMonth;
 private $preDay;
 
 /**
  * 构造函数
  * @name myClendar
  * @param int $preYear
  * @param int $preMonth
  * @param int $preDay
  * @param string $lan
  * @return myClendar
  */
 public function myClendar($preYear="",$preMonth="",$preDay="",$lan="chinese")
 {
  if($preYear=="") $this->preYear = date("Y");
  else $this->preYear = $preYear;
  if($preMonth=="" || $preMonth<1 || $preMonth>12) $this->preMonth = date("m");
  else $this->preMonth = $preMonth;
  if($preDay=="") $this->preDay = date("d");
  else $this->preDay = $preDay;
  $this->language = ($lan=="chinese")?"chinese":"english";
  if((($this->preYear%4 == 0)&&($this->preYear%100!= 0))||($this->preYear%400==0)) $this->dayRow[2]= 29;
 }
 
 /**
  * 显示星期行
  * @access private
  */
 private function showWeek()
 {
  $this->str .= "<tr align='center'>\r\n";  
  for($i=0;$i<count($this->weekRow[$this->language]);$i++) 
   $this->str .= "<td class='calTd'>".$this->weekRow[$this->language][$i]."</td>\r\n";   
  $this->str .= "</tr>\r\n";
 }
 
 /**
  * 显示日期
  * @access private
  */
 private function showDay()
 {  
  $time = mktime(0,0,0,$this->preMonth,1,$this->preYear); 
        $firstDay =date("w",$time);//得到当前月的第一天
        
        $this->str .= "<tr align='center' height='20'>\r\n";
  for($i=0;$i<$firstDay;$i++) $this->str .= "<td class='calTd'>&nbsp;</td>\r\n";
  for($j=1;$j<=$this->dayRow[$this->preMonth];$j++)
  {
   if($j == $this->preDay) $day = "<span class='today'>$j</span>";
   else if($firstDay==0) $day = "<span class='sunday'>$j</span>";
   else $day = $j;
   if($firstDay==6)
   {
    $this->str.="<td class='calTd' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\">";
    $this->str.=$day."</td>\r\n</tr>\r\n";
    if($j != $this->dayRow[$this->preMonth]) $this->str .= "<tr align='center' height='20'>\r\n";
    $firstDay = -1;
   }
   else
   {
    $this->str.="<td class='calTd' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\">";
    $this->str.=$day."</td>\r\n";
   } 
   $firstDay++;
  }
  if($firstDay!=0)
  {
   for($i=$firstDay;$i<=6;$i++)
   {
    $this->str .= "<td class='calTd'></td>\r\n";
    if($i==6) $this->str .= "</tr>\r\n";  
   }
  }
 }
 
 /**
  * 显示年份选择
  * @access private
  */
 private function showYearBar()
 {
  $this->str .= "&nbsp;<a href=?year=".($this->preYear-1)."&month=".$this->preMonth." title='上一年'><img src='08.png'></a> ";
  $this->str .= "<a href=?year=".($this->preYear+1)."&month=".$this->preMonth." title='下一年'><img src='07.png'></a>&nbsp;";
 }
 
 /**
  * 显示月份选择
  * @access private
  */
 private function showMonthBar()
 {
  $this->str .= "&nbsp;<a href=?year=".($this->preYear)."&month=".($this->preMonth-1)." title='上一月'><img src='08.png'></a> ";
  $this->str .= "<a href=?year=".($this->preYear)."&month=".($this->preMonth+1)." title='下一月'><img src='07.png'></a>&nbsp;";
 }

 /**
  * 显示日历
  * @access public
  * @return string
  */
 public function showCalendar()
 {
  $this->str = "<table border=0 cellpadding=0 cellspacing=0 class='calTable'>\r\n";
  $this->str .= "<tr height='30'>\r\n<td colspan=\"7\" align='center' class='calHeader'>\r\n";
  $this->showYearBar();
  $this->str .= "<span id='preYear'>".$this->preYear."</span> 年 \r\n";
  $this->str .= "<span id='preMonth'>".$this->preMonth."</span> 月\r\n";
  $this->showMonthBar();
  $this->str .= "</td>\r\n</tr>\r\n";
  $this->showWeek($this->language);
  $this->showDay();
  $this->str .= "</table>\r\n";
  return $this->str;
 }
}
?>