# symfonyCookieBundle
Aim is to provide a tool to ask for cookie permission. Bundle is based using bootstrap
## Installation
```composer require prolyfix/symfonyCookieBundle```
## Modifications of your base.html.twig
include inside your <body> following imports:
```     {% include '@ProlyfixSymfonyCookieNotification/_cookieConsent.html.twig' %} ```
in case you are using symfony encore package, that all you need to do on this file.
## Use case 1: add stimulus controller
Furthermore you need to copy the controller asset.
vendor/prolyfix/symfonyCookieBundle/assets/cookie_controller.js
and put it to
assets

## add the translations




