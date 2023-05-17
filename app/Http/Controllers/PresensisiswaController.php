<?php

namespace App\Http\Controllers;

use App\Models\Presensisiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;

class PresensisiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $presensisiswa;
    public function __construct()
    {
        $this->presensisiswa = new Presensisiswa();
    }
    
    public function index()
    {
      // cek apakah siswa sudah diteruma prakerin
      if(!Auth::user()->siswa->prakerin) {
        return back()->withError('Anda belum diterima Prakerin');
      }

      if(request('cari')) {
        $presensiSiswa = DB::table('view_presensi')
                          ->where('nis', Auth::user()->siswa->nis)
                          ->where('tgl_kehadiran', request('cari'))
                          ->paginate(10);
      } else {
        $presensiSiswa = DB::table('view_presensi')
                          ->where('nis', Auth::user()->siswa->nis)
                          ->paginate(10);
      }

      return view('dashboard.siswa.presensi.index', [
        'presensiSiswa'=>$presensiSiswa,
      ]);
    }

    public function indexPp()
    {
      if (request('cari')) {
        $presensiSiswa = DB::table('view_presensi')
                          ->where('nik_pp', Auth::user()->pembimbingperusahaan->nik_pp)
                          ->where('tgl_kehadiran', request('cari'))
                          ->paginate(20);
      } else {
        $presensiSiswa = DB::table('view_presensi')
                          ->where('nik_pp', Auth::user()->pembimbingperusahaan->nik_pp)
                          ->paginate(20);
      }

      return view('dashboard.pembimbing_perusahaan.presensi.index', [
        "presensiSiswa" => $presensiSiswa
      ]);
    }

    public function indexPs()
    {
      if (request('cari')) {
        $presensiSiswa = DB::table('view_presensi')
                          ->where('id_ps', Auth::user()->guru->pembimbingsekolah->id_ps)
                          ->where('tgl_kehadiran', request('cari'))
                          ->paginate(20);
      } else {
        $presensiSiswa = DB::table('view_presensi')
                          ->where('id_ps', Auth::user()->guru->pembimbingsekolah->id_ps)
                          ->paginate(20);
      }

      return view('dashboard.pembimbing_sekolah.presensi.index', [
        "presensiSiswa" => $presensiSiswa
      ]);
    }

    //INSERT
    public function store(Request $request)
    {
      //validasi
      $validated = $request->validate([
        "keterangan" => ['required'],
        "tgl_kehadiran" => ['required'],
        "jam_masuk" => ['required'],
        "jam_keluar" => ['required'],
        "kegiatan" => ['required'],
        "foto_selfie" => ['image', 'file', 'required'],
      ]);

      // simpan gambar
      $validated['foto_selfie'] = $request->file('foto_selfie')->store('foto_selfie');

      try {
        $dataview = [
            'nis' => $request->input('nis'),
            'nik_pp' => $request->input('nik_pp'),
            'keterangan' => $validated['keterangan'],
            'tgl_kehadiran' => $validated['tgl_kehadiran'],
            'jam_masuk' => $validated['jam_masuk'],
            'jam_keluar' => $validated['jam_keluar'],
            'kegiatan' => $validated['kegiatan'],
            'foto_selfie' => $validated['foto_selfie'],  
            'status_hadir' => 0
        ];

        // insert db
        Presensisiswa::create($dataview);
      } catch (Exception $e) {
          // redirect ke halaman index dengan pesan error
          return $e->getMessage();
      }

      // redirect ke halaman index dengan pesan success
      return redirect(route('presensi-siswa.index'))->withSuccess('Presensi berhasil dibuat');
    }

   //buka halaman edit 
    public function edit($id)
    {
      $dataupdt = DB::table('view_presensi')
                  ->where('id_presensi', $id)
                  ->select()
                  ->get();
                  // dd($dataupdt);

      return view('dashboard.siswa.presensi.edit', ['dataupdt' => $dataupdt]);
    }

    public function update(Request $request, Presensisiswa $presensi)
    {
        // cek apakah status_hadir 0 atau bukan
        if($presensi->status_hadir != 0) {
          return back()->withError('Presensi tidak dapat diubah');
        }

        //validasi
        $validated = $request->validate([
          "tgl_kehadiran" => ['required'],
          "jam_masuk" => ['required'],
          "jam_keluar" => ['required'],
          "keterangan" => ['required'],
          "kegiatan" => ['required'],
          "foto_selfie" => ['image', 'file'],
        ]);

        // cek apakah ada foto baru yang dimasukkan
        if ($request->file('foto_selfie')) {
          // hapus yang lama, masukkan yang baru
          Storage::delete($presensi->foto_selfie);
          $validated['foto_selfie'] = $request->file('foto_selfie')->store('foto_selfie');
        } else {
          // jika tidak ada foto baru maka pakai yang lama
          $validated['foto_selfie'] = $presensi->foto_selfie;
        }
        
        try {
          DB::table('presensi_siswa')
              ->where('id_presensi','=', $presensi->id_presensi)    
              ->update([
                  'tgl_kehadiran'=>$validated['tgl_kehadiran'],
                  'jam_masuk' => $validated['jam_masuk'],
                  'jam_keluar' => $validated['jam_keluar'],
                  'keterangan' => $validated['keterangan'],
                  'kegiatan' => $validated['kegiatan'],
                  'foto_selfie' => $validated['foto_selfie'],
              ]);
        } catch (Exception $e) {
          return $e->getMessage();
        }

        return back()->withSuccess('Presensi berhasil diubah');
    } 

    // terima presensi
    public function terimapresensi($id_presensi)
    { 
      try {
        DB::table('presensi_siswa')
            ->where('id_presensi', $id_presensi)
            ->update([
              'status_hadir' => 2
            ]);
      } catch (Exception $th) {
        return back()->withErrors('Gagal menerima presensi');
      }

      return back()->withSuccess('Berhasil terima presensi');
    }

    // tolak presensi
    public function tolakpresensi($id_presensi)
    {
      try {
        DB::table('presensi_siswa')
            ->where('id_presensi', $id_presensi)
            ->update([
              'status_hadir' => 1
            ]);
      } catch (Exception $th) {
        return back()->withErrors('Gagal menerima presensi');
      }

      return back()->withSuccess('Berhasil tolak presensi');
    }

    public function filter_presensi(Request $request)
    {
      // menangkap data pencarian
      $prakerin = DB::table('prakerin')
      ->select()
      ->get();
      $filterpresensi = $request->filter;

      // mengambil data dari table presensi_siswa sesuai pencarian data
      $dataview = DB::table('view_presensi')
      ->where('status_hadir',$filterpresensi)
      ->paginate();

      return view('dashboard.siswa.presensi.index',[
        'dataview' => $dataview,
        'prakerin' => $prakerin
        ]);
    }

    public function print($id)
    {
      $data_presensi = DB::table('view_presensi')
                        ->where('nis', $id)
                        ->select()
                        ->get();
                  //  dd($data_presensi);
                  
      return view('dashboard.siswa.presensi.laporan  ', ['data_presensi' => $data_presensi]);
    }

    public function destroy(Presensisiswa $presensi) {
      if($presensi->status_hadir != 0) {
        return back()->withError('Gagal hapus presensi');
      }

      try {
        Presensisiswa::destroy($presensi->id_presensi);
      } catch (Exception $e) {
        return back()->withError('Gagal hapus presensi');
      }
    }

}