<?php

namespace App\Http\Controllers;

use App\Models\DiaChi;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\KH_DC;
use Illuminate\Database\QueryException;

class KhachHangController extends Controller
{
    //
    public function index()
    {
        $kh = KhachHang::with("diaChis")->get();
        return view("admin.khachhang.review", compact("kh"));
    }

    public function user()
    {

        return view("user.index");
    }

    public function profile()
    {
        $MaKH = session()->get('MaKH');
        $kh = KhachHang::with("diaChis")->where("MaKH", $MaKH)->first();
        $kh->NgaySinh = \Carbon\Carbon::parse($kh->NgaySinh)->format('Y-m-d');
        if ($kh) {
            return view('user.hoso.profile', compact('kh'));
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng!');
        }
    }

    public function create()
    {
        $MaKH = session()->get('MaKH');
        $kh = KhachHang::with("diaChis")->where("MaKH", $MaKH)->first();
        $kh->NgaySinh = \Carbon\Carbon::parse($kh->NgaySinh)->format('Y-m-d');
        return view('user.hoso.create', compact('kh'));
    }

    public function store(Request $request)
    {
        try {
            $user = session()->get('MaKH'); // Lấy thông tin người dùng hiện tại

            // Xác thực dữ liệu đầu vào
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'ngaysinh' => 'required|date',
                'addresses' => 'required|array',
                'addresses.*.duong' => 'required|string|max:255',
                'addresses.*.thanhpho' => 'required|string|max:255',
                'addresses.*.quan' => 'required|string|max:255',
                'addresses.*.phuong' => 'required|string|max:255',
                'addresses.*.LoaiDC' => 'required|string|max:255',
            ]);

            //dd($validatedData);

            $customer = KhachHang::find($user);

            if (!$customer) {
                return redirect()->back()->with('error', 'Customer not found.');
            }
            //dd($customer);
            $customer->update([
                'TenKH' => $request->name,
                'Email' => $request->email,
                'DienThoai' => $request->phone,
                'NgaySinh' => $request->ngaysinh,
            ]);
            //dd($customer);

            // Save each address and attach it to the customer
            foreach ($validatedData['addresses'] as $index => $addressData) {
                // Determine address type

                // First, check if the address already exists in the database based on unique fields like street, city, etc.
                $address = DiaChi::where('Duong', $addressData['duong'])
                    ->where('ThanhPho', $addressData['thanhpho'])
                    ->where('Quan', $addressData['quan'])
                    ->where('Phuong', $addressData['phuong'])
                    ->first();

                if ($address) {
                    // Address exists, update LoaiDC if necessary
                    if ($address->LoaiDC !== $addressData['LoaiDC']) {
                        $address->update(['LoaiDC' => $addressData['LoaiDC']]);
                    }
                    $address = DiaChi::find($address->MaDC);
                } else {
                    // If the address doesn't exist, create a new one
                    $address = DiaChi::create([
                        'Duong' => $addressData['duong'],
                        'ThanhPho' => $addressData['thanhpho'],
                        'Quan' => $addressData['quan'],
                        'Phuong' => $addressData['phuong'],
                        'LoaiDC' => $addressData['LoaiDC'],
                    ]);
                    // Sau khi tạo địa chỉ, cần lấy lại giá trị MaDC từ cơ sở dữ liệu
                    $address = DiaChi::find($address->MaDC);
                    //dd($address);
                }
                // Liên kết địa chỉ với khách hàng thông qua bảng KH_DC (bảng trung gian)
                $customer->diaChis()->syncWithoutDetaching([$address->MaDC]);
            }
            //dd($kh_dc);
            return redirect()->back()->with('success', 'Profile and Address created successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request, $id) {

        //$MaKH = session()->get('MaKH');
        $kh = KhachHang::with("diaChis")->where("MaKH", $id)->first();
        $kh->NgaySinh = \Carbon\Carbon::parse($kh->NgaySinh)->format('Y-m-d');
        return view('user.hoso.update', compact('kh'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'ngaysinh' => 'required|date',
                'addresses' => 'required|array',
                'addresses.*.duong' => 'required|string|max:255',
                'addresses.*.thanhpho' => 'required|string|max:255',
                'addresses.*.quan' => 'required|string|max:255',
                'addresses.*.phuong' => 'required|string|max:255',
                'addresses.*.LoaiDC' => 'required|string|max:255',
            ]);
            // Find the customer by ID
            $khachHang = KhachHang::findOrFail($id);

            // Update customer personal information
            $khachHang->update([
                'TenKH' => $request->input('name'),
                'Email' => $request->input('email'),
                'DienThoai' => $request->input('phone'),
                'NgaySinh' => $request->input('ngaysinh'),
            ]);
            //dd($khachHang);
            // Retrieve current addresses for the customer
            $existingAddresses = $khachHang->diaChis()->get(); // Assuming diaChis() is the relationship method in the KhachHang model
            //dd($existingAddresses);
            // Save or update addresses (shipping and supplementary)
            if ($request->has('addresses')) {
                foreach ($request->addresses as $index => $addressData) {
                    $address = DiaChi::findOrFail($addressData['MaDC']);
                    // Determine address type
                    $loaiDC = $index == 0 ? 'Địa chỉ giao hàng' : 'Địa chỉ khác';
                    //dd($addressData);
                    // Check if this address is already linked to the customer
                    $address = $existingAddresses->first(function ($existingAddress) use ($addressData) {
                        return $existingAddress->Duong == $addressData['duong'] &&
                            $existingAddress->ThanhPho == $addressData['thanhpho'] &&
                            $existingAddress->Quan == $addressData['quan'] &&
                            $existingAddress->Phuong == $addressData['phuong'];
                    });

                    if ($address) {
                        // Cập nhật thông tin địa chỉ
                        $address->street = $addressData['duong'];
                        $address->city = $addressData['thanhpho'];
                        $address->district = $addressData['quan'];
                        $address->ward = $addressData['phuong'];
                        $address->LoaiDC = $addressData['LoaiDC']; // Địa chỉ giao hàng hoặc bổ sung
                        $address->save();
                    } 
                }
            }

            // Optionally: Remove addresses that were not in the updated list (if addresses can be removed)
            $submittedAddressIds = collect($request->addresses)->pluck('MaDC')->toArray();
            $khachHang->diaChis()->whereNotIn('diachi.MaDC', $submittedAddressIds)->detach();

            return redirect()->back()->with('success', 'Profile and addresses updated successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
