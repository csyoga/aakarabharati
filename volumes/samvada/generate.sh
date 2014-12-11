#!/bin/sh

host="localhost"
db="samvada"
usr="root"
pwd="mysql"

echo "drop database if exists samvada; create database samvada  DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql

perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
#~ perl ocr.pl $host $db $usr $pwd
#~ perl searchtable.pl $host $db $usr $pwd
#~ echo "create fulltext index text_index_records on searchtable (text);" | /usr/bin/mysql -uroot -pmysql vk
