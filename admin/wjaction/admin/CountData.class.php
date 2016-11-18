<?php

/**
 * 数据统计有关
 */
class CountData extends AdminBase{
	public $pageSize=15;

	public final function index(){
		//$expire=5*60;	// 缓存时间5分钟
		$expire=0.1*60;
		$this->display('count/index.php', $expire);
	}
	
	public final function betDate(){
		$this->display('count/date.php');
	}
	public final function betDateSearch(){
		$this->display('count/date-list.php');
	}
	public final function countImg(){
		$sql="select left(`date`,7) monthName, sum(betAmount) betAmount, sum(betAmount-zjAmount) winAmount from {$this->prename}count group by monthName order by monthName desc limit 5";
		$dataMonth=$this->getRows($sql);
		$dataMonth=array_reverse($dataMonth);
		foreach($dataMonth as $arrId=>$varAmount){
			$betAmountArr[$arrId]=intval($varAmount['betAmount']);
			$winAmountArr[$arrId]=intval($varAmount['winAmount']);
		}
		
		/*include_once $_SERVER['DOCUMENT_ROOT'].'/lib/classes/googleChart/GoogleChart.php';*/
		$chart = new GoogleChart('lc', 520, 140);
		$chart->setScale(0,100);
		
		$line = new GoogleChartData(array(58,88,30));
		$chart->addData($line);
		$line = new GoogleChartData(array(78,38,20));
		$chart->addData($line);
		
		$y_axis = new GoogleChartAxis('y');
		print_r($y_axis);exit;
		$chart->addAxis($y_axis);
		
		$x_axis = new GoogleChartAxis('x');
		$chart->addAxis($x_axis);
		
		header('Content-Type: image/png');
		echo $chart;
	}
}