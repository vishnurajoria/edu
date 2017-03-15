<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Course;

class GroupsController extends Controller
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
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_users = User::all();
        $all_courses = Course::all();
        return view('groups.create', compact('all_users','all_courses'));
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
            'description' => 'required|min:4',
            'group_users' => 'array',
            'group_courses' => 'array',
        ]);

        $new_group = Group::create([
            'name' => request('name'),
            'description' => request('description'),
        ]);
        if(!empty(request('group_users'))) {
            foreach (request('group_users') as $group_user) {
                if ($new_user = User::where('id', $group_user)->get()->first()) {
                    $new_group->addUser($new_user);
                }
            }
        }
        if(!empty(request('group_courses'))) {
            foreach (request('group_courses') as $group_course) {
                if ($new_course = Course::where('id', $group_course)->get()->first()) {
                    $new_group->addCourse($new_course);
                }
            }
        }

        session()->flash('message', 'Group created!');
        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $group_teachers = $group->getUsersByRole('teacher');
        $group_students = $group->getUsersByRole('student');
        $group_courses = $group->courses;
        return view('groups.show', compact('group','group_teachers', 'group_students', 'group_courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $group_teachers = $group->getUsersByRole('teacher');
        $group_students = $group->getUsersByRole('student');
        $group_courses = $group->courses;
        $all_teachers = User::getByRole('teacher');
        $all_students = User::getByRole('student');
        $all_courses = Course::all();
        return view('groups.edit', compact('group','group_teachers','group_students', 'group_courses', 'all_teachers', 'all_students', 'all_courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();
//        dd($request->group_users);
        $group->syncUsers($request->group_users);
        $group->syncCourses($request->group_courses);
        session()->flash('message', 'Group updated!');
        return redirect('/groups/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
//        Delete also relations with users
        $group->users()->detach();
        $group->courses()->detach();
        Group::destroy($group->id);
        session()->flash('message', 'Group deleted!');
        return redirect('/groups');
    }
}
