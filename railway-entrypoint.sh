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

# Instalação automática do Moodle se ainda não foi instalado
# Instalação automática do Moodle se ainda não foi instalado
ADMIN_PASS="${MOODLE_ADMIN_PASS:-IN\$0luc0#\$TI}"
ADMIN_EMAIL="${MOODLE_ADMIN_EMAIL:-suporte@halsten.com.br}"

if [ ! -f /var/www/moodledata/moodle_is_installed ]; then
  echo "Iniciando instalação automática do Moodle..."
  sudo -u www-data php /var/www/html/admin/cli/install_database.php \
    --agree-license \
    --fullname="Halsten Academy" \
    --shortname="halsten" \
    --adminuser=admin \
    --adminpass="${ADMIN_PASS}" \
    --adminemail="${ADMIN_EMAIL}" \
    --non-interactive \
    && touch /var/www/moodledata/moodle_is_installed \
    && echo "Moodle instalado com sucesso!"
fi

# Start the original entrypoint + Apache
exec /usr/local/bin/moodle-docker-php-entrypoint apache2-foreground