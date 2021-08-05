<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use Redirect;

use Log;
use Info;
use App\User;
use App\Details;

class UserController extends Controller
{
     public function index(Request $request)
    {
    	 $user['teamlist'] = User::get();
    	 // dd($user['teamlist']['0']);
    	return view('home',$user);
    }

    public function teamsave(Request $request)
    {
        // dd($request->all());
        $data = $request->all();

        $validation = Validator::make($data, [
            'team_name' => ['required', 'string', 'max:100',],
            'lead_name' => ['required', 'string', 'max:100',],
         ]);
        // dd($validation->errors()->all());
        if($validation->fails()){
            // dd($validation->errors());
             return Redirect::back()->withErrors([$validation->errors()->all()]);
        }
        else{
            // dd(Booking::get());

            $user = User::create([
                'team_name' => $data['team_name'],
                'lead_name' => $data['lead_name'],
                'team_members' => '0',
            ]);
            // dd($user['id']);
            foreach ($data['team_members'] as $key => $value) {
                $details = Details::create([
                    'user_id' => $user['id'],
                    'team_members' => $value,
                    'status' => '1'
                ]);
            }

        }

        return Redirect::back();

    } 

}
