#!/usr/bin/perl
$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$type = "102";
use DBI();

open(IN,"pgh.xml") or die "can't open pgh.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');


$sth1=$dbh->prepare("CREATE TABLE akbi_pgh(book_id varchar(4), 
level int(2),
book_title varchar(1000),
title varchar(1000),
page varchar(10),
type varchar(4),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM");
$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

while($line)
{
	chop($line);
	
	if($line =~ /<book code="(.*)" btitle="(.*?)" editor="(.*?)">/)
	{
		$book_id = $1;
		$book_title = $2;
	}
	elsif($line =~ /<s([0-9]+) page="(.*)" title="(.*)" author="(.*?)">/)
	{
		$level = $1;
		$page = $2;
		$title = $3;
		insert_to_db($book_id,$book_title,$level,$title,$page,$type);
		$scount++;
	}
	elsif($line =~ /<s([0-9]+) page="(.*)" title="(.*) author="(.*?)"><\/s([0-9]+)>/)
	{
		$level = $1;
		$page = $2;
		$title = $3;
		insert_to_db($book_id,$book_title,$level,$title,$page,$type);
		$scount++;
	}
	elsif($line =~ /<\/s([0-9]+)>/)
	{
	}
	else
	{
		#~ print $line . "\n";
	}
$line = <IN>;	
}

close(IN);

#~ print "Total S count:" . $scount . "\n";

sub insert_to_db()
{
	my($book_id,$book_title,$level,$title,$page) = @_;
	my($sth2);

	$title =~ s/'/\\'/g;
	$title =~ s/<i>/!!/g;
	$title =~ s/<\/i>/!!/g;

	$sth2=$dbh->prepare("insert into akbi_pgh values('$book_id','$book_title','$level','$title','$page','$type','')");
	$sth2->execute();
	$sth2->finish();
}
