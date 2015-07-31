#!/usr/bin/perl
$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"mgp_k.xml") or die "can't open mgp_k.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth1=$dbh->prepare("CREATE TABLE akbi_mgp_k(
book_id varchar(4), 
level int(2),
title varchar(1000),
authid varchar(200),
authorname varchar(1000),
page varchar(10),
page_end varchar(10),
type varchar(4),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM");

$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

$authid = '';
$authors = '';
while($line)
{
	chop($line);
	if($line =~ /<s([0-9]+) page="(.*?)" title="(.*?)" year="(.*?)" author="(.*?)">/)
	{
		$level = $1;
		$pages = $2;
		$title = $3;
		$authors = $5;
		if($authors ne "")
		{
			@list = split(/;/,$authors);
			for($i=0;$i<@list;$i++)
			{
				$authid = $authid . ";" . get_authid($list[$i]);
			}
			$authid =~ s/^;//;
		}
		else
		{
			$authid = "";
		}
		if($pages ne "")
		{
			($page,$page_end) = split(/-/,$2);
		}
		else
		{
			$page_start = "";
			$page_end = "";
		}
		
		$type = 101;
		
		insert_to_db($book_id,$level,$title,$authid,$authors,$page,$page_end,$type);
		$title =  "";
		$level = "";
		$authid = "";
		$authors = "";
		$page = "";
		$page_end = "";
		$book_id = "";		
		$type = "";
		$scount++;
	}
	elsif($line =~ /<\/s([0-9]+)>/)
	{
	}
	else
	{
		print $line . "\n";
	}
$line = <IN>;	
}

close(IN);

print "Total S count:" . $scount . "\n";

sub insert_to_db()
{
	my($book_id,$level,$title,$authid,$authors,$page,$page_end,$type) = @_;
	my($sth2);

	$title =~ s/'/\\'/g;

	$sth2=$dbh->prepare("insert into akbi_mgp_k values('$book_id','$level','$title','$authid','$authors','$page','$page_end','$type','')");
	$sth2->execute();
	$sth2->finish();
}


sub get_authid()
{
	my($authorname) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author where authorname='$authorname'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}

