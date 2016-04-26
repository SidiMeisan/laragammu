<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Phonebook;
use App\Models\ContactPhone;
use App\Models\Inbox;
use App\Models\Outbox;
use Input, DB, Redirect;

class SMSController extends Controller
{
    public function __construct() {
        $this->middleware('webAuth');
    }

    public function cekpulsa()
    {
    	$data['title'] = 'Cek Pulsa';
    	return view('cekpulsa', $data);
    }

    public function ajax_cek_pulsa()
    {
    	ini_set('max_execution_time', 500);
    	$ussd = Input::get('nomor');

        if($ussd != '')
        {
            exec('cd gammu && gammu getussd $ussd ', $hasil);

            for ($i=0; $i<=count($hasil)-1; $i++)
            {
               echo $hasil[$i];
            }
        }
    }

    public function phonebook()
    {
    	$data['data']  = Phonebook::all();
    	$data['title'] = 'Phonebook';
    	return view('phonebook.index', $data);
    }

    public function createPhonebook()
    {
        return view('phonebook.create')->withTitle('Tambah Kontak');
    }

    public function storePhonebook(Request $request)
    {
        $rules = [
            'nama'     => 'required',
            'birthday' => 'required|date',
            'phone'    => 'required',
            'email'    => 'required|email|unique:contact,email'
        ];

        $this->validate($request, $rules);
        DB::beginTransaction();
        try 
        {
            
            $phonebook = Phonebook::create($request->except('phone'));
            $phone = trim($request->phone);
            if (preg_match("/(^0)/", $phone)){
                  $phone = preg_replace("/^0/", "62", $phone);
            }

            $cek  = ContactPhone::all();
            $noHp = [];
            
            foreach ($cek as $hp) {
              $noHp[] = $hp->phone;
            }

            if(in_array($phone, $noHp))
            {
                return redirect()->back()->with('errorMessage', "Nomor HP $request->phone sudah ada di database ")->withInput();
            }

            ContactPhone::create(['contact_id' => $phonebook->id, 'phone' => $phone]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return Redirect::back()->with('errorMessage', 'Terjadi kesalahan input. Silahkan dicoba lagi.');
        }
        
        DB::commit();
        return redirect('phonebook')->with('successMessage', 'Berhasil Menambah Kontak');
    }

    public function editPhonebook($id)
    {
        $data['data'] = Phonebook::leftJoin('contact_phone', 'contact.id', '=', 'contact_phone.contact_id')
                        ->where('contact.id', $id)
                        ->first();

        $data['title'] = 'Edit Phonebook';
        return view('phonebook.edit', $data);
    }

    public function detailPhonebook($id)
    {
        $data['data'] = Phonebook::leftJoin('contact_phone', 'contact.id', '=', 'contact_phone.contact_id')
                        ->where('contact.id', $id)
                        ->first();

        $data['title'] = 'Detail Phonebook';
        $data['phone'] = ContactPhone::where('contact_id', $id)->get();
        return view('phonebook.detail', $data);
    }

    public function updatePhonebook(Request $request, $id)
    {
        $rules = [
            'nama'     => 'required|unique:contact,nama,'.$id.',id',
            'birthday' => 'required|date',
            'email'    => 'required|email|unique:contact,email,'.$id.',id'
        ];

        $this->validate($request, $rules);

        $phonebook = Phonebook::findOrFail($id);
        $phonebook->update($request->except('phone'));
        
        return redirect('phonebook')->with('successMessage', 'Berhasil Mengupdate Kontak');
    }

    public function storePhone(Request $request)
    {
        if($request->op == 'Tambah Nomor. Tlp')
        {
            $rules = ['phone' => 'required|unique:contact_phone,phone', 'status' => 'required'];

            $this->validate($request, $rules);

            $phone = trim($request->phone);
            if (preg_match("/(^0)/", $phone)){
                  $phone = preg_replace("/^0/", "62", $phone);
            }

            $cp = ContactPhone::create([
                'contact_id' => $request->contact_id,
                'phone'      => $phone
            ]);

            return Redirect::back()->with('successMessage', 'Berhasil Menambah Nomor Telepon');
        }
        else
        {
            $rules = ['cb' => 'required'];
            $this->validate($request, $rules);

            $cek = ContactPhone::findOrFail($request->cb);
            if($cek->status == 'A')
            {
               $cek->update(['status' => 'N']);
            }
            else
            {
                $cek->update(['status' => 'A']);
            }

            return redirect()->back()->with('successMessage', 'Status Berhasil di update');
        }
        
    }

    public function inbox()
    {
        $data['data'] = Inbox::all();
                        
        $data['title'] = 'Kotak Masuk';
        return view('inbox.index', $data);
    }

    public function destroyInbox()
    {
        $post = Input::get('cb');
        
        DB::beginTransaction();
        try
        {
            $inbox = DB::table('inbox')->whereIn('id', $post)->delete();
        }
        catch(Exception $m){
            
            DB::rollback();
            return Redirect::back()->with('errorMessage', 'Inbox gagal di hapus');
        }
        
        DB::commit();
        return redirect('inbox')->with('successMessage', 'Inbox berhasil di hapus');
    }

    public function sendsms()
    {
        return view('sendsms')->withTitle('Kirim Pesan');
    }

    public function sendMessage(Request $request)
    {
        $rules = ['jenis' => 'required', 'tujuan' => 'required', 'pesan' => 'required'];
        $this->validate($request, $rules);


        $nomorBroadcast = explode(',', $request->tujuan);
        
        
        DB::beginTransaction();
        try
        {
            if($request->jenis == 'tunggal')
            {
                trim($request->tujuan);
                $tujuan = str_replace('-', '', $request->tujuan);
                exec('c:\gammu\gammu-smsd-inject.exe -c c:\gammu\smsdrc EMS '.$tujuan.' -text "'.$request->pesan.'"');
            }
            else
            {
                foreach ($nomorBroadcast as $broadcast) 
                {
                   str_replace('-', '', $broadcast);
                   str_replace(' ', '', $broadcast);
                   trim($broadcast);
                   exec('c:\gammu\gammu-smsd-inject.exe -c c:\gammu\smsdrc EMS '.$broadcast.' -text "'.$request->pesan.'"');
                }
                
            }
        }
        catch(Exception $e)
        {
            DB::rollback();
            return Redirect::back()->with('errorMessage', 'Terjadi Kesalahan. Silahkan dicoba lagi.');
        }

        DB::commit();
        return Redirect::back()->with('successMessage', 'Berhasil Mengirim Pesan');
    }

    public function outbox()
    {
        $data['data'] = DB::table('sentitems')->get();
        return view('outbox.index', $data)->withTitle('Pesan Terikirim');
    }

    public function destroyOutbox()
    {
        $post = Input::get('cb');
        
        DB::beginTransaction();
        try
        {
            $outbox = DB::table('sentitems')->whereIn('ID', $post)->delete();
        }
        catch(Exception $m){
            
            DB::rollback();
            return Redirect::back()->with('errorMessage', 'Sent Item gagal di hapus');
        }
        
        DB::commit();
        return redirect('outbox')->with('successMessage', 'Sent Item berhasil di hapus');
    }
}
