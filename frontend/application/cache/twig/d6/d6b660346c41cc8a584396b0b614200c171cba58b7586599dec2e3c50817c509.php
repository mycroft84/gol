<?php

/* Templates/helpers.twig */
class __TwigTemplate_211c20141af5d9dd3bf02784d0737077f878dd5d881b3ac2aef98263d8831ef6 extends Twig_Template
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
        // line 6
        echo "
";
        // line 14
        echo "
";
    }

    // line 1
    public function getads($__id__ = null, $__ads__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "id" => $__id__,
            "ads" => $__ads__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "    ";
            if ($this->getAttribute($this->getAttribute((isset($context["ads"]) ? $context["ads"] : null), (isset($context["id"]) ? $context["id"] : null), array(), "array"), "enabled", array())) {
                // line 3
                echo "        ";
                $this->loadTemplate(twig_template_from_string($this->env, $this->getAttribute($this->getAttribute((isset($context["ads"]) ? $context["ads"] : null), (isset($context["id"]) ? $context["id"] : null), array(), "array"), "code", array())), "Templates/helpers.twig", 3)->display(array_merge($context, array("file" => $this->getAttribute($this->getAttribute((isset($context["ads"]) ? $context["ads"] : null), (isset($context["id"]) ? $context["id"] : null), array(), "array"), "file", array()))));
                // line 4
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 7
    public function getadsORM($__ads__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "ads" => $__ads__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 8
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["ads"]) ? $context["ads"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 9
                echo "        ";
                if ($this->getAttribute($context["item"], "ads_enabled", array())) {
                    // line 10
                    echo "            ";
                    $this->loadTemplate(twig_template_from_string($this->env, $this->getAttribute($context["item"], "ads_code", array())), "Templates/helpers.twig", 10)->display(array_merge($context, array("file" => Twigextension::getUserfile($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "files", array()), "getPics", array(), "method"), 0, array(), "array"), "fi_url", array())))));
                    // line 11
                    echo "        ";
                }
                // line 12
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 15
    public function getbanner($__banner__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "banner" => $__banner__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["banner"]) ? $context["banner"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 17
                echo "        ";
                $this->loadTemplate(twig_template_from_string($this->env, $this->getAttribute($context["item"], "ba_code", array())), "Templates/helpers.twig", 17)->display(array_merge($context, array("file" => Twigextension::getUserfile($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "files", array()), "getAll", array(), "method"), 0, array(), "array"), "fi_url", array())))));
                // line 18
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "Templates/helpers.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 18,  158 => 17,  140 => 16,  128 => 15,  101 => 12,  98 => 11,  95 => 10,  92 => 9,  74 => 8,  62 => 7,  46 => 4,  43 => 3,  40 => 2,  27 => 1,  22 => 14,  19 => 6,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% macro ads(id,ads) %}
    {% if ads[id].enabled %}
        {% include template_from_string(ads[id].code) with {file: ads[id].file} %}
    {% endif %}
{% endmacro %}

{% macro adsORM(ads) %}
    {% for item in ads %}
        {% if item.ads_enabled %}
            {% include template_from_string(item.ads_code) with {file: getUserfile(item.files.getPics()[0].fi_url)} %}
        {% endif %}
    {% endfor %}
{% endmacro %}

{% macro banner(banner) %}
    {% for item in banner %}
        {% include template_from_string(item.ba_code) with {file: getUserfile(item.files.getAll()[0].fi_url) } %}
    {% endfor %}
{% endmacro %}", "Templates/helpers.twig", "C:\\xampp\\htdocs\\gol\\frontend\\application\\views\\Templates\\helpers.twig");
    }
}
