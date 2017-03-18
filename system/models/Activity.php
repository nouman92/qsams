<?php
class Activity extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('asset'));
}
?>
