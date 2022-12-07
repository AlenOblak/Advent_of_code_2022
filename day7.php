<?

$lines = file('day7_input.txt', FILE_IGNORE_NEW_LINES);

$dir = array();

// part 1
foreach($lines as $line) {
	if(substr($line, 0, 1) == '$') {
		if($line == "$ cd /") {
			$curent_dir = "/";
			$dir[$curent_dir] = 0;
		} elseif($line == "$ cd ..") {
			$curent_dir = substr($curent_dir, 0, strrpos($curent_dir, '-'));
		} elseif(substr($line, 0, 4) == "$ cd") {
			$curent_dir = $curent_dir.'-'.substr($line, 5);
		}
	} elseif(substr($line, 0, 3) == 'dir') {
		$dir[$curent_dir.'-'.substr($line, 4)] = 0;
	} else {
		list($s, $f) = sscanf($line, "%d %s");
		$dir[$curent_dir] += $s;
	}
}

$dir2 = array();
foreach($dir as $d1 => $s1) {
	$dir2[$d1] = 0;
	foreach($dir as $d2 => $s2)
		if($d1 == substr($d2, 0, strlen($d1)))
			$dir2[$d1] += $s2;
}

$sum = 0;
foreach($dir2 as $d)
	if($d <= 100000)
		$sum += $d;
echo $sum."\n";

// part 2
$total = 70000000;
$unused = 30000000;
$used = $dir2['/'];
$free = $unused - ($total - $used);

$min = PHP_INT_MAX;
foreach($dir2 as $d)
	if($d < $min && $d > $free)
		$min = $d;
echo $min."\n";

?>