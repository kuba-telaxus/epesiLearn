<?php

/* LICENSE.twig */
class __TwigTemplate_248fb63e3f775aec4ce9321488c9dd37909bbbb0bbbb8dc74dc03423751b823d extends Twig_Template
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
        echo "The MIT License (MIT)

Copyright (c) ";
        // line 3
        echo twig_date_format_filter($this->env, "now", "Y");
        echo " ";
        echo $this->getAttribute($this->getAttribute((isset($context["component"]) ? $context["component"] : null), "author", array()), "name", array());
        echo "

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the \"Software\"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
";
    }

    public function getTemplateName()
    {
        return "LICENSE.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }
}
/* The MIT License (MIT)*/
/* */
/* Copyright (c) {{ "now"|date("Y") }} {{ component.author.name }}*/
/* */
/* Permission is hereby granted, free of charge, to any person obtaining a copy*/
/* of this software and associated documentation files (the "Software"), to deal*/
/* in the Software without restriction, including without limitation the rights*/
/* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell*/
/* copies of the Software, and to permit persons to whom the Software is*/
/* furnished to do so, subject to the following conditions:*/
/* */
/* The above copyright notice and this permission notice shall be included in all*/
/* copies or substantial portions of the Software.*/
/* */
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR*/
/* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,*/
/* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE*/
/* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER*/
/* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,*/
/* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE*/
/* SOFTWARE.*/
/* */
