#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"sakshi.xml") or die "can't open sakshi.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth11=$dbh->prepare("CREATE TABLE author(authid int(6) auto_increment, address varchar(50), authorname varchar(1000), primary key(authid))auto_increment=10001 ENGINE=MyISAM;");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<author address="(.*?)">(.*?)<\/author>/)
	{
		$address = $1;
		$authorname = $2;
		insert_authors($address,$authorname);
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_authors()
{
	my($authorname,$address,) = @_;

	$address =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select authid from author where authorname='$authorname'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into author values('$address','$authorname',null)");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();	
}
