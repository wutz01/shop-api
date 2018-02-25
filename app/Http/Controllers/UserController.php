<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator, Auth, DB;

class UserController extends Controller
{
    public function authenticate (Request $request) {
      $email = $request->input('email');
    	$password = $request->input('password');

    	if(isset($email) && isset($password)){

    		if(Auth::attempt(['email'=> $email, 'password' => $password])){
          $user = Auth::user();
          $json['token'] = $user->createToken('Ordering')->accessToken;
          $json['user'] = $user;
          return response()->json($json, 200);
    		} else {
    			$json['error']	   = "Email / Password is incorrect.";
          return response()->json($json, 401);
    		}
    	} else {
    		$json['error']		= "Please enter email and password.";
        return response()->json($json, 400);
    	}
    }

    public function register (Request $request) {
      $message = [
    		'email.required' => 'Email Address is required.',
    		'required' => 'The :attribute field is required.'
    	];

      $client = $this->getClient($request->input('userType'));

      $rules = [
          'name'             => 'required',
          'email'		         => 'email|required|unique:users,email',
          'password'	       => 'required|min:6',
          'confirm_password' => 'required|same:password',
          'image'            => 'image',
          'address'          => 'required',
          'userType'         => 'required'
      ];

      if ($client == 'CLIENT') {
        $rules = array_merge($rules, [
          'contactPerson'    => 'required',
          'contactNumber'    => 'required',
          'designation'      => 'required'
        ]);
      }
  	  $validator = Validator::make($request->all(), $rules, $message);

      if ($validator->fails()) {
          $json['errors'] = $validator->messages();
          return response()->json($json, 401);
      }


    	$user = new User;
    	$user->name          = $request->input('name');
    	$user->email         = $request->input('email');
    	$user->password      = bcrypt($request->input('password'));
      $user->address       = $request->input('address');
      $user->contactPerson = $request->has('contactPerson') ? $request->input('contactPerson') : '';
      $user->contactNumber = $request->has('contactNumber') ? $request->input('contactNumber') : '';
      $user->designation   = $request->has('designation') ? $request->input('designation') : '';
      $user->userType      = $client;
    	$user->save();

      // $data = $request->all();
      // if($image = array_pull($data, 'image')){
      //     $destinationPath = 'uploads/users/' . $data['username'] . $user->id . '/';
      //
      //     if (!file_exists(public_path($destinationPath))) {
      //         mkdir(public_path($destinationPath), 0777, true);
      //     }
      //
      //     if($image->isValid()){
      //         $ext        = $image->getClientOriginalExtension();
      //         $filename   = $image->getFilename();
      //         $orig_name  = $image->getClientOriginalName();
      //
      //         $for_upload = $filename . "." . $ext;
      //         $is_success = $image->move(public_path($destinationPath), $for_upload);
      //
      //         if($is_success){
      //             $user->image_path    = $destinationPath;
      //             $user->filename      = $filename;
      //             $user->orig_filename = $orig_name;
      //             $user->extension     = $ext;
      //             $user->save();
      //         }
      //     }
      // }

    	$json['token'] = $user->createToken('Ordering')->accessToken;
      return response()->json($json, 200);
    }

    public function getClient($client) {
      $client = strtoupper($client);
      switch ($client) {
        case 'CLIENT': $client = 'CLIENT'; break;
        case 'SALES_AGENT': $client = 'SALES_AGENT'; break;
        case 'ADMIN': $client = 'ADMIN'; break;
        default: $client = 'CLIENT'; break;
      }

      return $client;
    }

    public function userLogout(Request $request) {
      $request->user()->token()->revoke();
      return response(null, 204);
    }

    public function getUserLogin () {
      $json['user'] = $user = Auth::user();
      return response()->json($json, 200);
    }

    public function getAllUsers () {
      $json['users'] = User::all();
      return response()->json($json, 200);
    }

    public function getUser ($id) {
      $json['user'] = User::find($id);
      return response()->json($json, 200);
    }

    public function updateUser (Request $request) {
      $message = [
    		'email.required' => 'Email Address is required.',
    		'required' => 'The :attribute field is required.'
    	];
      $userId = $request->input('userId');

      $client = $this->getClient($request->input('userType'));

      $rules = [
          'name'             => 'required',
          'email'		         => 'email|required|unique:users,email,'.$userId,
          'image'            => 'image',
          'address'          => 'required',
          'userType'         => 'required'
      ];

      if ($client == 'CLIENT') {
        $rules = array_merge($rules, [
          'contactPerson'    => 'required',
          'contactNumber'    => 'required',
          'designation'      => 'required'
        ]);
      }

  	  $validator = Validator::make($request->all(), $rules, $message);

      if (!isset($userId)) {
        $json['error'] = 'User not found';
        return response()->json($json, 400);
      }

      if ($validator->fails()) {
          $json['errors'] = $validator->messages();
          return response()->json($json, 401);
      }

    	$user = User::find($userId);
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
      $user->address       = $request->input('address');
      $user->contactPerson = $request->has('contactPerson') ? $request->input('contactPerson') : null;
      $user->contactNumber = $request->has('contactNumber') ? $request->input('contactNumber') : null;
      $user->designation   = $request->has('designation') ? $request->input('designation') : null;
      $user->userType      = $client;
    	$user->save();

      $json['user'] = $user;
      return response()->json($json, 200);
    }
}
