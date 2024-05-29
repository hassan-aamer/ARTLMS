<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        // جلب جميع الفنانين مع بيانات المستخدمين المرتبطة بهم
        $usersData = Artist::with('user')->get();

        // // إنشاء مصفوفة لتخزين بيانات المستخدمين
        // $usersData = [];

        // // حلق عبر كل فنان واستخرج بيانات المستخدم المرتبطة به
        // foreach ($artists as $artist) {
        //     // جلب بيانات المستخدم المرتبطة بالفنان
        //     $userData = $artist->user;

        //     // إضافة بيانات المستخدم إلى المصفوفة
        //     $usersData[] = $userData;
        // }

        // إرجاع البيانات إلى العرض
        return view('admin_dashboard.artists.index', compact('usersData'));
    }
    public function studentasartist(request $request, $id)
    {
        artist::create([
            'user_id' => $id,
            'updated_at' => now(),
            'created_at' => now()
        ]);
        return redirect()->back()->with(['success' => 'تم تحويل المتعلم كفنان بنجاح']);

    }
    public function teacherasartist(request $request, $id)
    {
        artist::create([
            'user_id' => $id,
            'updated_at' => now(),
            'created_at' => now()
        ]);
        return redirect()->back()->with(['success' => 'تم تحويل المحاضر كفنان بنجاح']);

    }
    public function destroy(request $request, $id)
    {
        $artist=artist::find($id);
        $artist->delete();
        return redirect()->back()->with(['success' => 'تم حذف الفنان  بنجاح']);

    }
}
