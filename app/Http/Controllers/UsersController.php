<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Role;
use App\Group;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_courses = Course::all();
        $all_roles = Role::all();
        $all_groups = Group::all();

        return view('users.create', compact('all_courses', 'all_roles', 'all_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:4',
            'email' => 'required|email|min:4',
            'password' => 'required|min:6',
            'user_courses' => 'array',
            'user_roles' => 'array',
            'user_groups' => 'array',
        ]);

        $new_user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        if(!empty(request('user_courses'))) {
            foreach (request('user_courses') as $user_course) {
                $new_user->enrollToCourse(Course::find($user_course));
            }
        }
        if(!empty(request('user_roles'))) {
            foreach (request('user_roles') as $user_role) {
                $new_user->addRole(Role::find($user_role));
            }
        }
        if(!empty(request('user_groups'))) {
            foreach (request('user_groups') as $user_group) {
                $new_user->addGroup(Group::find($user_group));
            }
        }

        session()->flash('message', 'User created!');
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user_courses = $user->enrolledCourses()->get();
        $user_roles = $user->roles()->get();
        $user_groups = $user->groups()->get();
        $all_courses = Course::all();
        $all_roles = Role::all();
        $all_groups = Group::all();

        return view('users.edit', compact('user', 'user_courses', 'user_roles', 'user_groups', 'all_courses', 'all_roles', 'all_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|min:4',
            'email' => 'required|email|min:4',
            'password' => 'nullable|min:6',
            'user_courses' => 'array',
            'user_roles' => 'array',
            'user_groups' => 'array',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();


        $user->syncEnrolledCourses($request->user_courses);
        $user->syncRoles($request->user_roles);
        $user->syncGroups($request->user_groups);

        session()->flash('message', 'User updated!');
        return redirect('/users/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->enrolledCourses()->detach();
        $user->roles()->detach();
        $user->groups()->detach();

        User::destroy($user->id);
        session()->flash('message', 'User deleted!');
        return redirect('/users');
    }
}
