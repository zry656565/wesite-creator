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
				self::$connection = mysql_connect(MYSQL_IP, MYSQL_UNAME, MYSQL_PWD) or die(mysql_error());
				mysql_select_db('wesite') or die(mysql_error());
				mysql_query('set names utf8') or die(mysql_error());
			} else if ($mysql_location === 'SAE') {
				self::$connection = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS) or die(mysql_error());
				mysql_select_db(SAE_MYSQL_DB, self::$connection) or die(mysql_error());
				mysql_query('set names utf8') or die(mysql_error());
			}
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
		$sql = "select * from {$this->table} where {$this->columns[$key]} = $id and isDeleted = 0";
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
		$sql = "select * from {$this->table} $where and isDeleted = 0";
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

	public function insert($returnId = false) {
		$columns = '(';
		$values = '(';
		foreach ($this->columns as $objCol => $dbCol) {
			if ($this->$objCol) {
				$columns .= $dbCol . ',';
				$values .= $this->$objCol . ',';
			}
		}
		$columns = substr($columns, 0, strlen($columns) - 1) . ')';
		$values = substr($values, 0, strlen($values) - 1) . ')';
		$sql = "INSERT INTO $this->table $columns VALUES $values;";
		DataConnection::getConnection();
		mysql_query($sql) or die(mysql_error());
		if ($returnId) {
			$sql = "SELECT MAX($this->key) as max_id from {$this->table}";
			$rs = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($rs);
			return $row['max_id'];
		}
	}

	public function update($id = null) {
		$key = $this->key;
		if ($id === null) {
			$id = $this->$key;
		}
		$columns = '';
		foreach ($this->columns as $objCol => $dbCol) {
			if ($this->$objCol) {
				$columns .= "$dbCol={$this->$objCol}, ";
			}
		}
		$columns = substr($columns, 0, strlen($columns) - 2);
		$sql = "UPDATE $this->table SET $columns WHERE id = $id";
		DataConnection::getConnection();
		mysql_query($sql) or die(mysql_error());
	}

	public function delete($trulyDelete = true, $id = null) {
		$key = $this->key;
		if ($id === null) {
			$id = $this->$key;
		}
		if (!$trulyDelete) {
			$sql = "UPDATE $this->table SET isDeleted = 1 WHERE id = $id";
		} else {
			$sql = "DELETE FROM $this->table WHERE id = $id";
		}
		DataConnection::getConnection();
		mysql_query($sql) or die(mysql_error());
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

class Asset extends Data {
	public $id, $src, $width, $height, $top, $left, $slideId, $order;

	public function __construct() {
		$options = array(
			'key' => 'id',
			'table' => 'asset',
			'columns' => array(
				'id' => 'id',
				'src' => 'src',
				'width' => 'width',
				'height' => 'height',
				'top' => 'top',
				'left' => 'left_margin',
				'order' => 'animate_order',
				'slideId' => 'slide_id',
			)
		);
		parent::init($options);
	}
}

class Slide extends Data {
	public $id, $background, $blurBackground, $pageId, $link;

	public function __construct() {
		$options = array(
			'key' => 'id',
			'table' => 'slide',
			'columns' => array(
				'id' => 'id',
				'background' => 'background',
				'blurBackground' => 'blurBackground',
				'pageId' => 'pageId',
				'link' => 'link',
			)
		);
		parent::init($options);
	}

	public function assets() {
		$a = new Asset();
		$a->slideId = $this->id;
		return $a->find();
	}
}

class Page extends Data {
	public $id, $pageName, $bgm, $bg, $description;

	public function __construct() {
		$options = array(
			'key' => 'id',
			'table' => 'page',
			'columns' => array(
				'id' => 'id',
				'pageName' => 'pageName',
				'bgm' => 'backgroundMusic',
				'bg' => 'defaultBackground',
				'description' => 'description',
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