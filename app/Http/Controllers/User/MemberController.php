<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = "profile";
        $data['title'] = "Member Profile";
        return view("user/member/member",compact('data'));
    }
    public function profileProcess(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
        ]);
        $data = $request->all();
        if($request->new_password){
            $data['password'] = Hash::make($request->new_password);
        }
        $isexist = Member::where(['email' => $request->email])->first();
        if($isexist){
            $isexist->update($data);
            $isexist->save();
            $data = $isexist;
            return redirect()->back()->with('success', 'Profile saved');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $data['menu'] = "login";
        $data['title'] = "Member Login";
        return view("user/member/login",compact('data'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginProcess(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'min:6|required'
        ]);
        $exist = Member::where(['email' => $request->email])->first();
        // dd($exist->email_verified_at);
        if($exist->email_verified_at == null){
            return redirect()->back()->withErrors(['Please verified your email first']);
        }
        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('member')->with('message',"Login Success");
        }else{
            return redirect()->back()->withErrors(['Email/Password is wrong']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $data['menu'] = "register";
        $data['title'] = "Member Register";
        return view("user/member/register",compact('data'));
    }
    public function registerProcess(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'name' => 'required',
            'phone' => 'required',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $isexist = Member::where(['email' => $request->email])->first();
        $data['token_email'] = sha1(time());
        if($isexist){
            $isexist->update($data);
            $isexist->save();
            // dd($isexist);
            $data = $isexist;
        }else{
            $data = Member::create($data);
        }
        $data->sendEmailRegister();
        return redirect()->back()->with('success', 'Check your email');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function emailConfirm($token)
    {
        $token = Member::where(['token_email' => $token])->first();

        if(!$token){
            return "Member not found";
        }

        if($token->email_verified_at){
            return "Member is active";
        }

        $token->email_verified_at = date('Y-m-d H:i:s');
        $token->save();

        return "Confirm Success";
    }
}
