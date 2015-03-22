<?php
class MyWebUser extends CWebUser
{
	protected function beforeLogin($id,$states,$fromCookie)
	{
		return true;
	}
}
