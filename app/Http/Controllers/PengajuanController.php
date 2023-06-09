<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\ViewLihatPengajuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;

class PengajuanController extends Controller
{
    private $kaprog;
    private $walas;
    private $staff_hubin;
    protected $suratpengajuan;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->kaprog = DB::table('kepala_program')
                        ->join('guru', 'kepala_program.id_guru', '=', 'guru.id_guru')
                        ->select('kepala_program.id_kaprog', 'guru.nama_guru')
                        ->get();

      $this->walas = DB::table('wali_kelas')
                      ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')
                      ->select('wali_kelas.id_walas', 'guru.nama_guru')
                      ->get();

      $this->staff_hubin = DB::table('staff_hubin')
                            ->join('guru', 'staff_hubin.id_guru', '=', 'guru.id_guru')
                            ->select('staff_hubin.id_staff', 'guru.nama_guru')
                            ->get();
                            
      $this->suratpengajuan = Pengajuan::all();   
      $this->middleware('auth:web',[]);                   
    }
    
    public function index()
    {                       
      $pengajuan = ViewLihatPengajuan::get();

      if (request('cari')) {
        $pengajuan = ViewLihatPengajuan::where('nama_perusahaan', 'LIKE', '%'.request('cari').'%')->get();
      }
                    
      return view('dashboard.siswa.pengajuan.index', [
        'pengajuans' => $pengajuan,
        'kaprogs' => $this->kaprog,
        'walass' => $this->walas,
        'staff_hubins' => $this->staff_hubin
      ]);
    }

    public function indexsuratpengajuan()
    {

        if (Auth::user()->level_user == 1):
            return view('suratpengajuan.index', [
                'sp3' => Pengajuan::where('status_pengajuan','=',5)
                ->orWhere('status_pengajuan','=',6)
                ->orWhere('status_pengajuan','=',7)
                ->orderBy('id_pengajuan', 'desc')->paginate(10)->withQueryString()
            ]);
        endif;

        if (Auth::user()->level_user == 2):
            return view('suratpengajuan.index', [
                'sp' => Pengajuan::where('status_pengajuan','=',3)
                ->orWhere('status_pengajuan','=',4)
                ->orderBy('id_pengajuan', 'desc')->paginate(10)->withQueryString(),
            ]);
        endif;
        
        if (Auth::user()->level_user == 3):
            return view('suratpengajuan.index', [
                'sp2' => Pengajuan::where('status_pengajuan','=',1)
                ->orWhere('status_pengajuan','=',2)
                ->orderBy('id_pengajuan', 'desc')->paginate(10)->withQueryString(),
            ]);
        endif;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengajuanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi pengisisan pengajuan
        $validated = $request->validate([
          "nis" => ['required', 'max:15'],
          "perusahaan" => ['required', 'max:60'],
          "alamat_perusahaan" => ['required', 'max:60'],
          "telepon_perusahaan" => ['max:60'],
          "kaprog" => ['required', 'max:4'],
          "walas" => ['required', 'max:4'],
          "staff_hubin" => ['required', 'max:4'],
          "bukti_terima" => ['image', 'file', 'max:1024']
        ]);

        // cek apakah nis sama dengan yang di profil
        if ($validated['nis'] != Auth::user()->siswa->nis) {
          return back()->withErrors('NIS tidak sesuai');
        }

        // upload file ke storage
        if($request->file('bukti_terima')) {
          $validated['bukti_terima'] = $request->file('bukti_terima')->store('bukti_terima');
        } else {
          $validated['bukti_terima'] = null;
        }

        try {
        // execute procedure
        DB::select('CALL procedure_tambah_pengajuan(?, ?, ?, ?, ?, ?, ?, ?)', [
          $validated['nis'],
          $validated['perusahaan'],
          $validated['alamat_perusahaan'],
          $validated['telepon_perusahaan'],
          $validated['kaprog'],
          $validated['walas'],
          $validated['staff_hubin'],
          $validated['bukti_terima']
        ]);

        } catch(Exception $err) {
          // reload page apabila gagal kirim pengajuan
          // return back()->withErrors('Pengajuan gagal dikirim');
          return $err->getMessage();
        }
      // redirect ke siswa/pengajuan apabila sukses kirim pengajuan
      return redirect(route('pengajuan.index'))->withSuccess('Pengajuan berhasil dikirim');
    }

    public function carisuratpengajuan(Request $request)
    {
      $caripengajuan = Pengajuan::where('nis','like',"%".request('show')."%")
          ->get();

          // dd($caripengajuan);
          if (Auth::user()->level_user == 1):
              return view('suratpengajuan.index', [
                  'sp3' =>  $caripengajuan
              ]);
          endif;

          if (Auth::user()->level_user == 2):
              return view('suratpengajuan.index', [
                  'sp' =>  $caripengajuan
              ]);
          endif;
          
          if (Auth::user()->level_user == 3):
              return view('suratpengajuan.index', [
                  'sp2' =>  $caripengajuan
              ]);
          endif;
    }

    public function detailsuratpengajuan($id_pengajuan)
    {   
        $dataupdt = $this->suratpengajuan->find($id_pengajuan);

        return view('suratpengajuan.edit', [
            'edit' => $dataupdt
        ]);
    }

    public function updateterima(Request $request)
    {
        $dataTerima = [
            'status_pengajuan' => $request->status_pengajuan
        ];
        
        $upd = DB::table('pengajuan')
        -> where('id_pengajuan', $request->input('id_pengajuan'))
        -> update($dataTerima);
        
        if ($upd) {
            return redirect('/suratpengajuan')->withSuccess('Pengajuan berhasil diverifikasi !');
        }
    }

    public function edit(Pengajuan $pengajuan)
    {
      $getPengajuan = DB::table('pengajuan')
                    ->join('perusahaan', 'pengajuan.id_perusahaan', '=', 'perusahaan.id_perusahaan')
                    ->leftJoin('kontak_perusahaan', 'perusahaan.id_perusahaan', '=', 'kontak_perusahaan.id_perusahaan')
                    ->select('pengajuan.*', 'perusahaan.*', 'kontak_perusahaan.*')
                    ->where('id_pengajuan', '=', $pengajuan->id_pengajuan)
                    ->get();

      return view('dashboard.siswa.pengajuan.edit', [
        'pengajuan' => $getPengajuan,
        'kaprogs' => $this->kaprog,
        'walass' => $this->walas,
        'staff_hubins' => $this->staff_hubin
      ]);
    }
    
    public function updatehubin(Request $request)
    {
        $dataTerima = [
            'id_pengajuan' => $request->id_pengajuan,
            'nis' => $request->nis,
            'id_kaprog' => $request->id_kaprog,
            'id_perusahaan' => $request->id_perusahaan,
            'status_pengajuan' => $request->status_pengajuan
        ];
        try {
            // execute procedure
        Pengajuan::hydrate(DB::select('CALL procedure_tambah_prakerin(?, ?, ?, ?, ?)', [
            $dataTerima['id_pengajuan'],
            $dataTerima['nis'],
            $dataTerima['id_kaprog'],
            $dataTerima['id_perusahaan'],
            $dataTerima['status_pengajuan']
          ]));
        } catch(Exception) {
            // reload page apabila gagal buat akun
            return back()->withErrors('Pengajuan gagal disahkan');
          }
        // redirect ke hubin/leveluser apabila sukses buat akun
        return redirect('/suratpengajuan');
    }

    public function updatetolak(Request $request)
    {
      $dataTolak = [
        'status_pengajuan'   => $request->status_pengajuan
      ];
      $upd = DB::table('pengajuan')
            -> where('id_pengajuan', $request->input('id_pengajuan'))
            -> update($dataTolak);
      if ($upd) {
        return redirect('/suratpengajuan')->withAlert('Pengajuan berhasil ditolak !');
      } else {
  
      }
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
      // validasi pengisisan pengajuan
      $validated = $request->validate([
        "nis" => ['required', 'max:15'],
        "perusahaan" => ['required', 'max:60'],
        "alamat_perusahaan" => ['required', 'max:60'],
        "telepon_perusahaan" => ['max:60'],
        "kaprog" => ['required', 'max:4'],
        "walas" => ['required', 'max:4'],
        "staff_hubin" => ['required', 'max:4'],
        "bukti_terima" => ['image', 'file', 'max:1024']
      ]);
      
      // jika ada gambar baru, hapus gambar lama. Jika tidak ada gambar baru, pakai gambar lama
      if($request->file('bukti_terima')) {
        if($pengajuan->bukti_terima) {
          Storage::delete($pengajuan->bukti_terima);
        }
        $validated['bukti_terima'] = $request->file('bukti_terima')->store('bukti_terima');
      } else {
        $validated['bukti_terima'] = $pengajuan->bukti_terima;
      }
      
      try {
      // execute procedure
      DB::select('CALL procedure_update_pengajuan(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        $pengajuan->id_pengajuan,
        $pengajuan->id_perusahaan,
        $validated['nis'],
        $validated['perusahaan'],
        $validated['alamat_perusahaan'],
        $validated['telepon_perusahaan'],
        $validated['kaprog'],
        $validated['walas'],
        $validated['staff_hubin'],
        $validated['bukti_terima'],
      ]);

      } catch(Exception) {
        // reload page apabila gagal kirim pengajuan
        return back()->withErrors('Pengajuan gagal diubah');
      }
      // redirect ke siswa/pengajuan apabila sukses ubah pengajuan
      return redirect(route('pengajuan.index'))->withSuccess('Pengajuan ke '.$validated['perusahaan'].' berhasil diubah');
    }

    // print pengajuan
    public function print(Pengajuan $pengajuan)
    {
      $dataView = DB::table('view_print_pengajuan')->where('id_pengajuan', $pengajuan->id_pengajuan)->first();
      return view('dashboard.siswa.pengajuan.print', ["pengajuan" => $dataView]);
    }

    // hapus pengajuan
    public function destroy(Pengajuan $pengajuan)
    {
      try {
        // cek apakah ada bukti terima
        if ($pengajuan->bukti_terima) {
          Storage::delete($pengajuan->bukti_terima);
        }
        Pengajuan::destroy($pengajuan->id_pengajuan);
      } catch (Exception $th) {
        return back()->withErrors('Pengajuan gagal dihapus');
      }
      return redirect(route('pengajuan.index'))->withSuccess('Pengajuan berhasil dihapus');
    }
}