#!/bin/bash

cat ~/wordpress/wp-config.php | grep DB_PASSWORD
mysql -u {{pac}}_{{user}} {{pac}}_{{user}} -p