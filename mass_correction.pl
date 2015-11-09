#!/usr/bin/perl -w

use warnings;
use strict;


my $infile = $ARGV[0];
my $outfile = $ARGV[1];

my ($msms_line, $i, $entry, $diff);

my (@entry_parts, @masses, @starts, @ends);

open INFILE, "< $infile" or die "Can't open $infile : $!";

open OUTFILE, "> $outfile" or die "Can't open $outfile : $!";

my @all_entries = <INFILE>;

my $num_entries = $#all_entries;


#print "Number of entries: $num_entries\n";

my $dupcount = 0;

for ( $i=0; $i<=$num_entries; $i++ ) {

    $entry = $all_entries[$i];
    
    chomp $entry;
    
    @entry_parts = split(/\t/, $entry);
    $masses[$i] = $entry_parts[0];
    $starts[$i] = $entry_parts[1];
    $ends[$i] = $entry_parts[2];

    if ($i > 0) {
	$diff = $masses[$i] - $masses[$i - 1];
	if ($diff <= 0.00001 && ( ( $starts[$i] >= $starts[$i - 1] && $starts[$i] <= $ends[$i - 1] ) || ( $starts[$i - 1] >= $starts[$i] && $starts[$i - 1] <= $ends[$i] ) ) ) {
	  $dupcount++;
  	  $masses[$i] = $masses[$i] - $diff + 0.00002;
	}
    }
    #print OUTFILE "$entry\n";
    print OUTFILE "$masses[$i]\t$starts[$i]\t$ends[$i]\n";

} # end for loop


#print "\n\n******** num_entries : $i   dups = $dupcount\n";

## Close input and output file handles

close INFILE;

close OUTFILE;

