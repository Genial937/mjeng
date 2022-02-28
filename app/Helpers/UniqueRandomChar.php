<?php


namespace App\Helpers;
use App\Business;
use App\User;
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
    public static function otpCode()
    {
        try {
            for ($i = 100001; $i <= 999999; $i++):
                $code = sprintf("%06d", mt_rand(1, 999999));
                $user = User::where('otp', $code)->first();
                if (empty($user)):
                    break 1;
                endif;
            endfor;
            return $code;
        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }

}
