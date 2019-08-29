<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Components\UserRegisterValidation;

class UserController extends Controller
{
    /**
     * User instance.
     *
     * @var $user
     */
    private $user;

    /**
     * Itens per page in pagination.
     *
     * @const PAGINATION
     */
    const PAGINATION = 10;

    /**
     * Inject User
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * List users.
     *
     * @return User $users
     */
    public function index()
    {
        $usersList = $this->user->where('id', '<>', Auth::user()->id)->orderBy('first_name');
        $users = $usersList->paginate(self::PAGINATION);
        return view('admin.users.index', array('users' => $users));
    }

    /**
     * New user form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('admin.users.create');
    }

    /**
     * Submit new user.
     *
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $validation = UserRegisterValidation::createUsersValidation($request);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }

        $data = $request->all();
        
        if($this->user->createUser($data))
            return redirect()->route("users.index")->with('status', 'User created with success!');
        
        return redirect()->back()->withErrors('Error to create user. Please, try again!');
    }

    /**
     * Get data user.
     * 
     * @param integer $id User ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $user = $this->user->find($id);
        return view('admin.users.edit', array('user' => $user));
    }

    /**
     * Edit user.
     *
     * @param  integer  $id
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function postEdit($id, Request $request)
    {
        $validation = UserRegisterValidation::editUsersValidation($request);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }

        $data = $request->all();
        
        if($this->user->updateUser($id, $data))
            return redirect()->route("users.index")->with('status', 'User updated with success!');
        
        return redirect()->back()->withErrors('Error to update user. Please, try again!');
    }

    /**
     * Remove user.
     * 
     * @param integer $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getRemove($id)
    {
        if($this->user->deleteUser($id))
            return redirect()->route("users.index")->with('status', 'User removed with success!');
        
        return redirect()->back()->withErrors('Error to remove user. Please, try again!');
    }
}
