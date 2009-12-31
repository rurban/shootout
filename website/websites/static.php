<?php
header("Pragma: public");
header("Cache-Control: public");
header('Expires: Mon, 26 Jun 2010 14:00:00 GMT');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
 
<meta name="robots" content="all" />
 
<meta name="description" content="Compare the performance of ~30 programming languages using ~12 flawed benchmarks and ~1100 programs. Contribute faster more elegant programs." />
 
<title>Computer Language Benchmarks Game</title>
<link rel="stylesheet" type="text/css" href="./benchmark_css_22dec2009.php" />
<link rel="shortcut icon" href="./favicon_ico_11dec2009.php" />
</head>
 
<body id="core">

<table class="banner"><tr>
<td><h1><a>The&nbsp;Computer&nbsp;<strong>Language</strong>&nbsp; <br/><strong>Benchmarks</strong>&nbsp;Game</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./help.php" title="How to compare these programming language measurements. How programs were measured. How to contribute programs. FAQs">Help</a></h1></td>
</tr></table>
 
<div id="home">
<h5><strong>Compare the performance of ~30 programming languages</strong> <br/>using ~12 <strong>flawed benchmarks</strong> and ~1100 programs</h5>
<p><br/>Read the source code. Contribute faster more elegant programs.</p>
<p>Compare performance on both 32 bit and 64 bit Ubuntu&#8482;.</p>
<p>Compare performance both when programs are allowed to use <br/>quad-core and when programs are forced to use one core.</p>
 
 
 
<h5><br/><strong>Programming language performance comparisons</strong> Z to A</h5><br/>
 
<p><a href="./u32/smalltalk.php" title="Compare Smalltalk VisualWorks performance against one other programming language">Smalltalk&nbsp;<b>VisualWorks</b></a> <span class="smaller">uniform reflective environment - real live objects </span></p>
<p><a href="./u64/scheme.php" title="Compare Scheme PLT performance against one other programming language">Scheme&nbsp;<b>PLT</b></a> <span class="smaller">statically-scoped properly tail-recursive dialect of lisp </span></p>
<p><a href="./u32q/scala.php" title="Compare Scala performance against one other programming language"><b>Scala</b></a> <span class="smaller">higher-order type-safe programming for jvm </span></p>
<p><a href="./u32/ruby.php" title="Compare Ruby MRI performance against one other programming language">Ruby&nbsp;<b>MRI</b></a> <span class="smaller">programmer fun - everything is an object scripting </span></p>
<p><a href="./u64q/jruby.php" title="Compare Ruby JRuby performance against one other programming language">Ruby&nbsp;<b>JRuby</b></a> <span class="smaller">everything is an object scripting for jvm </span></p>
<p><a href="./u64/benchmark.php?test=all&amp;lang=yarv" title="Compare Ruby 1.9 performance against one other programming language">Ruby&nbsp;<b>1.9</b></a> <span class="smaller">the new Ruby </span></p>
<p><a href="./u32/python.php" title="Compare Python CPython performance against one other programming language">Python&nbsp;<b>CPython</b></a> <span class="smaller">uncluttered imperative programming plus objects </span></p>
<p><a href="./u32q/python3.php" title="Compare Python 3 performance against one other programming language"><b>Python&nbsp;3</b></a> <span class="smaller">the new Python </span></p>
<p><a href="./u32/php.php" title="Compare PHP performance against one other programming language"><b>PHP</b></a> <span class="smaller">scripts embedded in html, and much more </span></p>
<p><a href="./u64/perl.php" title="Compare Perl performance against one other programming language"><b>Perl</b></a> <span class="smaller">server-side shell &amp; cgi scripts </span></p>
<p><a href="./u32/pascal.php" title="Compare Pascal Free Pascal performance against one other programming language">Pascal&nbsp;<b>Free&nbsp;Pascal</b></a> <span class="smaller">imperative programming plus objects </span></p>
<p><a href="./u32q/ocaml.php" title="Compare OCaml performance against one other programming language"><b>OCaml</b></a> <span class="smaller">modular type-safe strict functional programming plus objects </span></p>
<p><a href="./u32/oz.php" title="Compare Mozart/Oz performance against one other programming language"><b>Mozart/Oz</b></a> <span class="smaller">multi-multi-multi-paradigm distributed programming </span></p>
<p><a href="./u32/luajit.php" title="Compare Lua LuaJIT performance against one other programming language">Lua&nbsp;<b>LuaJIT</b></a> <span class="smaller">jit compiler fully compatible with lua 5.1 </span></p>
<p><a href="./u64/lua.php" title="Compare Lua performance against one other programming language"><b>Lua</b></a> <span class="smaller">associative arrays for extensible embedded scripting </span></p>
<p><a href="./u64q/lisp.php" title="Compare Lisp SBCL performance against one other programming language">Lisp&nbsp;<b>SBCL</b></a> <span class="smaller">pioneering s-expression oriented programming </span></p>
<p><a href="./u32/lisaac.php" title="Compare Lisaac performance against one other programming language"><b>Lisaac</b></a> <span class="smaller">everything is a prototype object plus design by contract </span></p>
<p><a href="./u32/javascript.php" title="Compare JavaScript V8 performance against one other programming language">JavaScript&nbsp;<b>V8</b></a> <span class="smaller">web-browser embedded scripting </span></p>
<p><a href="./u32/benchmark.php?test=all&amp;lang=tracemonkey" title="Compare JavaScript TraceMonkey performance against one other programming language">JavaScript&nbsp;<b>TraceMonkey</b></a> <span class="smaller">ubiquitous web-browser embedded scripting  </span></p>
<p><a href="./u64q/benchmark.php?test=all&amp;lang=javasteady" title="Compare Java 6 steady state performance against one other programming language">Java&nbsp;<b>6&nbsp;steady&nbsp;state</b></a> <span class="smaller">approximate jvm steady state </span></p>
<p><a href="./u64q/benchmark.php?test=all&amp;lang=javaxint" title="Compare Java 6 -Xint performance against one other programming language">Java&nbsp;<b>6 -Xint</b></a> <span class="smaller">ubiquitous bytecode interpreter virtual machine </span></p>
<p><a href="./u64q/java.php" title="Compare Java 6 -server performance against one other programming language">Java&nbsp;<b>6&nbsp;-server</b></a> <span class="smaller">ubiquitous jit server virtual machine </span></p>
<p><a href="./u64q/haskell.php" title="Compare Haskell GHC performance against one other programming language">Haskell&nbsp;<b>GHC</b></a> <span class="smaller">lazy pure functional programming </span></p>
<p><a href="./u64q/benchmark.php?test=all&amp;lang=go" title="Compare Go 6g 8g performance against one other programming language">Go&nbsp;<b>6g&nbsp;8g</b></a> <span class="smaller">types just are - Go is an experiment </span></p>
<p><a href="./u32q/fortran.php" title="Compare Fortran Intel performance against one other programming language">Fortran&nbsp;<b>Intel</b></a> <span class="smaller">pioneering numeric and scientific programming </span></p>
<p><a href="./u32q/fsharp.php" title="Compare F# Mono performance against one other programming language">F#&nbsp;<b>Mono</b></a> <span class="smaller">higher-order type-safe programming (mono is not ms .net) </span></p>
<p><a href="./u64q/erlang.php" title="Compare Erlang HiPE performance against one other programming language">Erlang&nbsp;<b>HiPE</b></a> <span class="smaller">concurrent real-time distributed fault-tolerant software </span></p>
<p><a href="./u64q/clean.php" title="Compare Clean performance against one other programming language"><b>Clean</b></a> <span class="smaller">lazy &amp; strict pure functional programming </span></p>
<p><a href="./u64q/cpp.php" title="Compare C++ GNU g++ performance against one other programming language">C++&nbsp;<b>GNU g++</b></a> <span class="smaller">c plus objects plus generics </span></p>
<p><a href="./u64q/csharp.php" title="Compare C# Mono performance against one other programming language">C#&nbsp;<b>Mono</b></a> <span class="smaller">oo plus functional style (mono is not ms .net) </span></p>
<p><a href="./u64/c.php" title="Compare C GNU gcc performance against one other programming language">C&nbsp;<b>GNU gcc</b></a> <span class="smaller">unchecked low-level programming </span></p>
<p><a href="./u64q/ats.php" title="Compare ATS performance against one other programming language"><b>ATS</b></a> <span class="smaller">dependent types &amp; linear types plus theorem proving </span></p>
<p><a href="./u64q/ada.php" title="Compare Ada 2005 GNAT performance against one other programming language">Ada&nbsp;2005&nbsp;<b>GNAT</b></a> <span class="smaller">large-scale safety-critical software </span></p>
 

 
<p class="imgfooter">
<a href="./license.php" title="The Computer Language Benchmarks Game is published under this revised BSD license" >
   <img src="./open_source_button_png_11dec2009.php" alt="Revised BSD license" height="31" width="88" />
</a>
</p>
 
</div>
 
<script src='http://shootout.alioth.debian.org/ja_js_12dec2009.php' type='text/javascript'></script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1050511-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
