#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"pp.xml") or die "can't open pp.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');
$sth11=$dbh->prepare("CREATE TABLE feature_pp(feat_name varchar(100), featid int(6) auto_increment, primary key(featid))auto_increment=10001 ENGINE=MyISAM;");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<feature>(.*)<\/feature>/)
	{
		$feat_name = $1;
		insert_feature($feat_name);		
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_feature()
{
	my($feat_name) = @_;

	$feat_name =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select featid from feature_pp where feat_name='$feat_name'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into feature_pp values('$feat_name',null)");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();	
}
