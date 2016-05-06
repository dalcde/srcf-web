<?php 
$ALIASES = array(
  "vm" => array("IA_M", "vectors_and_matrices"),
  "vc" => array("IA_L", "vector_calculus"),
  "grm" => array("IB_L", "groups_rings_and_modules"),
  "ca" => array("IB_L", "complex_analysis"),
  "cm" => array("IB_L", "complex_methods"),
);

$request = explode("/", $_SERVER["REQUEST_URI"]);
if (empty($ALIASES[$request[2]])) {
  $term = $request[2];
  $course = $request[3];
  $content = $request[4];
  $dom="/h/$term/$course/";
} else {
  $term = $ALIASES[$request[2]][0];
  $course = $ALIASES[$request[2]][1];
  $content = $request[3];
  $dom="/h/".$request[2]."/";
}
function escape_now() {
  $_SERVER["REDIRECT_STATUS"] = "404"; # this totally makes sense
  include("../error.php");
  exit;
}
if (!preg_match('/^I[ABI]_[MLE]$/', $term) or !preg_match('/^[a-z_]*$/', $course)){
  escape_now();
}
$sections = array();
$meta = array();
$inverse_list = array();
$raw_list = array();

$handle = @fopen("../notes/$term/$course.tex", "r");
if (!$handle) {
  escape_now();
}
$raw_count = 2;
$sec_count = 0;
$subsec_count = 0;
$title = "";
$lecturer = "";
while (($line = fgets($handle)) !== false) {
  $matches = array();
  if (preg_match('/\\\\setcounter\{section\}\{([-0-9]*)\}/', $line, $matches)) {
    $sec_count = $matches[1];
  } else if (preg_match('/\\\\setcounter\{subsection\}\{([0-9]*)\}/', $line, $matches)) {
    $subsec_count = $matches[1];
  } else if (preg_match('/\\\\section\{(.*)\}/', $line, $matches)) {
    $sec_count ++;
    $sec_name = preg_replace('/\\\\texorpdfstring\{[^\}]*\}\{([^\}])\}/', '\1', $matches[1]);
    $subsec_count = 0;
    $sections[] = array("title" => $sec_name,
                        "number" => $sec_count,
                        "subsections" => array());
    $raw_count ++;
    $inverse_list[$sec_count] = $raw_count;
    $raw_list[$raw_count] = $sec_count;
  } else if (preg_match('/\\\\subsection\{(.*)\}/', $line, $matches)) {
    $subsec_count ++;
    $subsec_name = preg_replace('/\\\\texorpdfstring\{[^\}]*\}\{([^\}]*)\}/', '\1', $matches[1]);
    $index = count($sections) - 1;
    $sections[$index]["subsections"][] = array("title" => $subsec_name,
                                               "number" => $subsec_count);
    $raw_count ++;
    $inverse_list[$sec_count."_".$subsec_count] = $raw_count;
    $raw_list[$raw_count] = $sec_count."_".$subsec_count;
  } else if (preg_match('/\\\\def\\\\n([a-z]*) *\\{(.*)\\}/', $line, $matches)) {
    $meta[$matches[1]] = $matches[2];
  }
}
fclose($handle);
$title = $meta["part"]." - ".$meta["course"];
include "../header.php";

function genSubToc($section) {
    global $dom;
    echo "<ul class='disp-toc-sub'>";
    foreach ($section["subsections"] as $subsec) {
      echo "<li><a href='$dom".$section["number"].'_'.$subsec["number"]."'>".$section["number"].".".$subsec["number"]." ".$subsec["title"]."</a></li>";
    }
    echo "</ul>";
}
if (empty($content) and !($content === 0)) {
  echo "<div class='disp-toc-header'>";
  echo "<h1>Part ".$meta["part"]." - ".$meta["course"];
  echo "<h2>Lectured by ".$meta["lecturer"].", ".$meta["term"]." ".$meta["year"]."</h2>";
  echo "</div>";
?>
<p>This is an HTML version of my notes, generated using some horribly-written scripts and <a href="https://github.com/coolwanglu/pdf2htmlEX">pdf2htmlEX</a>. These are not gauranteed to display well, but do let me know if something is broken. Note however that I cannot help you if your browser does not support standard HTML features (eg. this part is known not to work well with w3m). You can either view the full version, or access individual sections below. If you want to download a pdf, head to the <a href="/">Notes</a> page.</p>

<p>This is still sort-of experimental, and let me know if you have any suggestions for improvement.</p>
<?
  echo "<h1 class='disp-toc-head'>Contents</h1>";
  echo "<ul class='disp-toc'>";
  echo "<li><a href='$dom"."full'>V Full version</a></li>";
  foreach ($sections as $section) {
    echo "<li><a href='$dom".$section["number"]."'>".$section["number"]." ".$section["title"]."</a></li>";
    genSubToc($section);
  }
  echo "</ul>";
} else if ($inverse_list[$content]) {
  $section_numbers = explode("_", $content);
  foreach ($sections as $section) {
    if ($section["number"] == $section_numbers[0]) {
      $sec = $section;
    }
  }
  echo "<div class='disp-header'>";
  echo "<p class='disp-header-left'>".$sec["number"]."<span style='padding-left:10pt;'></span>".$sec["title"]."</p>";
  echo "<p class='disp-header-right'>".$meta["part"]." ".$meta["course"]."</p>";
  echo "</div>";
  echo "<hr /><br />";

  if ((@include("$term/$course"."_".$inverse_list[$content])) == FALSE) {
    echo "Unable to read contents"; 
  }

  if (strpos($content, "_") === false and !empty($sec["subsections"])) {
    echo "<h1 class='disp-toc-head'>Contents</h1>";
    genSubToc($sec);
  }
  echo "<div class='disp-nav'>";
  echo '<p class="disp-nav-left">';
  if (!empty($raw_list[$inverse_list[$content] - 1]) or $raw_list[$inverse_list[$content] - 1] === 0) {
    echo "<a href='$dom".$raw_list[$inverse_list[$content] - 1]."'>Previous</a>";
  }
  echo '</p>';

  echo '<p class="disp-nav-right">';
  echo "<a href='$dom'>Table of Contents</a>";
  echo "</p>";

  echo '<p class="disp-nav-right">';
  if (!empty($raw_list[$inverse_list[$content] + 1])) {
    echo '<a href="'.$raw_list[$inverse_list[$content] + 1].'">Next</a>';
  }
  echo "</p>";
  echo "</div>";
} else if ($content === "full") {
  include("$term/$course"."_full");
} else {
?>
  <p class="error-header">Error 404</p>
  <p class="error">You have probably done something bad.</p>
<?php
}
?>
<?php include "../footer.php"?>
