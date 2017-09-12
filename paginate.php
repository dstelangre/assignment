
          <?php
          function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<span>" . $prevlabel . "</span>\n";
    } elseif ($page == 2) {
        $out.= "<ul class='pagination'><li><a  href=\"" . $reload . "\">" . $prevlabel . "</a>\n</li></ul>";
    } else {
        $out.= "<ul class='pagination'><li><a  href=\"" . $reload . "&amp;page=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li></ul>";
    }

    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<ul class='pagination'><li  class=\"active\"><a href=''>" . $i . "</a></li></ul>";
        } elseif ($i == 1) {
            $out.= "<ul class='pagination'><li><a  href=\"" . $reload . "\">" . $i . "</a>\n</li></ul>";
        } else {
            $out.= "<ul class='pagination'><li><a  href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a></li></ul>";
        }
    }

    if ($page < ($tpages - $adjacents)) {
        $out.= "<ul class='pagination'><li><a  href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $tpages . "</a></li></ul>";
    }
    // next
    if ($page < $tpages) {
        $out.= "<ul class='pagination'><li><a  href=\"" . $reload . "&amp;page=" . ($page + 1) . "\">" . $nextlabel . "</a></li></ul>";
    } 
    $out.= "";
    return $out;
}
?>

  