# lazyblob

# installation
1. prepare a linux box which installed apache with php

2. change php configuration file to support .html extension
"`
<FilesMatch ".+\.ph(p[345]?|t|tml)|.html$">
    SetHandler application/x-httpd-php
</FilesMatch>

