<?php

/* Jshelper/routing.twig */
class __TwigTemplate_8c05b355aebb0be2c345837be0c4a8259d4bc4cbac9e401d03a4bdced2a93d29 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "function jsRouter() {

    this.data = {};

    this.set = function(type,name,value) {
        if (!this.data.hasOwnProperty(type)) this.data[type] = {};

        this.data[type][name] = value;
    }

    this.get = function(name, params) {
        var method = (typeof params != 'undefined' && params.hasOwnProperty('method')) ? params['method'] : 'any';

        if (typeof(this.data[method][name]) != 'undefined') {
            var parts = [];
            \$.each(this.data[method][name],function(index,value){
                if (value.search(\"<\") != -1) {
                    var currentParam = value.replace(\"<\",\"\").replace(\">\",\"\");
                    if (params && params.hasOwnProperty(currentParam)) {
                        parts.push(params[currentParam]);
                    }
                } else {
                    parts.push(value);
                }
            });

            return parts.join(\"/\");

        } else return false;
    }
}

var jsRouter = new jsRouter();
";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["routings"]) ? $context["routings"] : null));
        foreach ($context['_seq'] as $context["type"] => $context["route"]) {
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["route"]);
            foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                // line 36
                echo "jsRouter.set('";
                echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                echo "','";
                echo twig_escape_filter($this->env, $context["index"], "html", null, true);
                echo "',";
                echo twig_jsonencode_filter($context["item"]);
                echo ");
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['route'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "Jshelper/routing.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 36,  58 => 35,  54 => 34,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("function jsRouter() {

    this.data = {};

    this.set = function(type,name,value) {
        if (!this.data.hasOwnProperty(type)) this.data[type] = {};

        this.data[type][name] = value;
    }

    this.get = function(name, params) {
        var method = (typeof params != 'undefined' && params.hasOwnProperty('method')) ? params['method'] : 'any';

        if (typeof(this.data[method][name]) != 'undefined') {
            var parts = [];
            \$.each(this.data[method][name],function(index,value){
                if (value.search(\"<\") != -1) {
                    var currentParam = value.replace(\"<\",\"\").replace(\">\",\"\");
                    if (params && params.hasOwnProperty(currentParam)) {
                        parts.push(params[currentParam]);
                    }
                } else {
                    parts.push(value);
                }
            });

            return parts.join(\"/\");

        } else return false;
    }
}

var jsRouter = new jsRouter();
{% for type,route in routings %}
{% for index,item in route %}
jsRouter.set('{{ type }}','{{ index }}',{% autoescape false %}{{ item|json_encode }}{% endautoescape %});
{% endfor %}
{% endfor %}", "Jshelper/routing.twig", "C:\\xampp\\htdocs\\gol\\core\\jshelper\\views\\Jshelper\\routing.twig");
    }
}
