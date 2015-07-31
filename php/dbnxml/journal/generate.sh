#!/bin/sh

host="localhost"
db="akbi"
usr="root"
pwd='mysql'

echo "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd
echo "DROP TABLE IF EXISTS article; CREATE TABLE article(journalid varchar(5), volume varchar(3), part varchar(10), year varchar(10),  month varchar(6), title varchar(500), feature varchar(100), pagerange varchar(40), authorname varchar(1000), titleid varchar(50), primary key(titleid)) ENGINE=MyISAM character set utf8 collate utf8_general_ci" | /usr/bin/mysql -u$usr -p$pwd $db

php insertJournalDetails.php $host $db $usr $pwd

php insertJournalArticle.php $host $db $usr $pwd '001'
php insertJournalArticle.php $host $db $usr $pwd '002'
php insertJournalArticle.php $host $db $usr $pwd '003'
php insertJournalArticle.php $host $db $usr $pwd '004'
php insertJournalArticle.php $host $db $usr $pwd '005'
php insertJournalArticle.php $host $db $usr $pwd '006'
php insertJournalArticle.php $host $db $usr $pwd '007'
php insertJournalArticle.php $host $db $usr $pwd '008'
php insertJournalArticle.php $host $db $usr $pwd '010'
php insertJournalArticle.php $host $db $usr $pwd '011'
