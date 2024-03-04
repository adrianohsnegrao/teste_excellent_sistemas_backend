FROM php:8.2-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensões
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar a aplicação Laravel
COPY . /var/www

# Instalar dependências do projeto
RUN composer install

# Dar permissão ao usuário do www-data
RUN chown -R www-data:www-data /var/www

# Expor a porta 9000
EXPOSE 9000

CMD ["php-fpm"]