<?php

namespace App\Http\Controllers\UserControllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AthleticType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserClientController extends Controller
{



    public function details(Request $request)
    {
        $user = new User();
        $title = "Add Client";
        if ($request->id) {
            $title = "Edit Client";
            $user = User::find($request->id);
        }
        $athletic_types = AthleticType::all();
        return view('N10Pages.UserPages.UserClient.form', compact('athletic_types', 'user', 'title'));
    }

    public function info(Request $request)
    {
        $user = new User();
        if ($request->id) {
            $title = "Edit Client";
            $user = User::find($request->id);
        }
        return view('N10Pages.UserPages.UserClient.info', compact('user'));
    }


    public function view($id)
    {

        $user = new User();
        $page_heading = 'Client';
        $sub_page_heading = collect(['User', 'Client']);
        if ($id) {
            $user = User::find($id);
        }

        $all_users = User::where('user_type', 'user')->get();
        return view('N10Pages.UserPages.UserClient.view', compact(
            'user',
            'sub_page_heading',
            'page_heading',
            'all_users'
        ));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $user = new User();
        $page_heading = 'Profile';
        $sub_page_heading = collect(['User', 'Client']);
        if ($id) {
            $user = User::find($id);
        }

        $all_users = User::where('user_type', 'user')->get();
        return view('N10Pages.UserPages.UserClient.view', compact(
            'user',
            'sub_page_heading',
            'page_heading',
            'all_users'
        ));
    }


    public function store(Request $request)
    {
        if (isset($request->id)) {
            request()->validate(User::editRules($request->id));
            $user = User::find($request->id);
            if ($request->password != null) {
                $password = Hash::make($request->password);
                if ($request->hasFile('avatar')) {
                    $newavatar = $this->updateprofile($request, 'avatar');
                    unset($request['avatar']);
                    $user->update(array_merge($request->all(), ['password' => $password, 'avatar' => $newavatar]));
                } else if ($request->avatar_remove == 1) {
                    $user->update(array_merge($request->all(), ['password' => $password, 'avatar' => null]));
                } else {
                    $user->update(array_merge($request->all(), ['password' => $password]));
                }
            } else {
                unset($request['password']);
                if ($request->hasFile('avatar')) {
                    $newavatar = $this->updateprofile($request, 'avatar');
                    unset($request['avatar']);
                    $user->update(array_merge($request->all(), ['avatar' => $newavatar]));
                } else if ($request->avatar_remove == 1) {
                    $user->update(array_merge($request->all(), ['avatar' => null]));
                } else {
                    $user->update(array_merge($request->all()));
                }
            }

            return response()->json(['success' => true, 'msg' => 'User Edit Complete']);
        } else {
            request()->validate(User::createRules());
            $newavatar = $this->updateprofile($request, 'avatar');
            unset($request['avatar']);
            $user = null;
            if ($request->avatar_remove == 1) {
                $newavatar = null;
            }
            if ($request->password != null) {
                $password = Hash::make($request->password);
                unset($request['avatar']);
                $user = User::create(array_merge($request->all(), ['password' => $password, 'avatar' => $newavatar, 'created_by' => Auth::user()->id, 'user_type' => 'coach']));
            } else {
                $user = User::create(array_merge($request->all(), ['avatar' => $newavatar, 'created_by' => Auth::user()->id, 'user_type' => 'coach']));
            }


            return response()->json(['success' => true, 'msg' => 'User Created']);
        }

        return response()->json(['success' => false, 'msg' => 'Some Error']);
    }
}
