<p>Each program should count the prime numbers from 2 to M, using the same na&#239ve Sieve of Eratosthenes algorithm:</p>
<ul>
  <li>create a sequence of M boolean flags</li>
  <li>for each index number
     <ul>
     <li>if the flag value at that index is true</li>
     <ul>
     <li>set all the flag values at multiples of that index false</li>
     <li>increment the count</li>
     </ul>
     </li>
     </ul>
   </li>
</ul>

<p>Calculate 3 prime counts, for M = 2<sup>N</sup> &#215; 10000, 2<sup>N-1</sup> &#215; 10000, and 2<sup>N-2</sup> &#215; 10000. Correct output N = 2 is:</p>
<pre>
Primes up to    40000    4203
Primes up to    20000    2262
Primes up to    10000    1229
</pre>
<br />

<p>The basic benchmark was described in "A High-Level Language Benchmark." BYTE, September 1981, p. 180, Jim Gilbreath.</p>
<p>For more information see Eric W. Weisstein, "Sieve of Eratosthenes." From <a href="http://mathworld.wolfram.com"><i>MathWorld</i></a>--A Wolfram Web Resource.<br/><a href="http://mathworld.wolfram.com/SieveofEratosthenes.html">http://mathworld.wolfram.com/SieveofEratosthenes.html</a> <a href="http://mathworld.wolfram.com/PrimeCountingFunction.html">http://mathworld.wolfram.com/PrimeCountingFunction.html</a></p>