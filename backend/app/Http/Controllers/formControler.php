<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerValidation;
use App\Http\Requests\updateValidation;
use App\Models\FormData;
use App\Models\User;
use App\Models\Stored_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\TempMail;
use App\Models\academicStoreModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\db;

class FormControler extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function show()
    {
        $formData = FormData::all();
        $result = [];

        foreach ($formData as $form) {
            $result[$form->children_class][$form->parentClassName][] = $form;
        }

        return response()->json(['data' => $result]);
    }

    public function store(registerValidation $request)
    {
         $validated = $request->validated();        
         

        function randomPassword()
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $pass = [];
            $alphaLength = strlen($alphabet) - 1;
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass);
        }
        $password = randomPassword();
        $user = new User();
        $user->name = $validated['Username'];
        $user->email = $validated['email'] ;
        $user->password = $password;
        $user->save();



        $toEmail = $validated['email'] ;
        $mains = 'Hello, your application has been submitted successfully. Your username is ' . $request->input('Name of applicant(Full name as in Matriculation certificate)') . ' and your password is ' . $password;
        $abhi = 'Your Application has been submitted successfully';

        Mail::to($toEmail)
            ->bcc('abhisheksaini9647@gmail.com')
            ->send(new TempMail($mains, $abhi));

        $storedData = new Stored_data();
      $name=  $storedData->Username = $validated['email'] ;
        $storedData->Roll_Number =$validated['Roll_Number'] ;
        $storedData->Neet_Score = $validated['Neet_Score'] ;
        $storedData->All_India_Rank = $validated['Rank'] ;
        $storedData->BFUHS_REGISTRATION_ID = $validated['Bfhus_Id'] ;
        $storedData->Father_Name = $validated['Father_Name'] ;
        $storedData->Mother_Name = $validated['Mother_Name'];
        $storedData->Dob = $validated['Dob'];
        $storedData->Gender = $validated['gender'];
        $storedData->Religion = $validated['religion'];
        $storedData->Member_Chruch = $validated['member'];
        $storedData->Duration_Membership = $validated['Duration_Membership'];
        $storedData->Date_Baptism = $validated['date_of_baptism'];
        $storedData->State = $validated['State'];
        $storedData->Address = $validated['Father_Name'];
        $storedData->Landline_Number = $validated['Landline_Number'];
        $storedData->Mobile = $validated['Mobile'];
        $storedData->Alternative = $validated['Alternative'];
        $storedData->email = $validated['email'];
        $storedData->course = $validated['course'];
        $storedData->save();
        return response()->json([
            'success' => 'Data has been saved successfully',
            'signal' => 200,
            
        ]);
    }

    public function update(request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|max:16|min:4|same:Confirm_password',
            'Confirm_password' => 'required|'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $mail = $request->input('email');
        $new = $request->input('password');
        $user = User::where('email', $mail)->first();
        $user->password = Hash::make($new);
        $user->save();
        $name = $user->email;
        $token = $user->createToken($name)->plainTextToken;
        return response()->json([
            'user' => "password Changed Successfully",
            'signal' => "200",
            'token' => $token,
            'email' => $mail
        ]);
    }

    public function login(request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4|max:16'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $mail = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $mail)->first();
        if (!$user) {
            return response()->json([
                'message' => "Email is not registered Please Check the email",
                'signal' => '400',
            ]);
        } else {
            $id = $user->id;
            if (hash::check($password, $user->password)) {
                $name = $user->email;
                $token = $user->createToken($name)->plainTextToken;
                return response()->json([
                    'message' => 'login successfully',
                    'signal' => '200',
                    'token' => $token,
                    'email' => $mail,
                ]);
            } else {
                return response()->json([
                    'message' => 'Wrong Psssword',
                    'signal' => '400'
                ]);
            }
        }
    }

    public function getData(request $request)
    {
        $mail = $request->input('mail');
        $email = Stored_data::where('email', $mail)->first();
        $emails = academicStoreModel::where('email', $mail)->first();
        if (!$email) {
            return  response()->json([
                'message' => 'email not found',

            ], 400);
        } else {
            return response()->json([
                'user' => $email,
                'academic' => $emails
            ]);
        }
    }
    public function updateData(updateValidation $request)
    {
        $validated = $request->validated();


        $update = DB::table('stored_datas')->updateOrInsert(
            ['email' => $request->input('email')],
            fn($exists) => $exists ? [
                'Username' => $validated['Username'],
                'Roll_Number' => $validated['Roll_Number'],
                'Neet_Score' =>  $validated['Neet_Score'],
                'All_India_Rank' =>   $validated['All_India_Rank'],
                'BFUHS_REGISTRATION_ID' =>  $validated['BFUHS_REGISTRATION_ID'],
                'Father_Name' =>  $validated['Father_Name'],
                'Mother_Name' =>  $validated['Mother_Name'],
                'Dob' =>  $validated['Dob'],
                'Gender' =>  $validated['Gender'],
                'Religion' =>  $validated['Religion'],
                'Member_Chruch' =>  $validated['Member_Chruch'],
                'Duration_Membership' =>  $validated['Duration_Membership'],
                'Date_Baptism' =>  $validated['Date_Baptism'],
                'State' =>  $validated['State'],
                'Landline_Number' =>  $validated['Landline_Number'],
                'Mobile' =>  $validated['Mobile'],
                'Alternative' =>  $validated['Alternative'],
                'email' =>  $validated['email'],
                'course' =>  $validated['course'],
            ] : [
                'Username' => $validated['Username'],
                'Roll_Number' => $validated['Roll_Number'],
                'Neet_Score' =>  $validated['Neet_Score'],
                'All_India_Rank' =>   $validated['All_India_Rank'],
                'BFUHS_REGISTRATION_ID' =>  $validated['BFUHS_REGISTRATION_ID'],
                'Father_Name' =>  $validated['Father_Name'],
                'Mother_Name' =>  $validated['Mother_Name'],
                'Dob' =>  $validated['Dob'],
                'Gender' =>  $validated['Gender'],
                'Religion' =>  $validated['Religion'],
                'Member_Chruch' =>  $validated['Member_Chruch'],
                'Duration_Membership' =>  $validated['Duration_Membership'],
                'Date_Baptism' =>  $validated['Date_Baptism'],
                'State' =>  $validated['State'],
                'Landline_Number' =>  $validated['Landline_Number'],
                'Mobile' =>  $validated['Mobile'],
                'Alternative' =>  $validated['Alternative'],
                'email' =>  $validated['email'],
                'course' =>  $validated['course'],
            ],
        );
        $updates = DB::table('academic_store_models')->updateOrInsert(
            ['email' => $request->input('email')],
            fn($exists) => $exists ? [
                'email' => $validated['email'],
                'board' => $validated['board'],
                'X_year' => $validated['X_year'],
                'X_State' => $validated['X_State'],
                'X_Marks' => $validated['X_Marks'],
                'XI_Board' => $validated['XI_Board'],
                'XI_year' => $validated['XI_year'],
                'XI_State' => $validated['XI_State'],
                'XI_Marks' => $validated['XI_Marks'],
                'XII_Marks' => $validated['XII_Marks'],
                'XII_Board' => $validated['XII_Board'],
                'XII_year' => $validated['XII_year'],
                'XII_State' => $validated['XII_State'],
                'updated_at' => Carbon::now(),
            ] : [
                'email' => $validated['email'],
                'board' => $validated['board'],
                'X_year' => $validated['X_year'],
                'X_State' => $validated['X_State'],
                'X_Marks' => $validated['X_Marks'],
                'XI_Board' => $validated['XI_Board'],
                'XI_year' => $validated['XI_year'],
                'XI_State' => $validated['XI_State'],
                'XI_Marks' => $validated['XI_Marks'],
                'XII_Marks' => $validated['XII_Marks'],
                'XII_Board' => $validated['XII_Board'],
                'XII_year' => $validated['XII_year'],
                'XII_State' => $validated['XII_State'],
            ]
        );

        return response()->json(['success' => 'Data updated successfully'], 200);
    }
    
    public function latest(){
        $user=DB::table('stored_datas')->latest('id')->first();
        return response()->json([
            'info'=>$user
        ]);
    }
}
