<?php 
	function pingAddress($ip){
		$pingresult = shell_exec("ping $ip -n 4");
		$dead_dhu = "Destination host unreachable.";
		$dead_rto = "Request timed out.";
		$deadoralive_dhu = strpos( $pingresult, $dead_dhu );
		$deadoralive_rto = strpos( $pingresult, $dead_rto );
		
		if($deadoralive_dhu == false && $deadoralive_rto == false ){ 
		echo "<td > ALIVE </td>"; 
		} else { 
		echo "<td class='bg-red blink_me'> DOWN!!! </td>"; 
		}
	} 