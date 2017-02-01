<?php

/* Templates/default.twig */
class __TwigTemplate_deb81ac6b903ed6f9b84aa115f0c3e6c8f3b3e83e1ef5dbd72f372fead52a03d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'facebook_meta' => array($this, 'block_facebook_meta'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["forms"] = $this->loadTemplate("Formbuilder/form.twig", "Templates/default.twig", 1);
        // line 2
        $context["helpers"] = $this->loadTemplate("Templates/helpers.twig", "Templates/default.twig", 2);
        // line 3
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\" />
        <meta http-equiv=\"Content-Language\" content=\"en\" />
        <title>";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>

\t\t";
        // line 10
        if ((isset($context["canonical"]) ? $context["canonical"] : null)) {
            echo "<link rel=\"canonical\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["canonical"]) ? $context["canonical"] : null), "html", null, true);
            echo "\"/>";
        }
        // line 11
        echo "        <meta name=\"keywords\" content=\"";
        echo twig_escape_filter($this->env, (isset($context["meta_keywords"]) ? $context["meta_keywords"] : null), "html", null, true);
        echo "\" />
        <meta name=\"description\" content=\"";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["meta_description"]) ? $context["meta_description"] : null), "html", null, true);
        echo "\" />
        <meta name=\"copyright\" content=\"";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["meta_copywrite"]) ? $context["meta_copywrite"] : null), "html", null, true);
        echo "\" />

        ";
        // line 15
        $this->displayBlock('facebook_meta', $context, $blocks);
        // line 22
        echo "
        <script type=\"text/javascript\">
            var ROOT = '";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["ROOT"]) ? $context["ROOT"] : null), "html", null, true);
        echo "';
            var LANG = '";
        // line 25
        echo twig_escape_filter($this->env, (isset($context["LANG"]) ? $context["LANG"] : null), "html", null, true);
        echo "';
            var MEDIA = '";
        // line 26
        echo twig_escape_filter($this->env, (isset($context["MEDIA"]) ? $context["MEDIA"] : null), "html", null, true);
        echo "';
        </script>

        ";
        // line 29
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "css", array(), "array");
        // line 30
        echo "    </head>

    <body class=\"page-body\">
        <div class=\"container\">
            <div class=\"main-content\">
            ";
        // line 35
        $this->loadTemplate("Templates/header.twig", "Templates/default.twig", 35)->display($context);
        // line 36
        echo "
            ";
        // line 37
        $this->displayBlock('content', $context, $blocks);
        // line 38
        echo "
            ";
        // line 39
        $this->loadTemplate("Templates/footer.twig", "Templates/default.twig", 39)->display($context);
        // line 40
        echo "            </div>
        </div>

";
        // line 43
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "js", array(), "array");
        // line 44
        echo "
    </body>
";
        // line 47
        echo "</html>";
    }

    // line 15
    public function block_facebook_meta($context, array $blocks = array())
    {
        // line 16
        echo "            <meta property=\"og:url\" content=\"";
        echo twig_escape_filter($this->env, (isset($context["current_url"]) ? $context["current_url"] : null), "html", null, true);
        echo "\" />
            <meta property=\"og:type\" content=\"website\" />
            ";
        // line 18
        if ((isset($context["meta_og_title"]) ? $context["meta_og_title"] : null)) {
            echo "<meta property=\"og:title\" content=\"";
            echo twig_escape_filter($this->env, (isset($context["meta_og_title"]) ? $context["meta_og_title"] : null), "html", null, true);
            echo "\" />";
        }
        // line 19
        echo "            ";
        if ((isset($context["meta_og_desc"]) ? $context["meta_og_desc"] : null)) {
            echo "<meta property=\"og:description\" content=\"";
            echo twig_escape_filter($this->env, (isset($context["meta_og_desc"]) ? $context["meta_og_desc"] : null), "html", null, true);
            echo "\" />";
        }
        // line 20
        echo "            ";
        if ($this->getAttribute((isset($context["meta_og_image"]) ? $context["meta_og_image"] : null), "loaded", array(), "method")) {
            echo "<meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, Twigextension::getUserfile($this->getAttribute((isset($context["meta_og_image"]) ? $context["meta_og_image"] : null), "fi_url", array())), "html", null, true);
            echo "\" />";
        }
        // line 21
        echo "        ";
    }

    // line 37
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "Templates/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 37,  142 => 21,  135 => 20,  128 => 19,  122 => 18,  116 => 16,  113 => 15,  109 => 47,  105 => 44,  103 => 43,  98 => 40,  96 => 39,  93 => 38,  91 => 37,  88 => 36,  86 => 35,  79 => 30,  77 => 29,  71 => 26,  67 => 25,  63 => 24,  59 => 22,  57 => 15,  52 => 13,  48 => 12,  43 => 11,  37 => 10,  32 => 8,  25 => 3,  23 => 2,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% import \"Formbuilder/form.twig\" as forms %}
{% import \"Templates/helpers.twig\" as helpers %}
<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\" />
        <meta http-equiv=\"Content-Language\" content=\"en\" />
        <title>{{ title }}</title>

\t\t{% if canonical %}<link rel=\"canonical\" href=\"{{ canonical }}\"/>{% endif %}
        <meta name=\"keywords\" content=\"{{ meta_keywords }}\" />
        <meta name=\"description\" content=\"{{ meta_description }}\" />
        <meta name=\"copyright\" content=\"{{ meta_copywrite }}\" />

        {% block facebook_meta %}
            <meta property=\"og:url\" content=\"{{ current_url }}\" />
            <meta property=\"og:type\" content=\"website\" />
            {% if meta_og_title %}<meta property=\"og:title\" content=\"{{ meta_og_title }}\" />{% endif %}
            {% if meta_og_desc %}<meta property=\"og:description\" content=\"{{ meta_og_desc }}\" />{% endif %}
            {% if meta_og_image.loaded() %}<meta property=\"og:image\" content=\"{{ getUserfile(meta_og_image.fi_url) }}\" />{% endif %}
        {% endblock %}

        <script type=\"text/javascript\">
            var ROOT = '{{ ROOT }}';
            var LANG = '{{ LANG }}';
            var MEDIA = '{{ MEDIA }}';
        </script>

        {% autoescape false %}{{ assets['css'] }}{% endautoescape %}
    </head>

    <body class=\"page-body\">
        <div class=\"container\">
            <div class=\"main-content\">
            {% include \"Templates/header.twig\" %}

            {% block content %}{% endblock %}

            {% include \"Templates/footer.twig\" %}
            </div>
        </div>

{% autoescape false %}{{ assets['js'] }}{% endautoescape %}

    </body>
{#{% html.encodeEmail('test@test.hu') %}#}
</html>", "Templates/default.twig", "C:\\xampp\\htdocs\\gol\\frontend\\application\\views\\Templates\\default.twig");
    }
}
