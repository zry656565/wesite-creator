<?php
class DataConnection {
	private static $connection = null;

	public static function getConnection() {
		if (self::$connection == null) {
			$mysql_location = 'local';

			if ($mysql_location === 'local') {
				define('MYSQL_IP', '127.0.0.1');
				define('MYSQL_UNAME', 'root');
				define('MYSQL_PWD', '');
			} else {
				define('MYSQL_IP', 'remote');
				define('MYSQL_UNAME', 'root');
				define('MYSQL_PWD', '');
			}
			self::$connection = mysql_connect(MYSQL_IP, MYSQL_UNAME, MYSQL_PWD) or die(mysql_error());
			mysql_select_db('wesite') or die(mysql_error());
			mysql_query('set names utf8') or die(mysql_error());
		}
		return self::$connection;
	}
}

class Data {
	public $key, $table, $columns;

	public function init($options) {
		$this->key = $options['key'];
		$this->table = $options['table'];
		$this->columns = $options['columns'];
	}

	public function load($id = null) {
		$key = $this->key;
		if ($id == null) {
			$id = $this->$key;
		}
		$sql = "select * from {$this->table} where {$this->columns[$key]} = $id";
		DataConnection::getConnection();
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		if ($row) {
			foreach ($this->columns as $objCol => $dbCol) {
				$this->$objCol = $row["$dbCol"];
			}
			return $this;
		} else {
			return null;
		}
	}

	public function find() {
		$result = array();
		$where = 'where 1=1 ';
		foreach ($this->columns as $objCol => $dbCol) {
			if ($this->$objCol) {
				$where .= " and $dbCol = {$this->$objCol}";
			}
		}
		$sql = "select * from {$this->table} $where";
		DataConnection::getConnection();
		$rs = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($rs);
		while ($row) {
			$o = clone $this;
			foreach ($o->columns as $objCol => $dbCol) {
				$o->$objCol = $row[$dbCol];
			}
			$result[] = $o;
			$row = mysql_fetch_assoc($rs);
		}
		return $result;
	}
}

class User extends Data {
	public $username, $password;

	public function __construct() {
		$options = array(
			'key' => 'username',
			'table' => 'user',
			'columns' => array(
				'username' => 'username',
				'password' => 'password',
			)
		);
		parent::init($options);
	}
}

class Slide extends Data {
	public $id, $title, $footer, $content, $contentType, $pageId;

	public function __construct() {
		$options = array(
			'key' => 'id',
			'table' => 'slide',
			'columns' => array(
				'id' => 'id',
				'title' => 'title',
				'footer' => 'footer',
				'content' => 'content',
				'contentType' => 'contentType',
				'pageId' => 'pageId',
			)
		);
		parent::init($options);
	}
}

class Page extends Data {
	public $id, $pageName, $bgm;

	public function __construct() {
		$options = array(
			'key' => 'id',
			'table' => 'page',
			'columns' => array(
				'id' => 'id',
				'pageName' => 'pageName',
				'bgm' => 'backgroundMusic',
			)
		);
		parent::init($options);
	}

	public function slides()
	{
		$s = new Slide();
		$s->pageId = $this->id;
		return $s->find();
	}
}