<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserAccount;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserProfile;
use App\Models\Profile;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Nipl;
use App\Models\IndonesiaProvinsi;
use App\Models\IndonesiaKota;
use App\Models\IndonesiaKecamatan;
use App\Models\IndonesiaKelurahan;
use App\Models\ListBank;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Image;
use jeremykenedy\Uuid\Uuid;
use Validator;
use Illuminate\Support\Facades\Hash;
use View;
use Auth;

class ProfilesController extends Controller
{
    protected $idMultiKey = '618423'; //int
    protected $seperationKey = '****';

    public  $user,
            $userinfo, 
            $nipl,
            $master_provinsi,
            $master_kota,
            $master_kecamatan,
            $master_kelurahan,
            $master_bank;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user             = new User;
        $this->userinfo         = new UserInfo;
        $this->nipl             = new Nipl;
        $this->master_provinsi  = new IndonesiaProvinsi;
        $this->master_kota      = new IndonesiaKota;
        $this->master_kecamatan = new IndonesiaKecamatan;
        $this->master_kelurahan = new IndonesiaKelurahan;
        $this->master_bank      = new ListBank;
        $this->middleware('auth');
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $username
     *
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)
        ->with(array(
                'userinfo'  => function($query){
                    $query->first();
                }
            )
        )
        ->firstOrFail();
    }

    /**
     * Display the specified resource.
     *
     * @param string $username
     *
     * @return Response
     */
    public function show($username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $currentTheme = Theme::find($user->profile->theme_id);

        $data = [
            'user'         => $user,
            'currentTheme' => $currentTheme,
        ];

        return view('profiles.show')->with($data);
    }

    /**
     * /profiles/username/edit.
     *
     * @param $username
     *
     * @return mixed
     */
    public function edit($username, $page)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            return view('pages.status')
                ->with('error', trans('profile.notYourProfile'))
                ->with('error_title', trans('profile.notYourProfileTitle'));
        }

        $themes = Theme::where('status', 1)
                        ->orderBy('name', 'asc')
                        ->get();

        $currentTheme = Theme::find($user->profile->theme_id);

        $nipl       = $this->nipl->where('id_user', $user->id)->first();
        $userinfo   = $this->userinfo->where('id_user',$user->id)->where('id_status_user', 2)->first();
        $provinsi   = $this->master_provinsi->select('id','text')->orderBy('text', 'ASC')->get();
        $bank       = $this->master_bank->select('id','nama')->orderBy('id',"ASC")->get();

        if(!empty($userinfo)){
            $kota       = $this->master_kota->where('id_provinsi', $userinfo->id_provinsi)->select('id','text')->orderBy('text', 'ASC')->get();
            $kecamatan  = $this->master_kecamatan->where('id_kota', $userinfo->id_kota)->select('id','text')->orderBy('text', 'ASC')->get();
            $kelurahan  = $this->master_kelurahan->where('id_kecamatan', $userinfo->id_kecamatan)->select('id','text')->orderBy('text', 'ASC')->get();
        }else{
            $kota       = '';
            $kecamatan  = '';
            $kelurahan  = '';
        }

        $data = [
            'user'          => $user,
            'themes'        => $themes,
            'currentTheme'  => $currentTheme,
            'nipl'          => $nipl,
            'userinfo'      => $userinfo,
            'provinsi'      => $provinsi,
            'kota'          => $kota,
            'kecamatan'     => $kecamatan,
            'kelurahan'     => $kelurahan,
            'bank'          => $bank,
        ];

        // return $kota;
        return view('profiles.edit')->with($data);
    }

    public function userinfo_store(Request $request, $id_user, $act, $page)
    {
        if($page == 'biodata'){
            $this->user->where('id', $id_user)
            ->update([
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name
            ]);

            if($act == 'add'){
                $usr                    = $this->userinfo;
                $usr->id_user           = $id_user;
                $usr->id_status_user    = 2;
                $usr->alamat            = $request->alamat;
                $usr->id_kelurahan      = $request->kelurahan;
                $usr->id_kecamatan      = $request->kecamatan;
                $usr->id_kota           = $request->kota;
                $usr->id_provinsi       = $request->provinsi;
                $usr->kode_pos          = $request->kode_pos;
                $usr->no_telepon        = $request->no_telepon;
                $usr->no_fax            = $request->no_fax;
                $usr->save();
            }else{
                $this->userinfo->where([
                    ['id_status_user', 2],
                    ['id_user', $id_user]
                ])->update([
                    'alamat'            => $request->alamat,
                    'id_kelurahan'      => $request->kelurahan,
                    'id_kecamatan'      => $request->kecamatan,
                    'id_kota'           => $request->kota,
                    'id_provinsi'       => $request->provinsi,
                    'kode_pos'          => $request->kode_pos,
                    'no_telepon'        => $request->no_telepon,
                    'no_fax'            => $request->no_fax
                ]);
            }
            return back()->with('status','Data berhasil diupdate!');

        }elseif($page == 'akuninfo'){

            if($request->username != Auth::user()->name){
                $request->validate([
                    'username'      => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,name'],
                ]);
            }

            if($request->email != Auth::user()->email){
                $request->validate([
                    'email'         => ['required', 'email', 'unique:users,email'],
                ]);
            }

            $this->user->where('id', $id_user)
            ->update([
                'name'          => $request->username,
                'email'         => $request->email
            ]);

            if($act == 'add'){
                $usr                    = $this->userinfo;
                $usr->no_ktp            = $request->no_ktp;
                $usr->npwp              = $request->npwp;
                $usr->nama_bank         = $request->nama_bank;
                $usr->no_rekening       = $request->no_rekening;
                $usr->cabang_bank       = $request->cabang_bank;
                $usr->atas_nama_bank    = $request->atas_nama_bank;
                $usr->save();
            }else{
                $this->userinfo->where([
                    ['id_status_user', 2],
                    ['id_user', $id_user]
                ])->update([
                    'no_ktp'            => $request->no_ktp,
                    'npwp'              => $request->npwp,
                    'nama_bank'         => $request->nama_bank,
                    'no_rekening'       => $request->no_rekening,
                    'cabang_bank'       => $request->cabang_bank,
                    'atas_nama_bank'    => $request->atas_nama_bank
                ]);
            }

            return redirect('/profile/'.$request->username.'/edit/'.$page)->with('status','Profile berhasil diupdate!');
        }
    }

    public function changePassword(Request $request){
    
        $request->validate([
            'password_lama'         => 'required',
            'password_baru'         => 'required|min:8|alpha_num',
            'password_baru_konfirm' => 'required|min:8|alpha_num',
        ]);

        if (!(Hash::check($request->password_lama, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("gagal","Password lama yang anda masukkan salah!");
        }
            
        if(strcmp($request->password_lama, $request->password_baru) == 0){
            //Current password and new password are same
            return redirect()->back()->with("gagal","Password Baru tidak boleh sama dengan Password Lama, silahkan masukan password lain!");
        }
        if(strcmp($request->password_baru, $request->password_baru_konfirm) !== 0){
            //New password and confirm password are not same
            return redirect()->back()->with("gagal","Konfirmasi Password tidak sama, pastikan Password Baru dan Konfirmasi Password harus sama!");
        }
        
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->password_baru);
        $user->save();
            
        return redirect()->back()->with("status","Password berhasil dirubah!");
    }

    /**
     * Update a user's profile.
     *
     * @param \App\Http\Requests\UpdateUserProfile $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function update(UpdateUserProfile $request, $username)
    {
        $user = $this->getUserByUsername($username);

        $input = Input::only('theme_id', 'location', 'bio', 'twitter_username', 'github_username', 'avatar_status');

        $ipAddress = new CaptureIpTrait();

        if ($user->profile == null) {
            $profile = new Profile();
            $profile->fill($input);
            $user->profile()->save($profile);
        } else {
            $user->profile->fill($input)->save();
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updateSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserAccount(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $ipAddress = new CaptureIpTrait();
        $rules = [];

        if ($user->name != $request->input('name')) {
            $usernameRules = [
                'name' => 'required|max:255|unique:users',
            ];
        } else {
            $usernameRules = [
                'name' => 'required|max:255',
            ];
        }
        if ($emailCheck) {
            $emailRules = [
                'email' => 'email|max:255|unique:users',
            ];
        } else {
            $emailRules = [
                'email' => 'email|max:255',
            ];
        }
        $additionalRules = [
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
        ];

        $rules = array_merge($usernameRules, $emailRules, $additionalRules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        $user->updated_ip_address = $ipAddress->getClientIp();

        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updateAccountSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserPasswordRequest $request
     * @param int                                          $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserPassword(UpdateUserPasswordRequest $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updatePWSuccess'));
    }

    /**
     * Upload and Update user avatar.
     *
     * @param $file
     *
     * @return mixed
     */
    public function upload()
    {
        if (Input::hasFile('file')) {
            $currentUser = \Auth::user();
            $avatar = Input::file('file');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path().'/users/id/'.$currentUser->id.'/uploads/images/avatar/';
            $path = $save_path.$filename;
            $public_path = '/images/profile/'.$currentUser->id.'/avatar/'.$filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);

            // Save the public image path
            $currentUser->profile->avatar = $public_path;
            $currentUser->profile->save();

            return response()->json(['path' => $path], 200);
        } else {
            return response()->json(false, 200);
        }
    }

    /**
     * Show user avatar.
     *
     * @param $id
     * @param $image
     *
     * @return string
     */
    public function userProfileAvatar($id, $image)
    {
        return Image::make(storage_path().'/users/id/'.$id.'/uploads/images/avatar/'.$image)->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\DeleteUserAccount $request
     * @param int                                  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserAccount(DeleteUserAccount $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($user->id != $currentUser->id) {
            return redirect('profile/'.$user->name.'/edit')->with('error', trans('profile.errorDeleteNotYour'));
        }

        // Create and encrypt user account restore token
        $sepKey = $this->getSeperationKey();
        $userIdKey = $this->getIdMultiKey();
        $restoreKey = config('settings.restoreKey');
        $encrypter = config('settings.restoreUserEncType');
        $level1 = $user->id * $userIdKey;
        $level2 = urlencode(Uuid::generate(4).$sepKey.$level1);
        $level3 = base64_encode($level2);
        $level4 = openssl_encrypt($level3, $encrypter, $restoreKey);
        $level5 = base64_encode($level4);

        // Save Restore Token and Ip Address
        $user->token = $level5;
        $user->deleted_ip_address = $ipAddress->getClientIp();
        $user->save();

        // Send Goodbye email notification
        $this->sendGoodbyEmail($user, $user->token);

        // Soft Delete User
        $user->delete();

        // Clear out the session
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login/')->with('success', trans('profile.successUserAccountDeleted'));
    }

    /**
     * Send GoodBye Email Function via Notify.
     *
     * @param array  $user
     * @param string $token
     *
     * @return void
     */
    public static function sendGoodbyEmail(User $user, $token)
    {
        $user->notify(new SendGoodbyeEmail($token));
    }

    /**
     * Get User Restore ID Multiplication Key.
     *
     * @return string
     */
    public function getIdMultiKey()
    {
        return $this->idMultiKey;
    }

    /**
     * Get User Restore Seperation Key.
     *
     * @return string
     */
    public function getSeperationKey()
    {
        return $this->seperationKey;
    }
}
