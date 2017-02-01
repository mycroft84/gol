<?php
/**
 * User: Tibor
 * Date: 2013.10.18.
 * Time: 22:09
 * Project: aurahotel.hu
 * Company: d2c
 */
class Model_Metadata extends ORM
{
    protected $_table_name = 'metadata';
    protected $_primary_key = 'met_id';

    protected $_translate_fields = array('met_title','met_desc','met_keys');

    public function getPageMeta(Request $request)
    {
        $requestLang = ORM::factory('languages')->getRequestLang($request);

        return $this->where('met_url','=',join("/",$requestLang['uri']))->find($requestLang['lang']);
    }
}