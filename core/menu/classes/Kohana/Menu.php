<?php
/**
 * User: MyCroft
 * Date: 2013.09.30.
 * Time: 10:14
 * Project: delina.hu
 * Company: d2c
 */
class Kohana_Menu
{
    private $_config = array();

    protected $_modules = array();
    protected $_main = array();

    private $auth = null;

    public static function instance(Auth $auth = null)
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Menu();
        }
        $inst->_config = Kohana::$config->load('menu');
        $inst->auth = $auth;

        return $inst;
    }

    public function generate()
    {
        foreach($this->_config as $item)
        {
            if (!isset($item['environment']) or $item['environment'] === Kohana::$environment)
            {
                if ($this->isEnabled($item))
                {
                    $this->convertMenu($item);
                    $this->addMenu($item);
                }
            }
        }

        $this->orders();

        return array(
            'module'=>$this->_modules,
            'main'=>$this->_main
        );
    }

    private function addMenu($item)
    {
        $target = ($item['type'] == 'module') ? $this->_modules : $this->_main;

        if (isset($item['top']) and !array_key_exists($item['top'],$target)) {
            $target[$item['top']] = array(
                'name'=>$item['top'],
                'position'=>$item['position'],
                'icon'=>(isset($item['sub'])) ? $item['topicon'] : $item['icon'],
            );
        }

        if (isset($item['sub'])) {
            if (!isset($target[$item['top']]['sub'])) {
                $target[$item['top']]['sub'] = array();
            }

            if (!array_key_exists($item['sub'],$target[$item['top']]['sub'])) {
                $target[$item['top']]['sub'][$item['sub']] = array(
                    'name'=>$item['sub'],
                    'isSub'=>true,
                    'position'=>$item['subposition'],
                    'icon'=>$item['icon'],
                    'links'=>array()
                );
            }

        }

        foreach ($item['menu'] as $link) {
            if (isset($item['sub'])) {
                $link['topName'] = $item['top'];
                $link['subName'] = $item['sub'];
                $target[$item['top']]['sub'][$item['sub']]['links'][] = $link;
            } else {
                $link['topName'] = $item['top'];
                $target[$item['top']]['links'][] = $link;
            }
        }


        if ($item['type'] == 'module') {
            $this->_modules = $target;
        } else {
            $this->_main = $target;
        }
    }

    private function isEnabled($item)
    {
        if (isset($item['roles']) and $this->auth)
        {
            if (!is_array($item['roles'])) {
                return $this->auth->hasRole($item['roles']);
            } else {
                $enabled = false;
                foreach($item['roles'] as $role)
                {
                    //echo Debug::vars($role,$this->auth->hasRole($role),$item);
                    if ($this->auth->hasRole($role)) $enabled = true;
                }

                return $enabled;
            }
        }

        return true;
    }

    private function orders()
    {
        usort($this->_modules,array('self','sort'));
        usort($this->_main,array('self','sort'));

        foreach($this->_modules as &$item)
        {
            if (isset($item['sub']))
                usort($item['sub'],array('self','sort'));
        }

        foreach($this->_main as &$item)
        {
            if (isset($item['sub']))
                usort($item['sub'],array('self','sort'));
        }
    }

    private function convertMenu(&$item)
    {
        $menu = array();
        foreach($item['menu'] as $mIndex=>$mItem)
        {
            if (!isset($mItem['environment']) or $mItem['environment'] == Kohana::$environment)
            {
                if ($this->isEnabled($mItem))
                {

                    if (!is_array($mItem)) $menu[] = array('url'=>URL::base(null,true).$mItem,'name'=>$mIndex);
                    else {
                        $mItem['url'] = URL::base(null,true).$mItem['url'];
                        $menu[] = $mItem;
                    }
                }
            }
        }
        $item['menu'] = $menu;
    }

    private static function sort($a,$b)
    {
        if ($a['position'] == $b['position']) return 0;

        return ($a['position'] > $b['position']) ? 1 : -1;
    }

}