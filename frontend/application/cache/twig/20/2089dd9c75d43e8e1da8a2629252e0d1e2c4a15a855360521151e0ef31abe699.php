<?php

/* Templates/default.twig */
class __TwigTemplate_a5e397f4a745ad008ab4b417ac167fafffab454b1d20af9cbb6f211d302e2522 extends Twig_Template
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

        <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-57x57.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-60x60.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-72x72.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-76x76.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-114x114.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-120x120.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-144x144.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-152x152.png"), "html", null, true);
        echo "\">
        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/apple-touch-icon-180x180.png"), "html", null, true);
        echo "\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/favicon-32x32.png"), "html", null, true);
        echo "\" sizes=\"32x32\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/android-chrome-192x192.png"), "html", null, true);
        echo "\" sizes=\"192x192\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/favicon-96x96.png"), "html", null, true);
        echo "\" sizes=\"96x96\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, Twigextension::getImage("favicon/favicon-16x16.png"), "html", null, true);
        echo "\" sizes=\"16x16\">
        <link rel=\"manifest\" href=\"/manifest.json\">
        <meta name=\"msapplication-TileColor\" content=\"#da532c\">
        <meta name=\"msapplication-TileImage\" content=\"/mstile-144x144.png\">
        <meta name=\"theme-color\" content=\"#ffffff\">

\t\t";
        // line 28
        if ((isset($context["canonical"]) ? $context["canonical"] : null)) {
            echo "<link rel=\"canonical\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["canonical"]) ? $context["canonical"] : null), "html", null, true);
            echo "\"/>";
        }
        // line 29
        echo "        <meta name=\"keywords\" content=\"";
        echo twig_escape_filter($this->env, (isset($context["meta_keywords"]) ? $context["meta_keywords"] : null), "html", null, true);
        echo "\" />
        <meta name=\"description\" content=\"";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["meta_description"]) ? $context["meta_description"] : null), "html", null, true);
        echo "\" />
        <meta name=\"copyright\" content=\"";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["meta_copywrite"]) ? $context["meta_copywrite"] : null), "html", null, true);
        echo "\" />

        ";
        // line 33
        $this->displayBlock('facebook_meta', $context, $blocks);
        // line 40
        echo "
        <script type=\"text/javascript\">
            var ROOT = '";
        // line 42
        echo twig_escape_filter($this->env, (isset($context["ROOT"]) ? $context["ROOT"] : null), "html", null, true);
        echo "';
            var LANG = '";
        // line 43
        echo twig_escape_filter($this->env, (isset($context["LANG"]) ? $context["LANG"] : null), "html", null, true);
        echo "';
            var MEDIA = '";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["MEDIA"]) ? $context["MEDIA"] : null), "html", null, true);
        echo "';
            var LOGGED_IN = ";
        // line 45
        if (Twigextension::logged_in()) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";
            var IS_CHECKED_SOCIAL_LOGIN = ";
        // line 46
        if ((isset($context["IS_CHECKED_SOCIAL_LOGIN"]) ? $context["IS_CHECKED_SOCIAL_LOGIN"] : null)) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";
        </script>

        ";
        // line 49
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "css", array(), "array");
        // line 50
        echo "    </head>

    <body>

        <div id=\"fb-root\"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = \"//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v";
        // line 59
        echo twig_escape_filter($this->env, Twigextension::config("facebook.version"), "html", null, true);
        echo "&appId=";
        echo twig_escape_filter($this->env, Twigextension::config("facebook.appId"), "html", null, true);
        echo "\";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        ";
        // line 64
        $this->loadTemplate("Templates/header.twig", "Templates/default.twig", 64)->display($context);
        // line 65
        echo "
        ";
        // line 66
        $this->displayBlock('content', $context, $blocks);
        // line 67
        echo "
        ";
        // line 68
        $this->loadTemplate("Templates/footer.twig", "Templates/default.twig", 68)->display($context);
        // line 69
        echo "
";
        // line 70
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "js", array(), "array");
        // line 71
        echo "
    </body>
";
        // line 74
        echo "</html>";
    }

    // line 33
    public function block_facebook_meta($context, array $blocks = array())
    {
        // line 34
        echo "            <meta property=\"og:url\" content=\"";
        echo twig_escape_filter($this->env, (isset($context["current_url"]) ? $context["current_url"] : null), "html", null, true);
        echo "\" />
            <meta property=\"og:type\" content=\"website\" />
            ";
        // line 36
        if ((isset($context["meta_og_title"]) ? $context["meta_og_title"] : null)) {
            echo "<meta property=\"og:title\" content=\"";
            echo twig_escape_filter($this->env, (isset($context["meta_og_title"]) ? $context["meta_og_title"] : null), "html", null, true);
            echo "\" />";
        }
        // line 37
        echo "            ";
        if ((isset($context["meta_og_desc"]) ? $context["meta_og_desc"] : null)) {
            echo "<meta property=\"og:description\" content=\"";
            echo twig_escape_filter($this->env, (isset($context["meta_og_desc"]) ? $context["meta_og_desc"] : null), "html", null, true);
            echo "\" />";
        }
        // line 38
        echo "            ";
        if ($this->getAttribute((isset($context["meta_og_image"]) ? $context["meta_og_image"] : null), "loaded", array(), "method")) {
            echo "<meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, Twigextension::getUserfile($this->getAttribute((isset($context["meta_og_image"]) ? $context["meta_og_image"] : null), "fi_url", array())), "html", null, true);
            echo "\" />";
        }
        // line 39
        echo "        ";
    }

    // line 66
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
        return array (  231 => 66,  227 => 39,  220 => 38,  213 => 37,  207 => 36,  201 => 34,  198 => 33,  194 => 74,  190 => 71,  188 => 70,  185 => 69,  183 => 68,  180 => 67,  178 => 66,  175 => 65,  173 => 64,  163 => 59,  152 => 50,  150 => 49,  140 => 46,  132 => 45,  128 => 44,  124 => 43,  120 => 42,  116 => 40,  114 => 33,  109 => 31,  105 => 30,  100 => 29,  94 => 28,  85 => 22,  81 => 21,  77 => 20,  73 => 19,  69 => 18,  65 => 17,  61 => 16,  57 => 15,  53 => 14,  49 => 13,  45 => 12,  41 => 11,  37 => 10,  32 => 8,  25 => 3,  23 => 2,  21 => 1,);
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

        <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"{{ getImage('favicon/apple-touch-icon-57x57.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"{{ getImage('favicon/apple-touch-icon-60x60.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"{{ getImage('favicon/apple-touch-icon-72x72.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"{{ getImage('favicon/apple-touch-icon-76x76.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"{{ getImage('favicon/apple-touch-icon-114x114.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"{{ getImage('favicon/apple-touch-icon-120x120.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"{{ getImage('favicon/apple-touch-icon-144x144.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"{{ getImage('favicon/apple-touch-icon-152x152.png') }}\">
        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{{ getImage('favicon/apple-touch-icon-180x180.png') }}\">
        <link rel=\"icon\" type=\"image/png\" href=\"{{ getImage('favicon/favicon-32x32.png') }}\" sizes=\"32x32\">
        <link rel=\"icon\" type=\"image/png\" href=\"{{ getImage('favicon/android-chrome-192x192.png') }}\" sizes=\"192x192\">
        <link rel=\"icon\" type=\"image/png\" href=\"{{ getImage('favicon/favicon-96x96.png') }}\" sizes=\"96x96\">
        <link rel=\"icon\" type=\"image/png\" href=\"{{ getImage('favicon/favicon-16x16.png') }}\" sizes=\"16x16\">
        <link rel=\"manifest\" href=\"/manifest.json\">
        <meta name=\"msapplication-TileColor\" content=\"#da532c\">
        <meta name=\"msapplication-TileImage\" content=\"/mstile-144x144.png\">
        <meta name=\"theme-color\" content=\"#ffffff\">

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
            var LOGGED_IN = {% if logged_in() %}true{% else %}false{% endif %};
            var IS_CHECKED_SOCIAL_LOGIN = {% if IS_CHECKED_SOCIAL_LOGIN %}true{% else %}false{% endif %};
        </script>

        {% autoescape false %}{{ assets['css'] }}{% endautoescape %}
    </head>

    <body>

        <div id=\"fb-root\"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = \"//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v{{ \"facebook.version\"|config }}&appId={{ \"facebook.appId\"|config }}\";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        {% include \"Templates/header.twig\" %}

        {% block content %}{% endblock %}

        {% include \"Templates/footer.twig\" %}

{% autoescape false %}{{ assets['js'] }}{% endautoescape %}

    </body>
{#{% html.encodeEmail('test@test.hu') %}#}
</html>", "Templates/default.twig", "C:\\xampp\\htdocs\\enigma\\frontend\\application\\views\\Templates\\default.twig");
    }
}
