<?php
class ControllerExtensionModuleCallback extends Controller {
	public function index() {
		$this->load->language('extension/module/callback');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/callback.css');
		$this->document->addScript('catalog/view/javascript/jquery.maskedinput.min.js');

		$data['config_email'] = $this->config->get('config_email');

		$data['module_callback_title'] = $this->config->get('module_callback_title');
		$data['module_callback_mask'] = $this->config->get('module_callback_mask');
		$data['module_callback_button'] = $this->config->get('module_callback_button');

		return $this->load->view('extension/module/callback', $data);
	}
}