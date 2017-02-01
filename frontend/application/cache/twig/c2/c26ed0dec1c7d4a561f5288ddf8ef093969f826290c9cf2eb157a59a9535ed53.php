<?php

/* helpers/phpstorm_meta.twig */
class __TwigTemplate_eee0b052ecb7e67181648253ffe603f8c435766f485c06ad6ddb2c3e48e3d308 extends Twig_Template
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
        echo "<?php
/**
 * User: MyCroft
 * Date: ";
        // line 4
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "y-m-d"), "html", null, true);
        echo "
 * Time: ";
        // line 5
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "H:i"), "html", null, true);
        echo "
 * Company: d2c
 */

namespace PHPSTORM_META {
    \$STATIC_METHOD_TYPES = [
        \\Kohana_Model::factory('') => [
";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["files"]) ? $context["files"] : null));
        foreach ($context['_seq'] as $context["index"] => $context["block"]) {
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["block"]);
            foreach ($context['_seq'] as $context["name"] => $context["path"]) {
                // line 14
                echo "            '";
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "' instanceof ";
                echo twig_escape_filter($this->env, $context["path"], "html", null, true);
                echo ",
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['path'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['index'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "        ],
    ];
}";
    }

    public function getTemplateName()
    {
        return "helpers/phpstorm_meta.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 17,  46 => 14,  42 => 13,  38 => 12,  28 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<?php
/**
 * User: MyCroft
 * Date: {{ now|date('y-m-d') }}
 * Time: {{ now|date('H:i') }}
 * Company: d2c
 */

namespace PHPSTORM_META {
    \$STATIC_METHOD_TYPES = [
        \\Kohana_Model::factory('') => [
{% for index,block in files %}
{% for name,path in block %}
            '{{ name }}' instanceof {{ path }},
{% endfor %}
{% endfor %}
        ],
    ];
}", "helpers/phpstorm_meta.twig", "C:\\xampp\\htdocs\\gol\\core\\helpers\\views\\helpers\\phpstorm_meta.twig");
    }
}
