<?php
/**
 * User: Tibor
 * Date: 2013.10.18.
 * Time: 21:40
 * Project: aurahotel.hu
 * Company: d2c
 */
class Model_Staticpage extends ORM
{
    protected $_table_name = 'staticpage';
    protected $_primary_key = 'stp_id';

    protected $_translate_fields = array('stp_page');

    public static function routing($route,$defaults,$request)
    {
        $requestLang = ORM::factory('languages')->getRequestLang($request);
        
        $page = ORM::factory('staticpage')->where('stp_url','=',join('/',$requestLang['uri']))->find($requestLang['lang']);
        if ($page->loaded()) {
            $meta = ORM::factory('metadata')->getPageMeta($request);

            return array(
                'controller'=>'Staticpage',
                'action'=>'index',
                'page'=>$page,
                'meta'=>$meta
            );
        }

        return array();
    }
}