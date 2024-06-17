<?php

class ControllerExtensionModuleUniSettings extends Controller
{
    private $error = array();
    private $status = "";
    private $time_left = "";
    public function index()
    {
        $this->load->model("extension/module/uni_settings");
        $this->load->model("tool/image");
        $this->load->model("localisation/language");
        $this->load->model("setting/store");
        $this->load->model("setting/setting");
        $this->load->model("setting/extension");
        $this->load->model("setting/module");
        $this->load->model("catalog/information");
        $this->load->model("catalog/category");
        $this->load->language("extension/module/uni_settings");
        $this->document->setTitle(strip_tags($this->language->get("heading_title")));
        $data["heading_title"] = $this->language->get("heading_title");
        $this->document->addStyle("view/stylesheet/unishop.css");
        $this->document->addStyle("view/stylesheet/bootstrap-colorpicker.min.css");
        $this->document->addScript("view/javascript/bootstrap-colorpicker.min.js");
        $this->document->addScript("view/javascript/unishop.js");
        if ($this->config->get("config_editor_default")) {
            $this->document->addScript("view/javascript/ckeditor/ckeditor.js");
            $this->document->addScript("view/javascript/ckeditor/ckeditor_init.js");
        } else {
            $this->document->addStyle("view/javascript/summernote/summernote.css");
            $this->document->addScript("view/javascript/summernote/summernote.js");
            $this->document->addScript("view/javascript/summernote/summernote-image-attributes.js");
            $this->document->addScript("view/javascript/summernote/opencart.js");
        }
        $data["ckeditor"] = $this->config->get("config_editor_default");
        $data["languages"] = $this->model_localisation_language->getLanguages();
        $data["error_warning"] = isset($this->error["warning"]) ? $this->error["warning"] : "";
        $data["breadcrumbs"] = array();
        $data["breadcrumbs"][] = array("text" => $this->language->get("text_home"), "href" => $this->url->link("common/home", "user_token=" . $this->session->data["user_token"], true));
        $data["breadcrumbs"][] = array("text" => $this->language->get("text_module"), "href" => $this->url->link("marketplace/extension", "user_token=" . $this->session->data["user_token"] . "&type=module", true));
        $data["breadcrumbs"][] = array("text" => $this->language->get("heading_title"), "href" => $this->url->link("extension/module/uni_settings", "user_token=" . $this->session->data["user_token"], true));
        $data["cancel"] = $this->url->link("marketplace/extension", "user_token=" . $this->session->data["user_token"] . "&type=module", true);
        $data["catalog"] = $this->config->get("config_secure") ? HTTPS_CATALOG : HTTP_CATALOG;
        $data["token"] = "user_token=" . $this->session->data["user_token"];
        $data["placeholder"] = $this->model_tool_image->resize("no_image.png", 100, 100);
        $data["store_id"] = $store_id = isset($this->request->get["store_id"]) ? $this->request->get["store_id"] : 0;
        $store_info = $this->model_setting_setting->getSetting("config", $store_id);
        $data["telephone"] = $store_info ? $store_info["config_telephone"] : $this->config->get("config_telephone");
        $data["set"] = $this->model_extension_module_uni_settings->getSetting($store_id);
        $data["stores"][] = array("store_id" => 0, "name" => $this->config->get("config_name"), "href" => $this->url->link("extension/module/uni_settings", "user_token=" . $this->session->data["user_token"] . "&store_id=0", true));
        $sort_string = isset($data["set"]["sort_stories"]) ? $data["set"]["sort_stories"] : "id,asc";
        $sort_1 = substr($sort_string, 0, 2) == "id" ? "store_id" : "url";
        $sort_2 = substr($sort_string, -3) == "asc" ? "ASC" : "DESC";
        $stores = $this->model_setting_store->getStores();
        if (1 < count($stores)) {
            foreach ($stores as $key => $value) {
                $sort[$key] = $value[$sort_1];
            }
            if ($sort_2 == "ASC") {
                array_multisort($sort, SORT_ASC, $stores);
            } else {
                array_multisort($sort, SORT_DESC, $stores);
            }
        }
        foreach ($stores as $store) {
            $data["stores"][] = array("store_id" => $store["store_id"], "name" => html_entity_decode($store["name"], ENT_QUOTES, "UTF-8"), "href" => $this->url->link("extension/module/uni_settings", "user_token=" . $this->session->data["user_token"] . "&store_id=" . $store["store_id"], true));
        }
        $data["modules"] = array();
        $request_modules = array("latest", "special", "featured", "bestseller");
        $modules = $this->model_setting_extension->getInstalled("module");
        foreach ($modules as $module) {
            $this->load->language("extension/module/" . $module);
            $modules = $this->model_setting_module->getModulesByCode($module);
            foreach ($modules as $module) {
                if (in_array($module["code"], $request_modules)) {
                    $data["modules"][] = array("name" => $this->language->get("heading_title"), "name2" => $module["name"]);
                }
            }
        }
        $data["informations"] = array();
        $filter_data = array("sort" => "name", "order" => "ASC");
        $infos = $this->model_catalog_information->getInformations($filter_data);
        foreach ($infos as $info) {
            $seo_link = $this->model_catalog_information->getInformationSeoUrls($info["information_id"]);
            $data["informations"][] = array("information_id" => $info["information_id"], "name" => $info["title"], "link" => "index.php?route=information/information&information_id=" . $info["information_id"], "seo_link" => isset($seo_link[$store_id]) ? $seo_link[$store_id] : "");
        }
        $data["categories"] = array();
        $filter_data = array("sort" => "name", "order" => "ASC");
        $categories = $this->model_catalog_category->getCategories($filter_data);
        foreach ($categories as $category) {
            $data["categories"][] = array("category_id" => $category["category_id"], "name" => $category["name"]);
        }
        $data["categories2"] = array();
        $categories2 = $this->model_extension_module_uni_settings->getCategories(0, $store_id);
        foreach ($categories2 as $category) {
            $data["categories2"][] = array("category_id" => $category["category_id"], "name" => $category["name"]);
        }
        $data["show_settings"] = true;
        $data["time_left"] = false;

        $data["header"] = $this->load->controller("common/header");
        $data["column_left"] = $this->load->controller("common/column_left");
        $data["footer"] = $this->load->controller("common/footer");
        $this->response->setOutput($this->load->view("extension/module/uni_settings", $data));
    }
    public function save()
    {
        $this->load->language("extension/module/uni_settings");
        $this->load->model("extension/module/uni_settings");
        $result = "";
        $store_id = isset($this->request->post["store_id"]) ? $this->request->post["store_id"] : 0;
        if ($this->request->server["REQUEST_METHOD"] == "POST" && isset($this->request->post["uni_set"]) && $this->permission()) {
            $result = $this->model_extension_module_uni_settings->setSetting($store_id, $this->request->post["uni_set"]);
        }
        $this->response->setOutput($result);
    }
    public function install()
    {
        $this->load->model("extension/module/uni_settings");
        $this->load->model("setting/setting");
        $this->model_extension_module_uni_settings->install();
        $this->model_setting_setting->editSetting("theme_unishop2_key", array("theme_unishop2_key" => ""));
    }
    public function getIconBlock()
    {
        $this->load->language("extension/module/uni_settings");
        $data = array();
        $this->response->setOutput($this->load->view("extension/module/uni_icon_block", $data));
    }
    private function permission()
    {
        $this->load->language("extension/module/uni_settings");
        if ($this->user->hasPermission("modify", "extension/module/uni_settings")) {
            return true;
        }
        $this->error["warning"] = $this->language->get("error_permission");
        return false;
    }
}

?>