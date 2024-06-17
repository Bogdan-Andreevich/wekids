<?php
class ControllerExtensionModuleCallback extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/callback');

		$this->document->setTitle($this->language->get('page_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_callback', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'].'&type=module', true));
		}

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'].'&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('page_title'),
			'href' => $this->url->link('extension/module/callback', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/callback', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'].'&type=module', true);


		if (isset($this->request->post['module_callback_status'])) {
			$data['module_callback_status'] = $this->request->post['module_callback_status'];
		} else {
			$data['module_callback_status'] = $this->config->get('module_callback_status');
		}

		if (isset($this->request->post['module_callback_title'])) {
			$data['module_callback_title'] = $this->request->post['module_callback_title'];
		} elseif($this->config->get('module_callback_title')) {
			$data['module_callback_title'] = $this->config->get('module_callback_title');
		} else {
			$data['module_callback_title'] = 'Оставьте свой номер и мы Вам перезвоним';
		}

		if (isset($this->request->post['module_callback_mask'])) {
			$data['module_callback_mask'] = $this->request->post['module_callback_mask'];
		} elseif($this->config->get('module_callback_mask')) {
			$data['module_callback_mask'] = $this->config->get('module_callback_mask');
		} else {
			$data['module_callback_mask'] = '+7 (999) 999-99-99';
		}

		if (isset($this->request->post['module_callback_button'])) {
			$data['module_callback_button'] = $this->request->post['module_callback_button'];
		} elseif($this->config->get('module_callback_button')) {
			$data['module_callback_button'] = $this->config->get('module_callback_button');
		} else {
			$data['module_callback_button'] = 'Оставить заявку';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/callback', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/callback')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}