echo "Creating Certificate.."

if [ "$1" == "--run" ]
then 
    echo "[RUN]"
    docker compose -f compose.dev.yml run --rm certbot certonly --webroot -w /var/www/certbot/ -d 143.198.242.211.sslip.io -d www.143.198.242.211.sslip.io --email ekin.tertemiz@swisstph.ch --agree-tos --non-interactive 
else
    echo "[DRY RUN]"
    docker compose -f compose.dev.yml run --rm certbot certonly --webroot -w /var/www/certbot/ -d 143.198.242.211.sslip.io -d www.143.198.242.211.sslip.io --email ekin.tertemiz@swisstph.ch --agree-tos --non-interactive --dry-run
fi
