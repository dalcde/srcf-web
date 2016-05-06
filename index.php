<?php
$title = "Maths Lecture Notes";
include "header.php"?>

<p>Below are the notes I took during lectures in Cambridge. None of this is official (unless otherwise specified). Included as well are stripped-down versions (eg. definition-only; script-generated and doesn't necessarily make sense), example sheets, and the source code. The source code has to be compiled with <a href="notes/header.tex"><code>header.tex</code></a>, and is also available on <a href="http://github.com/dalcde/cam-notes">GitHub</a>.</p>

<?php
  if ($termtime) {
?>
<p>Incomplete or unready notes are <span class="notes-item notes-item-old">greyed out</span>. The titles are <span class="notes-item notes-item-unready">bolded</span> if they have been updated since the most recent lecture.</p>
<?php
  } else {
?>
<p>Unready notes are <span class="notes-item notes-item-old">greyed out</span>.</p>
<?php
  }
?>

<?php include "courses_list.php"; ?>

<section>
<h1>Stuff</h1>
<p>THESE NOTES ARE PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, LACK OF TYPOS AND FUNNINESS OF PUNS.</p>

<p>Nevertheless, please email any comments to <a href="mailto:dec41@cam.ac.uk">dec41@cam.ac.uk</a>. Feel free to point out errors or unclear explanations, as well as general typographic suggestions. Even better, send a GitHub <a href="http://github.com/dalcde/cam-notes/pulls">pull request</a>.</p>

<p>Here I'd like to thank the lecturers who delivered the (usually) amazing lectures, and all of those who helpfully pointed out my mistakes and typos.</p>

</section>
<section>
<h1>External resources</h1>
<p>Notes from other sources I like.</p>
<ul>
  <li><a href="http://tartarus.org/gareth/maths/notes/">Gareth Taylor's</a> notes. Mostly pure mathematics.</a></li>
  <li><a href="http://www.damtp.cam.ac.uk/user/tong/teaching.html">David Tong's</a> notes. Theoretical physics.</a></li>
  <li><a href="http://www.statslab.cam.ac.uk/~rrw1/">Richard Weber's</a> notes. Applicable courses.</li>
  <li><a href="http://www.archim.org.uk/notes.php">Archimedeans'</a> site. Miscellaneous topics from different sources.</a></li>
  <li><a href="https://www.maths.cam.ac.uk/tripos-specific-resources">Student Representatives'</a> page. Miscellaneous topics from different sources. May overlap with above.</a></li>
</ul>
</section>

<?php include "footer.php"?>
