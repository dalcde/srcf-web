<?php
$title = "My Notes";
include "header.php"?>

<p>Below are the notes I took during lectures in Cambridge. None of this is official (unless otherwise specified). The source code of my notes is also available, which has to be compiled with <a href="notes/header.tex"><code>header.tex</code></a>. It is also available on <a href="http://github.com/dalcde/cam-notes">GitHub</a>.</p>

<p>I have also produced various stripped-down versions (e.g. definition-only) which may be useful for revision. However, keep in mind that they are automatically generated from my regular notes via a poorly-hacked-together shell script and may be nonsensical in certain cases.</p>

<p>For the sake of <a class="hidden" href="http://en.wikipedia.org/wiki/Completeness_(logic)">completeness</a>, the example sheets for the courses are included as well. These are <a class="hidden" href="http://theproofistrivial.com">obviously</a> not my work.</p>

<p>Please email any errors to <a href="mailto:dec41@cam.ac.uk">dec41@cam.ac.uk</a> (even better - GitHub pull requests). Typographic suggestions are also welcome.</p>

<?php
$SUBJECTS = array(
    "IA" => array(
        "Michaelmas" => array(
            "Groups" => array(
                "lecturer" => "J. Goedecke",
                "year" => 2014,
                "eg" => True,
                "official" => "http://www.dpmms.cam.ac.uk/~jg352/pdf/GroupsNotes.pdf"
            ),
            "Numbers and Sets" => array(
                "lecturer" => "A. G. Thomason",
                "year" => 2014,
                "eg" => True,
                "official" => null
            ),
            "Differential Equations" => array(
                "lecturer" => "M. G. Worster",
                "year" => 2014,
                "eg" => True,
                "official" => null
            ),
            "Vectors and Matrices" => array(
                "lecturer" => "N. Peake",
                "year" => 2014,
                "eg" => True,
                "official" => null
            )
        ),
        "Lent" => array(
            "Analysis I" => array(
                "lecturer" => "W. T. Gowers",
                "year" => 2015,
                "eg" => True,
                "official" => null
            ),
            "Probability" => array(
                "lecturer" => "R. R. Weber",
                "year" => 2015,
                "eg" => True,
                "official" => "http://www.statslab.cam.ac.uk/~rrw1/prob/index.html"
            ),
            "Dynamics and Relativity" => array(
                "lecturer" => "G. I. Ogilvie",
                "year" => 2015,
                "eg" => True,
                "official" => null
            ),
            "Vector Calculus" => array(
                "lecturer" => "B. Allanach",
                "year" => 2015,
                "eg" => True,
                "official" => "http://users.hepforge.org/~allanach/teaching.html"
            )
        )
    ),
    "IB" => array(
#        "Michaelmas" => array(
#            "Analysis II" => array(
#                "lecturer" => "",
#                "year" => 2015,
#                "eg" => False,
#                "official" => null
#            ),
#            "Linear Algebra" => array(
#                "lecturer" => "",
#                "year" => 2015,
#                "eg" => False,
#                "official" => null
#            ),
#            "Quantum Mechanics" => array(
#                "lecturer" => "",
#                "year" => 2015,
#                "eg" => False,
#                "official" => null
#            ),
#            "Markov Chains" => array(
#                "lecturer" => "",
#                "year" => 2015,
#                "eg" => False,
#                "official" => null
#            ),
#            "Methods" => array(
#                "lecturer" => "",
#                "year" => 2015,
#                "eg" => False,
#                "official" => null
#            )
#        ),
        "Lent" => array(
            "Electromagnetism" => array(
                "lecturer" => "D. Tong",
                "year" => 2015,
                "eg" => True,
                "official" => "http://www.damtp.cam.ac.uk/user/tong/em.html"
            ),
            "Statistics" => array(
                "lecturer" => "D. Spiegelhalter",
                "year" => 2015,
                "eg" => True,
                "official" => "http://www.statslab.cam.ac.uk/Dept/People/djsteaching/teaching15.html"
            )
        ),
        "Easter" => array(
            "Metric and Topological Spaces" => array(
                "lecturer" => "J. Rassmussen",
                "year" => 2015,
                "eg" => True,
                "official" => null
            ),
            "Optimisation" => array(
                "lecturer" => "A. Fischer",
                "year" => 2015,
                "eg" => True,
                "official" => "http://www.statslab.cam.ac.uk/~ff271/teaching/opt/"
            ),
            "Variational Principles" => array(
                "lecturer" => "P. K. Townsend",
                "year" => 2015,
                "eg" => True,
                "official" => "http://www.damtp.cam.ac.uk/user/examples/B6La.pdf"
            )
        )
    ),
    "II" => array(
        "Lent" => array(
            "Logic and Set Theory" => array(
                "lecturer" => "I. B. Leader",
                "year" => 2015,
                "eg" => True,
                "official" => null
            )
        )
    )
);


$PROPS = array( 
    "full" => array(".pdf", "Full version"),
    "def" => array("_def.pdf", "Definition-only version"),
    "thm" => array("_thm.pdf", "Theorem-only version"),
    "thp" => array("_thm_proof.pdf", "Theorem-with-proof version"),
    "src" => array(".tex", "Source code")
);

foreach ($SUBJECTS as $part => $terms) {
    echo "<section>";
    echo "<h1>Part $part</h1>";
    foreach ($terms as $term => $courses ) {
        echo "<h2>$term Term</h2>";
        foreach ($courses as $course => $details ) {
            $year = $details["year"];
            $lecturer = $details["lecturer"];

            $term_str = $part."_".substr($term, 0, 1);

            echo "<span class='notes-item'>$course <span class='notes-additional'>($year, $lecturer)</span> -&nbsp;";

            $course = strtolower($course);
            $course = str_replace(" ", "_", $course);

            foreach ($PROPS as $name => $stuff) {
                $ext = $stuff[0];
                $title = $stuff[1];

                $link = "notes/$term_str/$course$ext";
                $time = date("Y-m-d H:i:s", filemtime($link));

                echo "<a href='$link' title='$title (Last edited $time)'>$name</a>&nbsp;";
            }

            if ($details["eg"]) {
                $link = "notes/$term_str/$course"."_eg.pdf";
                $time = date("Y-m-d H:i:s", filemtime($link));

                echo "<a href='$link' title='Example sheets (Last edited: $time)'>eg</a>&nbsp;";
            }

            if ($details["official"]) {
                $official = $details["official"];
                echo "<a href='$official' title='Official notes'>official-notes</a>";
            }
            echo "</span><br />";
        }
    }
    echo "</section>";
}
?>

<?php include "footer.php"?>
