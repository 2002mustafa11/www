<?php
namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Technician;
use App\Http\Controllers\Controller;
// use FontLib\Table\Type\name;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class AccessoryController extends Controller
{

    public function index(Request $request)
    {
        // dd($request->type);
        $type = 'other';
        if ($request->type) {
            $type = $request->type;
        }
        $accessorys = Accessory::where('type',$type)->get();
        return view('Accessory.index',compact('accessorys','type'));
    }


    public function create()
    {
        // dd('');
        return view('Accessory.create');
    }



public function store(Request $request)
{
    $validatedData = $request->validate([
        'device_type' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'type' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = time() . '.jpg';


        $manager = new ImageManager(new Driver());

        $image = $manager->read($file->getRealPath());

        $image->resize(width: 80, height: 80);

        // 4. وضع العلامة المائية (اختياري)
        $watermarkPath = public_path('images/watermark.png');
        if (file_exists($watermarkPath)) {
            $image->place($watermarkPath, 'bottom-right', 10, 10);
        }

        // 5. تحويل إلى JPG بجودة 70%
        $encoded = $image->toJpg(quality: 70);

        Storage::disk('public')->put("accessory_images/$imageName", $encoded->toString());

        // 7. حفظ المسار في قاعدة البيانات
        $validatedData['image'] = "accessory_images/$imageName";
    }

    Accessory::create($validatedData);

    return redirect()->route('accessorys')->with('success', 'Accessory added successfully.');
    }




    public function show(Accessory $accessory)
    {
        $technicians = Technician::select('id','name')->get();
        return view('Accessory.show',compact('accessory','technicians'));
    }

    public function edit(Accessory $accessory)
    {
        return view('Accessory.edit',compact('accessory'));

    }


public function updateStock(Request $request, Accessory $accessory)
{
    $validatedData = $request->validate([
        'stock' => 'required|integer|min:0',
    ]);

    $accessory->update($validatedData);

    return redirect()->back()->with('success', $accessory->device_type.'تم تعديل العدد.');
}



public function update(Request $request, Accessory $accessory)
{
    $validatedData = $request->validate([
        'device_type' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'type' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = time() . '.jpg';

        // 1. إعداد مدير الصورة (ImageManager)
        $manager = new ImageManager(new Driver());

        // 2. قراءة الصورة الأصلية
        $image = $manager->read($file->getRealPath());

        $image->resize(width: 80, height: 80);


        // 4. إضافة علامة مائية إن وجدت
        $watermarkPath = public_path('images/watermark.png');
        if (file_exists($watermarkPath)) {
            $image->place($watermarkPath, 'bottom-right', 10, 10);
        }

        // 5. حفظ الصورة بعد تقليل الجودة
        $encoded = $image->toJpg(quality: 70);
        Storage::disk('public')->put('accessory_images/' . $imageName, $encoded->toString());

        // 6. حذف الصورة القديمة (اختياري إن كنت تريد تنظيف التخزين)
        if ($accessory->image && Storage::disk('public')->exists($accessory->image)) {
            Storage::disk('public')->delete($accessory->image);
        }

        // 7. حفظ المسار الجديد في البيانات
        $validatedData['image'] = 'accessory_images/' . $imageName;
    }

    // 8. تحديث بيانات الإكسسوار
    $accessory->update($validatedData);

    return redirect()->route("accessorys", ['type' => $accessory->type])
        ->with('success', 'Accessory updated successfully.');
}





    public function destroy(Accessory $accessory)
    {
        //
    }

}



