*here goes a description and the usual things in a README file (ETA: when the developer is inspired and not too lazy to write it)*

*Nota mental: estaria bé moure tots els fitxers que no interaccionen amb l'usuari fora de l'arrel del serviodor web (eg logs dins /var/logs)*

### Using HTTP basic authentication for reset.php

1. Create a `.htaccess` file in the root directory of your website, and add the following lines:

        <FilesMatch "reset\.php">
            AuthType Basic
            AuthName "Restricted Access"
            AuthUserFile /path/to/.htpasswd
            Require valid-user
        </FilesMatch>

2. Create a `.htpasswd` file in a secure location on your server (not within the web root directory).

    > I will personally put it in the folder `/etc/httpd/` and edit the ownership to **root** and the group **www-data**. And grant r/w permissions to the user and only read ones to the group (`640`)
   
   This file will store the username and encrypted password for each user who should be allowed to access the reset.php file. You can create a new user by running the following command:

    `htpasswd -c /path/to/.htpasswd username`

    You will be prompted to enter a password for the user. This password will be encrypted and stored in the .htpasswd file.
    
    To add additional users to the .htpasswd file, use the same command but omit the `-c` flag.

3. When someone tries to access `reset.php`, they will be prompted to enter a username and password. If the username and password they enter match a valid user in the `.htpasswd` file, they will be granted access to the `reset.php` file.
