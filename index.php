<?php
$title = "My Notes";
include "header.php"?>

<p>Below are the notes I took during lectures in Cambridge. None of this is official (unless otherwise specified). The source code of my notes is also available, which has to be compiled with <a href="notes/header.tex"><code>header.tex</code></a>. It is also available on <a href="http://github.com/dalcde/cam-notes">GitHub</a>.</p>

<p>I have also produced various stripped-down versions (e.g. definition-only) which may be useful for revision. However, keep in mind that they are automatically generated from my regular notes via a poorly-hacked-together shell script and may be nonsensical in certain cases.</p>

<p>For the sake of <a class="hidden" href="http://en.wikipedia.org/wiki/Completeness_(logic)">completeness</a>, the example sheets for the courses are included as well. These are <a class="hidden" href="http://theproofistrivial.com">obviously</a> not my work.</p>

<p>Please email any errors to <a href="mailto:dec41@cam.ac.uk">dec41@cam.ac.uk</a> (even better - GitHub pull requests). Typographic suggestions are also welcome.</p>

<p><em>Note that I upload my notes as I produce them, and fix and polish them when I have time. Hence they in their current form may or may not be suitable for human consumption. Those that are proven Cat. 1 carcinogen have been greyed out, and it is probably not a very good idea to consume these. Keep in mind that the others may also have occasional typos and errors, and prolonged consumption may have detrimental health effects.</em></p>

<?php
$subjects = array();

$directory = new RecursiveDirectoryIterator('notes/');
$iterator = new RecursiveIteratorIterator($directory);
$regex = new RegexIterator($iterator, '/^.+\.tex$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($regex as $item=>$object) {
    if (basename($item) == "header.tex") {
        continue;
    }
    $results = array();
    $count = 0;
    foreach (file($item) as $line) {
        if (preg_match('/\\\\def\\\\n([a-z]*) *\\{(.*)\\}/', $line, $matches)) {
            $results[$matches[1]] = $matches[2];
        }
        $count++;
        if (count > 15) {
            break;
        }
    }
    if (!isset($subjects[$results["part"]])) {
        $subjects[$results["part"]] = array();
    }
    if (!isset($subjects[$results["part"]][$results["term"]])) {
        $subjects[$results["part"]][$results["term"]] = array();
    }
    $subjects[$results["part"]][$results["term"]][$item] = $results;
}

function sort_terms($a, $b) {
    if ($a == $b) {
        return 0;
    }
    if ($a == "Michaelmas"){
        return -1;
    } else if ($a == "Lent" && $b == "Easter") {
        return -1;
    } else {
        return 1;
    }
}

function sort_courses ($a, $b) {
    if ($a["course"] == $b["course"]) {
        if ($a["year"] == $b["year"]) {
            return 0;
        }
        return ($a["year"] < $b["year"]) ? -1 : 1;
    }
    return ($a["course"] < $b["course"]) ? -1 : 1;
}

$PROPS = array( 
    "full" => array(".pdf", "Full version"),
    "def" => array("_def.pdf", "Definition-only version"),
    "thm" => array("_thm.pdf", "Theorem-only version"),
    "thp" => array("_thm_proof.pdf", "Theorem-with-proof version"),
    "src" => array(".tex", "Source code")
);

ksort($subjects);
foreach ($subjects as $part => $terms) {
    echo "<section>";
    echo "<h1>Part $part</h1>";

    uksort($terms, sort_terms);
    foreach ($terms as $term => $courses ) {
        echo "<h2>$term Term</h2>";

        uasort($courses, sort_courses);
        foreach ($courses as $path => $details ) {
            $year = $details["year"];
            $lecturer = $details["lecturer"];
            $style = isset($details["notready"]) ? "notes-item notes-item-unready" : "notes-item";
            $course = $details["course"];

            echo "<span class='$style'>$course <span class='notes-additional'>($year, $lecturer)</span> -&nbsp;";

            $link = substr($path, 0, -4);

            foreach ($PROPS as $name => $stuff) {
                $ext = $stuff[0];
                $title = $stuff[1];
                $time = date("Y-m-d H:i:s", filemtime("$link$ext"));

                echo "<a href='$link$ext' title='$title (Last edited $time)'>$name</a>&nbsp;";
            }

            $linkeg = $link."_eg.pdf";
            if (file_exists($linkeg)) {
                $time = date("Y-m-d H:i:s", filemtime($linkeg));
                echo "<a href='$link' title='Example sheets (Last edited: $time)'>eg</a>&nbsp;";
            }

            if (isset($details["official"])) {
                $official = $details["official"];
                echo "<a href='$official' title='Official notes'>official-notes</a>";
            }
            echo "</span><br />";
        }
    }
    echo "</section>";
}
?>
<section>
<h1>External resources</h1>
<p>Notes from other sources I like.</p>
<ul>
  <li><a href="http://tartarus.org/gareth/maths/notes/">Gareth Taylor's</a> notes. Mostly pure mathematics.</a></li>
  <li><a href="http://www.damtp.cam.ac.uk/user/tong/teaching.html">David Tong's</a> notes. Theoretical physics.</a></li>
  <li><a href="http://www.damtp.cam.ac.uk/user/eal40/teach/QM2012/QMroot.html">Eugene Lim's</a> notes. IB Quantum mechanics.</a></li>
  <li><a href="http://www.archim.org.uk/notes.php">Archimedeans'</a> notes. Miscellaneous topics from different sources, of variable quality.</a></li>
</ul>
</section>

<?php include "footer.php"?>
