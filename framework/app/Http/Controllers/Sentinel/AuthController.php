<?php

namespace App\Http\Controllers\Sentinel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel, Redirect;

class AuthController extends Controller
{
    public $redirectTo = 'login';
    public function authenticate(Request $request) {
    	$rules = [
    		'user'		=> 'required',
    		'password'	=> 'required',
    	];
    	$this->validate($request, $rules);

    	$credentials = [
    		'login'		=> $request->input('user'),
    		'password'	=> $request->input('password'),
    	];

    	try {
	        $user = Sentinel::authenticate($credentials, false);
	        if ($user) {
	        	return redirect('dashboard')->with('successMessage', 'Selamat Datang Bos');
	        } else {
	     		return Redirect::back()->with('errorMessage','Username atau Password salah.')->withInput();
	        }
		} catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
	        return Redirect::back()->with('errorMessage','Aktifitas mencurigakan terjadi dari alamat IP anda, Tidak bisa login selama [397] detik');
	    } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
	        return Redirect::back()->with('warningMessage','Akun anda belum diaktivasi');
	    } catch (Exception $e) {
	        return $e;
	    }
    }

    public function logout() {
        Sentinel::logout(null, true);
        return redirect($this->redirectTo)->with('successMessage', 'Anda Berhasil Logout');
    }
}
