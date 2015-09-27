<?php
$title = "FAQs";
include "header.php"?>
<p>Here I'll post some answers to certain FAQs.</p>

<div>
  <h2>Why is 1 + 1 = 2?</h2>
  <p>It's not. In a field of characteristic 2, we have 1 + 1 = 0. (In the rare cases where it is true, that's because we defined 2 to be a shorthand of 1 + 1)</p>
</div>

<div>
  <h2>What is your favorite text editor/mail client/version control system?</h2>
  <p>Butterflies/pigeons/VCS-is-too-difficult-to-run-on-clay-tablets.</p>
</div>

<div>
  <h2>What is your favorite text editor/mail client/version control system? -v</h2>
  <p>I'm not particularly interested in starting flame wars, you know.</p>
</div>

<div>
  <h2>What is your favorite text editor/mail client/version control system? -vv</h2>
  <p>Why must you insist on asking?</p>
</div>

<div>
  <h2>What is your favorite text editor/mail client/version control system? -vvv</h2>
  <p>Stop it.</p>
</div>

<div>
  <h2>What is your favorite text editor/mail client/version control system? -vvvv</h2>
  <p><pre>
                 (__) 
                 (oo) 
           /------\/ 
          / |    ||   
         *  /\---/\ 
            ~~   ~~   
..."Have you mooed today?"...</pre> 
  </p>
</div>

<div>
  <h2>What is your favorite text editor/mail client/version control system? -vvvvv</h2>
  <p><code>FAQ version 3.14.1-5 build 20150314082350</code></p>
</div>
<div>
  <h2>What is your favorite xkcd?</h2>
  <p><code>http://xkcd.com/`echo $[ 1 + $[ $RANDOM % \`curl http://xkcd.com/info.0.json 2&gt;/dev/null | sed 's/.*num": \([0-9]*\).*/\1/'\` ] ]`</code></p>
</div>

<div>
  <h2>What is the largest integer you can count up to?</h2>
  <p>3.</p>
</div>

<div>
  <h2>What language should I use for CATAM?</h2>
  <p>Not MATLAB.</p>
</div>

<div>
  <h2>What is your favorite astronomical entity?</h2>
  <p>Orion. That's the only one I can <a class="hidden" href="http://xkcd.com/66/">recognize</a>.</p>
</div>

<div>
  <h2>You keep producing pointless webpages. Do you have too much time?</h2>
  <p>Depends on what you mean by "too much". I have 24 hours a day. Is that too much?</p>
</div>

<div>
  <h2>How frequently are these questions asked?</h2>
  <p>Never.</p>
</div>

<div>
  <h2>Then why are they called FAQs?</h2>
  <p>They are frequently answered questions - questions I frequently answer even though no one ever asked them.</p>
</div>

<div>
  <h2>How are your notes different from others?</h2>
  <p>In many ways, but the one I'm most proud of is that the <em>page numbers make sense</em>. The first page is actually numbered "Page 1", not "Page -11". When the table of contents says the chapter is on Page 10, then it is actually on the 10<sup>th</sup> page, not, like, the 22<sup>nd</sup> page.</p>
</div>
<div>
  <h2>I cannot compile the tex files!</h2>
  <p>That's technically not a quesiton. But if you do encounter this issue, a good idea is to read what your compiler tells you.</p>
  
  <p>If it says that a package is missing, then a package is missing and you should install it.</p>
  
  <p>If it says it cannot find <code>header.tex</code>, then it cannot find <code>header.tex</code> and you should put <code>header.tex</code> right next to it when compiling (putting them in the same folder should suffice normally).</p>
  
  <p>If it says that it cannot find an image, then it cannot find the image and you should get the image files. The easiest way to solve this problem is to <code>git clone git://github.com/dalcde/cam-notes</code> and compile the git copy. (if the git version of the tex file is outdated, you might want manually update the tex file using the one you find on this website. This is a weird world where git version != latest version.)</p>

  <p>Finally relieved to find a remotely useful FAQ entry, right?</p>
</div>
<?php include "footer.php"?>
