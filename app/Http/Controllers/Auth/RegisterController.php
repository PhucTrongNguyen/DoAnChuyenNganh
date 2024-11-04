<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\SanPhamController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:KhachHang'],
            'password' => [
                'required',
                'string',
                'min:8',            // Mật khẩu ít nhất 8 ký tự
                'regex:/[a-z]/',    // Ít nhất một chữ thường
                'regex:/[A-Z]/',    // Ít nhất một chữ hoa
                'regex:/[0-9]/',    // Ít nhất một số
                'regex:/[@$!%*?&#]/', // Ít nhất một ký tự đặc biệt
                'confirmed'
            ],
        ]);
    }

    protected function create(array $data)
    {
        //dd($data);
        try {
            $kh = new KhachHang;
            $kh->TenKH = $data['name'];
            $kh->MatKhau = Hash::make($data['password']);
            $kh->Email = $data['email'];
            //dd($kh);
            $kh->TrangThaiTK = 1;
            $kh->save();
            
            session(['MaKH' => $kh->MaKH, 'TenKH' => $kh->TenKH]);
            
            // Có thể trả về một thông báo thành công
            //return redirect()->route('sanpham.index')->with('success', 'Đăng ký thành công!');
            session()->flash('success', 'Đăng ký thành công!');
            return redirect()->action([SanPhamController::class, 'index']);

        }catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Hàm xử lý đăng ký tài khoản
    public function register(Request $request)
    {
        try {
            //dd($request);
            // Log request data for debugging
            Log::info('User Registration Data:', $request->all());
            // Gọi validator để xác thực dữ liệu
            $this->validator($request->all())->validate();

            // Nếu xác thực thành công, gọi hàm create để lưu người dùng vào cơ sở dữ liệu
            $this->create($request->all());

            // Điều hướng người dùng đến trang chủ sau khi đăng ký thành công
            return redirect()->route('sanpham.index')->with('success', 'Đăng ký thành công!');
        }catch(QueryException $e) {
            Log::error('Error during registration:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
}
