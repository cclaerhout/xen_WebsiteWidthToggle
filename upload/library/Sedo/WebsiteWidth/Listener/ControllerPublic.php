<?php
class Sedo_WebsiteWidth_Listener_ControllerPublic
{
	public static function extendController($class, array &$extend)
	{
		if ($class == 'XenForo_ControllerPublic_Account')
		{
			$extend[] = 'Sedo_WebsiteWidth_ControllerPublic_Account_WidthOption';
		}
		
		if ($class == 'XenForo_ControllerPublic_Misc')
		{		
			$extend[] = 'Sedo_WebsiteWidth_ControllerPublic_Misc_WidthOption';		
		}
	}
}