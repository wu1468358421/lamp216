<?php

	function changeArray($data, $filed = 'id'){
		$list = array();
		foreach ($data as $key => $value) {
			$list[$value[$filed]] = $value;
		}
		return $list;
	}
?>