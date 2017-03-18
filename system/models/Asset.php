<?php
class Asset extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('assetsgrid')
	);

	static $has_many = array(
		array('activity')	);

}
?>
