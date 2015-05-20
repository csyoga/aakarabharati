#!/bin/sh

host="localhost"
db="akbi"
usr="root"
pwd="mysql"

echo "drop database if exists akbi; create database akbi  DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql

perl author_sakshi.pl $host $db $usr $pwd
perl author_samvada.pl $host $db $usr $pwd
perl author_maatukate.pl $host $db $usr $pwd
perl author_pp.pl $host $db $usr $pwd
perl author_ab.pl $host $db $usr $pwd
perl author_rb.pl $host $db $usr $pwd
perl akbi_hm_author.pl $host $db $usr $pwd
perl akbi_mgp_k_author.pl $host $db $usr $pwd
perl akbi_pgh_author.pl $host $db $usr $pwd

perl feat_sakshi.pl $host $db $usr $pwd
perl feat_samvada.pl $host $db $usr $pwd
perl feat_maatukate.pl $host $db $usr $pwd
perl feat_pp.pl $host $db $usr $pwd
perl feat_ab.pl $host $db $usr $pwd
perl feat_rb.pl $host $db $usr $pwd

perl articles_sakshi.pl $host $db $usr $pwd
perl articles_samvada.pl $host $db $usr $pwd
perl articles_maatukate.pl $host $db $usr $pwd
perl articles_pp.pl $host $db $usr $pwd
perl articles_ab.pl $host $db $usr $pwd
perl articles_rb.pl $host $db $usr $pwd


perl akbi_hm.pl $host $db $usr $pwd
perl akbi_mgp_k.pl $host $db $usr $pwd
perl akbi_pgh.pl $host $db $usr $pwd

#~ perl ocr.pl $host $db $usr $pwd
#~ perl searchtable.pl $host $db $usr $pwd
#~ echo "create fulltext index text_index_records on searchtable (text);" | /usr/bin/mysql -uroot -pmysql vk
