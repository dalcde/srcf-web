<?php
$title = "Exam tips";
include "header.php";
?>
<p>This is the record of all silly mistakes I have made, as well as some useful techniques I've gathered when doing past papers. You might want to read the corresponding sections before an exam.</p>

<h1>General</h1>
<ul>
  <li><p>Zero is a <a class="hidden" href="http://en.wikipedia.org/wiki/0_(number)">number</a>. Whenever you divide, make sure you are not dividing by <span class="maths">0</span>. Also, sometimes special cases need to be made for things that are zero (eg. in proving Rolle's theorem, you say if f is constant, result is trivial. If not, ...). When proving L'Hopital's rule, you also have to argue some way that the denominator is not <span class="maths">0</span> in some suitable neighbourhood. Don't miss these.</p></li>
  <li><p>Make sure you know all your bookwork (does this have to be said?), but not those that are non-examinable! <a href="http://www.planetary.org/blogs/jason-davis/2015/20150526-software-glitch-pauses-ls-test.html">Lightsail</a> got stuck in space because it ran out of memory. Don't let that happen to you! (also, a possible solution they proposed seems to be "redirect to <code>/dev/null</code>", which is not a good idea for exams) So read the course syllabus and make sure you don't waste your time and memory.</p></li>
  <li><p>The word "small" can mean many things. Usually it is either "Taylor expand it" or "ignore 2<sup>nd</sup>/3<sup>rd</sup>/... order terms" (mostly 2<sup>nd</sup> order). If not specified, make them vanish when you are too annoyed by them.</p></li>
  <li><p>A cartesian product <span class="maths">A × A</span> can be thought of the set of all functions from <span class="maths">{0, 1}</span> to <span class="maths">A</span> (where <span class="maths">(a, b)</span> is the function <span class="maths">f(0) = a, f(1) = b</span>). Of course, you can argue that this statement is formally nonsense, since functions are conventionally defined in terms of ordered pairs. However, this is helpful since it can be easily generalized to higher products, eg. <span class="maths">A<sup>n</sup></span> is the set of all functions from <span class="maths">{0, 1, ..., n - 1}</span> to <span class="maths">A</span>. This is consistent with the common notion of <span class="maths">X<sup>Y</sup></span> being the set of all functions from <span class="maths">Y</span> to <span class="maths">X</span> (becuase <span class="maths">n</span> is totally the set <span class="maths">{0, 1, ..., n - 1}</span>)</p>
  
  <p>This allows you to take infinite "products" or even uncountable products with ease. With this in mind, the last part of 2008 P3 8E is trivial.</p></li>

  <li><p>Read the whole question before starting, especially the hints. Sometimes you might spend a lot of time trying to prove some results    , only to see "you may assume that ... is true" below.</p></li>

  <li><p>When asked to state and prove a result, don't forget to <em>state</em> it.</p></li>
  <li><p>If you think you are very close to finishing a proof but can't think of the final step, write "so the result follows". Maybe they won't notice...<p>
  <p>Quote from xkcd: Handy exam trick: when you know the answer but not the correct derivation, derive blindly forward from the givens and backward from the answer, and join the chains once the equations start looking similar. Sometimes the graders don't notice the seam.</p>
  
  <p>DISCLAIMER: I don't gaurantee this works or is even beneficial.</p></li>
</ul>

<h1>Part IA</h1>

<h2>Vectors and Matrices</h2>
<ul>
  <li><p>Lots of computation. Be careful. Algebraic mistakes are easy to make.</p></li>
  <li><p>If the eigenvalues of a matrix are not integers, check your work.</p></li>
  <li><p>When solving vector equations like <span class="maths"><b>r</b> + <b>r</b>×<b>b</b> = <b>c</b></span>, you can always solve it by dotting and crossing with something in the equation, eg. <span class="maths"><b>r</b></span> or <span class="maths"><b>c</b></span>. There aren't many to try and most results are useful. Note that every result from dotting and crossing can be used and substituted into your next calculations, <em>including the original equation provided</em>. If in doubt, just cross and dot everything and try to put them together. This strategy has been working quite well for me so far.</p></li>
  <li><p>When you are given a linear transform in vector form and asked to find the inverse, you are expected to solve the vector equation, not write a huge matrix and try to invert.</p></li>
</ul>

<h2>Analysis I</h2>
<ul>
  <li><p>If you are asked to prove something that is true for <span class="maths">[0, 1]</span> but not <span class="maths">ℝ</span>, it is very likely that you have to construct a sequence, use Bolazano Weierstrass to obtain a convergent subsequence, and produce a contradiction for it. eg. continuous functions are bounded.</p></li>
  <li><p>Subsequences can be nested. Eg if you have two sequences <span class="maths">(x<sub>n</sub>)</span> and <span class="maths">(y<sub>n</sub>)</span>, you can get a convergent subsequence <span class="maths">(x<sub>n<sub>i</sub></sub>)</span>, and then obtain a convergent subsequence of <span class="maths">(y<sub>n<sub>i</sub></sub>)</span>, say <span class="maths">(y<sub>k<sub>i</sub></sub>)</span>. Then <span class="maths">(x<sub>k<sub>i</sub></sub>)</span> and <span class="maths">(y<sub>k<sub>i</sub></sub>)</span> are both convergent subsequences.</p></li>
  <li><p>It is often convenient to prove a statement by taking the supremum of some subset of <span class="maths">[0, 1]</span>. For example, to prove the intermediate value theorem, we take the supremum of <span class="maths">A = {x: f(x) &lt; 0}</span> and show that it is the zero of <span class="maths">f</span>. Alternatively, to prove Heine-Borel, we take the supremum of all <span class="maths">x</span> such that <span class="maths">[0, x]</span> is compact. Also see Analysis Sheet 2 Q. 8.<p/>
  <p>This technique is useful when we want to prove that "<span class="maths">1</span>" works, and given any <span class="maths">x</span> that works, we can push a bit further to find an <span class="maths">x'</span> &gt; <span class="maths">x</span> that works. While it might take infinitely many iterations to reach <span class="maths">1</span>, we can instantaneously "jump" there by taking the supremum.</p></li>
  <li><p>When defining the Riemann integral, do <b>not</b> use <span class="maths">S<sub>D</sub></span> and <span class="maths">s<sub>D</sub></span> for the upper and lower sums. Use something more distinguishable such as <span class="maths">U<sub>D</sub></span> and <span class="maths">L<sub>D</sub></span> (and yes it is a good idea to define everything from dissections to upper and lower sums).</p></li>
  <li><p>When doing limits, bounds can be very crude in many occasions (eg. when multiplying by something that tends to <span class="maths">0</span>). Don't be afraid to make terrible bounds if they can simplify the algebra a lot.</p></li>
</ul>

<hr />

<h2>Differential Equations</h2>
<ul>
  <li><p>Lots of computation. Be careful. Algebraic mistakes are easy to make.</p></li>
  <li><p>When asked to sketch contours and phase diagrams, just plot a few points/arrows/lines you know are correct and join them together with a curve.</p></li>
  <li><p>When the characteristic equation of your second-order linear ODE has complex roots, the general solution is <span class="maths">e<sup>k<b style="color:red">t</b></sup>(A cos ωt + B sin ωt)</span>, not <span class="maths">e<sup>k</sup>(A cos ωt + B sin ωt)</span>.</p></li>
  <li><p>If you get stuck on a differential equation, try the simplest methods. Is it separable? Can you use an integrating factor? These are usually the easiest to miss.</p></li>
</ul>

<h2>Probability</h2>
<ul>
  <li><p>In general, there will be some questions that are incredibly easy and some that are incredibly hard. Take your time to pick the right question (conditional probability ones are usually quite pleasant).</p></li>
  <li><p>If you have no idea how to find the expectation/variance of a random variable, try breaking it down into the sum of many (usually independent) pieces, eg. 2008 P2 12F.</p></li>
  <li><p>There is usually no nice way of proving that two variables are independent. Most likely you will have to do terrible conditionals or messy variable transforms and factor to get the result. This is usually not a sign that you are doing it wrong, and don't be afraid to do so (there are rare occasions where you can argue that they must be independent, but they are rare).</p></li>
  <li><p>Sometimes the inverse of the Jacobian is easier to calculate. Espcially when one side involves roots.</p></li>
  <li><p>When doing things involving Bernoulli trials/random walks/whatever, always keep in mind that <span class="maths">p = 1 - q</span>. This can sometimes simplify things quite a lot.</p></li>
</ul>

<hr />

<h2>Groups</h2>
<ul>
  <li><p>When asked to find the orbits of <span class="maths">A × A × A</span> (or something similar) under the action of a group <span class="maths">G</span>, don't forget elements of the form <span class="maths">(x, x, y)</span> or <span class="maths">(x, x, x)</span> with repeated elements.</p></li>
  <li><p>When asked to find groups with weird properties, try <span class="maths">C<sub>2</sub>×C<sub>2</sub></span> or <span class="maths">S<sub>3</sub></span> (which is the same as <span class="maths">D<sub>6</sub></span>, but <span class="maths">S<sub>3</sub></span> is usually easier to present). If these don't work, try <span class="maths">Q<sub>8</sub></span> or <span class="maths">D<sub>8</sub></span>. If everything goes wrong, <span class="maths">A<sub>5</sub></span> being a simple group might be helpful, or <span class="maths">S<sub>5</sub></span>, which contains <span class="maths">A<sub>5</sub></span>. There really aren't many groups out there<sup>[<a href="http://en.wikipedia.org/wiki/Edsel_Citation">citation needed</a>]</sup>.
  <li><p>When studying Mobius transformations on <span class="maths">𝔽<sub>p</sub></span>, most results proved in <span class="maths">ℂ</span> can be applied, but you have to make sure they do not rely on properties of <span class="maths">ℂ</span>. For instance, you cannot use the Jordan normal form theorem, since it relies on finding an eigenvector basis, which relies on solving the characteristic equation, but unlike <span class="maths">ℂ</span>, polynomial in <span class="maths">𝔽<sub>p</sub></span> need not have all the roots you need.</p></li>
</ul>

<h2>Vector Calculus</h2>
<ul>
  <li><p>The average value of <span class="maths">sin<sup>2</sup>x</span> (and <span class="maths">cos<sup>2</sup>x</span>) is <span class="maths">½</span>. So <span class="maths">∫<sub>0</sub><sup>2π</sup> sin<sup>2</sup>x dx = π</span>, and <span class="maths">∫<sub>0</sub><sup>2π</sup> sin<sup>2</sup>2x dx = π</span> as well. In fact <span class="maths">∫<sub>0</sub><sup>2π</sup> sin<sup>2</sup>kx dx = π</span> for any integer <span class="maths">k</span>. We don't need to do any substitution to know this. It is because <span class="maths">sin<sup>2</sup></span> is on average <span class="maths">½</span> and we are integrating <span class="maths">½</span> from <span class="maths">0</span> to <span class="maths">2π</span>, which obviously gives <span class="maths">π</span>. Of course, this only works if we are integrating over an integer multiple of the period of <span class="maths">sin</span>.</p></li>
  <li><p>Beware of symmetry and a lot of things can be made into zero, eg. when you are integrating <span class="maths">sin x</span> from <span class="maths">0</span> to <span class="maths">2π</span>, or when you contract a symmetric tensor with an antisymmetric tensor.</p></li>
  <li><p>Sometimes the inverse of the Jacobian is easier to calculate.</p></li>
</ul>

<hr />

<h2>Numbers and Sets</h2>
<ul>
  <li><p>Everyone likes to ignore this advice, but there is no harm in spending 10 minutes reading about RSA just in case it comes up.</p></li>
  <li><p>Whenever you see hcfs, think "Bezout".</p></li>
</ul>

<h2>Dynamics and Relativity</h2>
<ul>
  <li><p>Latitude is measured from the equator, but the <span class="maths">θ</span> in spherical coordinates is measured from vertical.</p></li>
  <li><p>When solving relativistic dynamics questions, most of the time you don't need to use the Center of Momenutm frame (unless it tells you to). Instead, you use the conservation of momentum equation directly. Most likely you will have to dot it with itself, and sometimes you want to use the conservation of energy/3-momenutm individually, or a combination of both.</p></li>
  <li><p>Newton's second law is basically the same as the conservation of energy, except that when using the conservation of energy, you have an additional piece of information about the initial energy. So if you are given the initial energy, it is often easier to user the conservation of energy directly instead of Newton's law.</p></li>
  <li><p>Just in case they decide to be really annoying, make sure you know all those obscure terms defined in lectures, such as the periapsis, apoapsis, apsides, perihelion, aphelion, perigge and apogee.</p></li>
</ul>


<?php include "footer.php"?>
