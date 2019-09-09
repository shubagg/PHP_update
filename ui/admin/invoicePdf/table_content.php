<?php
include 'excel_reader.php';     // include the class
$file_path=$_POST['path'];
// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read($file_path);
function sheetData($sheet) {
  $re = '<table  cellspacing="0" border="0" class="table table-striped no-footer dataTable">';     // starts html table

  $x = 1;
  while($x <= $sheet['numRows']) {
    $re .= "<tr>\n";
    $y = 1;
    while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      $re .= " <td class='tdclass drag'>$cell</td>\n";  
      $y++;
    }  
    $re .= "</tr>\n";
    $x++;
  }

  return $re .'</table>';     // ends and returns the html table
}

$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';              // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$nr_sheets; $i++) {
  $excel_data .= sheetData($excel->sheets[$i]) .'<br/>';  
}
?>
<?php
// displays tables with excel file data
echo $excel_data;
?>