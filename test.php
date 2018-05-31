<?php

$orderCorrector = array(23,22);

echo $checkOutitems= implode(",", $orderCorrector);
print_r($idsims = explode(',', $checkOutitems));
echo $numsims = count($idsims);

for ($i=0; $i <= $numsims; $i++) { 

  // $sqlfinditems = "SELECT * FROM nfy_sims WHERE sims_id = $idsims[$numsims]";
	echo $idsims[$i];
  // $ritems = mysql_query($sqlfinditems);
  // while ($aitems = mysql_fetch_array($ritems)) {
  //   $emailsims[] = $aitems['sims_ber'];
  // }

}

?>