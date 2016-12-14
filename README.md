# popori

# lazyblob
lazyblob is a very simple code which aims make you lazy for azure blob storage. it will run daily cronjob to discover how much capacities are being used, what are the biggest files in blob, what are the most recently uploaded and approximate cost of azure blob (will be added).

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

### replace absolute path to where you have installed application in lib/common.html and cron/blob.html if needed
```
    define("BHOM", "/var/www/html/lazyblob");
```

### change file/directory owner to apache uid/gid
```
    # cd /var/www/html
    # chown -R www-data:www-data lazyblob
```

### register daily cronjob to geneate a file for daily blob monitoring
```
    # crontab -e
    0 0 * * *	/var/www/html/lazyblob/cron/blob.html > /dev/null 2>&1
```

### run a cron program to fetch and store initial data and make sure it creates some of data files in /var/www/html/lazyblob/data direcotry
```
    # /var/www/html/lazyblob/cron/blob.html
```

And connect it! :+1:

![alt tag](https://github.com/jennylover/lazyblob/blob/master/capture/capture01.png?raw=true)

![alt tag](https://github.com/jennylover/lazyblob/blob/master/capture/capture02.png?raw=true)

![alt tag](https://github.com/jennylover/lazyblob/blob/master/capture/capture03.png?raw=true)
