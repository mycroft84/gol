<?php

/* Formbuilder/form.twig */
class __TwigTemplate_6361b770c35a4f61a21202982514d1b5d2a6b3b2f681163f786fad001076795f extends Twig_Template
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
        // line 76
        echo "
";
        // line 84
        echo "
";
        // line 90
        echo "
";
        // line 122
        echo "
";
        // line 150
        echo "
";
        // line 220
        echo "
";
        // line 289
        echo "
";
        // line 331
        echo "
";
        // line 350
        echo "
";
        // line 357
        echo "
";
        // line 372
        echo "
";
        // line 399
        echo "
";
        // line 445
        echo "
";
        // line 456
        echo "
";
        // line 459
        echo "}

";
        // line 463
        echo "}

";
        // line 478
        echo "}

";
        // line 483
        echo "
";
        // line 491
        echo "
";
        // line 496
        echo "
";
        // line 506
        echo "
";
    }

    // line 1
    public function getbuild($__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "    ";
            $context["forms"] = $this;
            // line 3
            echo "    ";
            echo $context["forms"]->getbuildLangForm((isset($context["data"]) ? $context["data"] : null));
            echo "
    ";
            // line 4
            echo $context["forms"]->getaddTemplates((isset($context["data"]) ? $context["data"] : null));
            echo "
";
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
    public function getbuildLangForm($__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 8
            echo "    ";
            $context["forms"] = $this;
            // line 9
            echo "    ";
            if ((($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasTab", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasTab", array()), false)) : (false))) {
                // line 10
                echo "        <div class=\"form-wizard";
                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hideTabHeader", array())) {
                    echo " hideTabHeader";
                }
                echo "\">
            <ul class=\"tabs\">
                ";
                // line 12
                if ((($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasLang", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasLang", array()), false)) : (false))) {
                    // line 13
                    echo "                    ";
                    echo $context["forms"]->gettabHeaderLangs($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "langs", array()), $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasTranslateField", array()));
                    echo "
                ";
                } else {
                    // line 15
                    echo "                    ";
                    echo $context["forms"]->gettabHeaderCustom((isset($context["data"]) ? $context["data"] : null));
                    echo "
                ";
                }
                // line 17
                echo "            </ul>

            <div class=\"progress-indicator\">
                <span></span>
            </div>

            <div class=\"tab-content no-margin\">
                ";
                // line 24
                if ((($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasLang", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasLang", array()), false)) : (false))) {
                    // line 25
                    echo "                    ";
                    echo $context["forms"]->gettabBodyLangs((isset($context["data"]) ? $context["data"] : null));
                    echo "
                ";
                } else {
                    // line 27
                    echo "                    ";
                    echo $context["forms"]->gettabBodyCustom((isset($context["data"]) ? $context["data"] : null));
                    echo "
                ";
                }
                // line 29
                echo "            </div>

            <ul class=\"pager wizard\">
                <li class=\"previous first\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <i class=\"fa-angle-double-left\"></i>
                        <span>";
                // line 35
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.first"), "html", null, true);
                echo "</span>
                    </a>
                </li>
                <li class=\"previous\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <i class=\"fa-angle-left\"></i>
                        <span>";
                // line 41
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.prev"), "html", null, true);
                echo "</span>
                    </a>
                </li>
                ";
                // line 44
                if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "orm_loaded", array()) == false)) {
                    // line 45
                    echo "                <li class=\"next finishAndNew\">
                    <a href=\"#\" class=\"btn btn-purple\" type=\"button\">
                        <i class=\"fa-check-circle\"></i>
                        <span>";
                    // line 48
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.saveAndNew"), "html", null, true);
                    echo "</span>
                    </a>
                </li>
                ";
                }
                // line 52
                echo "                <li class=\"next finish\">
                    <a href=\"#\" class=\"btn btn-purple\" type=\"button\">
                        <i class=\"fa-check\"></i>
                        <span>";
                // line 55
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.save"), "html", null, true);
                echo "</span>
                    </a>
                </li>
                <li class=\"next last\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <span>";
                // line 60
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.last"), "html", null, true);
                echo "</span>
                        <i class=\"fa-angle-double-right\"></i>
                    </a>
                </li>
                <li class=\"next\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <span>";
                // line 66
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.next"), "html", null, true);
                echo "</span>
                        <i class=\"fa-angle-right\"></i>
                    </a>
                </li>

            </ul>

        </div>
    ";
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

    // line 77
    public function gettabHeaderLangs($__langs__ = null, $__hasTranslateField__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "langs" => $__langs__,
            "hasTranslateField" => $__hasTranslateField__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 78
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["langs"]) ? $context["langs"] : null));
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
            foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                // line 79
                echo "\t\t";
                if (($this->getAttribute($context["loop"], "first", array()) || (isset($context["hasTranslateField"]) ? $context["hasTranslateField"] : null))) {
                    // line 80
                    echo "        <li ";
                    if ($this->getAttribute($context["loop"], "first", array())) {
                        echo " class=\"active\"";
                    }
                    echo "><a href=\"#tabs-";
                    echo twig_escape_filter($this->env, $context["item"], "html", null, true);
                    echo "\" data-toggle=\"tab\">";
                    if ($this->getAttribute($context["loop"], "first", array())) {
                        echo twig_escape_filter($this->env, Twigextension::i18n("formBaseData"), "html", null, true);
                        echo " - ";
                    }
                    echo twig_escape_filter($this->env, Twigextension::i18n($context["item"]), "html", null, true);
                    echo "</a></li>
\t\t";
                }
                // line 82
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
            unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
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

    // line 85
    public function gettabHeaderCustom($__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 86
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "tabs", array()));
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
            foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                // line 87
                echo "        <li ";
                if ($this->getAttribute($context["loop"], "first", array())) {
                    echo " class=\"active\"";
                }
                echo "><a href=\"#tabs-";
                echo twig_escape_filter($this->env, $context["index"], "html", null, true);
                echo "\" data-toggle=\"tab\">";
                if (($context["index"] == "base")) {
                    echo twig_escape_filter($this->env, Twigextension::i18n("formBaseData"), "html", null, true);
                } else {
                    echo twig_escape_filter($this->env, Twigextension::i18n($context["item"]), "html", null, true);
                }
                echo "</a></li>
    ";
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
            unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
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

    // line 91
    public function gettabBodyLangs($__data__ = null, $__useTab__ = true, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "useTab" => $__useTab__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 92
            echo "    ";
            $context["forms"] = $this;
            // line 93
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "langs", array()));
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
            foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                // line 94
                echo "\t\t";
                if (($this->getAttribute($context["loop"], "first", array()) || $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hasTranslateField", array()))) {
                    // line 95
                    echo "        ";
                    if ((isset($context["useTab"]) ? $context["useTab"] : null)) {
                        // line 96
                        echo "            <div class=\"tab-pane with-bg";
                        if ($this->getAttribute($context["loop"], "first", array())) {
                            echo " active";
                        }
                        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "sections", array())) != 0)) {
                            echo " hasSection";
                        }
                        echo "\" id=\"tabs-";
                        echo twig_escape_filter($this->env, $context["item"], "html", null, true);
                        echo "\">
        ";
                    } else {
                        // line 98
                        echo "           <div class=\"panel panel-default panel-border subform-item\">
               <div class=\"panel-heading\">
                   <div class=\"panel-options\">
                       <i class=\"loader-icon\">
                           <span class=\"fa fa-spin fa-refresh\"></span>
                       </i>
                       <a href=\"#\" class=\"delSubformItem\" data-toggle=\"tooltip\" title=\"";
                        // line 104
                        echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.delete"), "html", null, true);
                        echo "\">
                           <i class=\"fa fa-trash\"></i>
                       </a>
                   </div>
               </div>
               <div class=\"panel-body\">
           ";
                    }
                    // line 111
                    echo "            ";
                    echo $context["forms"]->getrows((isset($context["data"]) ? $context["data"] : null), $context["item"], $this->getAttribute($context["loop"], "first", array()), $context["item"]);
                    echo "

            ";
                    // line 113
                    echo $context["forms"]->getaddFileList($context["index"], (isset($context["data"]) ? $context["data"] : null));
                    echo "
            ";
                    // line 114
                    echo $context["forms"]->getaddSubforms($context["index"], (isset($context["data"]) ? $context["data"] : null));
                    echo "
            ";
                    // line 115
                    if (((isset($context["useTab"]) ? $context["useTab"] : null) == false)) {
                        echo "</div>";
                    }
                    // line 116
                    echo "
        </div>
\t\t";
                }
                // line 119
                echo "
    ";
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
            unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
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

    // line 123
    public function gettabBodyCustom($__data__ = null, $__useTab__ = true, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "useTab" => $__useTab__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 124
            echo "    ";
            $context["forms"] = $this;
            // line 125
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "tabs", array()));
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
            foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                // line 126
                echo "        ";
                if ((isset($context["useTab"]) ? $context["useTab"] : null)) {
                    // line 127
                    echo "            <div class=\"tab-pane with-bg";
                    if ($this->getAttribute($context["loop"], "first", array())) {
                        echo " active";
                    }
                    if ((twig_length_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "sections", array())) != 0)) {
                        echo " hasSection";
                    }
                    echo "\" id=\"tabs-";
                    echo twig_escape_filter($this->env, $context["index"], "html", null, true);
                    echo "\">
        ";
                } else {
                    // line 129
                    echo "                <div class=\"panel panel-default panel-border subform-item\">
                    <div class=\"panel-heading\">
                        <div class=\"panel-options\">
                            <i class=\"loader-icon\">
                                <span class=\"fa fa-spin fa-refresh\"></span>
                            </i>
                            <a href=\"#\" class=\"delSubformItem\" data-toggle=\"tooltip\" title=\"";
                    // line 135
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.delete"), "html", null, true);
                    echo "\">
                                <i class=\"fa fa-trash\"></i>
                            </a>
                        </div>
                    </div>
                    <div class=\"panel-body\">
        ";
                }
                // line 142
                echo "            ";
                echo $context["forms"]->getrows((isset($context["data"]) ? $context["data"] : null), $context["index"], $this->getAttribute($context["loop"], "first", array()), $context["index"], (isset($context["useTab"]) ? $context["useTab"] : null));
                echo "

            ";
                // line 144
                if (((isset($context["useTab"]) ? $context["useTab"] : null) == false)) {
                    echo $context["forms"]->getaddFileList($context["index"], (isset($context["data"]) ? $context["data"] : null));
                }
                // line 145
                echo "            ";
                echo $context["forms"]->getaddSubforms($context["index"], (isset($context["data"]) ? $context["data"] : null));
                echo "
            ";
                // line 146
                if (((isset($context["useTab"]) ? $context["useTab"] : null) == false)) {
                    echo "</div>";
                }
                // line 147
                echo "        </div>
    ";
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
            unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
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

    // line 151
    public function getaddFileList($__index__ = null, $__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "index" => $__index__,
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 152
            echo "    ";
            $context["forms"] = $this;
            // line 153
            echo "
    ";
            // line 154
            if (((isset($context["index"]) ? $context["index"] : null) == 0)) {
                // line 155
                echo "        ";
                if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "getFiles", array(), "method"), "hasFile", array())) {
                    // line 156
                    echo "        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"fileuploaded-container\">
                    <h4>";
                    // line 159
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.uploadedFiles"), "html", null, true);
                    echo "</h4>
                    <table class=\"sortable ordered table table-small-font table-bordered table-striped\">
                        <thead>
                            <tr>
                                <th>";
                    // line 163
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.preview"), "html", null, true);
                    echo "</th>
                                <th>";
                    // line 164
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filename"), "html", null, true);
                    echo "</th>
                                <th>";
                    // line 165
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filedesc"), "html", null, true);
                    echo "</th>
                                <th>";
                    // line 166
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filemime"), "html", null, true);
                    echo "</th>
                                <th>";
                    // line 167
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filesize"), "html", null, true);
                    echo "</th>
                                <th>";
                    // line 168
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filetags"), "html", null, true);
                    echo "</th>
                                <th>";
                    // line 169
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.fileactions"), "html", null, true);
                    echo "</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
                    // line 173
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "getFiles", array(), "method"), "getAll", array(), "method"));
                    foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                        // line 174
                        echo "                                ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($context["block"]);
                        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                            // line 175
                            echo "                                <tr data-id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "fi_id", array()), "html", null, true);
                            echo "\">
                                    <td>
                                         ";
                            // line 177
                            if (twig_in_filter("image", $this->getAttribute($context["item"], "fi_type", array()))) {
                                // line 178
                                echo "                                            <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px\"></i>
                                            <img src=\"";
                                // line 179
                                echo twig_escape_filter($this->env, Twigextension::getUserfile($this->getAttribute($context["item"], "fi_url", array())), "html", null, true);
                                echo "\" style='max-width: 75px;max-height: 75px'>
                                        ";
                            } else {
                                // line 181
                                echo "                                            <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px; margin-top: 10px;float: left;\"></i>
                                            <i class=\"fa fa-file-o\" style='font-size: 27px'></i>
                                        ";
                            }
                            // line 184
                            echo "                                    </td>
                                    <td>
                                        <div class=\"form-group\">
                                            <input type='text' class=\"form-control\" data-name=\"fi_name\" value='";
                            // line 187
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "fi_name", array()), "html", null, true);
                            echo "'>
                                        </div>
                                    </td>
                                    <td>
                                         <div class=\"form-group\">
                                            <input type='text' class=\"form-control\" data-name=\"fi_desc\" value=\"";
                            // line 192
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "fi_desc", array()), "html", null, true);
                            echo "\">
                                        </div>
                                    </td>
                                    <td>";
                            // line 195
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "fi_type", array()), "html", null, true);
                            echo "</td>
                                    <td>";
                            // line 196
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "filesize", array()), "html", null, true);
                            echo "</td>
                                    <td>
                                        <div class=\"form-group\">
                                            <select class=\"form-control fileTypes\" multiple>
                                                ";
                            // line 200
                            echo $context["forms"]->getsetFileType((isset($context["data"]) ? $context["data"] : null), $context["item"]);
                            echo "
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <a href=\"";
                            // line 205
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "root", array()), "html", null, true);
                            echo "download/files/";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "fi_id", array()), "html", null, true);
                            echo "\" class=\"btn btn-icon btn-success btn-sm\" data-toggle=\"tooltip\" title=\"";
                            echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.download"), "html", null, true);
                            echo "\"><i class=\"fa-download\"></i></a>
                                        ";
                            // line 206
                            if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "fileUpload", array()), "enableDel", array())) {
                                echo "<button class=\"btn btn-icon btn-red btn-sm filedel\" data-toggle=\"tooltip\" title=\"";
                                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.delete"), "html", null, true);
                                echo "\"><i class=\"fa-trash\"></i></button>";
                            }
                            // line 207
                            echo "                                    </td>
                                </tr>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 210
                        echo "                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 211
                    echo "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        ";
                }
                // line 217
                echo "    ";
            }
            // line 218
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 221
    public function getaddTemplates($__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 222
            $context["forms"] = $this;
            // line 255
            echo "
    <script type=\"text/twig\" id=\"file-template\">
         <tr>
            <td>
                <input type='hidden' name='upload_files[{{ input }}]{{ prefix }}' value='{{ data }}'>
                <input type='hidden' name='upload_filesize[{{ input }}]{{ prefix }}' value='{{ file.size }}'>
                <input type='hidden' name='upload_mime[{{ input }}]{{ prefix }}' value='{{ file.type }}'>
                <input type='hidden' name='upload_original_name[{{ input }}]{{ prefix }}' value='{{ file.name }}'>

                {% if 'image' in file.type %}
                    <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px\"></i>
                    <img src=\"{{ data }}\" class=\"{{ rotateClass }}\" style='max-width: 75px;max-height: 75px;'>
                {% else %}
                    <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px; margin-top: 10px;float: left;\"></i>
                    <i class=\"fa fa-file-o\" style='font-size: 27px'></i>
                {% endif %}
            </td>
            <td>
                <div class=\"form-group\">
                    <input type='text' class=\"form-control\" name='upload_filename[{{ input }}]{{ prefix }}' value='{{ file.name }}'>
                </div>
            </td>
            <td>
                 <div class=\"form-group\">
                    <input type='text' class=\"form-control\" name='upload_filedetails[{{ input }}]{{ prefix }}'>
                </div>
            </td>
            <td>{{ file.type }}</td>
            <td>{{ file.size }}</td>
            <td>
                <div class=\"form-group\">
                    <select class=\"form-control\" name='upload_filetypes[{{ input }}]{{ prefix }}[]' multiple>
    ";
            echo "
                        ";
            // line 256
            echo $context["forms"]->getsetFileType((isset($context["data"]) ? $context["data"] : null), (isset($context["item"]) ? $context["item"] : null));
            echo "
    ";
            // line 287
            echo "
                    </select>
                </div>
            </td>
            <td>
                <button class=\"btn btn-icon btn-red btn-sm fileuploaddel\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.delete'|i18n }}\"><i class=\"fa-trash\"></i></button>
            </td>
        </tr>
    </script>

    <script type=\"text/twig\" id=\"file-loading-template\">
        <tr>
            <td class='file-loading' colspan=\"7\">
                <a class='progress-abort btn btn-icon btn-red btn-xs'>
                    <i class='fa-times'></i>
                </a>

                <div class='progress-contaniner'>
                    <div class=\"progress progress-striped active\">
                        <div style=\"width: 0%\" aria-valuemax=\"100\" aria-valuemin=\"0\" aria-valuenow=\"0\" role=\"progressbar\" class=\"progress-bar progress-bar-success\">
                            <span class=\"sr-only\"></span>
                        </div>
                    </div>
                    <div class='progress-bar-value'></div>
                    <div class='progress-bar-percent'></div>
                </div>
            </td>
        </tr>
    </script>

    ";
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 290
    public function getaddSubforms($__index__ = null, $__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "index" => $__index__,
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 291
            echo "    ";
            $context["forms"] = $this;
            // line 292
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "subforms", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["subform"]) {
                // line 293
                echo "        ";
                if (((isset($context["index"]) ? $context["index"] : null) == $this->getAttribute($context["subform"], "tab", array()))) {
                    // line 294
                    echo "        <div class=\"panel panel-color panel-purple\">

            <div class=\"panel-heading\">
                <h3 class=\"panel-title\">";
                    // line 297
                    echo twig_escape_filter($this->env, $this->getAttribute($context["subform"], "title", array()), "html", null, true);
                    echo "</h3>
                <div class=\"panel-options\">
                    <a href=\"#\" class=\"addSubformItem\" data-relation=\"";
                    // line 299
                    echo twig_escape_filter($this->env, $this->getAttribute($context["subform"], "relation", array()), "html", null, true);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.additem"), "html", null, true);
                    echo "\">
                        <i class=\"fa fa-plus\"></i>
                    </a>
                </div>
            </div>

            <div class=\"panel-body subform-container-";
                    // line 305
                    echo twig_escape_filter($this->env, $this->getAttribute($context["subform"], "relation", array()), "html", null, true);
                    echo " subform-container\">
                ";
                    // line 306
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["subform"], "form", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["form"]) {
                        // line 307
                        echo "                    ";
                        if ((($this->getAttribute($context["form"], "hasLang", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["form"], "hasLang", array()), false)) : (false))) {
                            // line 308
                            echo "                        ";
                            echo $context["forms"]->gettabBodyLangs($context["form"], false);
                            echo "
                    ";
                        } else {
                            // line 310
                            echo "                        ";
                            echo $context["forms"]->gettabBodyCustom($context["form"], false);
                            echo "
                    ";
                        }
                        // line 312
                        echo "                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['form'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 313
                    echo "                ";
                    if ((($this->getAttribute($this->getAttribute($context["subform"], "formTemplate", array(), "any", false, true), "hasLang", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["subform"], "formTemplate", array(), "any", false, true), "hasLang", array()), false)) : (false))) {
                        // line 314
                        echo "                    ";
                        echo $context["forms"]->gettabBodyLangs($this->getAttribute($context["subform"], "formTemplate", array()), false);
                        echo "
                ";
                    } else {
                        // line 316
                        echo "                    ";
                        echo $context["forms"]->gettabBodyCustom($this->getAttribute($context["subform"], "formTemplate", array()), false);
                        echo "
                ";
                    }
                    // line 318
                    echo "            </div>

            <script type=\"text/twig\" id=\"subform-";
                    // line 320
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["subform"], "relation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["subform"], "relation", array()), twig_random($this->env))) : (twig_random($this->env))), "html", null, true);
                    echo "-template\">
                ";
                    // line 321
                    if ((($this->getAttribute($this->getAttribute($context["subform"], "formTemplate", array(), "any", false, true), "hasLang", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["subform"], "formTemplate", array(), "any", false, true), "hasLang", array()), false)) : (false))) {
                        // line 322
                        echo "                    ";
                        echo $context["forms"]->gettabBodyLangs($this->getAttribute($context["subform"], "formTemplate", array()), false);
                        echo "
                ";
                    } else {
                        // line 324
                        echo "                    ";
                        echo $context["forms"]->gettabBodyCustom($this->getAttribute($context["subform"], "formTemplate", array()), false);
                        echo "
                ";
                    }
                    // line 326
                    echo "            </script>
        </div>
        ";
                }
                // line 329
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subform'], $context['_parent'], $context['loop']);
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

    // line 332
    public function getgetFilesRow($__item__ = null, $__data__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "data" => $__data__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 333
            echo "    ";
            $context["forms"] = $this;
            // line 334
            echo "
    <div class=\"row\" data-id=\"";
            // line 335
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "fi_id", array()), "html", null, true);
            echo "\">
        <div class=\"col-md-12\">
            <div class=\"col-md-3\">
                <p>";
            // line 338
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "fi_name", array()), "html", null, true);
            echo " [<em>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "fi_type", array()), "html", null, true);
            echo " / ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "filesize", array()), "html", null, true);
            echo "</em>]</p>
            </div>
            <div class=\"col-md-3\">
                ";
            // line 341
            echo $context["forms"]->getsetFileType((isset($context["data"]) ? $context["data"] : null), (isset($context["item"]) ? $context["item"] : null));
            echo "
            </div>
            <div class=\"col-md-3\">
                <a href=\"";
            // line 344
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "root", array()), "html", null, true);
            echo "download/files/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "fi_id", array()), "html", null, true);
            echo "\" class=\"btn btn-icon btn-success btn-sm\" data-toggle=\"tooltip\" title=\"";
            echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.download"), "html", null, true);
            echo "\"><i class=\"fa-download\"></i></a>
\t\t\t\t";
            // line 345
            if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "fileUpload", array()), "enableDel", array())) {
                echo "<button class=\"btn btn-icon btn-red btn-sm filedel\" data-toggle=\"tooltip\" title=\"";
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.delete"), "html", null, true);
                echo "\"><i class=\"fa-trash\"></i></button>";
            }
            // line 346
            echo "            </div>
        </div>
    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 351
    public function getsetFileType($__data__ = null, $__item__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "item" => $__item__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 352
            echo "    ";
            $context["currentType"] = $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "getTypesAsArray", array(), "method");
            // line 353
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "getFiles", array(), "method"), "filesTypes", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                // line 354
                echo "    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["type"], "ft_id", array()), "html", null, true);
                echo "\"";
                if (twig_in_filter($this->getAttribute($context["type"], "ft_id", array()), (isset($context["currentType"]) ? $context["currentType"] : null))) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["type"], "ft_name", array()), "html", null, true);
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
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

    // line 358
    public function getrows($__data__ = null, $__lang__ = false, $__is_first__ = null, $__tab__ = null, $__useTab__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "lang" => $__lang__,
            "is_first" => $__is_first__,
            "tab" => $__tab__,
            "useTab" => $__useTab__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 359
            echo "    ";
            $context["forms"] = $this;
            // line 360
            echo "
    ";
            // line 361
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "sections", array())) == 0)) {
                // line 362
                echo "        ";
                echo $context["forms"]->getaddFieldsWithoutSection((isset($context["data"]) ? $context["data"] : null), (isset($context["lang"]) ? $context["lang"] : null), (isset($context["is_first"]) ? $context["is_first"] : null), (isset($context["tab"]) ? $context["tab"] : null));
                echo "
    ";
            } else {
                // line 364
                echo "        ";
                echo $context["forms"]->getaddFieldsWithSection((isset($context["data"]) ? $context["data"] : null), (isset($context["lang"]) ? $context["lang"] : null), (isset($context["is_first"]) ? $context["is_first"] : null), (isset($context["tab"]) ? $context["tab"] : null));
                echo "
    ";
            }
            // line 366
            echo "
    ";
            // line 367
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "elements", array()), "getHiddenElements", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 368
                echo "        ";
                echo $context["forms"]->getgetElement($context["item"], (isset($context["lang"]) ? $context["lang"] : null));
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 370
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 373
    public function getaddFieldsWithoutSection($__data__ = null, $__lang__ = false, $__step__ = null, $__tab__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "lang" => $__lang__,
            "step" => $__step__,
            "tab" => $__tab__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 374
            echo "    ";
            $context["forms"] = $this;
            // line 375
            echo "
    ";
            // line 376
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(Twigextension::chunk($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "elements", array()), "getRenderedElements", array(0 => "left", 1 => (isset($context["lang"]) ? $context["lang"] : null)), "method"), 2));
            foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                // line 377
                echo "        <div class=\"row\">
            ";
                // line 378
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["block"]);
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 379
                    echo "                ";
                    if (($this->getAttribute($this->getAttribute($context["item"], "options", array()), "render", array()) == true)) {
                        // line 380
                        echo "                    <div class=\"col-md-6\">
                        ";
                        // line 381
                        echo $context["forms"]->getgetFormGroup($context["item"], (isset($context["lang"]) ? $context["lang"] : null));
                        echo "
                    </div>
                ";
                    }
                    // line 384
                    echo "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 385
                echo "        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 387
            echo "
    ";
            // line 388
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "elements", array()), "getRenderedElements", array(0 => "right", 1 => (isset($context["lang"]) ? $context["lang"] : null)), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 389
                echo "        ";
                if (($this->getAttribute($this->getAttribute($context["item"], "options", array()), "render", array()) == true)) {
                    // line 390
                    echo "            <div class=\"row\">
                <div class=\"col-md-12\">
                    ";
                    // line 392
                    echo $context["forms"]->getgetFormGroup($context["item"], (isset($context["lang"]) ? $context["lang"] : null));
                    echo "
                </div>
            </div>
        ";
                }
                // line 396
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 397
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 400
    public function getaddFieldsWithSection($__data__ = null, $__lang__ = false, $__step__ = null, $__tab__ = null, $__useTab__ = true, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "data" => $__data__,
            "lang" => $__lang__,
            "step" => $__step__,
            "tab" => $__tab__,
            "useTab" => $__useTab__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 401
            echo "    ";
            $context["forms"] = $this;
            // line 402
            echo "
    ";
            // line 403
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "sections", array()), (isset($context["tab"]) ? $context["tab"] : null), array(), "array"));
            foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "sections", array(), "any", false, true), (isset($context["tab"]) ? $context["tab"] : null), array(), "array", true, true)) {
                    // line 404
                    echo "        ";
                    if ((isset($context["useTab"]) ? $context["useTab"] : null)) {
                        // line 405
                        echo "            <div class=\"panel panel-color panel-info\">
            ";
                        // line 406
                        if ($this->getAttribute($context["item"], "title", array())) {
                            // line 407
                            echo "                <div class=\"panel-heading\">
                    <h3 class=\"panel-title\">";
                            // line 408
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()), "html", null, true);
                            if ($this->getAttribute($context["item"], "helper", array())) {
                                echo " <small>";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "helper", array()), "html", null, true);
                                echo "</small>";
                            }
                            echo "</h3>
                    <div class=\"panel-options\">
                        <i class=\"loader-icon\">
                            <span class=\"fa fa-spin fa-refresh\"></span>
                        </i>
                    </div>
                </div>
            ";
                        }
                        // line 416
                        echo "                <div class=\"panel-body\">
                    ";
                        // line 417
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "getElementsForTab", array(0 => (isset($context["tab"]) ? $context["tab"] : null), 1 => $context["index"], 2 => (isset($context["lang"]) ? $context["lang"] : null)), "method"));
                        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                            // line 418
                            echo "                        <div class=\"row\">
                            ";
                            // line 419
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($context["row"]);
                            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                                // line 420
                                echo "                                ";
                                if (($this->getAttribute($this->getAttribute($context["field"], "options", array()), "render", array()) == true)) {
                                    // line 421
                                    echo "                                    <div class=\"col-md-";
                                    echo twig_escape_filter($this->env, (int) floor((12 / twig_length_filter($this->env, $context["row"]))), "html", null, true);
                                    echo "\">
                                        ";
                                    // line 422
                                    echo $context["forms"]->getgetFormGroup($context["field"], (isset($context["lang"]) ? $context["lang"] : null));
                                    echo "
                                    </div>
                                ";
                                }
                                // line 425
                                echo "                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 426
                            echo "                        </div>
                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 428
                        echo "                </div>
            </div>
        ";
                    } else {
                        // line 431
                        echo "            ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "getElementsForTab", array(0 => (isset($context["tab"]) ? $context["tab"] : null), 1 => $context["index"], 2 => (isset($context["lang"]) ? $context["lang"] : null)), "method"));
                        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                            // line 432
                            echo "                <div class=\"row\">
                    ";
                            // line 433
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($context["row"]);
                            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                                // line 434
                                echo "                        ";
                                if (($this->getAttribute($this->getAttribute($context["field"], "options", array()), "render", array()) == true)) {
                                    // line 435
                                    echo "                            <div class=\"col-md-";
                                    echo twig_escape_filter($this->env, (int) floor((12 / twig_length_filter($this->env, $context["row"]))), "html", null, true);
                                    echo "\">
                                ";
                                    // line 436
                                    echo $context["forms"]->getgetFormGroup($context["field"], (isset($context["lang"]) ? $context["lang"] : null));
                                    echo "
                            </div>
                        ";
                                }
                                // line 439
                                echo "                    ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 440
                            echo "                </div>
            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 442
                        echo "        ";
                    }
                    // line 443
                    echo "    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
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

    // line 446
    public function getgetFormGroup($__item__ = null, $__lang__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "lang" => $__lang__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 447
            echo "    ";
            $context["forms"] = $this;
            // line 448
            echo "    <div class=\"form-group\">
        ";
            // line 449
            if (($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "options", array()), "type", array()) != "hidden")) {
                // line 450
                echo "            ";
                echo $context["forms"]->getgetLabel((isset($context["item"]) ? $context["item"] : null), (isset($context["lang"]) ? $context["lang"] : null));
                echo "
        ";
            }
            // line 452
            echo "        ";
            echo $context["forms"]->getgetElement((isset($context["item"]) ? $context["item"] : null), (isset($context["lang"]) ? $context["lang"] : null));
            echo "
        ";
            // line 453
            echo $context["forms"]->getgetError((isset($context["item"]) ? $context["item"] : null), (isset($context["lang"]) ? $context["lang"] : null));
            echo "
    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 457
    public function getgetLabel($__item__ = null, $__lang__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "lang" => $__lang__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 458
            echo "    <label class=\"control-label\" for=\"";
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), array("[]" => "")), "html", null, true);
            if ((isset($context["lang"]) ? $context["lang"] : null)) {
                echo "_";
                echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
            }
            echo "\">";
            if ($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "options", array()), "label", array())) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "options", array()), "label", array()), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, Twigextension::i18n(twig_replace_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), array("[]" => ""))), "html", null, true);
            }
            if ($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "options", array()), "required", array())) {
                echo "<strong class=\"required-item\"> *</strong>";
            }
            if ($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "options", array()), "addNew", array())) {
                echo "<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "options", array()), "newUrl", array()), "html", null, true);
                echo "\"><i class=\"fa fa-plus-square\"></i> Új ";
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.additem"), "html", null, true);
                echo "a</a>";
            }
            echo "</label>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 461
    public function getgetError($__item__ = null, $__lang__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "lang" => $__lang__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 462
            echo "    <span id=\"";
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), array("[]" => "")), "html", null, true);
            if ((isset($context["lang"]) ? $context["lang"] : null)) {
                echo "_";
                echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
            }
            echo "-error\" class=\"validate-has-error\" style=\"display: none;\"></span>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 465
    public function getgetElement($__element__ = null, $__lang__ = null, $__direction__ = "left", ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "lang" => $__lang__,
            "direction" => $__direction__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 466
            echo "    ";
            $context["forms"] = $this;
            // line 467
            echo "    ";
            if (($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "type", array()) == "input")) {
                // line 468
                echo "        ";
                echo $context["forms"]->getgetInput((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null), (isset($context["direction"]) ? $context["direction"] : null));
                echo "
    ";
            } elseif (($this->getAttribute(            // line 469
(isset($context["element"]) ? $context["element"] : null), "type", array()) == "select")) {
                // line 470
                echo "        ";
                echo $context["forms"]->getgetSelect((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null), (isset($context["direction"]) ? $context["direction"] : null));
                echo "
    ";
            } elseif (($this->getAttribute(            // line 471
(isset($context["element"]) ? $context["element"] : null), "type", array()) == "textarea")) {
                // line 472
                echo "        ";
                echo $context["forms"]->getgetTextarea((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null), (isset($context["direction"]) ? $context["direction"] : null));
                echo "
    ";
            } elseif (($this->getAttribute(            // line 473
(isset($context["element"]) ? $context["element"] : null), "type", array()) == "captcha")) {
                // line 474
                echo "        ";
                echo $context["forms"]->getgetCaptcha((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null), (isset($context["direction"]) ? $context["direction"] : null));
                echo "
    ";
            } else {
                // line 476
                echo "        <span class=\"textarea\">";
                echo $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array());
                echo "</span>
    ";
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

    // line 480
    public function getgetElementAttr($__element__ = null, $__lang__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "lang" => $__lang__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 481
            echo "  ";
            if (($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "date", array()) == 1)) {
                echo " data-widget=\"datepicker\" ";
            }
            echo "data-input-title='";
            if ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "label", array())) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "label", array()), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, Twigextension::i18n(twig_replace_filter($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "name", array()), array("[]" => ""))), "html", null, true);
            }
            echo "'";
            if ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "helper", array())) {
                echo " data-inputhelper='";
                echo twig_escape_filter($this->env, Twigextension::i18n((twig_replace_filter($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "name", array()), array("[]" => "")) . "_helper")), "html", null, true);
                echo "'";
            }
            echo " id=\"";
            echo twig_escape_filter($this->env, twig_replace_filter($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "name", array()), array("[]" => "")), "html", null, true);
            if ((isset($context["lang"]) ? $context["lang"] : null)) {
                echo "_";
                echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
            }
            echo "\" name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "name", array()), "html", null, true);
            if (((isset($context["lang"]) ? $context["lang"] : null) && ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "translate", array()) == true))) {
                echo "_lang_";
                echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
            }
            if ((($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array(), "any", false, true), "isArray", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array(), "any", false, true), "isArray", array()), false)) : (false))) {
                echo "[]";
            }
            echo "\"";
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()))) {
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()));
                foreach ($context['_seq'] as $context["index"] => $context["item"]) {
                    if (!twig_in_filter($context["index"], array(0 => "value", 1 => "position", 2 => "options", 3 => "date", 4 => "translate", 5 => "render", 6 => "required", 7 => "helper", 8 => "tab", 9 => "message", 10 => "label", 11 => "isArray", 12 => "class", 13 => "chooseTitle", 14 => "addNew", 15 => "newUrl", 16 => "optionDatas"))) {
                        echo " ";
                        echo twig_escape_filter($this->env, $context["index"], "html", null, true);
                        echo "='";
                        echo twig_escape_filter($this->env, $context["item"], "html", null, true);
                        echo "'";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            if (($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "message", array()) != false)) {
            }
            echo " class=\"form-control";
            if ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array(), "any", false, true), "class", array(), "any", true, true)) {
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "class", array()), "html", null, true);
            }
            echo "\"
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 484
    public function getgetCaptcha($__element__ = null, $__lang__ = null, $__direction__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "lang" => $__lang__,
            "direction" => $__direction__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 485
            echo "    ";
            $context["forms"] = $this;
            // line 486
            echo "    <div class=\"captcha\">
    ";
            // line 487
            echo $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array());
            // line 488
            echo "    <input ";
            echo $context["forms"]->getgetElementAttr((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null));
            echo ">
    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 492
    public function getgetTextarea($__element__ = null, $__lang__ = null, $__direction__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "lang" => $__lang__,
            "direction" => $__direction__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 493
            echo "    ";
            $context["forms"] = $this;
            // line 494
            echo "    <textarea ";
            echo $context["forms"]->getgetElementAttr((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null));
            echo ">";
            if (($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "translate", array()) == false)) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array()), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array()), (isset($context["lang"]) ? $context["lang"] : null), array(), "array"), "html", null, true);
            }
            echo "</textarea>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 497
    public function getgetSelect($__element__ = null, $__lang__ = null, $__direction__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "lang" => $__lang__,
            "direction" => $__direction__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 498
            echo "    ";
            $context["forms"] = $this;
            // line 499
            echo "        <select ";
            echo $context["forms"]->getgetElementAttr((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null));
            echo ">
            ";
            // line 500
            if (((($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array(), "any", false, true), "multiple", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array(), "any", false, true), "multiple", array()), false)) : (false)) == false)) {
                echo "<option value=\"-1\"";
                if (($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array()) ==  -1)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                if ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "chooseTitle", array())) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "chooseTitle", array()), "html", null, true);
                } else {
                    echo twig_escape_filter($this->env, Twigextension::i18n("choosePlease"), "html", null, true);
                }
                echo "</option>";
            }
            // line 501
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "options", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 502
                echo "                <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "value", array()), "html", null, true);
                echo "\"";
                if ((($this->getAttribute($context["item"], "value", array()) == $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array())) || (twig_test_iterable($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array())) && twig_in_filter($this->getAttribute($context["item"], "value", array()), $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array()))))) {
                    echo " selected='selected'";
                }
                if ($this->getAttribute($context["item"], "data", array())) {
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "data", array()));
                    foreach ($context['_seq'] as $context["dIndex"] => $context["dData"]) {
                        echo "data-";
                        echo twig_escape_filter($this->env, $context["dIndex"], "html", null, true);
                        echo "=\"";
                        echo twig_escape_filter($this->env, $context["dData"], "html", null, true);
                        echo "\" ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['dIndex'], $context['dData'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                }
                echo ">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
                echo "</option>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 504
            echo "        </select>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 507
    public function getgetInput($__element__ = null, $__lang__ = null, $__direction__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "lang" => $__lang__,
            "direction" => $__direction__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 508
            echo "    ";
            $context["forms"] = $this;
            // line 509
            echo "        <input ";
            echo $context["forms"]->getgetElementAttr((isset($context["element"]) ? $context["element"] : null), (isset($context["lang"]) ? $context["lang"] : null));
            if ((null === $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "type", array()))) {
                echo " type=\"text\"";
            }
            if (($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "type", array()) != "checkbox")) {
                echo " value=\"";
                if (((isset($context["lang"]) ? $context["lang"] : null) && ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "translate", array()) == true))) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array()), (isset($context["lang"]) ? $context["lang"] : null), array(), "array"), "html", null, true);
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array()), "html", null, true);
                }
                echo "\"";
            } elseif ($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "value", array())) {
                echo " checked=\"checked\"";
            }
            echo "/>
        ";
            // line 510
            if (($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "options", array()), "type", array()) == "file")) {
                // line 511
                echo "        <div class=\"fileupload-container\" style=\"display: none;\">
            <h4>";
                // line 512
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.addedFiles"), "html", null, true);
                echo "</h4>
            <table class=\"sortable table table-small-font table-bordered table-striped\">
                <thead>
                    <tr>
                        <th>";
                // line 516
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.preview"), "html", null, true);
                echo "</th>
                        <th>";
                // line 517
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filename"), "html", null, true);
                echo "</th>
                        <th>";
                // line 518
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filedesc"), "html", null, true);
                echo "</th>
                        <th>";
                // line 519
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filemime"), "html", null, true);
                echo "</th>
                        <th>";
                // line 520
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filesize"), "html", null, true);
                echo "</th>
                        <th>";
                // line 521
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.filetags"), "html", null, true);
                echo "</th>
                        <th>";
                // line 522
                echo twig_escape_filter($this->env, Twigextension::i18n("formbuilder.fileactions"), "html", null, true);
                echo "</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        ";
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

    public function getTemplateName()
    {
        return "Formbuilder/form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2062 => 522,  2058 => 521,  2054 => 520,  2050 => 519,  2046 => 518,  2042 => 517,  2038 => 516,  2031 => 512,  2028 => 511,  2026 => 510,  2007 => 509,  2004 => 508,  1990 => 507,  1974 => 504,  1945 => 502,  1940 => 501,  1926 => 500,  1921 => 499,  1918 => 498,  1904 => 497,  1880 => 494,  1877 => 493,  1863 => 492,  1844 => 488,  1842 => 487,  1839 => 486,  1836 => 485,  1822 => 484,  1751 => 481,  1738 => 480,  1719 => 476,  1713 => 474,  1711 => 473,  1706 => 472,  1704 => 471,  1699 => 470,  1697 => 469,  1692 => 468,  1689 => 467,  1686 => 466,  1672 => 465,  1650 => 462,  1637 => 461,  1599 => 458,  1586 => 457,  1568 => 453,  1563 => 452,  1557 => 450,  1555 => 449,  1552 => 448,  1549 => 447,  1536 => 446,  1516 => 443,  1513 => 442,  1506 => 440,  1500 => 439,  1494 => 436,  1489 => 435,  1486 => 434,  1482 => 433,  1479 => 432,  1474 => 431,  1469 => 428,  1462 => 426,  1456 => 425,  1450 => 422,  1445 => 421,  1442 => 420,  1438 => 419,  1435 => 418,  1431 => 417,  1428 => 416,  1412 => 408,  1409 => 407,  1407 => 406,  1404 => 405,  1401 => 404,  1396 => 403,  1393 => 402,  1390 => 401,  1374 => 400,  1358 => 397,  1352 => 396,  1345 => 392,  1341 => 390,  1338 => 389,  1334 => 388,  1331 => 387,  1324 => 385,  1318 => 384,  1312 => 381,  1309 => 380,  1306 => 379,  1302 => 378,  1299 => 377,  1295 => 376,  1292 => 375,  1289 => 374,  1274 => 373,  1258 => 370,  1249 => 368,  1245 => 367,  1242 => 366,  1236 => 364,  1230 => 362,  1228 => 361,  1225 => 360,  1222 => 359,  1206 => 358,  1178 => 354,  1173 => 353,  1170 => 352,  1157 => 351,  1139 => 346,  1133 => 345,  1125 => 344,  1119 => 341,  1109 => 338,  1103 => 335,  1100 => 334,  1097 => 333,  1084 => 332,  1065 => 329,  1060 => 326,  1054 => 324,  1048 => 322,  1046 => 321,  1042 => 320,  1038 => 318,  1032 => 316,  1026 => 314,  1023 => 313,  1017 => 312,  1011 => 310,  1005 => 308,  1002 => 307,  998 => 306,  994 => 305,  983 => 299,  978 => 297,  973 => 294,  970 => 293,  965 => 292,  962 => 291,  949 => 290,  902 => 287,  898 => 256,  862 => 255,  860 => 222,  848 => 221,  832 => 218,  829 => 217,  821 => 211,  815 => 210,  807 => 207,  801 => 206,  793 => 205,  785 => 200,  778 => 196,  774 => 195,  768 => 192,  760 => 187,  755 => 184,  750 => 181,  745 => 179,  742 => 178,  740 => 177,  734 => 175,  729 => 174,  725 => 173,  718 => 169,  714 => 168,  710 => 167,  706 => 166,  702 => 165,  698 => 164,  694 => 163,  687 => 159,  682 => 156,  679 => 155,  677 => 154,  674 => 153,  671 => 152,  658 => 151,  630 => 147,  626 => 146,  621 => 145,  617 => 144,  611 => 142,  601 => 135,  593 => 129,  580 => 127,  577 => 126,  559 => 125,  556 => 124,  543 => 123,  515 => 119,  510 => 116,  506 => 115,  502 => 114,  498 => 113,  492 => 111,  482 => 104,  474 => 98,  461 => 96,  458 => 95,  455 => 94,  437 => 93,  434 => 92,  421 => 91,  381 => 87,  363 => 86,  351 => 85,  324 => 82,  308 => 80,  305 => 79,  287 => 78,  274 => 77,  249 => 66,  240 => 60,  232 => 55,  227 => 52,  220 => 48,  215 => 45,  213 => 44,  207 => 41,  198 => 35,  190 => 29,  184 => 27,  178 => 25,  176 => 24,  167 => 17,  161 => 15,  155 => 13,  153 => 12,  145 => 10,  142 => 9,  139 => 8,  127 => 7,  110 => 4,  105 => 3,  102 => 2,  90 => 1,  85 => 506,  82 => 496,  79 => 491,  76 => 483,  72 => 478,  68 => 463,  64 => 459,  61 => 456,  58 => 445,  55 => 399,  52 => 372,  49 => 357,  46 => 350,  43 => 331,  40 => 289,  37 => 220,  34 => 150,  31 => 122,  28 => 90,  25 => 84,  22 => 76,  19 => 6,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% macro build(data) %}
    {% import _self as forms %}
    {{ forms.buildLangForm(data) }}
    {{ forms.addTemplates(data) }}
{% endmacro %}

{% macro buildLangForm(data) %}
    {% import _self as forms %}
    {% if data.hasTab|default(false) %}
        <div class=\"form-wizard{% if data.hideTabHeader %} hideTabHeader{% endif %}\">
            <ul class=\"tabs\">
                {% if data.hasLang|default(false) %}
                    {{ forms.tabHeaderLangs(data.langs,data.hasTranslateField) }}
                {% else %}
                    {{ forms.tabHeaderCustom(data) }}
                {% endif %}
            </ul>

            <div class=\"progress-indicator\">
                <span></span>
            </div>

            <div class=\"tab-content no-margin\">
                {% if data.hasLang|default(false) %}
                    {{ forms.tabBodyLangs(data) }}
                {% else %}
                    {{ forms.tabBodyCustom(data) }}
                {% endif %}
            </div>

            <ul class=\"pager wizard\">
                <li class=\"previous first\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <i class=\"fa-angle-double-left\"></i>
                        <span>{{ 'formbuilder.first'|i18n }}</span>
                    </a>
                </li>
                <li class=\"previous\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <i class=\"fa-angle-left\"></i>
                        <span>{{ 'formbuilder.prev'|i18n }}</span>
                    </a>
                </li>
                {% if data.orm_loaded == false %}
                <li class=\"next finishAndNew\">
                    <a href=\"#\" class=\"btn btn-purple\" type=\"button\">
                        <i class=\"fa-check-circle\"></i>
                        <span>{{ 'formbuilder.saveAndNew'|i18n }}</span>
                    </a>
                </li>
                {% endif %}
                <li class=\"next finish\">
                    <a href=\"#\" class=\"btn btn-purple\" type=\"button\">
                        <i class=\"fa-check\"></i>
                        <span>{{ 'formbuilder.save'|i18n }}</span>
                    </a>
                </li>
                <li class=\"next last\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <span>{{ 'formbuilder.last'|i18n }}</span>
                        <i class=\"fa-angle-double-right\"></i>
                    </a>
                </li>
                <li class=\"next\">
                    <a href=\"#\" class=\"btn btn-white\" type=\"button\">
                        <span>{{ 'formbuilder.next'|i18n }}</span>
                        <i class=\"fa-angle-right\"></i>
                    </a>
                </li>

            </ul>

        </div>
    {% endif %}
{% endmacro %}

{% macro tabHeaderLangs(langs,hasTranslateField) %}
    {% for index,item in langs %}
\t\t{% if loop.first or hasTranslateField %}
        <li {% if loop.first %} class=\"active\"{% endif %}><a href=\"#tabs-{{ item }}\" data-toggle=\"tab\">{% if loop.first %}{{ 'formBaseData'|i18n }} - {% endif %}{{ item|i18n }}</a></li>
\t\t{% endif %}
    {% endfor %}
{% endmacro %}

{% macro tabHeaderCustom(data) %}
    {% for index,item in data.tabs %}
        <li {% if loop.first %} class=\"active\"{% endif %}><a href=\"#tabs-{{ index }}\" data-toggle=\"tab\">{% if index == 'base' %}{{ 'formBaseData'|i18n }}{% else %}{{ item|i18n }}{% endif %}</a></li>
    {% endfor %}
{% endmacro %}

{% macro tabBodyLangs(data,useTab = true) %}
    {% import _self as forms %}
    {% for index,item in data.langs %}
\t\t{% if loop.first or data.hasTranslateField %}
        {% if useTab %}
            <div class=\"tab-pane with-bg{% if loop.first %} active{% endif %}{% if data.sections|length != 0 %} hasSection{% endif %}\" id=\"tabs-{{ item }}\">
        {% else %}
           <div class=\"panel panel-default panel-border subform-item\">
               <div class=\"panel-heading\">
                   <div class=\"panel-options\">
                       <i class=\"loader-icon\">
                           <span class=\"fa fa-spin fa-refresh\"></span>
                       </i>
                       <a href=\"#\" class=\"delSubformItem\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.delete'|i18n }}\">
                           <i class=\"fa fa-trash\"></i>
                       </a>
                   </div>
               </div>
               <div class=\"panel-body\">
           {% endif %}
            {{ forms.rows(data,item,loop.first,item) }}

            {{ forms.addFileList(index,data) }}
            {{ forms.addSubforms(index,data) }}
            {% if useTab == false %}</div>{% endif %}

        </div>
\t\t{% endif %}

    {% endfor %}
{% endmacro %}

{% macro tabBodyCustom(data,useTab = true) %}
    {% import _self as forms %}
    {% for index,item in data.tabs %}
        {% if useTab %}
            <div class=\"tab-pane with-bg{% if loop.first %} active{% endif %}{% if data.sections|length != 0 %} hasSection{% endif %}\" id=\"tabs-{{ index }}\">
        {% else %}
                <div class=\"panel panel-default panel-border subform-item\">
                    <div class=\"panel-heading\">
                        <div class=\"panel-options\">
                            <i class=\"loader-icon\">
                                <span class=\"fa fa-spin fa-refresh\"></span>
                            </i>
                            <a href=\"#\" class=\"delSubformItem\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.delete'|i18n }}\">
                                <i class=\"fa fa-trash\"></i>
                            </a>
                        </div>
                    </div>
                    <div class=\"panel-body\">
        {% endif %}
            {{ forms.rows(data,index,loop.first,index,useTab) }}

            {% if useTab == false %}{{ forms.addFileList(index,data) }}{% endif %}
            {{ forms.addSubforms(index,data) }}
            {% if useTab == false %}</div>{% endif %}
        </div>
    {% endfor %}
{% endmacro %}

{% macro addFileList(index,data) %}
    {% import _self as forms %}

    {% if index == 0 %}
        {% if data.getFiles().hasFile %}
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"fileuploaded-container\">
                    <h4>{{ 'formbuilder.uploadedFiles'|i18n }}</h4>
                    <table class=\"sortable ordered table table-small-font table-bordered table-striped\">
                        <thead>
                            <tr>
                                <th>{{ 'formbuilder.preview'|i18n }}</th>
                                <th>{{ 'formbuilder.filename'|i18n }}</th>
                                <th>{{ 'formbuilder.filedesc'|i18n }}</th>
                                <th>{{ 'formbuilder.filemime'|i18n }}</th>
                                <th>{{ 'formbuilder.filesize'|i18n }}</th>
                                <th>{{ 'formbuilder.filetags'|i18n }}</th>
                                <th>{{ 'formbuilder.fileactions'|i18n }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for block in data.getFiles().getAll() %}
                                {% for item in block %}
                                <tr data-id=\"{{ item.fi_id }}\">
                                    <td>
                                         {% if 'image' in item.fi_type  %}
                                            <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px\"></i>
                                            <img src=\"{{ getUserfile(item.fi_url) }}\" style='max-width: 75px;max-height: 75px'>
                                        {% else %}
                                            <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px; margin-top: 10px;float: left;\"></i>
                                            <i class=\"fa fa-file-o\" style='font-size: 27px'></i>
                                        {% endif %}
                                    </td>
                                    <td>
                                        <div class=\"form-group\">
                                            <input type='text' class=\"form-control\" data-name=\"fi_name\" value='{{ item.fi_name }}'>
                                        </div>
                                    </td>
                                    <td>
                                         <div class=\"form-group\">
                                            <input type='text' class=\"form-control\" data-name=\"fi_desc\" value=\"{{ item.fi_desc }}\">
                                        </div>
                                    </td>
                                    <td>{{ item.fi_type }}</td>
                                    <td>{{ item.filesize }}</td>
                                    <td>
                                        <div class=\"form-group\">
                                            <select class=\"form-control fileTypes\" multiple>
                                                {{ forms.setFileType(data,item) }}
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <a href=\"{{ data.root }}download/files/{{ item.fi_id }}\" class=\"btn btn-icon btn-success btn-sm\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.download'|i18n }}\"><i class=\"fa-download\"></i></a>
                                        {% if data.fileUpload.enableDel %}<button class=\"btn btn-icon btn-red btn-sm filedel\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.delete'|i18n }}\"><i class=\"fa-trash\"></i></button>{% endif %}
                                    </td>
                                </tr>
                                {% endfor %}
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {% endif %}
    {% endif %}

{% endmacro %}

{% macro addTemplates(data) %}
{% import _self as forms %}
{% raw %}
    <script type=\"text/twig\" id=\"file-template\">
         <tr>
            <td>
                <input type='hidden' name='upload_files[{{ input }}]{{ prefix }}' value='{{ data }}'>
                <input type='hidden' name='upload_filesize[{{ input }}]{{ prefix }}' value='{{ file.size }}'>
                <input type='hidden' name='upload_mime[{{ input }}]{{ prefix }}' value='{{ file.type }}'>
                <input type='hidden' name='upload_original_name[{{ input }}]{{ prefix }}' value='{{ file.name }}'>

                {% if 'image' in file.type %}
                    <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px\"></i>
                    <img src=\"{{ data }}\" class=\"{{ rotateClass }}\" style='max-width: 75px;max-height: 75px;'>
                {% else %}
                    <i class=\"fa fa-arrows-v\" style=\"padding-right: 10px; margin-top: 10px;float: left;\"></i>
                    <i class=\"fa fa-file-o\" style='font-size: 27px'></i>
                {% endif %}
            </td>
            <td>
                <div class=\"form-group\">
                    <input type='text' class=\"form-control\" name='upload_filename[{{ input }}]{{ prefix }}' value='{{ file.name }}'>
                </div>
            </td>
            <td>
                 <div class=\"form-group\">
                    <input type='text' class=\"form-control\" name='upload_filedetails[{{ input }}]{{ prefix }}'>
                </div>
            </td>
            <td>{{ file.type }}</td>
            <td>{{ file.size }}</td>
            <td>
                <div class=\"form-group\">
                    <select class=\"form-control\" name='upload_filetypes[{{ input }}]{{ prefix }}[]' multiple>
    {% endraw %}
                        {{ forms.setFileType(data,item) }}
    {% raw %}
                    </select>
                </div>
            </td>
            <td>
                <button class=\"btn btn-icon btn-red btn-sm fileuploaddel\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.delete'|i18n }}\"><i class=\"fa-trash\"></i></button>
            </td>
        </tr>
    </script>

    <script type=\"text/twig\" id=\"file-loading-template\">
        <tr>
            <td class='file-loading' colspan=\"7\">
                <a class='progress-abort btn btn-icon btn-red btn-xs'>
                    <i class='fa-times'></i>
                </a>

                <div class='progress-contaniner'>
                    <div class=\"progress progress-striped active\">
                        <div style=\"width: 0%\" aria-valuemax=\"100\" aria-valuemin=\"0\" aria-valuenow=\"0\" role=\"progressbar\" class=\"progress-bar progress-bar-success\">
                            <span class=\"sr-only\"></span>
                        </div>
                    </div>
                    <div class='progress-bar-value'></div>
                    <div class='progress-bar-percent'></div>
                </div>
            </td>
        </tr>
    </script>

    {% endraw %}
{% endmacro %}

{% macro addSubforms(index,data) %}
    {% import _self as forms %}
    {% for subform in data.subforms %}
        {%  if index == subform.tab %}
        <div class=\"panel panel-color panel-purple\">

            <div class=\"panel-heading\">
                <h3 class=\"panel-title\">{{ subform.title }}</h3>
                <div class=\"panel-options\">
                    <a href=\"#\" class=\"addSubformItem\" data-relation=\"{{ subform.relation }}\" data-toggle=\"tooltip\" title=\"{{ \"formbuilder.additem\"|i18n }}\">
                        <i class=\"fa fa-plus\"></i>
                    </a>
                </div>
            </div>

            <div class=\"panel-body subform-container-{{ subform.relation }} subform-container\">
                {% for form in subform.form %}
                    {% if form.hasLang|default(false) %}
                        {{ forms.tabBodyLangs(form,false) }}
                    {% else %}
                        {{ forms.tabBodyCustom(form,false) }}
                    {% endif %}
                {% endfor %}
                {% if subform.formTemplate.hasLang|default(false) %}
                    {{ forms.tabBodyLangs(subform.formTemplate,false) }}
                {% else %}
                    {{ forms.tabBodyCustom(subform.formTemplate,false) }}
                {% endif %}
            </div>

            <script type=\"text/twig\" id=\"subform-{{ subform.relation|default(random()) }}-template\">
                {% if subform.formTemplate.hasLang|default(false) %}
                    {{ forms.tabBodyLangs(subform.formTemplate,false) }}
                {% else %}
                    {{ forms.tabBodyCustom(subform.formTemplate,false) }}
                {% endif %}
            </script>
        </div>
        {% endif %}
    {% endfor %}
{% endmacro %}

{% macro getFilesRow(item,data) %}
    {% import _self as forms %}

    <div class=\"row\" data-id=\"{{ item.fi_id }}\">
        <div class=\"col-md-12\">
            <div class=\"col-md-3\">
                <p>{{ item.fi_name }} [<em>{{ item.fi_type }} / {{ item.filesize }}</em>]</p>
            </div>
            <div class=\"col-md-3\">
                {{ forms.setFileType(data,item) }}
            </div>
            <div class=\"col-md-3\">
                <a href=\"{{ data.root }}download/files/{{ item.fi_id }}\" class=\"btn btn-icon btn-success btn-sm\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.download'|i18n }}\"><i class=\"fa-download\"></i></a>
\t\t\t\t{% if data.fileUpload.enableDel %}<button class=\"btn btn-icon btn-red btn-sm filedel\" data-toggle=\"tooltip\" title=\"{{ 'formbuilder.delete'|i18n }}\"><i class=\"fa-trash\"></i></button>{% endif %}
            </div>
        </div>
    </div>
{% endmacro %}

{% macro setFileType(data,item) %}
    {% set currentType = item.getTypesAsArray() %}
    {% for type in data.getFiles().filesTypes %}
    <option value=\"{{ type.ft_id }}\"{% if type.ft_id in currentType %} selected=\"selected\"{% endif %}>{{ type.ft_name }}</option>
    {% endfor %}
{% endmacro %}

{% macro rows(data, lang = false, is_first, tab, useTab) %}
    {% import _self as forms %}

    {% if data.sections|length == 0 %}
        {{ forms.addFieldsWithoutSection(data, lang, is_first,tab) }}
    {% else %}
        {{ forms.addFieldsWithSection(data, lang, is_first,tab) }}
    {% endif %}

    {% for item in data.elements.getHiddenElements() %}
        {{ forms.getElement(item, lang) }}
    {% endfor %}

{% endmacro %}

{% macro addFieldsWithoutSection(data, lang = false, step, tab) %}
    {% import _self as forms %}

    {% for block in data.elements.getRenderedElements('left',lang)|chunk(2) %}
        <div class=\"row\">
            {% for item in block %}
                {% if item.options.render == true %}
                    <div class=\"col-md-6\">
                        {{ forms.getFormGroup(item,lang) }}
                    </div>
                {% endif %}
            {% endfor %}
        </div>
    {% endfor %}

    {% for item in data.elements.getRenderedElements('right',lang) %}
        {% if item.options.render == true %}
            <div class=\"row\">
                <div class=\"col-md-12\">
                    {{ forms.getFormGroup(item,lang) }}
                </div>
            </div>
        {% endif %}
    {% endfor %}

{% endmacro %}

{% macro addFieldsWithSection(data, lang = false, step, tab, useTab = true) %}
    {% import _self as forms %}

    {% for index,item in data.sections[tab] if data.sections[tab] is defined %}
        {% if useTab %}
            <div class=\"panel panel-color panel-info\">
            {% if item.title %}
                <div class=\"panel-heading\">
                    <h3 class=\"panel-title\">{{ item.title }}{% if item.helper %} <small>{{ item.helper }}</small>{% endif %}</h3>
                    <div class=\"panel-options\">
                        <i class=\"loader-icon\">
                            <span class=\"fa fa-spin fa-refresh\"></span>
                        </i>
                    </div>
                </div>
            {% endif %}
                <div class=\"panel-body\">
                    {% for row in data.getElementsForTab(tab,index,lang) %}
                        <div class=\"row\">
                            {% for field in row %}
                                {% if field.options.render == true %}
                                    <div class=\"col-md-{{ 12 // row|length }}\">
                                        {{ forms.getFormGroup(field,lang) }}
                                    </div>
                                {% endif %}
                            {% endfor %}
                        </div>
                    {% endfor %}
                </div>
            </div>
        {% else %}
            {% for row in data.getElementsForTab(tab,index,lang) %}
                <div class=\"row\">
                    {% for field in row %}
                        {% if field.options.render == true %}
                            <div class=\"col-md-{{ 12 // row|length }}\">
                                {{ forms.getFormGroup(field,lang) }}
                            </div>
                        {% endif %}
                    {% endfor %}
                </div>
            {% endfor %}
        {% endif %}
    {% endfor %}
{% endmacro %}

{% macro getFormGroup(item,lang) %}
    {% import _self as forms %}
    <div class=\"form-group\">
        {% if item.options.type != 'hidden' %}
            {{ forms.getLabel(item, lang) }}
        {% endif %}
        {{ forms.getElement(item, lang) }}
        {{ forms.getError(item, lang) }}
    </div>
{% endmacro %}

{% macro getLabel(item, lang) %}
    <label class=\"control-label\" for=\"{{ item.name|replace({ '[]': '' }) }}{% if lang %}_{{ lang }}{% endif %}\">{% if item.options.label %}{{ item.options.label }}{% else %}{{ item.name|replace({ '[]': '' })|i18n }}{% endif %}{% if item.options.required %}<strong class=\"required-item\"> *</strong>{% endif %}{% if item.options.addNew %}<a href=\"{{ item.options.newUrl }}\"><i class=\"fa fa-plus-square\"></i> Új {{ \"formbuilder.additem\"|i18n }}a</a>{% endif %}</label>
{% endmacro %}}

{% macro getError(item, lang) %}
    <span id=\"{{ item.name|replace({ '[]': '' }) }}{% if lang %}_{{ lang }}{% endif %}-error\" class=\"validate-has-error\" style=\"display: none;\"></span>
{% endmacro %}}

{% macro getElement(element, lang, direction = 'left') %}
    {% import _self as forms %}
    {% if element.type == 'input' %}
        {{ forms.getInput(element, lang, direction) }}
    {% elseif element.type == 'select' %}
        {{ forms.getSelect(element, lang, direction) }}
    {% elseif element.type == 'textarea' %}
        {{ forms.getTextarea(element, lang, direction) }}
    {% elseif element.type == 'captcha' %}
        {{ forms.getCaptcha(element, lang, direction) }}
    {% else %}
        <span class=\"textarea\">{% autoescape false %}{{ element.options.value }}{% endautoescape %}</span>
    {% endif %}
{% endmacro %}}

{% macro getElementAttr(element,lang) %}
  {% if element.options.date == 1 %} data-widget=\"datepicker\" {% endif %}data-input-title='{% if element.options.label %}{{ element.options.label }}{% else %}{{ element.name|replace({ '[]': '' })|i18n }}{% endif %}'{% if element.options.helper %} data-inputhelper='{{ (element.name|replace({ '[]': '' }) ~ '_helper')|i18n }}'{% endif %} id=\"{{ element.name|replace({ '[]': '' }) }}{% if lang %}_{{ lang }}{% endif %}\" name=\"{{ element.name }}{% if lang and element.options.translate == true %}_lang_{{ lang }}{% endif %}{% if element.options.isArray|default(false) %}[]{% endif %}\"{% if element.options|length %}{% for index,item in element.options %}{% if index not in ['value', 'position', 'options','date','translate','render','required','helper','tab','message','label','isArray','class','chooseTitle','addNew','newUrl','optionDatas'] %} {{ index }}='{{ item }}'{% endif %}{% endfor %}{% endif %}{% if element.options.message != false %}{% endif %} class=\"form-control{% if  element.options.class is defined %} {{  element.options.class }}{% endif %}\"
{% endmacro %}

{% macro getCaptcha(element, lang, direction) %}
    {% import _self as forms %}
    <div class=\"captcha\">
    {% autoescape false %}{{ element.options.value }}{% endautoescape %}
    <input {{ forms.getElementAttr(element,lang) }}>
    </div>
{% endmacro %}

{% macro getTextarea(element, lang, direction) %}
    {% import _self as forms %}
    <textarea {{ forms.getElementAttr(element,lang) }}>{% if element.options.translate == false %}{{ element.options.value }}{% else %}{{ element.options.value[lang] }}{% endif %}</textarea>
{% endmacro %}

{% macro getSelect(element, lang, direction) %}
    {% import _self as forms %}
        <select {{ forms.getElementAttr(element, lang) }}>
            {% if element.options.multiple|default(false) == false %}<option value=\"-1\"{% if element.options.value == -1 %} selected=\"selected\"{% endif %}>{% if element.options.chooseTitle %}{{ element.options.chooseTitle }}{% else %}{{ 'choosePlease'|i18n }}{% endif %}</option>{% endif %}
            {% for item in element.options.options %}
                <option value=\"{{ item.value }}\"{% if item.value == element.options.value or (element.options.value is iterable and item.value in element.options.value) %} selected='selected'{% endif %}{% if item.data %}{% for dIndex,dData in item.data %}data-{{ dIndex }}=\"{{ dData }}\" {% endfor %}{% endif %}>{{ item.name }}</option>
            {% endfor %}
        </select>
{% endmacro %}

{% macro getInput(element, lang, direction) %}
    {% import _self as forms %}
        <input {{ forms.getElementAttr(element, lang) }}{% if element.options.type is null %} type=\"text\"{% endif %}{% if element.options.type != 'checkbox' %} value=\"{% if lang and element.options.translate == true %}{{ element.options.value[lang] }}{% else %}{{ element.options.value }}{% endif %}\"{% elseif element.options.value %} checked=\"checked\"{% endif %}/>
        {% if element.options.type == 'file' %}
        <div class=\"fileupload-container\" style=\"display: none;\">
            <h4>{{ 'formbuilder.addedFiles'|i18n }}</h4>
            <table class=\"sortable table table-small-font table-bordered table-striped\">
                <thead>
                    <tr>
                        <th>{{ 'formbuilder.preview'|i18n }}</th>
                        <th>{{ 'formbuilder.filename'|i18n }}</th>
                        <th>{{ 'formbuilder.filedesc'|i18n }}</th>
                        <th>{{ 'formbuilder.filemime'|i18n }}</th>
                        <th>{{ 'formbuilder.filesize'|i18n }}</th>
                        <th>{{ 'formbuilder.filetags'|i18n }}</th>
                        <th>{{ 'formbuilder.fileactions'|i18n }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        {% endif %}
{% endmacro %}", "Formbuilder/form.twig", "C:\\xampp\\htdocs\\gol\\core\\formbuilder\\views\\Formbuilder\\form.twig");
    }
}
