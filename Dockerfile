FROM php:7.0-apache-jessie

COPY site.db /var/www/html/site.db
COPY style.css /var/www/html/style.css
COPY processing.php /var/www/html/processing.php
COPY nfa.png /var/www/html/nfa.png
COPY index.php /var/www/html/index.php

RUN chown -R www-data:www-data /var/www/


EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
