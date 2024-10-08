# Utiliser l'image officielle PHP avec Apache
FROM php:7.4-apache

# Copier le contenu de votre répertoire actuel dans /var/www/html
COPY . /var/www/html/

# Donner les permissions appropriées
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80
