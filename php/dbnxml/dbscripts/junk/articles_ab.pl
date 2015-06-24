#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$type_code = '05';
use DBI();
@ids=();

open(IN,"ab.xml") or die "can't open ab.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth11r=$dbh->prepare("CREATE TABLE article_ab(title varchar(1500), 
authid varchar(20),
authorname varchar(1000),
featid varchar(5),
year varchar(10),
month varchar(10),
play varchar(20),
type varchar(5),
page_start varchar(5),
page_end varchar(5),
volume varchar(10),
part varchar(10),
info varchar(100),
titleid int(10) auto_increment, primary key(titleid)) ENGINE=MyISAM");
$sth11r->execute();
$sth11r->finish();

$line = <IN>;
print "Arivu Baraha\n";
while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$volume = $1;
		print $volume . "\n";
	}	
	elsif($line =~ /<part pnum="(.*)" month="(.*)" year="(.*)">/)
	{
		$pnum = $1;
		$month= $2;
		$year = $3;
	}	
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<feature>(.*)<\/feature>/)
	{
		$feature = $1;
		$featid = get_featid($feature);
	}	
	elsif($line =~ /<play>(.*)<\/play>/)
	{
		$play = $1;
	}	
	elsif($line =~ /<page>(.*)-(.*)<\/page>/)
	{
		$page_start=$1;
		$page_end=$2;
	}	
	elsif($line =~ /<author type="(.*)">(.*)<\/author>/)
	{
		$author_type = $1;
		$authorname = $2;
		$authids = $authids . ";" . get_authid($authorname);
		$author_name = $author_name . ";" .$authorname;
	}
	elsif($line =~ /<allauthors\/>/)
	{
		$authids = "0";
		$author_name = "";
	}
	elsif($line =~ /<\/entry>/)
	{
		insert_article($title,$authids,$author_name,$featid,$year,$month,$play,$type_code,$page_start,$page_end,$volume,$pnum,$info);
		$authids = "";
		$featid = "";
		$author_name = "";
		$id = "";
		$page_start = "";
		$page_end = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($title,$authids,$author_name,$featid,$year,$month,$play,$type_code,$page_start,$page_end,$volume,$pnum,$info) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	$sth1=$dbh->prepare("insert into article_ab values('$title','$authids','$author_name','$featid','$year','$month','$play','$type_code','$page_start','$page_end','$volume','$pnum','$info','')");
	
	$sth1->execute();
	$sth1->finish();
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

sub get_featid()
{
	my($feature) = @_;
	my($sth,$ref,$featid);

	$feature =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select featid from feature_ab where feat_name='$feature'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$featid = $ref->{'featid'};
	$sth->finish();
	return($featid);
}
