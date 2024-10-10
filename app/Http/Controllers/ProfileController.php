<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // public function profile()
    // {
    //     $user = auth()->user(); // Lấy thông tin người dùng hiện tại
    //     $addresses = $user->addresses; // Lấy địa chỉ của người dùng

    //     return view('Profile.profile', compact('user', 'addresses'));
    // }

    // public function update()
    // {
    //     $user = auth()->user(); // Lấy thông tin người dùng hiện tại
    //     $addresses = $user->addresses; // Lấy địa chỉ của người dùng

    //     return view('Profile.update', compact('user', 'addresses'));
    // }

    // public function updateProfile(Request $request)
    // {
    //     $user = auth()->user(); // Lấy thông tin người dùng hiện tại

    //     // Xác thực dữ liệu đầu vào
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'phone' => 'nullable|string|max:15',
    //         'street' => 'required|string|max:255',
    //         'ward' => 'required|string|max:255',
    //         'district' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'zip_code' => 'required|string|max:10',
    //     ]);

    //     // Cập nhật thông tin cá nhân
    //     $user->update($request->only('name', 'email', 'phone'));

    //     // Cập nhật địa chỉ (giả sử có ít nhất một địa chỉ để cập nhật)
    //     if ($user->addresses()->exists()) {
    //         $user->addresses()->first()->update($request->only('street', 'ward', 'district', 'city', 'zip_code'));
    //     } else {
    //         // Nếu không có địa chỉ nào, bạn có thể tạo mới nếu cần
    //         $user->addresses()->create($request->only('street', 'ward', 'district', 'city', 'zip_code'));
    //     }

    //     return redirect()->route('Profile.profile')->with('success', 'Profile updated successfully.');
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

    public function update()
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

        return view('Profile.update', compact('user', 'addresses'));
    }

    public function updateProfile(Request $request)
    {
        // Thực hiện cập nhật thông tin cá nhân và địa chỉ
        // Xác thực và xử lý dữ liệu như đã nêu trước đó

        return redirect()->route('Profile.profile')->with('success', 'Profile updated successfully.');
    }


}
