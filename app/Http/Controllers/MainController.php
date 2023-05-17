<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Leveluser;
use App\Models\Viewbelumprakerin;
use App\Models\Viewprakerin;
use App\Models\Viewperusahaanaktif;
use App\Models\Viewpssiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $levelUser;
    
    public function __construct()
    {
        $this->levelUser = Leveluser::all();
        $this->middleware('auth:web',[]);
    }

    public function index(Request $request)
    {   
        // dd(Auth::user()->guru->kepalaprogram->jurusan->id_jurusan);
        if (Auth::user()->level_user == 1):
            return view('dashboard.index', [
                'level_user' => $this->levelUser,
                'view_perusahaan_aktif' => Viewperusahaanaktif::orderBy('jml_murid', 'desc')
                ->paginate(5)
            ]);
        endif;

        if (Auth::user()->level_user == 2):
            if (Auth::user()->guru->kepalaprogram->jurusan == null) 
            {
                return view('dashboard.index', [
                    'level_user' => $this->levelUser,
                    'jurusan' => Jurusan::all()->whereNull('kepala_jurusan')
                ]);
            } else {
                return view('dashboard.index', [
                    'level_user' => $this->levelUser,
                    'jurusanfull' => Jurusan::all(),
                    'view_kaprog_siswa' => Viewbelumprakerin::all()->where('id_jurusan', '=', Auth::user()->guru->kepalaprogram->jurusan->id_jurusan)
                ]);
            }
        endif;
        
        if (Auth::user()->level_user == 3):
            return view('dashboard.index', [
                'level_user' => $this->levelUser,
                'view_walas_siswa' => Viewbelumprakerin::where('nama_walas','=', Auth::user()->guru->nama_guru)
                ->orderBy('id_prakerin', 'desc')
                ->paginate(5)
            ]);
        endif;

        if (Auth::user()->level_user == 4):
            return view('dashboard.index', [
                'level_user' => $this->levelUser,
                'view_ps_siswa' => Viewpssiswa::all()->where('id_ps','=', Auth::user()->guru->pembimbingsekolah->id_ps)
            ]);
        endif;

        if (Auth::user()->level_user == 5):
            return view('dashboard.index', [
                'level_user' => $this->levelUser,
                'view_pp_siswa' => Viewprakerin::where('nik_pp','=', Auth::user()->pembimbingperusahaan->nik_pp)
                ->orderBy('id_prakerin', 'desc')
                ->paginate(5)
            ]);
        endif;

        if (Auth::user()->level_user == 6):
            return view('dashboard.index', [
                'level_user' => $this->levelUser,
                'view_perusahaan_aktif' => Viewperusahaanaktif::orderBy('jml_murid', 'desc')
                ->paginate(5)
            ]);
        endif;
    }

    public function uploadfoto(Request $request)
    {

        $validated = $request->validate([
            "foto" => ['image', 'file', 'max:1024']
          ]);
          
          // jika ada gambar baru, hapus gambar lama. Jika tidak ada gambar baru, pakai gambar lama
          if($request->file('foto')) {
            if(Auth::user()->foto) {
              Storage::delete(Auth::user()->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_profile');
          } else {
            $validated['foto'] = Auth::user()->foto;
          }
        
        $data = DB::table('akun')
        -> where('id', '=', Auth::user()->id)
        -> update([
            'foto' => $validated['foto']
        ]);
        
        if ($data) {
            return redirect('/dashboard');
        } else {
            return redirect('/dashboard')->withErrors('Maaf, foto tidak bisa diubah');
        }
    }

    public function pilihjurusan(Request $request)
    {
        
        $dataJurusan = DB::table('jurusan')
        -> where('id_jurusan','=', $request->jurusan)
        -> update([
            'kepala_jurusan' => $request->id_kaprog
        ]);
        // dd($dataJurusan);
        if ($dataJurusan) {
            return redirect('/dashboard');
        } else {
            return redirect('/dashboard')->withErrors('Maaf, jurusan tidak bisa diubah');
        }
    }

    public function lepasjurusan(Request $request)
    {
        
        $lepasJurusan = DB::table('jurusan')
        -> where('id_jurusan','=', $request->jurusan_ada)
        -> update([
            'kepala_jurusan' => null
        ]);
        // ddd($lepasJurusan);
        if ($lepasJurusan) {
            return redirect('/dashboard');
        } else {
            return redirect('/dashboard')->withErrors('Maaf, jurusan tidak bisa diubah');
        }
    }
}