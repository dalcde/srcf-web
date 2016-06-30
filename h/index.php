<?php 
$ALIASES = array(
  "de" => array("IA_M", "differential_equations"),
  "vm" => array("IA_M", "vectors_and_matrices"),
  "vc" => array("IA_L", "vector_calculus"),
  "ca" => array("IB_L", "complex_analysis"),
  "cm" => array("IB_L", "complex_methods"),
  "em" => array("IB_L", "electromagnetism"),
  "grm" => array("IB_L", "groups_rings_and_modules"),
  "la" => array("IB_M", "linear_algebra"),
  "na" => array("IB_L", "numerical_analysis"),
  "stat" => array("IB_L", "statistics"),
  "vp" => array("IB_E", "variational_principles"),
  "lst" => array("II_L", "logic_and_set_theory"),
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

function lookupSec($secno) {
  global $sections;
  $s = explode("_", $secno);
  foreach ($sections as $section) {
    if ($section["number"] === $s[0]) {
      return $section;
    }
  }
  return NULL;
}
function lookupObj($secno) {
  global $sections;
  $s = explode("_", $secno);
  $section = lookupSec($secno);
  if (count($s) > 1) {
    foreach ($section["subsections"] as $subsec) {
      if ($subsec["number"] === $s[1]) {
        return $subsec;
      }
    }
    return NULL;
  } else {
    return $section;
  }
}
$TEXORPDFSTRING = '%\\\\texorpdfstring(\{(?:[^\{\}]+|(?1)+)*+\})\{([^\}]*)\}%';
while (($line = fgets($handle)) !== false) {
  $matches = array();
  if (preg_match('/\\\\setcounter\{section\}\{([-0-9]*)\}/', $line, $matches)) {
    $sec_count = $matches[1];
  } else if (preg_match('/\\\\setcounter\{subsection\}\{([0-9]*)\}/', $line, $matches)) {
    $subsec_count = $matches[1];
  } else if (preg_match('/\\\\section\{(.*)\}/', $line, $matches)) {
    $sec_count ++;
    $sec_name = preg_replace($TEXORPDFSTRING, '\2', $matches[1]);
    $subsec_count = 0;
    $sections[] = array("title" => $sec_name,
                        "number" => (string) $sec_count,
                        "fullno" => $sec_count,
                        "fulluno" => $sec_count,
                        "subsections" => array());
    $raw_count ++;
    $inverse_list[$sec_count] = $raw_count;
    $raw_list[$raw_count] = $sec_count;
  } else if (preg_match('/\\\\subsection\{(.*)\}/', $line, $matches)) {
    $subsec_count ++;
    $subsec_name = preg_replace($TEXORPDFSTRING, '\2', $matches[1]);
    $fulluno = $sec_count."_".$subsec_count;
    $sections[count($sections) - 1]["subsections"][] = array(
      "title" => $subsec_name,
      "number" => (string) $subsec_count,
      "fullno" => $sec_count.".".$subsec_count,
      "fulluno" => $fulluno);
    $raw_count ++;
    $inverse_list[$fulluno] = $raw_count;
    $raw_list[$raw_count] = $fulluno;
  } else if (preg_match('/\\\\def\\\\n([a-z]*) *\\{(.*)\\}/', $line, $matches)) {
    $meta[$matches[1]] = $matches[2];
  }
}
fclose($handle);

function genSubToc($section) {
    global $dom;
    echo "<ul class='disp-toc-sub'>";
    foreach ($section["subsections"] as $subsec) {
      echo sprintf("<li><a href='%s%s_%s'>%s.%s %s</a></li>\n",
        $dom, $section["number"], $subsec["number"],
        $section["number"], $subsec["number"], $subsec["title"]);
    }
    echo "</ul>";
}
if (empty($content) and !($content === "0")) {
  $title = $meta["part"]." ".$meta["course"];
  include "../header.php";
  echo sprintf(<<<EOT
<div class='disp-toc-header'>
  <h1>Part %s - %s</h1>
  <h2>Lectured by %s, %s %s</h2>
</div>

<p>This is an HTML version of the notes, generated using some horribly-written scripts and <a href="https://github.com/coolwanglu/pdf2htmlEX">pdf2htmlEX</a>. These are not guaranteed to display well, but do let me know if something is broken. Note however that I cannot help you if your browser does not support standard HTML features (eg. this part is known not to work well with w3m). You can either view all sections in a single page (Full version), or access individual sections below. If you want to download a pdf, head to the <a href="/">Notes</a> page.</p>

<h1 class='disp-toc-head'>Contents</h1>
<ul class='disp-toc'>
  <li><a href='%sfull'>V Full version</a></li>
EOT
, $meta["part"], $meta["course"], $meta["lecturer"], $meta["term"], $meta["year"] , $dom);
  foreach ($sections as $section) {
    echo "<li><a href='$dom".$section["number"]."'>".$section["number"]." ".$section["title"]."</a></li>\n";
    genSubToc($section);
  }
  echo "</ul>";
} else if ($inverse_list[$content]) {
  $sec = lookupSec($content);
  $title = $meta["part"]." ".$meta["course"]." - ".$sec["title"];
  include "../header.php";
  echo sprintf(<<<EOT
<div class='disp-header'>
<p class='disp-header-left'>%s<span style='padding-left:10pt;'></span>%s</p>
<p class='disp-header-right'>%s %s</p>
</div>
<hr /><br />
EOT
, $sec["number"], $sec["title"], $meta["part"], $meta["course"]);

  if ((@include("$term/$course"."_".$inverse_list[$content])) == FALSE) {
    echo "Unable to read contents"; 
  }

  if (strpos($content, "_") === false and !empty($sec["subsections"])) {
    echo "<h1 class='disp-toc-head'>Contents</h1>";
    genSubToc($sec);
  }

  echo <<<EOT
<nav class='disp-nav'>
<p class='disp-nav-left'>
EOT;

  $prev = lookupObj($raw_list[$inverse_list[$content] - 1]);
  if ($prev !== NULL) {
    echo "<a rel='prev' href='$dom".$prev["fulluno"]."' title='".$prev["fullno"]." ".$prev["title"]."'>&lt; ".$prev["fullno"]."</a>";
  }

  echo sprintf(<<<EOT
</p>
<p class="disp-nav-center">
<a href='%s'>Table of Contents</a>
</p>
<p class="disp-nav-right">
EOT
, $dom);

  $next = lookupObj($raw_list[$inverse_list[$content] + 1]);
  if ($next !== NULL) {
    echo "<a rel='next' href='$dom".$next["fulluno"]."' title='".$next["fullno"]." ".$next["title"]."'>".$next["fullno"]." &gt;</a>";
  }
  echo <<<EOT
</p>
</nav>
EOT;
} else if ($content === "full") {
  $title = $meta["part"]." ".$meta["course"]." (Full)";
  include "../header.php";
  echo <<<EOT
EOT;
  include("$term/$course"."_full");
} else {
  echo <<<EOT
<p class="error-header">Error 404</p>
<p class="error">You have probably done something bad.</p>
EOT;
}

include "../footer.php"?>
