<?php

/* Templates/footer.twig */
class __TwigTemplate_ca810145591baafe2cc9c4adda3b45be79ac0415adbb634ef872656a16e9aaaf extends Twig_Template
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
        echo "<footer>

</footer>";
    }

    public function getTemplateName()
    {
        return "Templates/footer.twig";
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
        return new Twig_Source("<footer>

</footer>", "Templates/footer.twig", "C:\\xampp\\htdocs\\gol\\frontend\\application\\views\\Templates\\footer.twig");
    }
}
