<?php

class Sedo_WebsiteWidth_ControllerPublic_Misc_WidthOption extends XFCP_Sedo_WebsiteWidth_ControllerPublic_Misc_WidthOption
{
	public function actionSetWebsiteWidth()
	{
		$visitor = XenForo_Visitor::getInstance();
		$id = $visitor['user_id'];

		$value = $this->_input->filterSingle('value', XenForo_Input::STRING);
		
		if (empty($id) || !in_array($value, array(0, 1)))
		{
			return $this->responseError(new XenForo_Phrase('sedo_website_width_error_action_not_allowed'));
		}

		$value = intval(!$value);

		$db = XenForo_Application::get('db');
		$db->query("UPDATE xf_user_option SET sedo_website_width = '$value' WHERE user_id =$id");

		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::SUCCESS,
			XenForo_Link::buildPublicLink($this->_input->filterSingle('redirect', XenForo_Input::STRING))
		);
	}
}