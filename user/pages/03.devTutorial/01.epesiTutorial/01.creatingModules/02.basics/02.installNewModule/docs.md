---
title: Install New Module
taxonomy:
    category: docs
---


Now, as you have your new module files placed in the right directory you can now proceed to module installation. Run epesi using your browser, log in to the system as administrator and go through menu: **Home->Administration->Modules Administration** and press **Rebuild modules database** in order to add your module to the list. Now your module should be among the modules list that you can install.

_**Notice:**_ _You may be required to select Advanced Setup to install your module if your function simple_setup in <module>Install.php returns false._

If you do not see your module in the module list after choosing **Rebuild modules database** please double-check names of all files and classes included in your module. Now as you have installed your module you should proceed to the next chapter and put some contents in the module and make it accessible in epesi.