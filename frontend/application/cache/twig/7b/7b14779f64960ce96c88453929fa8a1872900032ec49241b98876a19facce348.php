<?php

/* Templates/header.twig */
class __TwigTemplate_bb54aaf3cdcd4cd634e8a7f1040726e40d267bf440fc3bad658b47cd7c322a2f extends Twig_Template
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
        echo "<header>
   
</header>
";
    }

    public function getTemplateName()
    {
        return "Templates/header.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<header>
   
</header>
", "Templates/header.twig", "C:\\xampp\\htdocs\\gol\\frontend\\application\\views\\Templates\\header.twig");
    }
}
