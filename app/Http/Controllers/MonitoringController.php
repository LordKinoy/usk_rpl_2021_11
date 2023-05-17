<?php

namespace App\Http\Controllers;

use App\Models\Kepalasekolah;
use App\Models\Monitoring;
use App\Models\Viewmonitoring;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    protected $monitoring;
    protected $kepsek;
    protected $perusahaan;
    
    public function __construct()
    {
        $this->monitoring = Monitoring::all();
        $this->kepsek = Kepalasekolah::all();
        $this->perusahaan = Perusahaan::all();
    }
    
    public function monitoring()
    {
            if (Auth::user()->level_user == 2) 
            {
                return view('monitoring.index',[
                    'title' => 'Monitoring',
                    'monitoring' => Monitoring::paginate(6)
                ]);
            }  
            if (Auth::user()->level_user == 4){
                return view('monitoring.index',[
                    'title' => 'Monitoring',
                    'monitoring' => Monitoring::where('id_ps','=',Auth::user()->guru->pembimbingsekolah->id_ps)->paginate(6)
                ]);
            }
    }

    public function tambahmonitoring()
    {
        return view('monitoring.tambah',[
            'perusahaan' => $this->perusahaan,
            'kepsek' => $this->kepsek
        ]);
    }

    public function detailmonitoring($id_monitoring = null)
    {
        $detail = $this->monitoring->find($id_monitoring);
        // dd($detail);
        return view('monitoring.detail', ['detail' => $detail]);
    }

    public function storemonitoring(Request $request)
    {
        $insertMonitor = [
            "id_ps" => $request->input('id_ps'),
            "id_kepsek" => $request->input('id_kepsek'),
            "id_perusahaan" => $request->input('id_perusahaan'),
            "tanggal" => $request->input('tanggal'),
            "resume" => $request->input('resume'),
            "verifikasi" => $request->input('verifikasi')
          ];
          
        $insert = Monitoring::create($insertMonitor);

        // ddd($insert);
        
        if ($insert){
            return redirect('/monitoring')->with('success','Data Monitoring berhasil ditambahkan');
        } else {
            return redirect('/monitoring')->with('alert','Data Monitoring gagal ditambahkan');
        }
    }
  
    public function editmonitoring($id_monitoring = null)
    {
        $edit = Monitoring::where('id_monitoring', $id_monitoring)->get();
        // dd($edit);
        return view('monitoring.edit', [
            'edit' => $edit,
            'kepsek' => $this->kepsek,
            'perusahaan' => $this->perusahaan
        ]);
    }

    public function updatemonitoring(Request $request)
    {
        $data = [
            'id_ps' => $request->input('id_ps'),
            'id_kepsek' => $request->input('id_kepsek'),
            'id_perusahaan' => $request->input('id_perusahaan'),
            'tanggal' => $request->input('tanggal'),
            'resume' => $request->input('resume'),
            'verifikasi' => $request->input('verifikasi')
        ];
        $upd = DB::table('monitoring')
                    ->where('id_monitoring','=',$request->input('id_monitoring'))
                    ->update($data);
        if ($upd) {
            return redirect('/monitoring')->with('success','Update Monitoring berhasil');
        } else {
            // ddd($upd);
            return redirect('/monitoring')->with('alert','Update Monitoring gagal');
        }
    }

    public function destroymonitoring($id_monitoring = null)
    {
        $hapus = Monitoring::where('id_monitoring',$id_monitoring)->delete();
        
            if($hapus){
                return redirect('monitoring')->with('alert','Data Monitoring Berhasil Dihapus');
            }
    }

    public function printmonitoring($id_monitoring = null)
    {
        $print = DB::table('view_monitoring')->where('id_monitoring','=',$id_monitoring)->get();
        return view('monitoring.laporanmonitoring',[
            'print' => $print,
            'print2' => $print,
            'print3' => $print,
            'print4' => $print
        ]);
    }
}