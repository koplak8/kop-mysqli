<?php
define('LAK_MYSQL_0000_HOST', 'localhost');
define('LAK_MYSQL_0000_UID', 'root');
define('LAK_MYSQL_0000_PWD', '');
define('LAK_MYSQL_0000_DB', 'lak_mysql');
class LAK_MYSQL{
	public $LAK_MYSQL_0000_CON = null;
	public $LAK_MYSQL_0000_DATASET = [];
	private $LAK_TMP = null;
	function __construct(){

	}
	function open(){
		$this->LAK_MYSQL_0000_CON = new mysqli(
			LAK_MYSQL_0000_HOST,
			LAK_MYSQL_0000_UID,
			LAK_MYSQL_0000_PWD,
			LAK_MYSQL_0000_DB
		);
		if($this->LAK_MYSQL_0000_CON -> connect_errno){
			echo $this->LAK_MYSQL_0000_CON -> connect_error;
			die();
		}
	}
	function query($params_string){
		$this->LAK_TMP = $this->LAK_MYSQL_0000_CON->query($params_string);
		$this->LAK_MYSQL_0000_DATASET['res'] = [$this->LAK_TMP];
		if(is_object($this->LAK_TMP)){
			$this->LAK_MYSQL_0000_DATASET['data'] = [$this->LAK_TMP -> fetch_all(MYSQLI_ASSOC)];
		}
		$this->LAK_TMP = null;
		return $this->LAK_MYSQL_0000_DATASET;
	}
	function close(){
		$this->LAK_MYSQL_0000_CON->close(); 
		$this->LAK_MYSQL_0000_CON = null; 
	}
}
$id = 1;
$MYSQLI = new LAK_MYSQL();
$MYSQLI -> open();
$DATA = $MYSQLI -> query("SELECT * FROM dummy_dataset WHERE id='$id'");
echo "<pre>";
print_r($DATA);
echo "</pre>";
$MYSQLI -> close();
