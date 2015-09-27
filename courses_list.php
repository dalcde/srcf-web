<?php
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

$PROPS = array( 
    "full" => array(".pdf", "Full version"),
    "def" => array("_def.pdf", "Definition-only version"),
    "thm" => array("_thm.pdf", "Theorem-only version"),
    "thp" => array("_thm_proof.pdf", "Theorem-with-proof version"),
    "src" => array(".tex", "Source code"),
    "eg" => array("_eg.pdf", "Example sheets")
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
                $full = "$link$ext";
                if (file_exists ($full)) {
                    $time = date("Y-m-d H:i:s O", filemtime($full));

                    echo "<a href='$full' title='$title (Last edited $time)'>$name</a>&nbsp;";
                }
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
