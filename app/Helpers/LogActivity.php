<?php


namespace App\Helpers;
use Illuminate\Http\Request;
use App\LogActivity as LogActivityModel;


class LogActivity
{


    public static function addToLog($log_type,$description,$reference)
    {
        $log = [];
        $log['log_type'] = $log_type;
        $log['description'] = $description;
        $log['reference'] = $reference;
        $log['user_id'] = auth()->check() ? auth()->id() : "_";
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }


}
