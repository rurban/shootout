<table>
<tr><td><h3 class="rev">&nbsp;Committer&nbsp;FAQ</h3></td></tr>

<tr class="b"><td>Basic Workflow</td></tr>
<tr><td><p>
<ol>
<li><strong>Move <em>Open item</em> source-code into CVS</strong></li>
<li>Generate HTML from new CVS source-code</li>
<li>Move HTML to website</li>
<li>Build & Measure new CVS source-code</li>
<li>Move Build & Benchmark results to website</li>
</ol>
<p>We're mainly concerned with timely CVS check-in, providing feedback, and deciding which programs should be shown on the website.</p>
</td></tr>


<tr><td><h3 class="rev">&nbsp;Move&nbsp;<em>Open&nbsp;item</em>&nbsp;source-code&nbsp;into&nbsp;CVS</h3></td></tr>

<tr class="b"><td>Browse Contribute Programs for <em>Open items</em></td></tr>
<tr><td>
<p>On the <a href="https://alioth.debian.org/tracker/?func=browse&group_id=30402&atid=411646" title="Browse Contribute Programs"><strong>Browse Contribute Programs</strong></a> form, select <em>Open</em> state and maybe a particular language, and browse for new items.</p>
</td></tr>



<tr class="b"><td>Where is that benchmark in CVS?</td></tr>
<tr><td>
<p>Some of the names we use for benchmarks and programs in CVS are different from the names shown on the website!</p>
<p>Program contributors are likely to use the names shown on the website. Change the file-name to the name used in CVS.</p>
<table>
<tr><th>&nbsp;website&nbsp;</th><th>&nbsp;CVS&nbsp;</th></tr>
<tr><td>count-words</td><td>wc</td></tr>
<tr><td>fibonacci</td><td>fibo</td></tr>
<tr><td>k-nucleotide</td><td>knucleotide</td></tr>
<tr><td>n-body</td><td>nbody</td></tr>
<tr><td>nsieve-bits</td><td>nsievebits</td></tr>
<tr><td>object</td><td>objinst</td></tr>
<tr><td>object-methods</td><td>methcall</td></tr>
<tr><td>regex</td><td>regexmatch</td></tr>
<tr><td>reverse-complement</td><td>revcomp</td></tr>
<tr><td>startup</td><td>hello</td></tr>
<tr><td>statistics</td><td>moments</td></tr>
<tr><td>sum-file</td><td>sumcol</td></tr>
<tr><td>tcp-echo</td><td>tcpecho</td></tr>
<tr><td>tcp-request-reply</td><td>tcprequest</td></tr>
<tr><td>tcp-stream</td><td>tcpstream</td></tr>
<tr><td>threads</td><td>process</td></tr>
<tr><td>threads-flow</td><td>message</td></tr>
<tr><td>word-frequency</td><td>wordfreq</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
</td></tr>


<tr class="b"><td>How do I know the program does what's required?</td></tr>
<tr><td>
<p>Download the source-code attachment and review the code. Use your <strong>judgement</strong>.</p>
</td></tr>

<tr class="b"><td>The program is fine - what next?</td></tr>
<tr><td>
<p>Make sure the source-code file uses <strong>Unix LF</strong> line-endings.</p>
<p>Make sure the source-code file has the <strong>standard header</strong> comment.</p>
<p>Make sure the there are no promos or adverts in the comment text.</p>
<p>If you changed the source-code file name then maybe you need to <strong>change class names or module names</strong> in the source-code to match the new file name.</p>

<p>The build-scripts expect the <strong>file-extension</strong> to indicate the programming language. Mostly the file-extensions are just be the programming language or implementation name - look at the file-extensions used for the fibonacci programs. However there are some exceptions:
<table>
<tr><th>&nbsp;language&nbsp;</th><th>&nbsp;file&nbsp;extension&nbsp;</th></tr>
<tr><td>C#</td><td>csharp</td></tr>
<tr><td>D</td><td>dlang</td></tr>
<tr><td>GNU C++</td><td>gpp</td></tr>
<tr><td>Intel Fortran</td><td>ifc</td></tr>
<tr><td>OO2C Oberon</td><td>oberon2</td></tr>
<tr><td>GNU Objective-C</td><td>objc</td></tr>
<tr><td>Mozart/Oz</td><td>oz</td></tr>
</table>
</p>
<p>Change the source-code file-extension to the extension used in CVS.</p>
</td></tr>

<tr class="b"><td>Is there already a program for that benchmark in CVS?</td></tr>
<tr><td>
<p>There's a directory for each benchmark, in the /shootout/bench/ directory in CVS.</p>
<ul>
<li>If there's <strong>no file</strong>, for example no <em>nsieve.ruby</em> in the /shootout/bench/nsieve/ directory, then just Add the source-code file to the appropriate directory.</li>
<li>If there <strong>already is a file</strong> then
<ul>
<li>If the existing program results in <strong>Timeout or Error</strong>, then just replace it with the new source-code file.</li>
<li><strong>Otherwise</strong>, if the existing program works fine, then add the new source-code file with a version number.<br/>
If there's already a <em>nsieve.ruby</em> then rename the new source-code file as <strong>nsieve.ruby-2.ruby</strong> and if that already exists add the file as <strong>nsieve.ruby-3.ruby</strong> <em>etc</em>
</li>
</ul>
</li>
</ul>
<p>After committing the source-files to CVS <strong>update the status</strong> of the corresponding Contribute Programs items from <em>Open</em> to <em>Pending</em>.</p>
</td></tr>


<tr><td><h3 class="rev">&nbsp;Remove slower programs</h3></td></tr>

<tr class="b"><td>How do I know when to remove programs?</td></tr>
<tr><td>
<p>Once we can see that there's a faster program, we normally <strong>remove the slower programs</strong> from CVS and then update the corresponding Contribute Programs items from <em>Closed</em> to <em>Deleted</em>.</p>
<p>If the slower program is particularly interesting or elegant, then maybe we'll keep showing it - <strong>use your judgement</strong>. When in doubt, remove the program.</p>
</td></tr>


<tr><td><h3 class="rev">&nbsp;Interesting Alternative Programs</h3></td></tr>

<tr class="b"><td>What is an Interesting Alternative Programs?</td></tr>
<tr><td>
<p>Obviously <em>interesting</em> is a personal judgement!</p>
<p>Having 2 or 3 or 4 or more programs that implement the same <em>interesting</em> algorithm isn't interesting! One example is enough.</p>
<p><em>Interesting Alternative Programs</em> should be the exception not the rule.</p>
</td></tr>

<tr class="b"><td>How do I show an Interesting Alternative Programs?</td></tr>
<tr><td>
<p>Add a row to the spreadsheet csv file <em>/shootout/website/desc/exclude.csv</em></p>
<p>To show nsieve.ruby-2.ruby as an <em>Interesting Alternative Program</em> add a row <strong>,nsieve,ruby,2</strong> to <em>/shootout/website/desc/exclude.csv</em></p>
</td></tr>

</table>