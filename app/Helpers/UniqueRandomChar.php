<?php


namespace App\Helpers;
use App\Business;
use Illuminate\Database\QueryException;



class UniqueRandomChar
{


    public static  function businessCode()
    {
        try {
            for ($i = 100001; $i <= 999999; $i++):
                $code = "BC".sprintf("%06s", $i);
                $business = Business::where('business_code', $code)->first();
                if (empty($business)):
                    break 1;
                endif;
            endfor;
            return $code;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }


}
