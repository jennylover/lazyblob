# lazyblob
blah blah

## installation
### prepare a linux box which installed apache with php

### change php configuration file to support .html extension
```
    <FilesMatch ".+\.ph(p[345]?|t|tml)|.html$">
        SetHandler application/x-httpd-php
    </FilesMatch>
```

### clone application from github
```
    cd /var/www/html
    git clone https://github.com/jennylover/lazyblob.git
```

### replace azure blob name/key in lib/blob.json
```
{
    "<place your storage name>": {
        "keys":"<place your storage key>"
    }
}
```

### replace absolute path where you installed application in lib/common.html and cron/blob.html
```
    define("BHOM", "/var/www/html/lazyblob");
```

### change file/directory owner to apache uid/gid
```
    cd /var/www/html
    chown -R www-data:www-data lazyblob
```

### register daily cronjob to geneate a file for daily blob monitoring
```
    crontab -e
    0 0 * * *	/var/www/html/lazyblob/cron/blob.html > /dev/null 2>&1
```

### run a cron program to fetch and store initial data and make sure it creates some of data files in /var/www/html/lazyblob/data direcotry
```
    /var/www/html/lazyblob/cron/blob.html
```

And connect it! :+1:
