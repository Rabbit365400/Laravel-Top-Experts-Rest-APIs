<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Award;
use App\Models\Specialization;
use App\Models\Review;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\Reply;
use App\Models\Job_applicant;
use App\Mail\Verify_email;
use Illuminate\Support\Facades\Mail;

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
                $register_expert->user_type = $request->user_type;
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
            $response['error'] = false;
            $response['message'] = "Phone number exists.";
            $my_phone_exists = DB::table('experts')->where('pnumber',$request->pnumber)->first();
            $response['id'] = $my_phone_exists->id;
            $response['fname']= $my_phone_exists->fname;
            $response['lname'] = $my_phone_exists->lname;
            $response['email'] = $my_phone_exists->email;
            $response['pnumber'] = $my_phone_exists->pnumber;
            $response['user_type'] = $my_phone_exists->user_type;
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "Phone number does not exist.";
            echo json_encode($response);
        }
    }

    function edit_basic_profile(Request $request)
    {
        $check_email_exists = DB::table('experts')->where('email',$request->email)->whereNot('id',$request->id)->exists();
        if($check_email_exists)
        {
            $response['error'] = true;
            $response['message'] = "That email already exists in the database.";
            echo json_encode($response);
        }
        else
        {
            $check_phone_exists = DB::table('experts')->where('pnumber',$request->pnumber)->whereNot('id',$request->id)->exists();
            if($check_phone_exists)
            {
                $response['error'] = true;
                $response['message'] = "That phone number already exists in the database.";
                echo json_encode($response);
            }
            else
            {
                $update = Expert::find($request->id);
                $update->fname = $request->fname;
                $update->lname = $request->lname;
                $update->pnumber = $request->pnumber;
                $update->email = $request->email;
                $save = $update->save();
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


    function get_profile_details(Request $request)
    {
        $profile_data = Expert::where('id',$request->id)->first();
        $response = array();
        $array = array();
        $subArray=array();
        return $profile_data;
    }

    function update_business_details(Request $request)
    {
        $update = Expert::find($request->id);
        $update->business_name = $request->business_name;
        $update->no_of_employees = $request->no_of_employees;
        $update->number_of_customers = $request->number_of_customers;
        $update->business_pnumber = $request->business_pnumber;
        $update->description = $request->description;
        $save = $update->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Details updated successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }

    //add branch
    function add_branch(Request $request)
    {
        $add_branch = new Branch;
        $add_branch->branch_name = $request->branch_name;
        $add_branch->expert = $request->expert;
        $add_branch->save();
        $save = $add_branch->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Branch added successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }

    //branches payload
    function branches_payload(Request $request)
    {
        $response = array();
        $array = array();
        $subArray=array();

        $branches_payload = DB::table('branches')->where('expert','=',$request->expert)->get();
        echo'{"branches":'.$branches_payload.'}';
    }

    //add awards
    function add_award(Request $request)
    {
        $add_award = new Award;
        $add_award->award = $request->award;
        $add_award->expert = $request->expert;
        $add_award->save();
        $save = $add_award->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Award added successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }

    //awards payload
    function awards_payload(Request $request)
    {
        $awards_payload = DB::table('awards')->where('expert','=',$request->expert)->get();
        echo'{"awards":'.$awards_payload.'}';
    }

    //update experience
    function update_experience(Request $request)
    {
        $experience = Expert::find($request->id);
        $experience->years_of_experience = $request->years_of_experience;
        $experience->licensed = $request->licensed;
        $experience->save();
        $save = $experience->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Experience added successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }

    //get specialization
    function get_specializations()
    {
        $specs = Specialization::all();
        echo'{"specs":'.$specs.'}';
    }
    //update career
    function update_career(Request $request)
    {
        $career = Expert::find($request->id);
        $career->area_of_expertise = $request->area_of_expertise;
        $career->save();
        $save = $career->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Area of expertise added successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }

    //get experts payload
    function get_experts()
    {
        $experts_payload = DB::table('experts')->where('user_type','=','Expert')->get();
        echo'{"experts":'.$experts_payload.'}';
    }

    //post expert review
    function post_review(Request $request)
    {
        date_default_timezone_set('Africa/Nairobi');
        $mobile_create_date = date("d-m-Y");
        $post_review = new Review;
        $post_review->expert = $request->expert;
        $post_review->reviewer = $request->reviewer;
        $post_review->rating = $request->rating;
        $post_review->remarks = $request->remarks;
        $post_review->rating_category = $request->rating_category;
        $post_review->added_at = $mobile_create_date;
        $post_review->seen = "N";
        $post_review->save();
        $save = $post_review->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Review submitted successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }

    }

    //get reviews
    function get_reviews(Request $request)
    {
        $reviews_payload = DB::table('reviews')->select('reviews.id','experts.fname','experts.lname','reviews.reviewer','reviews.expert','reviews.rating','reviews.remarks','reviews.added_at')->join('experts','reviews.reviewer','=','experts.id')->where('expert','=',$request->expert)->get();
        echo'{"reviews":'.$reviews_payload.'}';
    }

    //get review count
    function review_count(Request $request)
    {
        $reviews_count = Review::where('expert',$request->expert)->where('seen','N')->count();
        $response['review_counts'] = $reviews_count;
        echo json_encode($response);

    }


    //get avg
    function get_avg(Request $request)
    {    $reviews_count = Review::where('expert',$request->expert)->count();

        $avg_stars = Review::Where('expert',$request->expert)->pluck('rating')->avg();
        $response['review_counts'] = $reviews_count;
        $response['average'] = $avg_stars;
        echo json_encode($response);
    }

    //clear review counts
    function clear_reviews_count(Request $request)
    {
        $update = Review::where('expert', $request->expert)->update(['seen' =>'Y']);
    }

    //post job
    function post_job(Request $request)
    {
        $post_job = new Job;
        $post_job->job_title = $request->job_title;
        $post_job->company = $request->company;
        $post_job->job_category = $request->job_category;
        $post_job->looking_for = $request->looking_for;
        $post_job->what_we_offer = $request->what_we_offer;
        $post_job->posted_by = $request->posted_by;
        $post_job->status = "Pending";
        $save = $post_job->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Job submitted successfully.";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }

    }

    //display jobs
    function display_jobs(Request $request)
    {
        $get_jobs = DB::table('jobs')->select('jobs.id','jobs.company','jobs.job_category','jobs.status','jobs.looking_for','jobs.what_we_offer','specializations.specialization','jobs.posted_by')->where('posted_by',$request->expert)->join('specializations','jobs.job_title','=','specializations.id')->get();
        echo'{"jobs":'.$get_jobs.'}';
    }

    //display all jobs
    function display_all_jobs()
    {
        $get_jobs = DB::table('jobs')->select('jobs.id','jobs.company','jobs.job_category','jobs.status','jobs.looking_for','jobs.what_we_offer','specializations.specialization','jobs.posted_by')->join('specializations','jobs.job_title','=','specializations.id')->get();
        echo'{"jobs":'.$get_jobs.'}';
    }

    //upload cv
    function post_cv(Request $request)
    {
        if($request->hasFile('cv'))
        {
            $file = $request->file('cv');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.'.$extension;
            $file->move('cvs',$filename);
        }
        else
        {
            $filename = "N";
        }

        $post = new Job_applicant;
        $post->job_id = $request->job_id;
        $post->applicant = $request->applicant;
        $post->cv = $filename;
        $post->save();
        $save = $post->save();
        if($save)
        {
            echo "<h3>Job applied successfully!</h3>";
        }
        else
        {

        }
    }

    //verify applicant

    function verify_applicant(Request $request)
    {
        $check_application = DB::table('job_applicants')->where('job_id',$request->job_id)->where('applicant',$request->applicant)->exists();
        if($check_application)
        {
            $response['error'] = true;
            $response['message'] = "Continue...";
            echo json_encode($response);
        }
        else
        {
            $response['error'] = false;
            $response['message'] = "Continue...";
            echo json_encode($response);
        }
    }

    //Register FCM Token
    function register_fcm_token(Request $request)
    {
        $update = Expert::find($request->id);
        $update->fcm_token = $request->fcm_token;
        $update->save();
    }

    //Register Email Token
    function register_email_token(Request $request)
    {
        $update = Expert::find($request->id);
        $update->email_token = $request->email_token;
        $update->save();
        $save = $update->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Job submitted successfully.";
            $response['email_token'] = $request->email_token;
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }


    //function search expert
    function search_expert(Request $request)
    {
        $experts_payload = DB::table('experts')->where('user_type','=','Expert')->where('fname','=',$request->fname)->get();
        echo'{"experts":'.$experts_payload.'}';
    }

    //function update location

    function update_location(Request $request)
    {
        $update = Expert::find($request->id);
        $update->location = $request->location;
        $update->lat = $request->lat;
        $update->lng = $request->lng;
        $update->save();
    }

    //upload photo

    function post_photo(Request $request)
    {
        //$request->validate(['photo' => 'required|mimes:png,jpg,jpeg|max:2048']);
        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.'.$extension;
            $file->move('photos',$filename);
        }
        else
        {
            $filename = "N";
        }

        $update = Expert::find($request->user_id);
        $update->photo = $filename;
        $update->save();
        $save = $update->save();
        if($save)
        {
            return redirect()->back()->with('success','Photo Uploaded Successfully!!');
        }
        else
        {
            return redirect()->back()->with('error','Something went wrong while uploading photo!');

        }


    }

    //post reply

    function post_reply(Request $request)
    {
        $post = new Reply;
        $post->review = $request->review;
        $post->replied_by = $request->replied_by;
        $post->reply = $request->reply;
        $post->save();
        $save = $post->save();
        if($save)
        {
            $response['error'] = false;
            $response['message'] = "Reply submitted successfully.";
            $response['email_token'] = $request->email_token;
            echo json_encode($response);
        }
        else
        {
            $response['error'] = true;
            $response['message'] = "An error occured please contact the admin.";
            echo json_encode($response);
        }
    }

    //display replies
    function display_replies(Request $request)
    {
        $replies_payload = DB::table('replies')->select('replies.id','replies.replied_by','replies.reply','replies.review','experts.fname','experts.lname')->where('review','=',$request->review)->join('experts','replies.replied_by','=','experts.id')->get();
        echo'{"replies":'.$replies_payload.'}';
    }


}
