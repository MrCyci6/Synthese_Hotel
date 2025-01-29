# Before starting

## admin.conf

```
<VirtualHost *:80>
    ServerName admin.hotel.local
    DocumentRoot /var/www/hotel_admin

    <Directory /var/www/hotel_admin>
            AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
``` 

```sh
cd /etc/apache2/sites-enabled
sudo ln -s ../sites-available/admin.conf admin.conf
```


# Active url rewriting
```sh
cd /etc/apache2/mods-enabled
sudo ln -s ../mods-available/rewrite.load rewrite.load
```

# Starting

```sh
sudo systemctl start postgresql
sudo systemctl start apache2
```