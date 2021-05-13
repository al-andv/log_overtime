<?php
namespace App\Repositories;

use App\Attendence;
use App\Overtime;
use App\User;
use Mail;

class UserRepository
{
    static function add($request)
    {
        $addUser = new User();
        $addUser->user_name = $request->username;
        $addUser->password = bcrypt($request->password);
        $addUser->email = $request->email;
        $addUser->position = $request->position;
        $addUser->role = $request->role;
        $addUser->picture = "default-150x150.png";
        $addUser->save();

        Mail::send('admin/user_manage/mail',
            [
                'username' => $request->username,
                'password' => $request->password,
                'email' =>$request->email
            ],
            function ($message) use ($request){
                $message->from('andinh.da@gmail.com');
                $message->to($request->email);
            }
        );
    }

    static function edit($request, $id)
    {
        $listUsers = User::all();
        $updateUser = User::find($id);
        $username = $request->username;
        $fullname = $request->fullname;
        $email = $request->email;
        $position = $request->position;
        $phone = $request->phone_number;
        $role = $request->role;
        $error = [];
        foreach ($listUsers as $us) {
            if ($us->id != $id) {
                if ($us->user_name == $username) {
                    $error[] = "Username already exist !";
                }
                if (isset($fullname)) {
                    if ($us->full_name == $fullname) {
                        $error[] = "Fullname already exist !";
                    }
                }
                if ($us->email == $email) {
                    $error[] = "Email already exist !";
                }
            }
        }
        if (isset($request->picture)) {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $extensionAvatar = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension,$extensionAvatar);
                if (!$check) {
                    $error[] = 'Choose file of type: "jpg, jpeg, png, gif".';
                } else {
                    $picture = $file->getClientOriginalName();
                    $updateUser->picture = $picture;
                }
            }
        }
        if (count($error) > 0) {
            $user['user_name'] = $username;
            $user['full_name'] = $fullname;
            $user['id'] = $id;
            $user['email'] = $email;
            $user['position'] = $position;
            $user['phone_number'] = $phone;
            $user['picture'] = $request->picture_old;
            $user['role'] = $role;
            return view('admin/user_manage/edit', ['userEdit' => $user, 'error' => $error]);
        }

        $updateUser->full_name = $fullname;
        $updateUser->user_name = $username;
        if ($request["changePassword"] == "on") {
            $updateUser->password = bcrypt($request->password);
        }
        $updateUser->email = $email;
        $updateUser->position = $position;
        $updateUser->role = $role;
        $updateUser->phone_number = $phone;
        $updateUser->save();
    }

    static function delete($id)
    {
        $findUser = User::find($id);
        $findOT = Overtime::where('user_id', $id)->get();
        if (isset($findOT[0]->id)) {
            Overtime::where('user_id',$id)->delete();
        }
        $findOff = Attendence::where('user_id', $id)->get();
        if (isset($findOff[0]->id)) {
            Attendence::where('user_id',$id)->delete();
        }
        $findUser->delete();
    }

    static function editUser($request, $id)
    {
        $listUsers = User::all();
        $updateUser = User::find($id);
        $username = $request->username;
        $fullname = $request->fullname;
        $email = $request->email;
        $error = [];
        foreach ($listUsers as $us) {
            if ($us->id != $id) {
                if ($us->user_name == $username) {
                    $error[] = "Username already exist !";
                }
                if (isset($fullname)) {
                    if ($us->full_name == $fullname) {
                        $error[] = "Fullname already exist !";
                    }
                }
                if ($us->email == $email) {
                    $error[] = "Email already exist !";
                }
            }
        }
        if (count($error) > 0) {
            $user['user_name'] = $username;
            $user['full_name'] = $fullname;
            $user['id'] = $id;
            $user['email'] = $email;
            return view('page/profile/edit', ['user' => $user, 'error' => $error]);
        }

        $updateUser->full_name = $fullname;
        $updateUser->user_name = $username;
        if ($request["changePassword"] == "on") {
            $updateUser->password = bcrypt($request->password);
        }
        $updateUser->email = $email;
        $updateUser->position = $request->position;
        $updateUser->role = "0";
        $updateUser->phone_number = $request->phone_number;
        if (isset($request->picture)) {
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $extensionAvatar = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension,$extensionAvatar);
                if (!$check) {
                    $error[] = 'Choose file of type: "jpg, jpeg, png, gif".';
                } else {
                    $picture = $file->getClientOriginalName();
                    $updateUser->picture = $picture;
                }
            }
        }
        $updateUser->save();
    }
}
