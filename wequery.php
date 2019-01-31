$cnx = new mysqli("host", "user", "password", "database");
function wequery($q, $vars = "") {
	global $cnx;
	$stmt = $cnx->prepare($q);
	if($vars != "") {
		$e = explode(',', $vars);
		$str = '$stmt->bind_param("'.$e[0].'"';
		for($i = 1; $i < sizeof($e); $i++) {
			if($e[0][$i-1] == "i")
				$str .=', intval($e['.$i.'])';
			else if($e[0][$i-1] == "d")
				$str .=', floatvar($e['.$i.'])';
			else
				$str .=', $e['.$i.']';
		}
		$str .=');';
		eval($str);
	}
	$stmt->execute();
	$results = $stmt->get_result();
	$stmt->close();
	return $results;
}
