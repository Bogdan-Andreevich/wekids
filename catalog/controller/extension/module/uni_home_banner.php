<?php
class ControllerExtensionModuleUniHomeBanner extends Controller {
	public function index() {		
		$uniset = $this->config->get('config_unishop2');
		$lang_id = $this->config->get('config_language_id');
		
		$data['home_banners'] = [];
		$data['hide_parent'] = false;
		
		$i = 0;
		
		if(isset($uniset['home']['text_banner'])) {
			$this->document->addStyle('catalog/view/theme/unishop2/stylesheet/home-banner.css');
			
			foreach($uniset['home']['text_banner'] as $key => $banner) {
				if(isset($banner['text_1'][$lang_id]) && $banner['text_1'][$lang_id] != '') {
					$data['home_banners'][] = [
						'icon' 			=> $banner['icon'][$lang_id],
						'img' 			=> $banner['img'][$lang_id],
						'text_1' 		=> html_entity_decode($banner['text_1'][$lang_id], ENT_QUOTES, 'UTF-8'),
						'text_2' 		=> html_entity_decode($banner['text_2'][$lang_id], ENT_QUOTES, 'UTF-8'),
						'link' 			=> $banner['link'][$lang_id],
						'link_popup'	=> isset($banner['link_popup'][$lang_id]) ? true : false,
						'hide' 			=> isset($banner['hide'][$lang_id]) ? true : false,
					];
					
					if(isset($banner['hide'])){
						$i++;
					}
				}
			}
			
			if(count($uniset['home']['text_banner']) == $i) {
				$data['hide_parent'] = true;
			}
		}
		
		return $this->load->view('extension/module/uni_home_banner', $data);
	}
}
?>
