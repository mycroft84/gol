<?php

/* Emailtemplate/remember.twig */
class __TwigTemplate_d222a8f255c942dfbb102d4990c1c10a43ec1ce1ffeb072e8e87316f955e926a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("Emailtemplate/default.twig", "Emailtemplate/remember.twig", 1);
        $this->blocks = array(
            'emailheader' => array($this, 'block_emailheader'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "Emailtemplate/default.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_emailheader($context, array $blocks = array())
    {
        // line 4
        echo "    Kedves ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "first_name", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "last_name", array()), "html", null, true);
        echo "!
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "    <p>Ön elfelejtte a jelszavát, kérésére új jelszót generálunk önnek: <strong>";
        echo twig_escape_filter($this->env, (isset($context["password"]) ? $context["password"] : null), "html", null, true);
        echo "</strong></p>
";
    }

    public function getTemplateName()
    {
        return "Emailtemplate/remember.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 8,  41 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'Emailtemplate/default.twig' %}

{% block emailheader %}
    Kedves {{ user.first_name }} {{ user.last_name }}!
{% endblock %}

{% block content %}
    <p>Ön elfelejtte a jelszavát, kérésére új jelszót generálunk önnek: <strong>{{ password }}</strong></p>
{% endblock %}", "Emailtemplate/remember.twig", "C:\\xampp\\htdocs\\enigma\\frontend\\application\\views\\Emailtemplate\\remember.twig");
    }
}
