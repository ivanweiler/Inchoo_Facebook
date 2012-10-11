Facebook Connect Magento Extension
==================================

Magento extension that enables customers fast and easy registration and login with their Facebook identity.

For instalation instructions, additional help and demo visit:  
<http://inchoo.net/ecommerce/magento/facebook-connect-magento-extension/>

Copyright (c) 2012 Ivan Weiler, Inchoo

Changelog
---------
* 1.0.0
  * Code changed to follow proper inchoo namespace. Layout and templates moved to inchoo/facebook/.
  * New referer logic, resolves IE problems.
  * Catalan, Chinese(China), Italian, Chinese(Taiwan) and Russian translation added thanks to Raül Pérez, magentochinese.org, Mitch, pkduck, tuvinez.
* 0.9.9
  * Client and javascript compatible with new Facebook OAuth2 authentication changes.
  * Event.fire changed to document object to avoid javascript conflicts.
  * Asking for user_birthday permission from now on.
  * Norwegian translation added thanks to Magnus Alexander.
* 0.9.8
  * Version fix, licenses added, connect release.
* 0.9.7
  * Estonian, Swedish, Czech, Turkish and Korean translations added thanks to Sir Mull, Andreas Karlsson, Pavel Hrdlicka, ea and COBAY.
* 0.9.6
  * Bugfix release. Fixed undefined variable notice in client thanks to Toni Grigoriu.
  * Romanian and Lithuanian translations added thanks to Toni Grigoriu, Justinas Lelys.
* 0.9.5
  * Custom channel added. Should increase performance and resolve possible https warnings in some browsers without flash.
  * Bulgarian, Danish, German, Spanish, Dutch, Polish and Portuguese translations added thanks to Dino, Roberto, Simon, Bruno Alexandre, jemoon, Rico van de Vin, Niels, Casper Munk, Matthias Zeis, ivan balabanov.
* 0.9.4
  * Added enable/disable setting, better output handling.
  * Small javascript improvements and text changes.
* 0.9.3
  * Facebook client rewrite, new graph apis implemented and used.
* 0.9.2
  * Improved compatibility with secure URLs and required customer email confirmation.
  * New asynchronous initialization, better Safari and Chrome integration.
  * Layout and configuration improvements, module respects disabled module output now.
  * Facebook lokalization implemented, configuration setting in administration.
  * Better and faster session validation.
  * New OAuth client authentication.
  * Help page and controller removed.
* 0.9.1
  * Added compatibility with older Magento CE 1.3.2.x versions.
* 0.9.0
  * First public release. Compatible with Magento CE 1.4.x.
