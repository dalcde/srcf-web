<?php
$title = "My Notes";
include "header.php"?>

<p>Below are the notes I took during lectures in Cambridge. None of this is official (unless otherwise specified). The source code of my notes is also available, which has to be compiled with <a href="notes/header.tex"><code>header.tex</code></a>. It is also available on <a href="http://github.com/dalcde/cam-notes">GitHub</a>.</p>

<p>I have also produced various stripped-down versions (e.g. definition-only) which may be useful for revision. However, keep in mind that they are automatically generated from my regular notes via a poorly-hacked-together shell script and may be nonsensical in certain cases.</p>

<p>For the sake of <a class="hidden" href="http://en.wikipedia.org/wiki/Completeness_(logic)">completeness</a>, the example sheets for the courses are included as well. These are <a class="hidden" href="http://theproofistrivial.com">obviously</a> not my work.</p>

<p>Please email any comments to <a href="mailto:dec41@cam.ac.uk">dec41@cam.ac.uk</a>. Feel free to point out errors or unclear explanations, as well as general typographic suggetsions. Even better, send a GitHub <a href="http://github.com/dalcde/cam-notes/pulls">pull request</a>.</p>

<p><em>Note that I upload my notes as I produce them, and fix and polish them when I have time. Hence they in their current form may or may not be suitable for human consumption. Those that are proven Cat. 1 carcinogen have been greyed out, and it is probably not a very good idea to consume these. Keep in mind that the others may also have occasional typos and errors, and prolonged consumption may have detrimental health effects.</em></p>

<?php include "courses_list.php"; ?>
<section>
<h1>External resources</h1>
<p>Notes from other sources I like.</p>
<ul>
  <li><a href="http://tartarus.org/gareth/maths/notes/">Gareth Taylor's</a> notes. Mostly pure mathematics.</a></li>
  <li><a href="http://www.damtp.cam.ac.uk/user/tong/teaching.html">David Tong's</a> notes. Theoretical physics.</a></li>
  <li><a href="http://www.damtp.cam.ac.uk/user/eal40/teach/QM2012/QMroot.html">Eugene Lim's</a> notes. IB Quantum mechanics.</a></li>
  <li><a href="http://www.statslab.cam.ac.uk/~rrw1/">Ricahrd Weber's</a> notes. Applicable courses.</li>
  <li><a href="http://www.archim.org.uk/notes.php">Archimedeans'</a> notes. Miscellaneous topics from different sources.</a></li>
</ul>
</section>

<?php include "footer.php"?>
