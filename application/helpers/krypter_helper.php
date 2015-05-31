<?php

	function krypter_encrypt($dec) {
		$krypter_list = Array(
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
			'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
			'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
			'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
			'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
			'Y', 'Z', '-', '_'
		)

		$hex_count = (int)count($krypter_list);

		$hexdemical = $dec;
		$hexdemical_result = 0;
		while($hexdemical >= $hex_count){
			$namerzi = $dec % $hex_count;
			$hexdemical_result .= $krypter_list[$namerzi];
			$hexdemical = (int)($hexdemical / $hex_count);
		}
		$hexdemical_result .= $krypter_encrypt[$hexdemical];

		return $hexdemical_result;
	}