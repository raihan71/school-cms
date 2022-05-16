<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Activity;
use App\Teacher;
use App\User;
use App\Imports\TeachersImport;
use Image;
use File;
use Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        $teachers = Teacher::where('name', 'LIKE', '%'.$request->get('search').'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('teachers.index', [
            'users' => $users,
            'teachers' => $teachers
        ]);
    }

    public function addAdmin()
    {
        return view('teachers.add-admin');
    }

    public function saveAdmin(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $activity = Activity::create('telah menambahkan admin baru '.$request->name.'');

        return redirect()->route('teacher.index')->with('status', 'Admin berhasil ditambah');
    }

    public function deleteAdmin($id)
    {
        $user = User::findOrFail($id);
        $activity = Activity::create('telah menghapus admin '.$user->name.'');
        $user->delete();
        return redirect()->route('teacher.index')->with('status', 'Admin berhasil dihapus');

    }

    public function add()
    {
        return view('teachers.add');
    }

    function uploadImage($gambar)
    {
        $fileName = "TEACHER-".time().'.'.$gambar->getClientOriginalExtension();
        $img            = Image::make($gambar->getRealPath());
        $img->stream();
        $upload         = Storage::disk('local')->put('public/teacher'.'/'.$fileName,$img,'public');
        // set path
        $path           = '';
        if ($upload) {
            $path       = 'public/teacher/'.$fileName;
        }
        return $path;
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpg,jpeg,png|max:10000',
            'name'    => 'required|string',
            'nip'    => 'required|string',
            'subject'    => 'required|string',
        ]);
        $pic = $request->file('image');
        $uploadPic = $this->uploadImage($pic);
        $teacher = new Teacher();
        $teacher->name = $request->get('name');
        $teacher->nip = $request->get('nip');
        $teacher->subject = $request->get('subject');
        $teacher->pic = $uploadPic;
        $teacher->save();
        $activity = Activity::create('telah menambahkan guru '.$teacher->name.'');
        return redirect()->route('teacher.index')->with('status', 'Guru berhasil ditambah');

    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'pic' => 'mimes:jpg,jpeg,png|max:10000',
            'name'  => 'required|string',
            'nip' => 'required|string',
            'subject' => 'required|string'
        ]);
        $teacher = Teacher::findOrFail($request->get('id'));
        $teacher->name = $request->get('name');
        $teacher->nip = $request->get('nip');
        $teacher->subject = $request->get('subject');
        $pic   = $request->file('pic');
        if ($pic !== NULL) {
            $uploadPic = $this->uploadImage($pic);
            $fileName = Storage::url($request->get('old_pic'));
            if (File::exists('.'.$fileName)) {
                File::delete('.'.$fileName);
            }
            $pathPic      = $uploadPic;
        } else {
            $pathPic      = $request->get('old_pic');
        }
        $teacher->pic = $pathPic;
        $teacher->save();
        $activity = Activity::create('telah mengubah data guru '.$teacher->name.'');
        return redirect()->route('teacher.index')->with('status', 'Guru berhasil diubah');
    }

    public function delete($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        $activity = Activity::create('telah menghapus guru' .$teacher->name.'');
        return redirect()->route('teacher.index')->with('status', 'Guru berhasil dihapus');
    }

    public function import(Request $request)
    {
        Excel::import(new TeachersImport, request()->file('teacher'));
        $activity = Activity::create('telah import banyak guru');
        return redirect()->route('teacher.index')->with('status', 'Guru berhasil ditambahkan');
    }
}
