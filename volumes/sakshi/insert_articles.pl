#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"sakshi.xml") or die "can't open sakshi.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth11r=$dbh->prepare("CREATE TABLE article(title varchar(500), 
authid varchar(20),
authorname varchar(1000),
featid varchar(5),
rutu varchar(10),
page varchar(5),
volume varchar(5),
titleid int(10) auto_increment, primary key(titleid)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
$sth11r->execute();
$sth11r->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$volume = $1;
		print $volume . "\n";
	}	
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<rutu>(.*)<\/rutu>/)
	{
		$rutu = $1;
	}
	elsif($line =~ /<feature>(.*)<\/feature>/)
	{
		$feature = $1;
		$featid = get_featid($feature);
	}	
	elsif($line =~ /<page>(.*)<\/page>/)
	{
		$page = $1;
		#~ ($page, $page_end) = split(/-/, $pages);
		#~ if($pages eq $prev_pages)
		#~ {
			#~ $count++;
			#~ $id = "sakshi_" . $volume . "_" . $part . "_" . $page . "_" . $page_end . "_" . $count; 
		#~ }
		#~ else
		#~ {
			#~ $id = "sakshi_" . $volume . "_" . $part . "_" . $page . "_" . $page_end . "_0";
			#~ $count = 0;		
		#~ }
		#~ $prev_pages = $pages;
		#~ if ($page_end)
		 #~ {
	   #~ } 
		#~ else {
			#~ $page_end = $page;
		#~ }
	}	
	elsif($line =~ /<author address="(.*)">(.*)<\/author>/)
	{
		$authorname = $1;
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
		insert_article($title,$authids,$author_name,$featid,$page,$volume,$rutu);
		$authids = "";
		$featid = "";
		$author_name = "";
		$id = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($title,$authids,$author_name,$featid,$page,$volume,$rutu) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	$sth1=$dbh->prepare("insert into article values('$title','$authids','$author_name','$featid','$rutu','$page','$volume','')");
	
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
	
	$sth=$dbh->prepare("select featid from feature where feat_name='$feature'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$featid = $ref->{'featid'};
	$sth->finish();
	return($featid);
}
