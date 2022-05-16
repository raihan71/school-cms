<?php

namespace App\Http\Controllers;
use Image;
use File;
use Storage;
use App\School;
use App\Activity;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::find(1);
        return view('schools.index', compact('school'));
    }

    public function add()
    {
        $school = School::find(1);
        if ($school) {
            return redirect('schools.index')->with('Sudah tidak bisa tambah profil');
        } else {
            return view('schools.add');
        }
    }

    public function show()
    {
        $school = School::findOrFail(1);
        return view('schools.update', compact('school'));
    }

    function uploadImage($gambar)
    {
        $fileName = "SCHOOL-".time().'.'.$gambar->getClientOriginalExtension();
        $img            = Image::make($gambar->getRealPath());
        $img->stream();
        $upload         = Storage::disk('local')->put('public/school'.'/'.$fileName,$img,'public');
        // set path
        $path           = '';
        if ($upload) {
            $path       = 'public/school/'.$fileName;
        }
        return $path;
    }

    function uploadOrgImg($gambar)
    {
        $fileName = "ORG-".time().'.'.$gambar->getClientOriginalExtension();
        $img            = Image::make($gambar->getRealPath());
        $img->stream();
        $upload         = Storage::disk('local')->put('public/org'.'/'.$fileName,$img,'public');
        // set path
        $path           = '';
        if ($upload) {
            $path       = 'public/org/'.$fileName;
        }
        return $path;
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required|string',
            'vision'            => 'required',
            'mission'           => 'required',
            'yayasan'           => 'required',
            'headmaster_pic'    => 'required|mimes:jpg,jpeg,png|max:10000',
            'structure_org'     => 'required|mimes:jpg,jpeg,png|max:10000',
            'link_video'        => 'required|string'
        ]);
        $headmaster_pic   = $request->file('headmaster_pic');
        $uploadHeadmaster = $this->uploadImage($headmaster_pic);
        $structure_org   = $request->file('structure_org');
        $uploadStructureOrg = $this->uploadOrgImg($structure_org);
        $school = new School;
        $school->name = $request->get('name');
        $school->vision = $request->get('vision');
        $school->mission = $request->get('mission');
        $school->yayasan = $request->get('yayasan');
        $school->link_video = $request->get('link_video');
        $school->headmaster_pic = $uploadHeadmaster;
        $school->structure_org = $uploadStructureOrg;
        $school->save();
        $activity = Activity::create('telah menambahkan profil sekolah');

        return redirect()->route('school.index')->with('status', 'Profil sekolah berhasil ditambah');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required|string',
            'vision'            => 'required',
            'mission'           => 'required',
            'yayasan'           => 'required',
            'headmaster_pic'    => 'mimes:jpg,jpeg,png|max:10000',
            'structure_org'     => 'mimes:jpg,jpeg,png|max:10000',
            'link_video'        => 'required|string'
        ]);
        $headmaster_pic   = $request->file('headmaster_pic');
        if ($headmaster_pic !== NULL) {
            $uploadHeadmaster = $this->uploadImage($headmaster_pic);
            $fileNameMaster = Storage::url($request->get('old_headmaster_pic'));
            if (File::exists('.'.$fileNameMaster)) {
                File::delete('.'.$fileNameMaster);
            }
            $pathMaster      = $uploadHeadmaster;
        } else {
            $pathMaster      = $request->get('old_headmaster_pic');
        }
        $structure_org   = $request->file('structure_org');
        if ($structure_org !== NULL) {
            $uploadStructureOrg = $this->uploadOrgImg($structure_org);
            $fileNameOrg = Storage::url($request->get('old_structure_org'));
            if (File::exists('.'.$fileNameOrg)) {
                File::delete('.'.$fileNameOrg);
            }
            $pathOrg      = $uploadStructureOrg;
        } else {
            $pathOrg      = $request->get('old_structure_org');
        }
        $school = School::findOrFail(1);
        $school->name = $request->get('name');
        $school->yayasan = $request->get('yayasan');
        $school->mission = $request->get('mission');
        $school->vision = $request->get('vision');
        $school->link_video = $request->get('link_video');
        $school->headmaster_pic = $pathMaster;
        $school->structure_org = $pathOrg;
        $school->save();
        $activity = Activity::create('telah mengubah profil sekolah');
        return redirect()->route('school.index')->with('status', 'Profil sekolah berhasil diedit');
    }

}
