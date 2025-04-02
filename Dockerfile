# Dockerfile
FROM php:8.3-cli-alpine

# Install system dependencies: PostgreSQL dev libraries, git, zip, unzip, Node.js, and npm.
RUN apk add --no-cache postgresql-dev git zip unzip nodejs npm

# Install Yarn globally
RUN npm install -g yarn

# Install the PHP PDO extension for PostgreSQL
RUN docker-php-ext-install pdo_pgsql

# Install Composer (using the official Composer image's binary)
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the entire project into the container
COPY . /var/www/html

# Install PHP dependencies via Composer
RUN composer install

# Install Node dependencies via Yarn and build assets if applicable.
# If you’re not using Webpack or building assets, you can remove the yarn build step.
RUN yarn install && yarn build

# Expose port 8000
EXPOSE 8000

# Start the built-in PHP web server, serving files from the public directory.
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
