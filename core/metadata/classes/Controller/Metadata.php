<?php
/**
 * User: MyCroft
 * Date: 15-01-07
 * Time: 13:44
 * Company: d2c
 */

class Controller_Metadata extends Controller_DefaultTemplate
{
    public function action_index()
    {
        $this->context->title = Kohana::subtitles('breadcrumbMetadataList');
        $this->context->current_menu = Kohana::$config->load('menu.metadata.top');
        $this->context->current_submenu= 'metadata_list';

        $metadata = new Model_Metadata();
        $grid = Grid::factory('Metadata',$metadata);
        $this->context->grid = $grid->render();
    }

    public function action_create()
    {
        $metadata = new Model_Metadata();
        $form = Formbuilder::factory('metadata',$metadata);

        $this->context->form = $form->render();

        $this->context->title = Kohana::subtitles('breadcrumbMetadataCreate');
        $this->context->current_menu = Kohana::$config->load('menu.metadata.top');
        $this->context->current_submenu= 'metadata_create';
    }

    public function action_update()
    {
        $metadata = new Model_Metadata();
        $metadata->findByPk($this->request->param('slug'),'*');

        if ($metadata->loaded())
        {
            $form = Formbuilder::factory('metadata',$metadata);
            $this->context->form = $form->render();

            $this->context->title = Kohana::subtitles('breadcrumbMetadataUpdate');
            $this->context->current_menu = Kohana::$config->load('menu.metadata.top');
            $this->context->current_submenu= 'metadata_list';

        } else throw new Kohana_HTTP_Exception_404;
    }

    public function action_details()
    {
        $metadata = new Model_Metadata();
        $metadata->findByPk($this->request->param('slug'),I18n::$lang);

        if ($metadata->loaded())
        {
            $this->context->title = Kohana::subtitles('breadcrumbMetadataDetails');
            $this->context->current_menu = Kohana::$config->load('menu.metadata.top');
            $this->context->current_submenu= 'metadata_list';

            $details = Details::factory('Metadata',$metadata);
            $this->context->details = $details->render();
            $this->context->slug = $this->request->param('slug');
        }

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
            case 'metadata':
                $model = new Model_Metadata();
                $grid = Grid::factory('Metadata',$model);
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