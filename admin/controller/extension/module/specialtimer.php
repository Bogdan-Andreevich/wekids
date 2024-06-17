<?php

class ControllerExtensionModuleSpecialtimer extends Controller {

	private $error = array();

	public function index() {
		
		$this->load->language('extension/module/specialtimer');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('setting/setting');



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
        
			$this->model_setting_setting->editSetting('special_time', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));

		}



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_edit'] = $this->language->get('text_edit');

		$data['text_enabled'] = $this->language->get('text_enabled');

		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['text_yes'] = $this->language->get('text_yes');

		$data['text_no'] = $this->language->get('text_no');


		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['entry_special_product_page'] = $this->language->get('entry_special_product_page');
		
		$data['entry_special_product_module'] = $this->language->get('entry_special_product_module');
		
		$data['entry_product_page'] = $this->language->get('entry_product_page');
		
		$data['entry_featured_product_page'] = $this->language->get('entry_featured_product_page');
		
		$data['entry_latest_product_page'] = $this->language->get('entry_latest_product_page');
		
		$data['entry_special_product_category_page'] = $this->language->get('entry_special_product_category_page');
		
		$data['entry_search_product_page'] = $this->language->get('entry_search_product_page');
		
		$data['button_save'] = $this->language->get('button_save');

		$data['button_cancel'] = $this->language->get('button_cancel');



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
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], true)
		);


		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/specialtimer', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);


		$data['action'] = $this->url->link('extension/module/specialtimer', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], true);
	

		if (isset($this->request->post['special_timer_status'])) {
			$data['special_timer_status'] = $this->request->post['special_timer_status'];
		} else {
			$data['special_timer_status'] = $this->config->get('special_timer_status');
		}
		
		
		if (isset($this->request->post['special_time_config_special_product_page'])) {
			$data['special_time_config_special_product_page'] = $this->request->post['special_time_config_special_product_page'];
		} else {
			$data['special_time_config_special_product_page'] = $this->config->get('special_time_config_special_product_page');
		}
		
		if (isset($this->request->post['special_time_config_special_product_module'])) {
			$data['special_time_config_special_product_module'] = $this->request->post['special_time_config_special_product_module'];
		} else {
			$data['special_time_config_special_product_module'] = $this->config->get('special_time_config_special_product_module');
		}
		
		if (isset($this->request->post['special_time_config_product_page'])) {
			$data['special_time_config_product_page'] = $this->request->post['special_time_config_product_page'];
		} else {
			$data['special_time_config_product_page'] = $this->config->get('special_time_config_product_page');
		}
		
		if (isset($this->request->post['special_time_config_featured_product_page'])) {
			$data['special_time_config_featured_product_page'] = $this->request->post['special_time_config_featured_product_page'];
		} else {
			$data['special_time_config_featured_product_page'] = $this->config->get('special_time_config_featured_product_page');
		}
		
		if (isset($this->request->post['special_time_config_latest_product_page'])) {
			$data['special_time_config_latest_product_page'] = $this->request->post['special_time_config_latest_product_page'];
		} else {
			$data['special_time_config_latest_product_page'] = $this->config->get('special_time_config_latest_product_page');
		}
		
		if (isset($this->request->post['special_time_config_special_product_category_page'])) {
			$data['special_time_config_special_product_category_page'] = $this->request->post['special_time_config_special_product_category_page'];
		} else {
			$data['special_time_config_special_product_category_page'] = $this->config->get('special_time_config_special_product_category_page');
		}

       if (isset($this->request->post['special_time_config_search_product_page'])) {
			$data['special_time_config_search_product_page'] = $this->request->post['special_time_config_search_product_page'];
		} else {
			$data['special_time_config_search_product_page'] = $this->config->get('special_time_config_search_product_page');
		}


		$data['user_token'] = $this->session->data['user_token'];



		$data['header'] = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/specialtimer', $data));

	}



	protected function validate() {

		if (!$this->user->hasPermission('modify', 'extension/module/specialtimer')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}	


		return !$this->error;

	}

}

