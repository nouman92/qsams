<?php
class Asset extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('assetsgrid'));
}
?>
