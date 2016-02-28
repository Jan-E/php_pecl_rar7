--TEST--
RarEntry::getUnpackedSize() on platforms with 32-bit longs
--SKIPIF--
<?php
if(!extension_loaded("rar")) die("skip");
if (PHP_INT_SIZE != 4) die("skip this test is for 32bit platforms only");
--FILE--
<?php
$fn1 = dirname(__FILE__) . '/sparsefiles_rar.rar';
$fn2 = dirname(__FILE__) . '/sparsefiles.tmp.rar';
$rarF = RarArchive::open($fn1);
$t = $rarF->getEntries();
reset($t)->extract(false, $fn2);
$rarF2 = RarArchive::open($fn2);
$t = $rarF2->getEntries();
var_dump($t[0]->getUnpackedSize());
var_dump($t[1]->getUnpackedSize());
echo "Done.\n";
--CLEAN--
<?php
$fn2 = dirname(__FILE__) . '/sparsefiles.tmp.rar';
@unlink($fn2);
--EXPECTF--
int(2147483647)
int(2147483647)
Done.
