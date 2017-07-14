<?php

/* plugin.yaml.twig */
class __TwigTemplate_2c2442bff8f63f4a314b999b5e3beff7019e4f5f930f4cb2d90153572b4f6090 extends Twig_Template
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
        echo "enabled: true
text_var: Custom Text added by the **";
        // line 2
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("title", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "** plugin (disable plugin to remove)
";
    }

    public function getTemplateName()
    {
        return "plugin.yaml.twig";
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
/* enabled: true*/
/* text_var: Custom Text added by the **{{ component.name|titleize }}** plugin (disable plugin to remove)*/
/* */
