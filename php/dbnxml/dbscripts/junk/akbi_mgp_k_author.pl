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

$line = <IN>;

while($line)
{
	if($line =~ /<s([0-9]+) page="(.*)" title="(.*)" author="(.*)">/)
	{
		$authors = $4;
		$type_code = '101';
		
		if($authors ne '')
		{
			insert_authors($authors, $type_code);
			$type_code = '';			
		}
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_authors()
{
	my($authors, $type_code) = @_;
	my(@list,$i,$authorname);
	my($sth,$ref,$sth1);
	
	@list = split(/;/,$authors);
	for($i=0;$i<@list;$i++)
	{

		$authorname = $list[$i];
		$authorname =~ s/'/\\'/g;

		$sth = $dbh->prepare("select * from author where authorname='$authorname'");
		$sth->execute();
		$ref=$sth->fetchrow_hashref();
		if($sth->rows()==0)
		{
			$sth1=$dbh->prepare("insert into author values(null,'$type_code','$authorname')");
			$sth1->execute();
			$sth1->finish();
		}
		else
		{
			$type = $ref->{'type'};
			$authid = $ref->{'authid'};
			
			if(!($type=~/$type_code/))
			{
				$type = $type . ";" . $type_code;
				$sth1=$dbh->prepare("update author set type='$type' where authid='$authid' and authorname='$authorname'");
				$sth1->execute();
				$sth1->finish();
			}
			
		}
		$sth->finish();	
	}
}
