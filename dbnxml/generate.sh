#!/bin/sh

host="localhost"
db="akbi"
usr="root"
pwd='mysql'

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd
echo "DROP TABLE IF EXISTS journals; CREATE TABLE journals(journalid varchar(5), volume varchar(3), part varchar(10), year varchar(10),  month varchar(6), title varchar(500), feature varchar(100), page varchar(40), authorname varchar(1000), info varchar(300), titleid varchar(50), primary key(titleid)) ENGINE=MyISAM character set utf8 collate utf8_general_ci" | /usr/bin/mysql -u$usr -p$pwd $db
echo "DROP TABLE IF EXISTS books; CREATE TABLE books(bookid varchar(5), level varchar(10), page varchar(30), title varchar(1000),  authorname varchar(1000)) ENGINE=MyISAM character set utf8 collate utf8_general_ci" | /usr/bin/mysql -u$usr -p$pwd $db

php insertJournalDetails.php $host $db $usr $pwd
php insertJournalArticle.php $host $db $usr $pwd
php insertBooksDetail.php $host $db $usr $pwd
php insertBookArticle.php $host $db $usr $pwd



#~ Removing Journal entries having id's 006 - 009 and 011 
echo "DELETE FROM journals WHERE journalid REGEXP '00[7-9]' OR journalid = '011'" | /usr/bin/mysql -u$usr -p$pwd $db

#~ sudo chown -R www-data:www-data Volumes
#~ sudo chmod 777 php/bookreader/temples/apache.manifest
#~ sudo chown -R www-data:www-data Volumes
