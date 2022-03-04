<?php


namespace App\Helpers;
use App\Business;
use App\User;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class UploadFiles
{


    public static  function vendorBusinessFile($file,$id)
    {
        try {
            $fileNameWithExt = $file->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $file->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $id.'_'.$filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = public_path("/uploads/business/vendors/reg/" . $fileNameToStore);
            if (file_exists($path)):
                return response()->json([
                    'success' => false,
                    'errors' => ['file' => ["Sorry a file with same name as $fileNameToStore exist, please rename your file"]],
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            $file->move(public_path("/uploads/business/vendors/reg/"), $fileNameToStore);
            return response()->json([
                'success' => true,
                'path' => $path,
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'errors' => ['err' => [$e->getMessage()]],
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public static function viewDocument($url)
    {

        return str_ireplace(["/var/www/mijengo/staging/mijengo/public",'D:\\MIJENGO\\mijengo_v3\\public\\'],['',''],$url);

    }
    public static  function businessEquipmentImage($file,$side)
    {
        try {
            $fileNameWithExt = $file->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $file->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $side.'_'.$filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = public_path("/uploads/business/vendors/equipments/$side/" . $fileNameToStore);
            if (file_exists($path)):
                return response()->json([
                    'success' => false,
                    'errors' => ['file' => ["Sorry a file with same name as $fileNameToStore exist, please rename your file"]],
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            $file->move(public_path("/uploads/business/vendors/equipments/$side/"), $fileNameToStore);
            return response()->json([
                'success' => true,
                'path' => $path,
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'errors' => ['err' => [$e->getMessage()]],
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
