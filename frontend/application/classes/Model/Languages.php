<?php
/**
 * User: MyCroft
 * Company: design2code.hu
 * Product: d2cadmin
 * Date: 2013.05.11.
 * Time: 11:29
 */
class Model_Languages extends ORM {

    protected $_table_name = 'statictext';
    protected $_primary_key = 'stt_id';

    protected $_translate_fields = array('stt_text');
    
    public function getRequestLang(Request $request = null)
    {
		if ($request == null) $request = Request::factory();
	
        $langs = Kohana::$config->load('settings.frontendLangs');
        $uriParts = explode('/',$request->uri());

        $uri = array_diff($uriParts,$langs);
        $langTemp = array_intersect($langs,$uriParts);
        $lang = (empty($langTemp)) ? current($langs) : current($langTemp);

        if (Kohana::$config->load('settings.forceLang')) $lang = Kohana::$config->load('settings.forceLang');

        return array('uri'=>$uri,'lang'=>$lang);
    }
}