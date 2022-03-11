<?php


namespace App\Helpers;
use App\Business;
use App\User;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class GeneralFunctions
{


    public static  function getMonths($start_date,$end_date)
    {
        try {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $start_date);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $end_date);
            return $to->diffInMonths($from);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public static  function getDays($start_date,$end_date)
    {
        try {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $start_date);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $end_date);
            return $to->diffInDays($from);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
