<!--#set var="TITLE" value="Shootout Editorial" -->
<!--#set var="KEYWORDS" value="performance, benchmark, computer,
algorithms, languages, compare, cpu, memory" --> 
<?php require("html/header.php");
      require("nav.html");
      require("html/toptabs.php");
      require("html/testnav.php");
     
      $current = "index.php";
      toptabs($current); ?>

<table border="0" cellspacing="0" cellpadding="4" id="main" width="100%">
  <tr valign="top">
<?php benchlist(".");
      nav_list_end(); ?>
  <td>
    <div id="bodycol">
      <div id="apphead"><h2>Best of Show (My favorites)</h2></div>
      <div class="app">
<p>
  I've been almost exclusively a <a href="lang/perl/">Perl</a>
  programmer for a long time now, and I found my skills in other
  languages seemed to be atrophying.  One of the motivations for
  the shootout was to shake off some rust and learn (or re-learn)
  some new languages.  I still think Perl is a fine language, but
  now I've come to appreciate some of the alternatives out there,
  and I thought I'd share some of my perceptions.

<ul>
<li>
  Of all the languages I've been exposed to in this shootout, I've
  been most impressed with <a href="lang/ocaml/">Ocaml</a>, for a
  number of reasons.  It wasn't the easiest for me to pick up the
  basics, but it was far from the hardest.  I think that Ocaml's
  multi-paradigm features (Functional, Imperative and OO) make it a
  very practical and general purpose language.  I'm generally
  impressed with its ease of use, speed, and the error detection of
  the compiler (due to its nice typing system).  I also think it is
  great that Ocaml offers both a <a href="lang/ocamlb/">bytecode
  compiler</a> and a <a href="lang/ocaml/">native code compiler</a>
  (for some platforms).  Ocaml's support for Unix, objects and threads
  are all a big plus for me.  Ocaml's compilers are also regarded as
  being very, very fast, which is nice for a programmer, as it reduces
  the edit/compile/debug cycle.  The fact that it does garbage
  collection, and (in my tests) it produces code comparable in speed
  to C/C++ makes it very valuable to me as a programmer.  Speed,
  elegance and programming safety.  What more could a programmer ask
  for?  Out of all the languages in the shootout, I can see Ocaml
  becoming my main development <a href="/~doug/ocaml/">language of
  choice</a>.</li>

<li>
  The one language I was completely new to, that was the easiest for me
  to learn is <a href="lang/ruby/">Ruby</a>, which I would recommend to
  anyone who already knows Perl or Python, but perhaps isn't quite
  satisfied.  Even though Ruby may not currently be as fast as Perl in
  some areas, it does have many of Perl's features, plus a superior
  (IMHO) object model, and other very cool features like iterators.
  One of the things I like the most about Ruby is that you can write
  very terse programs (the less code you have to write, the better),
  yet these programs are still very clear and readable.</li>

<li>
  If you are looking for a fast interpreted language, I would also
  recommend <a href="lang/pike/">Pike</a>.  It is also somewhat C-like
  in syntax, so I think most people would be able to pick it up pretty
  easily.  Pike doesn't seem to be very well known, but it should be.
</li>
<li>
  <a href="lang/lua/">Lua</a> is a wonderful little language.  Its
  standard distribution is the smallest of all the languages I've
  surveyed, and if you are looking for something small and powerful
  (and quite fast) this language may be for you.  I have read on the
  Net that a few game companies have used embedded Lua as their
  scripting language.
</li>
<li>
  I've dabbled with Lisp (e.g. <a href="lang/cmucl/">CMUCL</a>) on and
  off for many years, but the shootout gave me an opportunity to look
  more at Common Lisp and at Scheme (<a href="lang/bigloo/">Bigloo</a>)
  too, which I hadn't done before.  This family of languages has so
  much to offer, it's a shame that they are not more popular.</li>
</ul>
    </div></div>
    </td>
  </tr>
</table>
<?php require("html/footer.php"); ?>
