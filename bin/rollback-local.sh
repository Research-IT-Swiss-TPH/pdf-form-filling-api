docker compose -f compose.local.yml run --rm -it php-fpm php vendor/bin/phinx rollback -t 0 -f