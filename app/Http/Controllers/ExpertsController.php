<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpertsController extends Controller
{
    //
    function register_expert(Request $request)
    {

        $check_email_exists = DB::table('experts')->where('email',$request->email)->exists();
        if($check_email_exists)
        {
            $response['error'] = true;
            $response['message'] = "That email already exists in the database.";
            echo json_encode($response);
        }
        else
        {
            $check_phone_exists = DB::table('experts')->where('pnumber',$request->pnumber)->exists();
            if($check_phone_exists)
            {
                $response['error'] = true;
                $response['message'] = "That phone number already exists in the database.";
                echo json_encode($response);
            }
            else
            {
                $register_expert = new Expert;
                $register_expert->fname = $request->fname;
                $register_expert->lname = $request->lname;
                $register_expert->pnumber = $request->pnumber;
                $register_expert->email = $request->email;
                $register_expert->email_verified = "N";
                $register_expert->save();
                $save = $register_expert->save();
                if($save)
                {
                    $response['error'] = false;
                    $response['message'] = "Registration successful!!";
                    echo json_encode($response);
                }
                else
                {
                    $response['error'] = true;
                    $response['message'] = "An error occured please contact the admin.";
                    echo json_encode($response);
                }
            }
        }
    }

    function verify_pnumber(Request $request)
    {
        $check_phone_exists = DB::table('experts')->where('pnumber',$request->pnumber)->exists();

        if($check_phone_exists)
        {
            $my_phone_exists = DB::table('experts')->where('pnumber',$request->pnumber)->first();
            $response['error'] = false;
            $response['message'] = "Phone number exists.";
            $response['id'] = $my_phone_exists->id;
            $response['fname']= $my_phone_exists->fname;
            $response['lname'] = $my_phone_exists->lname;
            $response['email'] = $my_phone_exists->email;
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "Phone number exists";
            echo json_encode($response);
        }
    }
}
