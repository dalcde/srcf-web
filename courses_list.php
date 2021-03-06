<?php
$CURRENT_TERM="Lent";

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
    if (!preg_match('/notes\/I[ABI]+_[MLE]/', $item)){
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
    $type = $results["part"]."_".substr($results["term"],0,1);
    if (!preg_match('/notes\/'.$type.'/', $item)){
        continue;
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
            $style = isset($details["notready"]) ? ($termtime ? "notes-item notes-item-unready" : "notes-item notes-item-old") : "notes-item";
            $course = $details["course"];

            if (isset($details["lectures"]) && $termtime) {
                $lectures = explode(".", $details["lectures"]);
                $dates = $lectures[0];
                $time = $lectures[1];
                $time = $time == "12" ? "12pm" : $time."am";

                $edit = filemtime($path);
                $edit_day = date("N", $edit);

                if ($dates == "MWF") {
                    $next = min(strtotime("next Monday"   , $edit),
                                strtotime("next Wednesday", $edit),
                                strtotime("next Friday"   , $edit));
                    if (($edit_day == 1 || $edit_day == 3 || $edit_day == 5) &&
                        (strtotime($time, $edit) > $edit)) {
                            $next = $edit;
                    }

                } else if ($dates == "TTS") {
                    $next = min(strtotime("next Tuesday"  , $edit),
                                strtotime("next Thursday" , $edit),
                                strtotime("next Saturday" , $edit));

                    if (($edit_day == 2 || $edit_day == 4 || $edit_day == 6) &&
                        (strtotime($time, $edit) > $edit)) {
                        $next = $edit;
                    }

                } else if ($dates == "TT") {
                    $next = min(strtotime("next Tuesday"  , $edit),
                                strtotime("next Thursday" , $edit));

                    if (($edit_day == 2 || $edit_day == 4) &&
                        (strtotime($time, $edit) > $edit)) {
                        $next = $edit;
                    }
                }
                $next = strtotime($time, $next);
                $today = strtotime("today");
                if (time() > $next) {
                    $style = "notes-item notes-item-old";
                }
            }
            $link = substr($path, 0, -4);
            $slink = substr($link, 6);
            if ($term == $CURRENT_TERM) {
              echo "<span class='gone'>$course <span class='notes-additional'>($year, $lecturer)</span> -&nbsp;";
            }
            else {
              echo "<span class='$style'><a href='/h/$slink'>$course</a> <span class='notes-additional'>($year, $lecturer)</span> -&nbsp;";
            }

            foreach ($PROPS as $name => $stuff) {
                $ext = $stuff[0];
                $title = $stuff[1];
                $full = "$link$ext";
                if (file_exists ($full)) {
                    $time = date("Y-m-d H:i:s O", filemtime($full));

                    if ($term == $CURRENT_TERM) {
                      echo "<span title='Taken down, see above'>$name</span>&nbsp;";
                    } else {
                      echo "<a href='$full' title='$title (Last edited $time)'>$name</a>&nbsp;";
                    }
                }
            }

            if (isset($details["official"])) {
              $official = $details["official"];
              if ($term == $CURRENT_TERM) {
                echo "<span title='You can Google it yourself'>official-notes</a>";
              } else {
                echo "<a href='$official' title='Official notes'>official-notes</a>";
              }
            }
            if ($term == $CURRENT_TERM) {
              echo "</span>";
            }
            echo "</span><br />";
        }
    }
    echo "</section>";
}
?>
