<?php
/**
 * User: Tibi
 * Date: 2015.02.25.
 * Time: 13:51
 * Project: enigma
 * Company: d2c
 */

class Task_Assets_Compress extends Minion_Task
{
    protected $_options = array(
        'controller' => '',
        'action' => '',
    );

    public function build_validation(Validation $validation)
    {
        return parent::build_validation($validation);
    }

    protected function _execute(array $params)
    {
        if ($params['controller'] and $params['action']) {
            $this->doCompress($params['controller'],$params['action']);
        } elseif ($params['controller']) {
            $all = $this->getControllerActions();
            if (array_key_exists($params['controller'],$all)) {
                foreach ($all[$params['controller']] as $action) {
                    $this->doCompress($params['controller'],$action);
                }
            }
        } else {
            $all = $this->getControllerActions();
            foreach($all as $controller=>$block) {
                foreach ($block as $action) {
                    $this->doCompress($controller,$action);
                }

            }
        }
    }

    private function doCompress($controller,$action)
    {
        $assets =  AssetManager::instance()->getRequestAssets(null,$controller,$action);
        $files = AssetCollection::instance()->getAssets($assets['css'],$assets['js']);

        $assets = Assets::instance()
                ->controller(ucfirst($controller))
                ->action($action);

        foreach($files['css'] as $css)
        {
            //echo Debug::vars($css);
            $assets->css($css);
        }

        foreach($files['js'] as $js)
        {
            $assets->js($js);
        }

        $assets->render();
    }

    private function getControllerActions()
    {
        return Route::getUriControllersActions();
    }
}