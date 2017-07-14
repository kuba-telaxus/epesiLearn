<?php

/* CHANGELOG.md.twig */
class __TwigTemplate_2938063681266147adbb1cf9aae7901370d7e1393c4fbd76f2c572e35eaaebe9 extends Twig_Template
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
        echo "# v0.1.0
##  ";
        // line 2
        echo twig_date_format_filter($this->env, "now", "m/d/Y");
        echo "

1. [](#new)
    * ChangeLog started...
";
    }

    public function getTemplateName()
    {
        return "CHANGELOG.md.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  19 => 1,);
    }
}
/* # v0.1.0*/
/* ##  {{ "now"|date("m/d/Y") }}*/
/* */
/* 1. [](#new)*/
/*     * ChangeLog started...*/
/* */
