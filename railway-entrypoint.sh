#!/usr/bin/env bash
set -euo pipefail

# Ensure only one MPM module is enabled (prefork)
a2dismod mpm_event mpm_worker >/dev/null 2>&1 || true
a2enmod mpm_prefork >/dev/null 2>&1 || true

# Remove any leftover symlinks that could cause conflicts
rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* || true
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load || true
ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf || true

# Fix permissions for the Railway Volume (moodledata)
mkdir -p /var/www/moodledata
chown -R www-data:www-data /var/www/moodledata
chmod -R 0775 /var/www/moodledata

# Log which MPM module is loaded
apache2ctl -M 2>/dev/null | grep mpm || true

# Railway reverse-proxy: treat request as HTTPS when the proxy indicates it
echo "SetEnvIf X-Forwarded-Proto https HTTPS=on" > /etc/apache2/conf-available/railway-proxy.conf
a2enconf railway-proxy >/dev/null 2>&1 || true

# Sempre atualiza o config.php no volume com a versão mais recente
echo "Atualizando config.php no volume..."
cp /var/www/html/theme/halsten/config.moodle.php /var/www/moodledata/config.php
chown www-data:www-data /var/www/moodledata/config.php
echo "config.php atualizado!"

# Restaura o config.php do volume para o Moodle
if [ -f /var/www/moodledata/config.php ] && [ ! -f /var/www/html/config.php ]; then
  echo "Restaurando config.php do volume..."
  cp /var/www/moodledata/config.php /var/www/html/config.php
  chown www-data:www-data /var/www/html/config.php
  echo "config.php restaurado!"
fi

# Start the original entrypoint + Apache
exec /usr/local/bin/moodle-docker-php-entrypoint apache2-foreground