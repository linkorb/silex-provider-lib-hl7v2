# linkorb/silex-provider-lib-hl7v2

Provides `Hl7v2\MessageParser` and `Hl7v2\AcknowledgementGenerator` from
[linkorb/lib-hl7v2][] as services respectively named `hl7v2.parser.service` and `hl7v2.acknowledgement.service`.

## Install

Install using composer:-

    $ composer require linkorb/silex-provider-lib-hl7v2

Then register the provider:-

    // app/app.php
    use LinkORB\Hl7v2\Provider\Hl7v2ServiceProvider;
    ...
    $app->register(new Hl7v2ServiceProvider);



[linkorb/lib-hl7v2]: <https://github.com/linkorb/lib-hl7v2>
  "linkorb/lib-hl7v2 at GitHub"
