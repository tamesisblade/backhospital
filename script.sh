  #!/bin/bash
chown -R :nginx /var/www/northospital-backend/storage/
chown -R :nginx /var/www/northospital-backend/bootstrap/cache/
chmod -R 0777 /var/www/northospital-backend/storage/
chmod -R 0775 /var/www/northospital-backend/bootstrap/cache/
semanage fcontext -a -t httpd_sys_rw_content_t '/var/www/northospital-backend/storage(/.*)?'
semanage fcontext -a -t httpd_sys_rw_content_t '/var/www/northospital-backend/bootstrap/cache(/.*)?'
restorecon -Rv '/var/www/northospital-backend'