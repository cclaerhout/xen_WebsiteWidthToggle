<?php
class Sedo_WebsiteWidth_Listener_Templates
{
	public static function hooks($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
	{
		switch ($hookName) {
			case 'body':
				$isMember = XenForo_Visitor::getUserId();
				if(!$isMember)
				{
					break;
				}
				
				$isActivate = XenForo_Template_Helper_Core::styleProperty('sedo_websitewidth_toggle_activation');			
				if(!$isActivate)
				{
					break;
				}

				$search = '#(class="[^"]*?pageWidth)([ ]?)([^"]*?")#i';
				$replace = '$1 pageWidthDefault$2$3';
			
				$contents = preg_replace($search, $replace, $contents);
				break;
		}

	}
}