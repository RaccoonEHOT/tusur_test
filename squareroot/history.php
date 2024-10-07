<?php
declare(strict_types=1);
require_once(__DIR__.'/../../config.php');
global $DB, $USER, $CFG;
$PAGE->set_url(new moodle_url('/blocks/squareroot/history.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title("Solver history");

echo $OUTPUT->header();

$sql = "SELECT * FROM mdl_block_historysqareroot WHERE user_id = $USER->id";
$result = $DB->get_records_sql($sql);

$table = "<style>
            .table-result>tbody>tr>th,
            .table-result>tbody>tr>td
            {
            border: 2px solid;
            }
          </style>";

$table .= "<div style='display:flex; justify-content:center;'>";

$table .= "<table class = 'table-result' style='width:50%; text-align:center;'><tbody>";
$table .= "<tr>
            <th>Result</th>
            <th>a</th>
            <th>b</th>
            <th>c</th>
            <th>X1</th>
            <th>X2</th>
          </tr>
";
foreach ($result as $res){
  $table .= "<tr>
            <td>".$res->result."</td>
            <td>".$res->a."</td>
            <td>".$res->b."</td>
            <td>".$res->c."</td>
            <td>".$res->x1."</td>
            <td>".$res->x2."</td>
          </tr>
";
}

$table .= "</tbody></table>";
$table .= "</div>";

echo $table;

echo $OUTPUT->footer();

?>