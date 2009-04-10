<?
/* 
   The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   contributed by Damien Bonvillain
*/

$sequence = read_sequence('THREE');

fclose(STDIN);

$jobs = array(
   array('write_freq', 1),
   array('write_freq', 2),
   array('write_count', 'GGT'),
   array('write_count', 'GGTA'),
   array('write_count', 'GGTATT'),
   array('write_count', 'GGTATTTTAATT'),
   array('write_count', 'GGTATTTTAATTTATAGT'),
);

$tok = ftok(__FILE__, chr(time() & 255));
$queue = msg_get_queue($tok);

$parent = TRUE;
$count = count($jobs);
for ($i = 1; $i < $count; ++$i) {
   $pid = pcntl_fork();
   if ($pid === -1) {
      die('could not fork');
   } else if ($pid) {
      continue;
   }
   $parent = FALSE;
   break;
}
if ($parent) {
   $i = 0;
}

$func = $jobs[$i][0];
$arg =  $jobs[$i][1];

ob_start();

$func($sequence, $arg);

$result = array($i, ob_get_clean());

if (!msg_send($queue, 2, $result, TRUE, FALSE, $errno)) {
   var_dump("$errno");
   var_dump(msg_stat_queue($queue));
}

if (!$parent) {
   exit(0);
}

$results = array();
foreach($jobs as $job) {
    msg_receive($queue, 2, $msgtype, 4096, $result, TRUE);
   $results[$result[0]] = $result[1];
   pcntl_wait($s);
}

ksort($results);
foreach ($results as $result) {
   echo $result;
}

msg_remove_queue($queue);


/* functions definitions follow */

function read_sequence($id) {
   $id = '>' . $id;
   $ln_id = strlen($id);
   $fd = STDIN;
   // reach sequence three
   $line = '';
   while($line !== '' || !feof($fd)) {
      $line = stream_get_line($fd, 100, "\n");
      if($line[0] == '>' && strncmp($line, $id, $ln_id) === 0) {
         break;
      }
   }
   if(feof($fd)) {
      echo "sequence not found\n";
      exit(-1);
   }
   // next, read the content of the sequence
   $sequence = '';
   while($line !== '' || !feof($fd)) {
      $line = stream_get_line($fd, 100, "\n");
      if (!isset($line[0])) continue;
      $c = $line[0];
      if ($c === ';') continue;
      if ($c === '>') break;
      // append the uppercase sequence fragment,
      // must get rid of the CR/LF or whatever if present
      $sequence .= $line;
   }
   return strtoupper(&$sequence);
}

function write_freq(&$sequence, $key_length) {
   $map = generate_frequencies($sequence, $key_length);
   sort_by_freq_and_name($map);
   foreach($map as $key => $val) {
      printf ("%s %.3f\n", $key, $val);
   }
   echo "\n";
}

function write_count(&$sequence, $key) {
   $map = generate_frequencies($sequence, strlen($key), false);
   if (isset($map[$key])) $value = $map[$key];
   else $value = 0;
   printf ("%d\t%s\n", $value, $key);
}

/**
 * Returns a map (key, count or freq(default))
 */
function generate_frequencies(&$sequence, $key_length, $compute_freq = true) {
   $result = array();
   $total = strlen(&$sequence) - $key_length;
   $i = $total;
   if ($key_length === 1) { 
      do {
         $key = $sequence[$i--];
         if (isset($result[$key])) ++$result[$key];
         else $result[$key] = 1;
      } while ($i);
   } else {
      do {
         $key = substr(&$sequence, $i--, $key_length);
         if(isset($result[$key])) ++$result[$key];
         else $result[$key] = 1;
      } while ($i);
   }
   if($compute_freq) {
      foreach($result as &$v) {
         $v = $v * 100 / $total;
      }
   }
   return $result;
}

function compute_freq(&$count_freq, $key, $total) {
   $count_freq = ($count_freq* 100) / $total;
}

function sort_by_freq_and_name(&$map) {
   // since PHP 4.1.0, sorting is not stable => dirty kludge
   array_walk($map, 'append_key');
   uasort($map, 'freq_name_comparator');
   array_walk($map, 'remove_key');
}

function append_key(&$val, $key) {
   $val = array($val, $key);
}

function freq_name_comparator($val1, $val2) {
   $delta = $val2[0] - $val1[0];
   // the comparator must return something close to an int
   $result = ($delta == 0)?strcmp($val1[1],$val2[1]):
      ($delta < 0)?-1:1;
   return $result;
}

function remove_key(&$val, $key) {
   $val = $val[0];
}
