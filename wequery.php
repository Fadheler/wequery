$cnx = new mysqli("host", "user", "password", "database");
function wequery($q, $vars = "") {
	global $cnx;
	$stmt = $cnx->prepare($q);
	if($vars != "") {
		$e = explode("','", substr($vars, 1, strlen($vars)-2));
		$str = '$stmt->bind_param("'.$e[0].'"';
		for($i = 1; $i < sizeof($e); $i++) {
			if($e[0][$i-1] == "i")
				$str .=', intval($e['.$i.'])';
			else if($e[0][$i-1] == "d")
				$str .=', floatval($e['.$i.'])';
			else
				$str .=', $e['.$i.']';
		}
		$str .=');';
		eval($str);
	}
	$stmt->execute();
	if(substr($q, 0, 6) == "INSERT")
		$results = $stmt->insert_id;
	else
		$results = $stmt->get_result();
	$stmt->close();
	return $results;
}
