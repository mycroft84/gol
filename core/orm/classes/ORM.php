<?php defined('SYSPATH') OR die('No direct script access.');

class ORM extends Kohana_ORM {

    use Traits_ORM_Enabled,
        Traits_ORM_Orders,
        Traits_ORM_Defaults,
        Traits_ORM_Fileupload,
        Traits_ORM_Defaultvalues,
        Traits_ORM_Softdelete,
        Traits_ORM_Validations,
        Traits_ORM_Translate,
        Traits_ORM_Sluggable,
        Traits_ORM_Searchable,
        Traits_ORM_Save,
        Traits_ORM_Delete,
        Traits_ORM_Utility,
        Traits_ORM_Grid,
        Traits_ORM_Form,
        Traits_ORM_Logging;


	protected $form;
    protected $queries = array();

    protected $is_nested_tree = false;

    public static function factory($model, $id = NULL)
    {
        $model = self::getClassName($model);

        return new $model($id);
    }

    private static function getClassName($name)
    {
        if (strpos($name,'\\') !== false) {
            return self::getNamespaceName($name);
        } else {
            return self::getPR0Name($name);
        }
    }

    private static function getPR0Name($name)
    {
        $class = 'Model_';
        $parts = explode('_',$name);
        $name = array();
        foreach($parts as $item)
        {
           $name[] = ucfirst($item);
        }

        return $class.join('_',$name);
    }

    private static function getNamespaceName($name)
    {
        $parts = explode('\\',$name);
        if ($parts[0] == 'Backend' || $parts[0] == 'Frontend') $parts = Arr::insert($parts,1,'Model');

        return '\\'.join('\\',$parts);
    }
}
