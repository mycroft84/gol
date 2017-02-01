<?php

/* Main/index.twig */
class __TwigTemplate_fcab3df76f8a5ef6a712c954a19b08ee80558979381390d1165205a37348353c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("Templates/default.twig", "Main/index.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "Templates/default.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
    ";
        // line 5
        if (((isset($context["width"]) ? $context["width"] : null) && (isset($context["height"]) ? $context["height"] : null))) {
            // line 6
            echo "        <div class=\"row\">
            <div class=\"col-md-12\">
                <table id=\"board\" data-width=\"";
            // line 8
            echo twig_escape_filter($this->env, (isset($context["width"]) ? $context["width"] : null), "html", null, true);
            echo "\" data-height=\"";
            echo twig_escape_filter($this->env, (isset($context["height"]) ? $context["height"] : null), "html", null, true);
            echo "\">
                    ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["width"]) ? $context["width"] : null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 10
                echo "                        <tr>
                            ";
                // line 11
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["height"]) ? $context["height"] : null)));
                foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                    // line 12
                    echo "                                <td id=\"";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "-";
                    echo twig_escape_filter($this->env, $context["j"], "html", null, true);
                    echo "\"";
                    if (twig_in_filter((($context["i"] . "-") . $context["j"]), (isset($context["lives"]) ? $context["lives"] : null))) {
                        echo " class=\"active\"";
                    }
                    echo "></td>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 14
                echo "                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "                </table>
            </div>
        </div>

        <div class=\"row\">
            <div class=\"col-md-12\" style=\"margin-top: 20px\">
                <div class=\"col-md-4\">
                    <button type=\"button\" id=\"autoPlay\" class=\"btn btn-primary\">Start</button>
                    <button type=\"button\" id=\"stepOne\" class=\"btn btn-info\">Step +1</button>
                    <button type=\"button\" id=\"editButton\" class=\"btn btn-warning\">Edit on</button>
                    <button type=\"button\" id=\"resetButton\" class=\"btn btn-danger\">Reset</button>
                </div>

                <div class=\"col-md-2\">
                    <select id=\"patterns\" class=\"form-control\">
                        <option value=\"-1\">Minta betöltése</option>
                        ";
            // line 32
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["boards"]) ? $context["boards"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 33
                echo "                            <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "pk", array(), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "bo_name", array()), "html", null, true);
                echo "</option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "                    </select>
                </div>
                <div class=\"col-md-2\">
                    <button type=\"button\" id=\"loadButton\" class=\"btn btn-success\">Load</button>
                    <button type=\"button\" id=\"saveButton\" class=\"btn btn-success\">Save</button>
                </div>
            </div>
        </div>

    ";
        } else {
            // line 45
            echo "        <div class=\"row\">
            <div class=\"col-md-3\">
                <h1>Add meg a tábla méretei</h1>

                <form>
                    <div class=\"form-group\">
                        <label for=\"width\">Szélesség *</label>
                        <input type=\"number\" class=\"form-control\" name=\"width\" id=\"width\" required>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"height\">Magasság *</label>
                        <input type=\"number\" class=\"form-control\" name=\"height\" id=\"height\" required>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"height\">Élő pontok (soronként 1, x-y formában)</label>
                        <textarea class=\"form-control\" name=\"lives\"></textarea>
                    </div>

                    <button type=\"submit\" class=\"btn btn-default\">Mehet</button>
                </form>
            </div>
        </div>
    ";
        }
        // line 70
        echo "
    <div class=\"modal fade\" id=\"saveModal\" tabindex=\"-1\" role=\"dialog\">
        <div class=\"modal-dialog\" role=\"document\">
            ";
        echo Form::open(Twigextension::url("mainAjax", array("actiontarget" => "gol", "maintarget" => "save"))        ,array("id" => "save-Form")        );        // line 74
        echo "            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                    <h4 class=\"modal-title\">Alakzat mentése</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <label for=\"width\">Név *</label>
                        <input type=\"text\" class=\"form-control\" name=\"name\" id=\"width\" required>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Mégsem</button>
                    <button type=\"submit\" class=\"btn btn-primary\">Mentés</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    ";
        // line 106
        echo "
    <script id=\"td-template\" type=\"text/twig\">
        {% for i in 1..width %}
            <tr>
                {% for j in 1..height %}
                    <td id=\"{{ i }}-{{ j }}\"{% if i~\"-\"~j in lives %} class=\"active\"{% endif %}></td>
                {% endfor %}
            </tr>
        {% endfor %}
    </script>
    ";
        echo "

";
    }

    public function getTemplateName()
    {
        return "Main/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 106,  156 => 74,  151 => 70,  124 => 45,  112 => 35,  101 => 33,  97 => 32,  79 => 16,  72 => 14,  57 => 12,  53 => 11,  50 => 10,  46 => 9,  40 => 8,  36 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"Templates/default.twig\" %}

{% block content %}

    {% if width and height %}
        <div class=\"row\">
            <div class=\"col-md-12\">
                <table id=\"board\" data-width=\"{{ width }}\" data-height=\"{{ height }}\">
                    {% for i in 1..width %}
                        <tr>
                            {% for j in 1..height %}
                                <td id=\"{{ i }}-{{ j }}\"{% if i~\"-\"~j in lives %} class=\"active\"{% endif %}></td>
                            {% endfor %}
                        </tr>
                    {% endfor %}
                </table>
            </div>
        </div>

        <div class=\"row\">
            <div class=\"col-md-12\" style=\"margin-top: 20px\">
                <div class=\"col-md-4\">
                    <button type=\"button\" id=\"autoPlay\" class=\"btn btn-primary\">Start</button>
                    <button type=\"button\" id=\"stepOne\" class=\"btn btn-info\">Step +1</button>
                    <button type=\"button\" id=\"editButton\" class=\"btn btn-warning\">Edit on</button>
                    <button type=\"button\" id=\"resetButton\" class=\"btn btn-danger\">Reset</button>
                </div>

                <div class=\"col-md-2\">
                    <select id=\"patterns\" class=\"form-control\">
                        <option value=\"-1\">Minta betöltése</option>
                        {% for item in boards %}
                            <option value=\"{{ item.pk() }}\">{{ item.bo_name }}</option>
                        {% endfor %}
                    </select>
                </div>
                <div class=\"col-md-2\">
                    <button type=\"button\" id=\"loadButton\" class=\"btn btn-success\">Load</button>
                    <button type=\"button\" id=\"saveButton\" class=\"btn btn-success\">Save</button>
                </div>
            </div>
        </div>

    {% else %}
        <div class=\"row\">
            <div class=\"col-md-3\">
                <h1>Add meg a tábla méretei</h1>

                <form>
                    <div class=\"form-group\">
                        <label for=\"width\">Szélesség *</label>
                        <input type=\"number\" class=\"form-control\" name=\"width\" id=\"width\" required>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"height\">Magasság *</label>
                        <input type=\"number\" class=\"form-control\" name=\"height\" id=\"height\" required>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"height\">Élő pontok (soronként 1, x-y formában)</label>
                        <textarea class=\"form-control\" name=\"lives\"></textarea>
                    </div>

                    <button type=\"submit\" class=\"btn btn-default\">Mehet</button>
                </form>
            </div>
        </div>
    {% endif %}

    <div class=\"modal fade\" id=\"saveModal\" tabindex=\"-1\" role=\"dialog\">
        <div class=\"modal-dialog\" role=\"document\">
            {% form.open url('mainAjax',{actiontarget: 'gol',maintarget: 'save'}),{id: 'save-Form'} %}
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                    <h4 class=\"modal-title\">Alakzat mentése</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"form-group\">
                        <label for=\"width\">Név *</label>
                        <input type=\"text\" class=\"form-control\" name=\"name\" id=\"width\" required>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Mégsem</button>
                    <button type=\"submit\" class=\"btn btn-primary\">Mentés</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    {% raw %}
    <script id=\"td-template\" type=\"text/twig\">
        {% for i in 1..width %}
            <tr>
                {% for j in 1..height %}
                    <td id=\"{{ i }}-{{ j }}\"{% if i~\"-\"~j in lives %} class=\"active\"{% endif %}></td>
                {% endfor %}
            </tr>
        {% endfor %}
    </script>
    {% endraw %}

{% endblock %}", "Main/index.twig", "C:\\xampp\\htdocs\\gol\\frontend\\application\\views\\Main\\index.twig");
    }
}
