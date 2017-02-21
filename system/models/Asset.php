<?php
class Asset extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('assetsgrid'));

		static $validates_presence_of = array(
			array('active'),
			array('installed'),
			array('seriel_no'),
			array('assets_grid_id'));
}
?>
