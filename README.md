DoMaS
=====

Vor Deployment:
    composer dump-autoload --optimize
    php bin/console cache:clear --env=prod

Server:
    Extension: OPCache
    Extesison: APCu