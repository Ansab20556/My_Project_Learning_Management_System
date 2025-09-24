<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Specialization;

use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        // جلب كل التخصصات
        $specializations = Specialization::all();

        // تمرير البيانات للـ view
        return view('admins.specialization.index', compact('specializations'));
    }

    public function create()
    {
        return view('admins.specialization.create');
    }
    
    public function show(Specialization $specialization)
    {
        return view('admins.specialization.show', compact('specialization'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable|string',
            // 'cover_image' => 'image|required',
            'what_you_will_learn' => 'nullable|string',

        ]);


        $Specialization = new Specialization();
        $Specialization->name = $request->name;
        $Specialization->description = $request->description;
        $Specialization->what_you_will_learn = $request->what_you_will_learn;


        // حفظ صورة الغلاف
        // if ($request->hasFile('cover_image')) {
        //     $path = $request->file('cover_image')->store('covers', 'public');
        //     $book->cover_image = $path;
        // }

        // حفظ الكتاب أولاً للحصول على ID
        $Specialization->save();



        // رسالة نجاح وتحويل المستخدم
        session()->flash('flash_message', 'تمت إضافة الكتاب بنجاح');
        return redirect()->route('admin.specializations.index', ['Specializations' => $Specialization]);
    }


    public function edit(Specialization $specialization)
    {
        return view('admins.specialization.edit', compact('specialization'));
    }


    public function update(Request $request, Specialization $specialization)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'description'        => 'nullable|string',
            'what_you_will_learn' => 'nullable|string',
        ]);

        $specialization->update($request->all());

        return redirect()->route('admin.specializations.index')
            ->with('success', 'تم تحديث بيانات التخصص بنجاح ✅');
    }




    public function destroy(Specialization $specialization)
    {
        $specialization->delete();

        return redirect()->route('admin.specializations.index')
            ->with('success', 'تم حذف التخصص بنجاح 🗑️');
    }
}