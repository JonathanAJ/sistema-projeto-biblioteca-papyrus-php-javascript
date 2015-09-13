<?php

	$dias = $_POST['dias'];
	echo date('d/m/Y', strtotime('+'.$dias.' days'));

?>