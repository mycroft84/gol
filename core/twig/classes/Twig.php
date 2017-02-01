<?php
/**
 * User: Tibor
 * Date: 2014.02.24.
 * Time: 19:44
 * Project: csodaszarvastajpark.hu
 * Company: d2c
 */
class Twig extends Kohana_Twig
{
    public static function get_template_content($template,array $context = array())
    {
        $twig = Kohana_Twig::instance();
        return $twig->loadTemplate($template)->render($context);
    }
}