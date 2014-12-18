#!/bin/sh

host="localhost"
db="akbi"
usr="root"
pwd="mysql"

echo "drop database if exists akbi; create database akbi  DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql

perl insert_author_sakshi.pl $host $db $usr $pwd
perl insert_author_samvada.pl $host $db $usr $pwd

perl insert_feat_sakshi.pl $host $db $usr $pwd
perl insert_feat_samvada.pl $host $db $usr $pwd

perl insert_articles_sakshi.pl $host $db $usr $pwd
perl insert_articles_samvada.pl $host $db $usr $pwd
#~ perl ocr.pl $host $db $usr $pwd
#~ perl searchtable.pl $host $db $usr $pwd
#~ echo "create fulltext index text_index_records on searchtable (text);" | /usr/bin/mysql -uroot -pmysql vk
