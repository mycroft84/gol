<?php
class View_Extensions extends Twig_Extension {

    public function getTokenParsers() {
        return array(
            new ViewExtensionHtmlTokenParser(), // all HTML methods
            new ViewExtensionFormTokenParser(), // all Form methods
            new ViewExtensionDebugTokenParser(), // all Debug methods
        );
    }

    public function getFilters() {
        return array(
            'limit_words'       =>  new Twig_Filter_Function('Text::limit_words'),
            'i18n'              =>  new Twig_Filter_Function('Twigextension::i18n'),
            'i18nHtml'              =>  new Twig_Filter_Function('Twigextension::i18nHtml'),
            'config'            =>  new Twig_Filter_Function('Twigextension::config'),
            'pad'               =>  new Twig_Filter_Function('Twigextension::pad'),
            'in_array'          =>  new Twig_Filter_Function('Twigextension::in_array'),
            'mb_strlen'         =>  new Twig_Filter_Function('Twigextension::mb_strlen'),
            'mb_substr'         =>  new Twig_Filter_Function('Twigextension::mb_substr'),
            'shortest'          =>  new Twig_Filter_Function('Twigextension::shortest'),
            'shortest_word'     =>  new Twig_Filter_Function('Twigextension::shortest_word'),
            'chunk'             =>  new Twig_Filter_Function('Twigextension::chunk'),
            'str_replace'       =>  new Twig_Filter_Function('Twigextension::str_replace'),
        );
    }
    
    public function getFunctions() {
        return array(
            'path'              =>  new Twig_Function_Function('Twigextension::path'),
            'url'               =>  new Twig_Function_Function('Twigextension::url'),
            'getImage'          =>  new Twig_Function_Function('Twigextension::getImage'),
            'getUserfile'       =>  new Twig_Function_Function('Twigextension::getUserfile'),
            'logged_in'         =>  new Twig_Function_Function('Twigextension::logged_in'),
            'get_user'          =>  new Twig_Function_Function('Twigextension::get_user'),
            'isGranted'         =>  new Twig_Function_Function('Twigextension::isGranted'),
            'hasRole'           =>  new Twig_Function_Function('Twigextension::hasRole'),
            'checkCurrentMenu'  =>  new Twig_Function_Function('Twigextension::checkCurrentMenu'),
            'time'              =>  new Twig_Function_Function('Twigextension::time'),
        );
    }

    public function getName() {
        return 'view_extension';
    }
}