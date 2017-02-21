<?php
class AssetsGrid extends ActiveRecord\Model
{
	static $has_many = array(
		array('asset'));

	static $validates_presence_of = array(
		array('block_number'),
		array('row_number'),
		array('table_number'),
		array('panel_number'),
		array('panel_position'),
		array('vacent'));
}
?>
