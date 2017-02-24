<?php
class Users extends ActiveRecord\Model
{
  static $validates_presence_of = array(
    array('email'),
    array('password'),
    array('role'));
}
?>
