<?php
function appendToFile($filename, $content) {
	shell_exec("sudo remount");
	if(file_exists($filename)) {
		$decoded = (array) json_decode(file_get_contents($filename), false);
		array_push($decoded, $content);
		$content = $decoded;
	} else {
		$content = [$content];
	}
	file_put_contents($filename, json_encode($content));
	shell_exec("sudo remount ro");
}

function deleteFile($filename) {
	shell_exec("sudo remount");
	unlink($filename);
	shell_exec("sudo remount ro");
}

function getFileContents($filename) {
	if(!file_exists($filename)) {
		return "{}";
	}
	return file_get_contents($filename);
}

if(!empty($_GET["type"])) {
	switch($_GET["type"]) {
		case "adblue":
			switch($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					$adblueFillList = getFileContents("adblue.json");
					if(empty($_GET["mileage"])) {
						header("Content-Type: application/json");
						echo $adblueFillList == "{}" ? "[]" : $adblueFillList;
					} else {
						$consumption = 1;
						$adblueFillList = json_decode($adblueFillList, false);
						if(count((array)$adblueFillList) < 1) {
							echo json_encode(["error" => 1]);
							return;
						}
						if(count($adblueFillList) > 2) {
							$lastFourFills = array_slice($adblueFillList, -4, 4, false);
							$consumptionList = [];
							foreach($lastFourFills as $index => $fill) {
								if($index == count($lastFourFills) - 1) {
									break;
								}
								$consumptionForTrip = 1;
								if(((array)$lastFourFills[$index+1])["liters"] != null) {
									$mileageBetween = ((array)$lastFourFills[$index+1])["mileage"] - ((array)$lastFourFills[$index])["mileage"];
									$consumptionForTrip = ((array)$lastFourFills[$index+1])["liters"] / ($mileageBetween/1000);
								
								}
								array_push($consumptionList, $consumptionForTrip);
							}
							sort($consumptionList);
							$consumption = $consumptionList[(int)count($consumptionList)/2];
						}
						$sinceLastFill = ($_GET["mileage"] - ((array)$adblueFillList[count($adblueFillList)-1])["mileage"]);
						$remaining = 17 - ($sinceLastFill / 1000) * $consumption;
						
						$output = round($remaining, 2);
						echo $output;
						/*$output = [
							"sinceLastFill" => round($sinceLastFill),
							"remaining" => round($remaining, 2),
							"consumption" => round($consumption, 2)
						];
						header("Content-Type: application/json");
						echo json_encode($output);*/
					}
					return;
				case 'POST':
					$toWrite = [
						"mileage" => $_POST["mileage"],
						"liters" => $_POST["liters"],
					];
					appendToFile("adblue.json", $toWrite);
					echo '{}';
					return;
				case 'DELETE':
					deleteFile("adblue.json");
					echo '{}';
					return;
			}
			return;
	}
}

echo "{}";
return;
?>

