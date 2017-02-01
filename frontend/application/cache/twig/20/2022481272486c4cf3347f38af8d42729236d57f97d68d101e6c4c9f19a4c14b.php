<?php

/* Emailtemplate/default.twig */
class __TwigTemplate_7635c57fd8773322cf98d6257a2a2a73a2dbf017680a4257c5efbafe14fe0390 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'emailheader' => array($this, 'block_emailheader'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\" />
        <meta http-equiv=\"Content-Language\" content=\"en\" />
    </head>

    <body style=\"background-color: #eeeeee; margin: 0; padding: 0;\">
        <table style=\"margin: 0 auto; width: 700px; border: 0; border-spacing: 0; border-collapse: collapse; table-layout: fixed; background-color: #EFF0F2\">
            <tr>
                <td style=\"font-size: 27px;background: #f8f8f8;-webkit-box-shadow: 0 1px 0 rgba(0,1,1,.08), inset 0 1px 0 #ededed;-moz-box-shadow: 0 1px 0 rgba(0,1,1,.08), inset 0 1px 0 #ededed;box-shadow: 0 1px 0 rgba(0,1,1,.08), inset 0 1px 0 #ededed; font-family: Arial; color: #2c2e2f; line-height: 18px !important; padding: 20px\">
                    ";
        // line 12
        $this->displayBlock('emailheader', $context, $blocks);
        // line 13
        echo "                </td>
            </tr>
            <tr>
                <td style=\"padding: 20px; font-family: Arial; font-size: 13px; color: #333333; background: #fff\">
                    ";
        // line 17
        $this->displayBlock('content', $context, $blocks);
        // line 18
        echo "                </td>
            </tr>
            <tr>
                <td style=\"background: #2c2e2f; padding: 10px 20px; font-size: 12px; color: #fff; font-family: Arial\">
                    <a href=\"http://design2code.hu\" style=\"color: #fff; text-decoration: none; float: right\">powered by <img src=\"";
        // line 22
        echo twig_escape_filter($this->env, Twigextension::getImage("email/logo@2x.png"), "html", null, true);
        echo "\" alt=\"\" style=\"height: 16px; display: inline-block; vertical-align: middle\"></a>
                </td>
            </tr>
        </table>
        </p>
    </body>
</html>";
    }

    // line 12
    public function block_emailheader($context, array $blocks = array())
    {
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "Emailtemplate/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 17,  61 => 12,  50 => 22,  44 => 18,  42 => 17,  36 => 13,  34 => 12,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\" />
        <meta http-equiv=\"Content-Language\" content=\"en\" />
    </head>

    <body style=\"background-color: #eeeeee; margin: 0; padding: 0;\">
        <table style=\"margin: 0 auto; width: 700px; border: 0; border-spacing: 0; border-collapse: collapse; table-layout: fixed; background-color: #EFF0F2\">
            <tr>
                <td style=\"font-size: 27px;background: #f8f8f8;-webkit-box-shadow: 0 1px 0 rgba(0,1,1,.08), inset 0 1px 0 #ededed;-moz-box-shadow: 0 1px 0 rgba(0,1,1,.08), inset 0 1px 0 #ededed;box-shadow: 0 1px 0 rgba(0,1,1,.08), inset 0 1px 0 #ededed; font-family: Arial; color: #2c2e2f; line-height: 18px !important; padding: 20px\">
                    {% block emailheader %}{% endblock %}
                </td>
            </tr>
            <tr>
                <td style=\"padding: 20px; font-family: Arial; font-size: 13px; color: #333333; background: #fff\">
                    {% block content %}{% endblock %}
                </td>
            </tr>
            <tr>
                <td style=\"background: #2c2e2f; padding: 10px 20px; font-size: 12px; color: #fff; font-family: Arial\">
                    <a href=\"http://design2code.hu\" style=\"color: #fff; text-decoration: none; float: right\">powered by <img src=\"{{ getImage('email/logo@2x.png') }}\" alt=\"\" style=\"height: 16px; display: inline-block; vertical-align: middle\"></a>
                </td>
            </tr>
        </table>
        </p>
    </body>
</html>", "Emailtemplate/default.twig", "C:\\xampp\\htdocs\\enigma\\core\\mailer\\views\\Emailtemplate\\default.twig");
    }
}
