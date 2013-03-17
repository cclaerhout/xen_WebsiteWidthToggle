<?php
class Sedo_WebsiteWidth_Listener_Datawriter
{
	public static function extendDw($class, array &$extend)
	{
		if ($class == 'XenForo_DataWriter_User')
		{
			$extend[] = 'Sedo_WebsiteWidth_DataWriter_User_WidthOption';
		}
	}
}