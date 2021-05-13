<?php

    namespace App\Http\Controllers;

    use App\User;
    use App\Http\Requests\ProfileRequest;
    use Maatwebsite\Excel\Facades\Excel;
    use App\Exports\UserExport;
    use App\Repositories\UserRepository;
    use Mail;

class UserController extends Controller
{
    //view list user
    public function index()
    {
        $listUsers = User::orderBy('status','DESC')->orderBy('user_name')->paginate(15);
        return view('admin/user_manage/list',['user'=> $listUsers]);
    }

    //view page add user
    public  function getAdd()
    {
        return view('admin/user_manage/add');
    }

    //add user
    public function postAdd(ProfileRequest $request)
    {
        UserRepository::add($request);
        return redirect('admin/user_manage/add')
            ->with('global','User "'.$request->username.'" has been added !');
    }

    //view page edit user
    public function getEdit($id)
    {
        $findUser = User::find($id);
        return view('admin/user_manage/edit',['user'=> $findUser]);
    }

    //edit user
    public static function postEdit(ProfileRequest $request, $id)
    {
        UserRepository::edit($request, $id);

        return redirect('admin/user_manage/list')
            ->with('global','User "'.$request->username.'" was changed !');
    }

    //delete user
    public function getDelete($id)
    {
        UserRepository::delete($id);
        return redirect('admin/user_manage/list')->with('global','User was delete !');
    }

    //export user
    public function getExport()
    {
        return Excel::download(new UserExport, 'list_user.xls');
        return back();
    }
}
