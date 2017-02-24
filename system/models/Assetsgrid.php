<?php
class AssetsGrid extends ActiveRecord\Model
{
	static $has_many = array(
		array('asset'));
}
?>
