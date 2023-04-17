<?php

	function total_price($cart){
		$price = 0.0;
		if(is_array($cart)){
		  	foreach($cart as $ndc => $qty){
		  		$medicineprice = getmedicineprice($ndc);
		  		if($medicineprice){
		  			$price += $medicineprice * $qty;
		  		}
		  	}
		}
		return $price;
	}

	function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $ndc => $qty){
				$items += $qty;
			}
		}
		return $items;
	}
?>
