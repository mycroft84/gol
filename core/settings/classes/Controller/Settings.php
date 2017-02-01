<?php
/**
 * User: MyCroft
 * Date: 15-01-14
 * Time: 10:19
 * Company: d2c
 */

class Controller_Settings extends Controller_DefaultTemplate
{
    public function action_index()
    {
        $this->context->title = Kohana::subtitles('breadcrumbSettingsList');
        $this->context->current_menu = Kohana::$config->load('menu.settings.top');
        $this->context->current_submenu= 'settings_list';

        $settings = new Model_Settings();
        $grid = Grid::factory('Settings',$settings);
        $this->context->grid = $grid->render();
    }

    public function action_create()
    {
        $settings = new Model_Settings();
        $form = Formbuilder::factory('settings',$settings);

        $this->context->form = $form->render();

        $this->context->title = Kohana::subtitles('breadcrumbSettingsCreate');
        $this->context->current_menu = Kohana::$config->load('menu.settings.top');
        $this->context->current_submenu= 'settings_create';
    }

    public function action_update()
    {
        $settings = new Model_Settings();
        $settings->findByPk($this->request->param('slug'),'*');

        if ($settings->loaded() and $settings->set_display)
        {
            $form = Formbuilder::factory('settings',$settings);
            $this->context->form = $form->render();

            $this->context->title = Kohana::subtitles('breadcrumbSettingsUpdate');
            $this->context->current_menu = Kohana::$config->load('menu.settings.top');
            $this->context->current_submenu= 'settings_list';

        } else throw new Kohana_HTTP_Exception_404;
    }

    public function action_details()
    {
        $settings = new Model_Settings();
        $settings->findByPk($this->request->param('slug'),I18n::$lang);

        if ($settings->loaded())
        {
            $this->context->title = Kohana::subtitles('breadcrumbSettingsDetails');
            $this->context->current_menu = Kohana::$config->load('menu.settings.top');
            $this->context->current_submenu= 'settings_list';

            $details = Details::factory('Settings',$settings);
            $this->context->details = $details->render();
            $this->context->slug = $this->request->param('slug');
        } else throw new Kohana_HTTP_Exception_404;

    }

    function action_ajax()
    {
        if (!$this->request->is_ajax()) {
            $this->auto_render = false;
            echo 'Only Ajax Request!';
            exit;
        }

        switch($this->request->param('actiontarget'))
        {
            case 'settings':
                $model = new Model_Settings();
                $grid = Grid::factory('Settings',$model);
                switch($this->request->param('maintarget'))
                {
                    case 'save':
                        $data = $model->submit(Input::post_all(true));
                        echo json_encode($data);
                        break;

                    case 'validation':
                        $data = $model->ajaxValidation(Input::post_all());
                        echo json_encode($data);
                        break;

                    case 'getGrid':
                        echo json_encode($grid->getData(Input::post('page'),Input::post('order'),Input::post('orderDir'),Input::post('limit'),Input::post('filter')));
                        break;

                    case 'autocomplete':
                        echo json_encode($grid->getAutocompleteData(Input::post_all()));
                        break;

                    case 'del':
                        $data = $model->delByPk(Input::post('id'));
                        echo json_encode($data);
                        break;
                }
                break;

            default: echo json_encode('Action target not found!');
        }
    }
}