<?php defined('SYSPATH') or die('No direct script access.');

class Controller_DefaultTemplate extends Controller_Twig
{
	
    public $template = 'templates/default';
    
    public function before()
	{
		// Run anything that need ot run before this.
		parent::before();

        $ac = Access_Control::instance();
        $ac->check($this,Auth::instance());

        //Cache::$default = "file";

       //Set actually language
        $requestLang = ORM::factory('languages')->getRequestLang($this->request);
        $lang = $requestLang['lang'];
        Session::instance()->set('f_default_lang',$lang);

		I18n::lang($lang);
		//I18n::lang('de');

		if ($this->request->is_ajax())
		{
			$this->auto_render = FALSE;
            if (Kohana::$environment != Kohana::DEVELOPMENT) $this->response->headers('Content-Type', 'application/json');
		}
		
		if($this->auto_render)
		{
			// Initialize empty values
			$this->context->title = 'Welcome';
			$this->context->meta_keywords = '';
			$this->context->meta_description = '';
			$this->context->meta_copywrite = '';
		}
        
                
	}
	
	/**
	* Fill in default values for our properties before rendering the output.
	*/
	public function after()
	{
        if($this->auto_render)
        {
            $assets =  AssetManager::instance()->getRequestAssets($this->request);
            $files = AssetCollection::instance()->getAssets($assets['css'],$assets['js']);

            $assets = Assets::instance()
                    ->controller($this->request->controller())
                    ->action($this->request->action());

            foreach($files['css'] as $css)
            {
                //echo Debug::vars($css);
                $assets->css($css);
            }

            foreach($files['js'] as $js)
            {
                $assets->js($js);
            }

            $this->context->assets = $assets->render();

            $this->context->LANG = i18n::$lang;
            $this->context->ROOT = URL::base(null,true);
            $this->context->MEDIA = URL::base(null,false);
            $this->context->MODULES = Kohana::modules();
            $this->context->IS_IFRAME = (Input::get('iframe')) ? true : false;
            $this->context->IS_CHECKED_SOCIAL_LOGIN = Session::instance()->get('is_checked_social_login',false);

            $title = $this->context->title;
            $meta = ORM::factory('metadata')->getPageMeta($this->request);
            if ($meta->loaded()) {
                $title = $meta->met_title;
                $this->context->meta_keywords = $meta->met_keys;
                $this->context->meta_description = $meta->met_desc;
                $this->context->meta_og_title = $meta->met_og_title;
                $this->context->meta_og_desc = $meta->met_og_desc;
                $this->context->meta_og_image = $meta->getFiles()->getDefaultPic();
            }

            $this->context->title = $title." | ".Kohana::$config->load('settings.siteName');
            
            $current_url = trim(URL::base().Request::uri().URL::query(),"/")."/";
            $this->context->current_url = $current_url;
        }

		// Run anything that needs to run after this.
		parent::after();
	}
}
