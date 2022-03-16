# System Anomaly (SA) Mail Alias Generator

The SA Mail Alias Generator was written to easily manage mysql-based mail aliases for use with postfix. It is able to handle multiple domains and is mobile friendly.

No warranty, use as is, I suggest hiding this in a password-protected directory. It's not well written, but gets the job done. Improvements will be sparse.

# System Requirements

- httpd service (tested Apache 2.4.52)
- php 5.4+ (tested 7.4.25)
- mysql 15.1+ or equivalent (tested MariaDB 10.5.12)
- postfix (tested 3.5.6)
- postifx-mysql (tested 3.5.6)

# Installation

## SA Mail Alias Generator

Simply git-clone this project into a working directory, move config.php.pub to config.php and modify configuration options. Use included tables.sql to create the associated mySQL table.

## Postfix

`main.cf`

```
alias_maps = mysql:/etc/postfix/mysql-aliases.cf
alias_database = mysql:/etc/postfix/mysql-aliases.cf
virtual_alias_maps = mysql:/etc/postfix/mysql-aliases.cf
```

`mysql-aliases.cf`

```
user     = postfix
password = mysqlpass
hosts    = 127.0.0.1
dbname   = database
query    = SELECT destination FROM virtual_aliases WHERE source='%s' AND valid=1
```

Restart postifx.

# Latest Changes

## 0-β1

- First official release. Mostly feature complete.
