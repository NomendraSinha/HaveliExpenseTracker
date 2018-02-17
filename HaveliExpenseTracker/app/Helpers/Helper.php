<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;
 
class Helper {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function get_per_diff($last,$current) {
    	$percent_diff = 0;
    	if($current != 0){
    		$percent_diff = (($current-$last)/$current)*100;
    		$percent_diff = round($percent_diff,2);
    	}
        return round($percent_diff,2);
    }
}