<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // public function profile()
    // {
    //     $user = auth()->user();
    //     $addresses = $user->addresses; // Lấy địa chỉ của người dùng
    //     return view('profile', compact('user', 'addresses'));
    // }

    // public function updateProfileAndAddress(Request $request)
    // {
    //     $user = auth()->user();

    //     // Cập nhật thông tin cá nhân
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'phone' => 'nullable'
    //     ]);
    //     $user->update($request->only('name', 'email', 'phone'));

    //     // Kiểm tra xem có thêm địa chỉ mới hay không
    //     if ($request->has('street')) {
    //         $request->validate([
    //             'street' => 'required',
    //             'city' => 'required',
    //             'state' => 'required',
    //             'zip_code' => 'required',
    //             'country' => 'required'
    //         ]);

    //         $user->addresses()->create($request->only('street', 'city', 'state', 'zip_code', 'country'));
    //     }

    //     return back()->with('success', 'Profile and address updated successfully!');
    // }

    public function profile()
    {
        $user = (object)[
            'name' => 'Bùi Quốc Công',
            'email' => 'ameil@email.com',
            'phone' => '0373456789',
        ];

        $addresses = [
            (object)[
                'street' => '123 Đường Lê Lợi',
                'ward' => 'Phường Bến Nghé',
                'district' => 'Quận 1',
                'city' => 'Thành phố Hồ Chí Minh',
                'zip_code' => '700000',
                'country' => 'Việt Nam'
            ],
            (object)[
                'street' => '456 Đường Trần Hưng Đạo',
                'ward' => 'Phường Cô Giang',
                'district' => 'Quận 1',
                'city' => 'Thành phố Hồ Chí Minh',
                'zip_code' => '700000',
                'country' => 'Việt Nam'
            ]
        ];

        return view('Profile.profile', compact('user', 'addresses'));
    }

    public function updateProfileAndAddress(Request $request)
    {
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
