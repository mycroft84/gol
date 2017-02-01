<?php
/**
 * User: Tibor
 * Date: 2015.08.24.
 * Time: 20:01
 * Project: enigma
 * Company: d2c
 */
trait Traits_ORM_Sluggable
{
    public function getSlug($name,$field)
    {
        if (is_array($this->$field))
        {
            $temp = array();
            $currentSlug = $this->$name;

            foreach($this->$field as $index=>$item)
            {
                $slug = $this->createSlug($name,$item,(isset($currentSlug[$index])) ? $currentSlug[$index] : '',$index);
                $temp[$index] = $slug;
            }

            return $temp;
        } else {
            return $this->createSlug($name,$this->$field,$this->$name);
        }
    }

    public function createSlug($name,$text,$currentSlug,$lang = false)
    {
        $slug = $this->toAscii($text);
        $defaultLang = current(Kohana::$config->load('settings.frontendLangs'));

        if ($lang == false) $lang = $defaultLang;
        $currentSlugName = join('-',explode('-',$currentSlug,-1));

        if ($slug == $currentSlug) return $currentSlug;
        elseif ($slug == $currentSlugName) return $currentSlug;
        else
        {
            if (in_array($name,$this->_translate_fields)) {

				$this->createLanguagesTable();
                $this->createTranslateView();

                $view = $this->table_name()."_lang_view";
                $count = DB::select($name)
                    ->from($view)
                    ->where($name,'LIKE',"%".$slug."%")
                    ->where($this->primary_key(),'!=',$this->pk())
                    ->where('lang','=',$lang)
                    ->execute()->as_array();

            } else {
                $count = DB::select($name)
                    ->from($this->table_name())
                    ->where($name,'LIKE',"%".$slug."%")
                    ->where($this->primary_key(),'!=',$this->pk())
                    ->execute()->as_array();

            }

            $count = Arr::DBQueryConvertSingleArray($count);
            natsort($count);
            $lastNum = explode('-',end($count));

            if (count($count) == 0) $newSlug = $slug;
            elseif (count($count) == 1) $newSlug = $slug."-1";
            else $newSlug = $slug."-".(end($lastNum)+1);

            return $newSlug;
        }
    }

    public function toAscii($str, $delimiter='-')
    {
        try {
            $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        } catch (Exception $e){
            $encoding = mb_detect_encoding($str, mb_detect_order(), false);
            if($encoding == "UTF-8")
            {
                $str = mb_convert_encoding($str, 'ASCII','UTF-8');
            }
            $clean = @iconv('UTF-8', 'ASCII//IGNORE', $str);
        }

        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}