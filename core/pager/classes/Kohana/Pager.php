<?php
/**
 * User: Tibor
 * Date: 2013.11.30.
 * Time: 20:06
 * Project: gag.hu
 * Company: d2c
 */
class Kohana_Pager
{

    public static function factory()
    {
        $pager = new Pager();
        return $pager;
    }

    public function get($type, $current, $max, $url, $options = array())
    {
        if ($max <= 1) return "";

        $twig = Kohana_Twig::instance();

        $context = array(
            'current'=>$current,
            'max'=>$max,
            'url'=>$url,
            'numbers'=>$this->getNumbers($type,$current,$max),
            'options'=>$options
        );

        $pager = $twig->loadTemplate('pagers/pager_'.$type.".twig")->render($context);

        return $pager;
    }

    public function getNumbers($type,$current,$max)
    {
        $result = array();
        switch($type)
        {
            case 1:
            case 2:
                $result = $this->getNumbersForType1($current,$max);
                break;
        }

        return $result;
    }

    public function getNumbersForType1($current,$pageNum)
    {
        $min = ($pageNum-4 > $current) ? $current : (($pageNum-4 > 0) ? $pageNum-4 : 1);
        $max = ($current+4 < $pageNum) ? $current+4 : $pageNum;

        return array(
            'min'=>$min,
            'max'=>$max
        );
    }
}