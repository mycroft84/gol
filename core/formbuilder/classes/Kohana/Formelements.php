<?php

class Kohana_Formelements
{
    public $left = array();
    public $right = array();
    public $all = array();

    public function add($direction, $name, $type = null, array $options = array())
    {
        switch ($direction) {
            case 'right':
                $this->right[] = array('name' => $name, 'type' => $type, 'options' => $options);
                break;

            default:
                $this->left[] = array('name' => $name, 'type' => $type, 'options' => $options);
                break;
        }

        return $this;
    }

    public function getRenderedElements($direction = 'left', $lang)
    {
        $langs = Kohana::$config->load('settings.frontendLangs');
        $defaultLang = current($langs);

        $target = $this->$direction;
        $result = array();
        foreach ($target as $item) {
            if ($item['options']['render'] == true) {
                if (!isset($item['options']['type']) or $item['options']['type'] != 'hidden') {
                    if (in_array($lang,$langs)) {
                        //hasLang tabs
                        if ($defaultLang == $lang) {
                            $result[] = $item;
                        } else {
                            if ($item['options']['translate']) {
                                $result[] = $item;
                            }
                        }
                    } else {
                        if (isset($item['options']['tab']) == false || $item['options']['tab'] == $lang) {
                            $result[] = $item;
                        }
                    }
                }
            }
        }

        return $result;
    }

    public function getHiddenElements()
    {
        $result = array();
        foreach ($this->left as $item) {
            if ($item['options']['render'] == true) {
                if (isset($item['options']['type']) and $item['options']['type'] == 'hidden') {
                        $result[] = $item;
                }
            }
        }

        return $result;
    }
}