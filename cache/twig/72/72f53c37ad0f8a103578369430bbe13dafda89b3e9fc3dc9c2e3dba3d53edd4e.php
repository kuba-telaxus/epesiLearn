<?php

/* blueprints.yaml.twig */
class __TwigTemplate_4b8954c18d6a526bf9adf46b386b16e993d915c9fa267f3bfe22b3c854d90914 extends Twig_Template
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
        echo "name: ";
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("title", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "
version: 0.1.0
description: ";
        // line 3
        echo $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "description", array());
        echo "
icon: plug
author:
  name: ";
        // line 6
        echo $this->getAttribute($this->getAttribute((isset($context["component"]) ? $context["component"] : null), "author", array()), "name", array());
        echo "
  email: ";
        // line 7
        echo $this->getAttribute($this->getAttribute((isset($context["component"]) ? $context["component"] : null), "author", array()), "email", array());
        echo "
homepage: https://github.com/";
        // line 8
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute($this->getAttribute((isset($context["component"]) ? $context["component"] : null), "author", array()), "githubid", array()));
        echo "/grav-plugin-";
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "
demo: http://demo.yoursite.com
keywords: grav, plugin, etc
bugs: https://github.com/";
        // line 11
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute($this->getAttribute((isset($context["component"]) ? $context["component"] : null), "author", array()), "githubid", array()));
        echo "/grav-plugin-";
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "/issues
docs: https://github.com/";
        // line 12
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute($this->getAttribute((isset($context["component"]) ? $context["component"] : null), "author", array()), "githubid", array()));
        echo "/grav-plugin-";
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "/blob/develop/README.md
license: MIT

form:
  validation: strict
  fields:
    enabled:
      type: toggle
      label: Plugin status
      highlight: 1
      default: 0
      options:
        1: Enabled
        0: Disabled
      validate:
        type: bool
    text_var:
      type: text
      label: Text Variable
      help: Text to add to the top of a page
";
    }

    public function getTemplateName()
    {
        return "blueprints.yaml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 12,  47 => 11,  39 => 8,  35 => 7,  31 => 6,  25 => 3,  19 => 1,);
    }
}
/* name: {{ component.name|titleize }}*/
/* version: 0.1.0*/
/* description: {{ component.description }}*/
/* icon: plug*/
/* author:*/
/*   name: {{ component.author.name }}*/
/*   email: {{ component.author.email }}*/
/* homepage: https://github.com/{{ component.author.githubid|hyphenize }}/grav-plugin-{{ component.name|hyphenize }}*/
/* demo: http://demo.yoursite.com*/
/* keywords: grav, plugin, etc*/
/* bugs: https://github.com/{{ component.author.githubid|hyphenize }}/grav-plugin-{{ component.name|hyphenize }}/issues*/
/* docs: https://github.com/{{ component.author.githubid|hyphenize }}/grav-plugin-{{ component.name|hyphenize }}/blob/develop/README.md*/
/* license: MIT*/
/* */
/* form:*/
/*   validation: strict*/
/*   fields:*/
/*     enabled:*/
/*       type: toggle*/
/*       label: Plugin status*/
/*       highlight: 1*/
/*       default: 0*/
/*       options:*/
/*         1: Enabled*/
/*         0: Disabled*/
/*       validate:*/
/*         type: bool*/
/*     text_var:*/
/*       type: text*/
/*       label: Text Variable*/
/*       help: Text to add to the top of a page*/
/* */
