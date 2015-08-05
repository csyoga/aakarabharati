#!/bin/sh

host="localhost"
db="akbi"
usr="root"
pwd='mysql'

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd
echo "DROP TABLE IF EXISTS article; CREATE TABLE article(journalid varchar(5), volume varchar(3), part varchar(10), year varchar(10),  month varchar(6), title varchar(500), feature varchar(100), page varchar(40), authorname varchar(1000), info varchar(300), titleid varchar(50), primary key(titleid)) ENGINE=MyISAM character set utf8 collate utf8_general_ci" | /usr/bin/mysql -u$usr -p$pwd $db

echo "Journal Details Insertion.......";
php insertJournalDetails.php $host $db $usr $pwd
echo "Journals Article Insertion.......";
php insertJournalArticle.php $host $db $usr $pwd
