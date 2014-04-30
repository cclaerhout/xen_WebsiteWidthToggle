<?php
class Sedo_WebsiteWidth_Installer
{
	public static function install($addon)
	{
		$db = XenForo_Application::get('db');
		
		if(empty($addon))
		{
			 $db->query("ALTER TABLE xf_user_option ADD sedo_website_width TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0'");
		}
	}
 
	public static function uninstall()
	{
		XenForo_Application::get('db')->query("ALTER TABLE xf_user_option DROP sedo_website_width");	
	}
}

