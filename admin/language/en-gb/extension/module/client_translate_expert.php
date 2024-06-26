<?php
// Heading
$_['heading_title']    = '<strong style="color:#41637d">DEV-OPENCART.COM —</strong> <b>Bulk automatic translation of texts</b> <a href="https://dev-opencart.com" target="_blank" title="Dev-opencart.com - Модули и шаблоны для Opencart"><img style="margin-left:15px;height:35px;margin-top:10px;margin-bottom:10px;" src="https://dev-opencart.com/logob.svg" alt="Dev-opencart.com - Модули и шаблоны для Opencart"/></a>';

// Text
$_['text_extension']   = 'Modules';
$_['text_success']     = 'Module settings updated!';
$_['text_edit']        = 'Editing a module';

$_['text_login_is_correct']        = '<div class="translate_expert_correct"> Authorization check succeeded. </div>';
$_['text_need_to_login'] = '';
$_['text_no_need_to_pay'] = '<div class="translate_expert_correct"> You still have a lot of characters to translate.</div> ';
$_['text_about_page']        = '';
$_['text_current_module_version']        = 'The current version of the module <b>{current_module_version}</b>';
$_['text_newest_module_version']        = 'The latest available version of the module <b>{newest_module_version}</b>';
$_['text_you_need_to_update_module']        = '';
$_['text_you_have_the_newest_version_of_module']        = '<div class="translate_expert_correct">Congratulations you have the latest version of the module.</div>';
$_['text_debug_log']        = 'Debug log';
$_['text_clear_debug_log_success']	   = 'Success: You have successfully cleared your debug log!';
$_['text_clear_confirm']	   = 'Are you sure you want to delete the debug log file?';

// Entry;
$_['entry_key'] = 'Key';
$_['entry_server_key'] = 'Google Translate Api Key';
$_['entry_limit'] = 'Limit';
$_['entry_image'] = 'Image (width x height)';
$_['entry_width'] = 'Width';
$_['entry_height'] = 'Height';
$_['entry_status'] = 'Status';
$_['entry_login'] = 'Your login';
$_['entry_name'] = 'Title';
$_['entity_table'] = 'Table';
$_['entity_column'] = 'Column';
$_['entity_language'] = 'Language';
$_['entry_info'] = 'Information';
$_['entry_char_quantity'] = 'Number of characters available for translation';
$_['entry_analization'] = 'Analize non-translated strings';
$_['entity_begin_analization'] = 'Analyze';
$_['entry_analization_result'] = 'Analysis Result';
$_['entry_analization_mode'] = 'Analysis mode';
$_['entry_stop_modal_process'] = 'Stop';
$_['entry_stop_modal_process_confirmation'] = 'Are you sure you want to stop current process?';
$_['entry_time_in_sec'] = 'Time: <strong id="timeInSec">{timeInSec} seconds</strong> ';
$_['entry_summ'] = 'All languages';
$_['entry_close'] = 'Close';
$_['entry_try_translate']     = 'Translation verification form<br>API key test';
$_['entry_try_translate_text']     = 'Translation verification form';
$_['entry_translate_expert_version']     = 'Module version';
$_['entry_php_version']     = 'PHP version';
$_['entry_opencart_version']= 'Opencart version';
$_['entry_license_info']= 'License information';
$_['entry_debug_status']     = 'Debug mode status';
$_['entry_table']     = 'Table';
$_['entry_analization_language_from'] = 'The language from which to translate';
$_['entry_analization_language_to'] = 'What language to translate';
$_['entry_all_tables']     = 'All tables';
$_['entry_table_deep']     = 'Deep analize';
$_['entry_table_deep_description']     = 'Full analysis of the entire table (Turn off if the analysis takes a very long time)';

$_['entry_localization_language_from'] = 'Language to translate from';
$_['entry_localization_language_to'] = 'Language to translate to';
$_['entry_localization_analization'] = 'Analyze unlocalized values';
$_['entry_localization_analization_result'] = 'Analysis result';
$_['entry_localization_file_to_translate_info'] = '{path}: <b>{count} values not translated</b>';
$_['entry_localization_file_to_translate_info_full_translated'] = '{path}: Fully translated';

$_['entry_fileCount'] = 'Total files';
$_['entry_needToTranslateFileCount'] = 'No files translated';
$_['entry_needToTranslateValueCount'] = 'Values not translated';
$_['entry_needToTranslateCharCount'] = 'Number of characters not translated';
$_['entry_TranslateAll'] = 'Translate All';

// Tabs;
$_['tab_general'] = 'General';
$_['tab_translate_site'] = 'Website content translation';
$_['tab_localization']   = 'Localization files translation';
$_['tab_debug']          = 'Debug';
$_['tab_about'] = 'About module';

// Value;
$_['value_analization_mode_only_empty'] = 'Search for empty values only';
$_['value_analization_mode_same_value'] = 'Search for duplicate values';
$_['value_analization_mode_both'] = 'Search for empty and identical values';

// Html Title attributes;
$_['title_translate_all_tables'] = 'Translate all tables';
$_['title_translate_table'] = 'Translate table {table}';
$_['title_translate_table_column'] = 'Translate the {textColumnName} column of the {table}';
$_['title_translate_table_confirmation'] = 'You really want to {translateTableTitle}?';
$_['title_translate_to_lang_suffix'] = '(language {langCode})';
$_['title_not_translater_char_count'] = 'Number of characters not translated';

// js constants;
$_['js_const_done_status'] = 'Completed!';
$_['js_const_in_progress_status'] = "In Progress...";
$_['js_const_statistic_html'] = "<div id='statusLog'> {historyLog}</div><div id='statusCurrent'> Таблиця <strong>{table}</strong>, translated: <strong class='statusTranslatedCharCount'>{translatedCharCount}</strong>, Status: <strong class='translatedStatus'>{status}</strong></div>";
$_['js_const_analization_process_is_started'] = "Analyzation process is in progress...<br>Table: <strong id='analization_current_table'></strong><br>Request number: <strong id='analization_request_number'>1</strong>";

// Error;
$_['error_permission'] = 'You do not have permission to manage this module!';
$_['Error_name'] = 'The module name must be between 3 and 64 characters!';
$_['error_width'] =' You must specify the width! ';
$_['error_height'] =' You must specify the height! ';
$_['error_unlicensed'] = '';
$_['error_debug_log_warning']	   = 'Warning: Your debug log file %s is %s!';

$_['error_lang_from_folder_is_not_exists']	   = 'Localization files folder for "Language to translate from" not found: ';
$_['error_lang_to_folder_is_not_exists']	   = 'Localization files folder for "Language to translate to" not found: ';
$_['error_lang_from_and_lang_to_are_equal']	   = 'Select language to translate to';

// Messages;
$_['message_analize_global_info'] =' <b>All tables</b> ';
$_['message_analize_table_head_info'] = ' <strong class="et_table" id="et_{table}">{table}</strong> ';
$_['message_analize_field_head_info'] = 'Text field <strong class="et_field" id="et_{table}_{textColumnName}">{textColumnName}</strong> ';



$_['entry_table_product_filter'] = 'Product filter';
$_['entry_table_product_status_filter'] = 'Product status filter, only active products';
$_['entry_table_product_quantity_filter'] = 'Product quantity filter, only products with quantity > 0)';
$_['entry_table_product_category_id_filter'] = 'Product category filter';
$_['entry_table_product_stock_status_filter'] = 'Product stock status filter';
$_['entry_filter_all'] = '';