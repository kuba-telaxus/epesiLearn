<?php

/* plugin.php.twig */
class __TwigTemplate_be7030d18b5369cd4398650633cb467d9cccee425fd936b4225d4c983f0d5db6 extends Twig_Template
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
namespace Grav\\Plugin;

use Grav\\Common\\Plugin;
use RocketTheme\\Toolbox\\Event\\Event;

/**
 * Class ";
        // line 8
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("camel", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "Plugin
 * @package Grav\\Plugin
 */
class ";
        // line 11
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("camel", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo "Plugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if (\$this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        \$this->enable([
            'onPageContentRaw' => ['onPageContentRaw', 0]
        ]);
    }

    /**
     * Do some work for this event, full details of events can be found
     * on the learn site: http://learn.getgrav.org/plugins/event-hooks
     *
     * @param Event \$e
     */
    public function onPageContentRaw(Event \$e)
    {
        // Get a variable from the plugin configuration
        \$text = \$this->grav['config']->get('plugins.";
        // line 55
        echo $this->env->getExtension('GravTwigExtension')->inflectorFilter("hyphen", $this->getAttribute((isset($context["component"]) ? $context["component"] : null), "name", array()));
        echo ".text_var');

        // Get the current raw content
        \$content = \$e['page']->getRawContent();

        // Prepend the output with the custom text and set back on the page
        \$e['page']->setRawContent(\$text . \"\\n\\n\" . \$content);
    }
}
";
    }

    public function getTemplateName()
    {
        return "plugin.php.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 55,  34 => 11,  28 => 8,  19 => 1,);
    }
}
/* <?php*/
/* namespace Grav\Plugin;*/
/* */
/* use Grav\Common\Plugin;*/
/* use RocketTheme\Toolbox\Event\Event;*/
/* */
/* /***/
/*  * Class {{ component.name|camelize }}Plugin*/
/*  * @package Grav\Plugin*/
/*  *//* */
/* class {{ component.name|camelize }}Plugin extends Plugin*/
/* {*/
/*     /***/
/*      * @return array*/
/*      **/
/*      * The getSubscribedEvents() gives the core a list of events*/
/*      *     that the plugin wants to listen to. The key of each*/
/*      *     array section is the event that the plugin listens to*/
/*      *     and the value (in the form of an array) contains the*/
/*      *     callable (or function) as well as the priority. The*/
/*      *     higher the number the higher the priority.*/
/*      *//* */
/*     public static function getSubscribedEvents()*/
/*     {*/
/*         return [*/
/*             'onPluginsInitialized' => ['onPluginsInitialized', 0]*/
/*         ];*/
/*     }*/
/* */
/*     /***/
/*      * Initialize the plugin*/
/*      *//* */
/*     public function onPluginsInitialized()*/
/*     {*/
/*         // Don't proceed if we are in the admin plugin*/
/*         if ($this->isAdmin()) {*/
/*             return;*/
/*         }*/
/* */
/*         // Enable the main event we are interested in*/
/*         $this->enable([*/
/*             'onPageContentRaw' => ['onPageContentRaw', 0]*/
/*         ]);*/
/*     }*/
/* */
/*     /***/
/*      * Do some work for this event, full details of events can be found*/
/*      * on the learn site: http://learn.getgrav.org/plugins/event-hooks*/
/*      **/
/*      * @param Event $e*/
/*      *//* */
/*     public function onPageContentRaw(Event $e)*/
/*     {*/
/*         // Get a variable from the plugin configuration*/
/*         $text = $this->grav['config']->get('plugins.{{ component.name|hyphenize }}.text_var');*/
/* */
/*         // Get the current raw content*/
/*         $content = $e['page']->getRawContent();*/
/* */
/*         // Prepend the output with the custom text and set back on the page*/
/*         $e['page']->setRawContent($text . "\n\n" . $content);*/
/*     }*/
/* }*/
/* */
