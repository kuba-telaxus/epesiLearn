---
title: Using Tabbed Browser
taxonomy:
    category: docs
---

_Utils/TabbedBrowser_ is a module that provides tabbed interface four our module. 'Tabbed' like in modern internet browsers.

####Initialization
___

To create instance of the module, like for every module in epesi, we type:

	$tabbed_browser = & $this->init_module('Utils/TabbedBrowser');

To display its content:

	$this->display_module($tabbed_browser);

####Usage
___

**Inline tabs**

Method syntax

	$tabbed_browser = & $this->init_module('Utils/TabbedBrowser');
	$tabbed_browser->start_tab( <tab name> );
		[tab's content]
	$tabbed_browser->end_tab();

Example

	$tabbed_browser = & $this->init_module('Utils/TabbedBrowser');
	$tabbed_browser->start_tab( 'Tab One' );
		print 'Some data for tab one.';
	$tabbed_browser->end_tab();
	$tabbed_browser->start_tab( 'Tab Two' );
		print 'Some data for tab two.';
	$tabbed_browser->end_tab();
	$tabbed_browser->start_tab( 'Tab Three' );
		$i = 12;
		print 'And a variable for tab three: ' . $i;
	$tabbed_browser->end_tab();

This code displays three tabs. Their content is determined by what you place between _start_tab_ and _end_tab_ methods.

**Callback tabs**

Method syntax

	$tabbed_browser = & $this->init_module('Utils/TabbedBrowser');
	$tabbed_browser->set_tab( <tab name>, <callback function> );

Example

	$tabbed_browser = & $this->init_module('Utils/TabbedBrowser');
	$tabbed_browser->set_tab( 'Tab One', array($this, 'function_1') );
	$tabbed_browser->set_tab( 'Tab Two', array($this, 'function_2') );
	$tabbed_browser->set_tab( 'Tab Three', array($this, 'function_3') );

* First parameter is name for a tab.

* Second parameter tells, what function should be called, when tab is activated. Structure of second parameter may by a little confusing, so let's detail its structure.

   * First element is class, where the called method is located. In this case, it's the same module, where _$tabbed_browser_ is located.

   * Second element is name of the method to be called. The method has to be present in module named by first element and has to have public access -- otherwise it will not be shown.

The above code will create two tabs ('Tab One' will be show by default). Content of this tab is whatever function _function_1_ prints. Respectively, 'Tab Two' and 'Tab Three', when activated, display what _function_2_ and _function_3_ print.

**More functionality**

_Utils/TabbedBrowser_ ofer a few methods to simplify its usage. Those include:

* set_default_tab(<tab number>) -- lets you specify, which tab should be displayd by default.

* switch_tab(<tab number>) -- switches dislayd tabs from within php file.

	Note: When you use this method, remember to add [tabbed browser instance]->tag() method in each tab.