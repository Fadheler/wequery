$cnx = new mysqli("host", "user", "password", "database");
function wequery($q, $vars) {
	global $cnx;
	$stmt = $cnx->prepare($q);
	$e = explode(',', $vars);
	$str = '$stmt->bind_param("'.$e[0].'"';
	for($i = 1; $i < sizeof($e); $i++) {
		if($e[0][$i] == "i")
			$str .=', intval($e['.$i.'])';
		else if($e[0][$i] == "d")
			$str .=', floatvar($e['.$i.'])';
		else
			$str .=', $e['.$i.']';
	}
	$str .=');';
	echo $str;
	eval($str);
	$stmt->execute();
	$stmt->store_result();
	$meta = $stmt->result_metadata();
	$nrows = $stmt->num_rows;
	$stmt->close();
	return $meta;
}
