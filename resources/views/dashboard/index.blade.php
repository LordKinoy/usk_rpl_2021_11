@extends('layouts.main')

@section('title', 'Dashboard | SIMAK')

@section('container')

@if (Session::has('alert'))
{{-- pop up alert --}}
<input id="my-modal-5" type="checkbox" class="modal-toggle" checked={true} />
<div class="modal">
    <div class="modal-box w-1/4 bg-white text-center text-black">
        <x-heroicon-s-x-mark class="m-auto w-1/4 items-center text-red-600" />
        <p class="py-4 text-red-600">{{ Session::get('alert') }} <br> <img src="{{ asset('foto_profile/rock.jpg') }}" />
        </p>
        <div class="modal-action">
            <label for="my-modal-5" class="btn bg-[#0A3A58]">TUTUP</label>
        </div>
    </div>
</div>
@endif

<div class="mb-3 w-full text-center text-[20px] font-normal uppercase tracking-widest text-[#173a6e] md:text-[28px]">
    selamat datang
    @if (Auth::user()->level_user == 1 ||
    Auth::user()->level_user == 2 ||
    Auth::user()->level_user == 3 ||
    Auth::user()->level_user == 4)
    {{ Auth::user()->guru->nama_guru }}
    @elseif (Auth::user()->level_user == 5)
    {{ Auth::user()->pembimbingperusahaan->nama_pp }}
    @else
    {{ Auth::user()->siswa->nama_siswa }}
    @endif
</div>
<div class="flex flex-wrap gap-4 lg:grid lg:grid-cols-4 lg:grid-rows-5">
    {{-- Profile --}}
    <div
        class="col-span-2 row-span-2 h-[327px] w-full rounded-xl bg-[#0A3A58] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-10">
        {{-- div 1 --}}
        <div>
            <p class="text-[32px] font-semibold uppercase tracking-widest">Profil</p>
        </div>
        {{-- div 2 --}}
        <div class="flex-rows flex">
            <div>
                <x-heroicon-o-user-circle class="w-[110px] text-[#7893a3] md:w-[150px]" />
            </div>
            <div class="mt-[20px] md:ml-5">
                <p class="text-lg font-light md:text-2xl">
                    @if (Auth::user()->level_user == 1 ||
                    Auth::user()->level_user == 2 ||
                    Auth::user()->level_user == 3 ||
                    Auth::user()->level_user == 4)
                    {{ Auth::user()->guru->nama_guru }}
                    @elseif (Auth::user()->level_user == 5)
                    {{ Auth::user()->pembimbingperusahaan->nama_pp }}
                    @else
                    {{ Auth::user()->siswa->nama_siswa }}
                    @endif
                </p>
                <p class="text-lg font-light md:text-2xl">{{ Auth::user()->leveluser->nama_level }}</p>
                <a href="#" class="hidden h-20 md:inline">
                    <button class="mt-5 cursor-pointer rounded-md bg-[#ffffff] px-3 py-1 align-bottom text-[#4C77A9]">
                        <label for="my-modal-3" class="cursor-pointer">
                            Lihat Profil
                        </label>
                    </button>
                </a>
            </div>
        </div>
        {{-- div 3 --}}
        <div class="relative mt-8 md:mt-10 md:block">
            <a href="#" class="absolute right-0 left-0 -bottom-16 md:hidden">
                <button class="mt-3 w-full rounded-md bg-[#ffffff] px-3 py-1 align-bottom text-[#4C77A9]">
                    <label for="my-modal-3" class="cursor-pointer">
                        Lihat Profil
                    </label>
                </button>
            </a>
        </div>
    </div>

    @if (Auth::user()->level_user == 1 || Auth::user()->level_user == 2 || Auth::user()->level_user == 3)
    {{-- Surat pengajuan GURU --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#256D85] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest">Surat Pengajuan</p>
            </div>
            <div>
                <a href="/suratpengajuan">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-document-text class="w-[130px] text-[#7893a3] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 6)
    {{-- Surat pengajuan SISWA --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#256D85] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest">Surat Pengajuan</p>
            </div>
            <div>
                <a href="{{ route('pengajuan.index') }}">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-document-text class="w-[130px] text-[#7893a3] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 1)
    {{-- level user --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#dff6ff] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#1e586c]">Level User</p>
            </div>
            <div>
                <a href="#">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-400">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-user-group class="w-[130px] text-[#a5ccd9] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 1)
    {{-- Data Prakerin --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#67699d] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Data Prakerin</p>
            </div>
            <div>
                <a href="/dataprakerin">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-500">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-s-document-text class="w-[130px] text-[#abacc9] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 2)
    {{-- Pembimbing Sekolah --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#dff6ff] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#1e586c]">Pembimbing Sekolah</p>
            </div>
            <div>
                <a href="/pilihpembimbingsekolah">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-400">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-s-user-minus class="w-[130px] text-[#a5ccd9] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 3 || Auth::user()->level_user == 6)
    {{-- Presensi Siswa --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#00b191] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between lg:w-[45%]">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Presensi Siswa</p>
            </div>
            <div>
                <a href="{{ route('presensi-siswa.index') }}">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-clock class="w-[130px] text-[#73d4c2] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 4)
    {{-- Presensi Siswa --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#00b191] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between lg:w-[45%]">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Presensi Siswa</p>
            </div>
            <div>
                <a href="/presensi-siswasiswa">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-clock class="w-[130px] text-[#73d4c2] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 5)
    {{-- Presensi Siswa --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#00b191] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between lg:w-[45%]">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Presensi Siswa</p>
            </div>
            <div>
                <a href="{{ route('presensi.pp.index') }}">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-clock class="w-[130px] text-[#73d4c2] md:w-[140px]" />
        </div>
    </div>
    @endif


    @if (Auth::user()->level_user == 5)
    {{-- Penilaian --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#47b5ff] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest">Penilaian</p>
            </div>
            <div>
                <a href="#">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-500">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-clipboard-document-check class="w-[130px] text-[#8bd0ff] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 2 || Auth::user()->level_user == 4)
    {{-- Monitoring --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#ad68a6] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest">Monitoring</p>
            </div>
            <div>
                <a href="/monitoring">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-500">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-computer-desktop class="w-[130px] text-[#d2acce] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 1)

    {{-- View Perusahaan Aktif --}}

    <div class="col-span-4 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Perusahaan Ter-Aktif</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">Nama Perusahaan</td>
                <td class="bg-white text-black">Kontak</td>
                <td class="bg-white text-black">Alamat</td>
                <td class="bg-white text-black">Jumlah Murid</td>
            </tr>

            <?php $i = 1; ?>

            @foreach ($view_perusahaan_aktif as $key)
            <tr class="text-center">
                <td class="table-auto bg-white text-black">{{ $i++ }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_perusahaan }}</td>
                @if ($key->kontak_perusahaan !== null)
                <td class="table-auto bg-white text-black">{{ $key->kontak_perusahaan }}</td>
                @else
                <td class="table-auto bg-white text-red-500">Tidak Ada</td>
                @endif
                <td class="table-auto bg-white text-black">{{ $key->alamat_perusahaan }}</td>
                <td class="table-auto bg-white text-black">{{ $key->jml_murid }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    @endif

    @if (Auth::user()->level_user == 2 ||
    Auth::user()->level_user == 3 ||
    Auth::user()->level_user == 4 ||
    Auth::user()->level_user == 5)
    {{-- Data Prakerin --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#67699d] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Data Prakerin</p>
            </div>
            <div>
                <a href="/dataprakerin">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-500">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-s-document-text class="w-[130px] text-[#abacc9] md:w-[140px]" />
        </div>
    </div>
    @endif

    @if (Auth::user()->level_user == 4)

    {{-- View PS Siswa --}}

    <div class="col-span-4 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Siswa Yang Dibimbing</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">NIS</td>
                <td class="bg-white text-black">Nama</td>
                <td class="bg-white text-black">Kelas</td>
                <td class="bg-white text-black">Perusahaan</td>
            </tr>

            <?php $i = 1; ?>

            @foreach ($view_ps_siswa as $key)
            <tr class="text-center">
                <td class="table-auto bg-white text-black">{{ $i++ }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nis }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_siswa }}</td>
                @if ($key->tingkat_kelas == null)
                <td class="table-auto bg-white text-black">-</td>
                @else
                <td class="table-auto bg-white text-black">{{ $key->tingkat_kelas }} {{ $key->akronim }}
                    {{ $key->nama_kelas }}</td>
                @endif
                <td class="table-auto bg-white text-black">{{ $key->nama_perusahaan }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    @endif

    @if (Auth::user()->level_user == 3)

    {{-- View Walas Siswa --}}

    <div class="col-span-4 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Siswa Yang Belum Prakerin</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">NIS</td>
                <td class="bg-white text-black">Nama</td>
                <td class="bg-white text-black">Kelas</td>
                <td class="bg-white text-black">Nama Walas</td>
            </tr>

            <?php $i = 1; ?>

            @foreach ($view_walas_siswa as $key)
            <tr class="text-center">
                <td class="table-auto bg-white text-black">{{ $i++ }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nis }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_siswa }}</td>
                <td class="table-auto bg-white text-black">{{ $key->tingkat_kelas }} {{ $key->akronim }}
                    {{ $key->nama_kelas }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_walas }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    @endif

    @if (Auth::user()->level_user == 6)

    {{-- View Perusahaan Aktif --}}

    <div class="col-span-4 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Perusahaan Ter-Aktif</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">Nama Perusahaan</td>
                <td class="bg-white text-black">Kontak</td>
                <td class="bg-white text-black">Alamat</td>
                <td class="bg-white text-black">Jumlah Murid</td>
            </tr>

            <?php $i = 1; ?>

            @foreach ($view_perusahaan_aktif as $key)
            <tr class="text-center">
                <td class="table-auto bg-white text-black">{{ $i++ }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_perusahaan }}</td>
                @if ($key->kontak_perusahaan !== null)
                <td class="table-auto bg-white text-black">{{ $key->kontak_perusahaan }}</td>
                @else
                <td class="table-auto bg-white text-red-500">Tidak Ada</td>
                @endif
                <td class="table-auto bg-white text-black">{{ $key->alamat_perusahaan }}</td>
                <td class="table-auto bg-white text-black">{{ $key->jml_murid }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    @endif

    @if (Auth::user()->level_user == 2)

    @if (Auth::user()->guru->kepalaprogram->jurusan == null)

    <div class="col-span-3 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Daftar Murid Yang Belum Prakerin</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">NIS</td>
                <td class="bg-white text-black">Nama Siswa</td>
                <td class="bg-white text-black">Angkatan</td>
                <td class="bg-white text-black">Kelas</td>
            </tr>
        </table>
    </div>
    @else
    {{-- View Murid yang belum prakerin --}}

    <div class="col-span-3 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Daftar Murid
                    {{ Auth::user()->guru->kepalaprogram->jurusan->akronim }} Yang Belum Prakerin</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">NIS</td>
                <td class="bg-white text-black">Nama Siswa</td>
                <td class="bg-white text-black">Angkatan</td>
                <td class="bg-white text-black">Kelas</td>
            </tr>

            <?php $i = 1; ?>

            @foreach ($view_kaprog_siswa as $key)
            <tr class="text-center">
                <td class="table-auto bg-white text-black">{{ $i++ }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nis }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_siswa }}</td>
                <td class="table-auto bg-white text-black">{{ $key->tahun }}</td>
                <td class="table-auto bg-white text-black">{{ $key->tingkat_kelas }} {{ $key->akronim }}
                    {{ $key->nama_kelas }}</td>
            </tr>
            @endforeach


        </table>
    </div>
    @endif

    @endif

    @if (Auth::user()->level_user == 5)

    {{-- View Murid yang dibimbing --}}

    <div class="col-span-4 h-[155px] text-white">
        <table border="1" cellpadding="0" class="table w-full border-collapse text-center">
            <tr class="border-collapse text-white">
                <td colspan="8" class="w-max-auto sticky h-14 bg-[#0A3A58]">Daftar Murid Yang Dibimbing</td>
            </tr>
            <tr>
                <td class="bg-white text-black">No</td>
                <td class="bg-white text-black">NIS</td>
                <td class="bg-white text-black">Nama Siswa</td>
                <td class="bg-white text-black">Perusahaan</td>
                <td class="bg-white text-black">Kepala Program</td>
            </tr>

            <?php $i = 1; ?>

            @foreach ($view_pp_siswa as $key)
            <tr class="text-center">
                <td class="table-auto bg-white text-black">{{ $i++ }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nis }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_siswa }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_perusahaan }}</td>
                <td class="table-auto bg-white text-black">{{ $key->nama_kaprog }}</td>
            </tr>
            @endforeach


        </table>
    </div>

    @endif

    @if (Auth::user()->level_user == 2)
    {{-- Kompetensi --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#256D85] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Kompetensi</p>
            </div>
            <div>
                <a href="/kompetensi">
                    <button
                        class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9] shadow-md shadow-slate-500">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-m-clipboard-document-list class="w-[130px] text-[#abacc9] md:w-[140px]" />
        </div>
    </div>
    @endif

</div>

@if (Auth::user()->level_user == 2)

{{-- pop up profile --}}
<input id="my-modal-3" type="checkbox" class="modal-toggle" />
<div class="modal">
    <div class="w-[60em] rounded-2xl bg-transparent">
        <div class="card card-side m-auto w-[24em] bg-base-100 shadow-xl md:w-[40em]">
            <label for="my-modal-3"
                class="btn-sm btn-circle btn absolute right-2 top-2 border border-[#000000] bg-[#eb2424] hover:bg-red-500">✕</label>
            <div class="w-[15em] rounded-l-2xl bg-[#d9d9d9] pb-3">
                <div class="ml-3 mb-3 w-full text-xl font-normal uppercase text-[#173A6F]">
                    <p>Profile</p>
                </div>
                <div class="flex space-x-2">
                    <label tabindex="0" class="avatar m-auto mt-[0.3em]">
                        <div class="w-[10em] rounded-full">
                            @if (Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" />
                            @else
                            <img src="{{ asset('foto_profile/profile.jpg') }}" />
                            @endif
                        </div>
                    </label>
                </div>
                <div class="m-auto mt-5 h-[3em] w-fit text-center">
                    <form action="/dashboard/gantifoto/{id}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="hidden" value="{{ Auth::user()->id }}" />
                        <input id="foto" type="file" name="foto" accept="image/*"
                            class="file-input-bordered file-input file-input-xs m-auto w-3/4 max-w-xs text-center" />
                        <button type="submit" class="mt-2 w-fit rounded-md bg-[#ffffff] px-2 py-1 text-[#4C77A9]">Simpan
                            Foto
                        </button>
                    </form>
                    @if (Session::has('errors'))
                    <p class="w-full text-center text-red-500">{{ Session::get('errors') }}</p>
                    @endif
                </div>
            </div>
            <div class="card-body w-[20em] pb-3">
                @auth
                <div class="m-auto mb-4 h-min w-full">
                    <label class="text-md font-normal" for="">NAMA</label>
                    <br>
                    <span class="text-center text-lg">{{ Auth::user()->guru->nama_guru }}</span>
                </div>
                @endauth
                <div class="mb-4 h-min w-full">
                    <label class="text-md font-normal" for="">NIP</label>
                    <br>
                    <span class="text-center text-lg">{{ Auth::user()->guru->nip_guru }}</span>
                </div>
                <div class="mb-4 h-min w-full">
                    <label class="text-md font-normal" for="">LEVEL</label>
                    <br>
                    <span class="text-center text-lg">{{ Auth::user()->leveluser->nama_level }}</span>
                </div>
                <div class="mb-4 h-min w-full">
                    <label class="text-md font-normal" for="">JURUSAN</label>
                    <br>
                    @auth
                    @if (!isset(Auth::user()->guru->kepalaprogram->jurusan->nama_jurusan))
                    <form action="/dashboard/pilihjurusan" method="POST">
                        @csrf
                        <input type="text" hidden name="id_kaprog"
                            value="{{ Auth::user()->guru->kepalaprogram->id_kaprog }}">
                        <select id="" name="jurusan">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusan as $key)
                            <option value="{{ $key->id_jurusan }}">{{ $key->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-fit rounded-md bg-[#ffffff] px-2 py-1 text-[#4C77A9]">Simpan
                        </button>
                    </form>
                    @else
                    <div class="flex">
                        <div class="flex-warp mr-2">
                            <span
                                class="text-center text-lg">{{ Auth::user()->guru->kepalaprogram->jurusan->nama_jurusan }}</span>
                        </div>
                        <div class="flex-warp">
                            <form action="/dashboard/lepasjurusan" method="post">
                                @method('PUT')
                                @csrf
                                <input type="text" name="id_kaprog" hidden
                                    value="{{ Auth::user()->guru->kepalaprogram->id_kaprog }}">
                                <input type="text" name="jurusan_ada" hidden
                                    value="{{ Auth::user()->guru->kepalaprogram->jurusan->id_jurusan }}">
                                <button
                                    class="rounded-lg bg-red-500 px-1 py-1 text-black shadow-[1px_2px_5px_rgba(0,0,1,0.2)] transition hover:bg-red-600 active:bg-slate-500"
                                    type="submit">Lepas
                                    Jurusan</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endauth
                </div>
                <div class="mb-4 h-min w-full">
                    <label class="text-md font-normal" for="">E-MAIL</label>
                    <br>
                    <span class="text-center text-lg">{{ Auth::user()->email }}</span>
                </div>
                <div class="mb-4 h-min w-full">
                    <label class="text-md font-normal" for="">KONTAK</label>
                    <br>
                    @auth
                    @if (!isset(Auth::user()->guru->kontak_guru->kontak))
                    <span class="text-center text-lg">-</span>
                    @else
                    <span class="text-center text-lg">{{ Auth::user()->guru->kontak_guru->kontak }}</span>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@if (Auth::user()->level_user == 1 || Auth::user()->level_user == 3 || Auth::user()->level_user == 4)

{{-- pop up profile --}}
<input id="my-modal-3" type="checkbox" class="modal-toggle" />
<div class="modal">
    <form action="/dashboard/gantifoto/{id}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="w-[60em] rounded-2xl bg-transparent">
            <div class="card card-side m-auto w-[24em] bg-base-100 shadow-xl md:w-[40em]">
                <label for="my-modal-3"
                    class="btn-sm btn-circle btn absolute right-2 top-2 border border-[#000000] bg-[#eb2424] hover:bg-red-500">✕</label>
                <div class="w-[15em] rounded-l-2xl bg-[#d9d9d9] pb-3">
                    <div class="ml-3 mb-3 w-full text-xl font-normal uppercase text-[#173A6F]">
                        <p>Profile</p>
                    </div>
                    <div class="flex space-x-2">
                        <label tabindex="0" class="avatar m-auto mt-[0.3em]">
                            <div class="w-[10em] rounded-full">
                                @if (Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" />
                                @else
                                <img src="{{ asset('foto_profile/profile.jpg') }}" />
                                @endif
                            </div>
                        </label>
                    </div>
                    <div class="m-auto mt-5 h-[3em] w-fit text-center">
                        <input type="text" class="hidden" value="{{ Auth::user()->id }}" />
                        <input id="foto" type="file" name="foto" accept="image/*"
                            class="file-input-bordered file-input file-input-xs m-auto w-3/4 max-w-xs text-center" />
                        @if (Session::has('errors'))
                        <p class="w-full text-center text-red-500">{{ Session::get('errors') }}</p>
                        @endif
                    </div>
                </div>
                <div class="card-body w-[20em] pb-3">
                    @auth
                    <div class="m-auto mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">NAMA</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->guru->nama_guru }}</span>
                    </div>
                    @endauth
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">NIP</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->guru->nip_guru }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">LEVEL</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->leveluser->nama_level }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">E-MAIL</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">KONTAK</label>
                        <br>
                        @auth
                        @if (!isset(Auth::user()->guru->kontak_guru->kontak))
                        <span class="text-center text-lg">-</span>
                        @else
                        <span class="text-center text-lg">{{ Auth::user()->guru->kontak_guru->kontak }}</span>
                        @endif
                        @endauth
                    </div>
                    <div class="mb-4 h-min w-full text-right">
                        <button type="submit" class="w-fit rounded-md bg-[#ffffff] px-2 py-1 text-[#4C77A9]">Simpan
                            Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endif

@if (Auth::user()->level_user == 5)

{{-- pop up profile --}}
<input id="my-modal-3" type="checkbox" class="modal-toggle" />
<div class="modal">
    <form action="/dashboard/gantifoto/{id}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="w-[60em] rounded-2xl bg-transparent">
            <div class="card card-side m-auto w-[24em] bg-base-100 shadow-xl md:w-[40em]">
                <label for="my-modal-3"
                    class="btn-sm btn-circle btn absolute right-2 top-2 border border-[#000000] bg-[#eb2424] hover:bg-red-500">✕</label>
                <div class="w-[15em] rounded-l-2xl bg-[#d9d9d9] pb-3">
                    <div class="ml-3 mb-3 w-full text-xl font-normal uppercase text-[#173A6F]">
                        <p>Profile</p>
                    </div>
                    <div class="flex space-x-2">
                        <label tabindex="0" class="avatar m-auto mt-[0.3em]">
                            <div class="w-[10em] rounded-full">
                                @if (Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" />
                                @else
                                <img src="{{ asset('foto_profile/profile.jpg') }}" />
                                @endif
                            </div>
                        </label>
                    </div>
                    <div class="m-auto mt-5 h-[3em] w-fit text-center">
                        <input type="text" class="hidden" value="{{ Auth::user()->id }}" />
                        <input id="foto" type="file" name="foto"
                            class="file-input-bordered file-input file-input-xs m-auto w-3/4 max-w-xs text-center" />
                    </div>
                </div>
                <div class="card-body w-[20em] pb-3">
                    @auth
                    <div class="m-auto mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">NAMA</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->pembimbingperusahaan->nama_pp }}</span>
                    </div>
                    @endauth
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">NIK</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->pembimbingperusahaan->nik_pp }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">LEVEL</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->leveluser->nama_level }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">E-MAIL</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="mb-4 h-min w-full text-right">
                        <button type="submit" class="w-fit rounded-md bg-[#ffffff] px-2 py-1 text-[#4C77A9]">Simpan
                            Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endif

@if (Auth::user()->level_user == 6)

{{-- pop up profile --}}
<input id="my-modal-3" type="checkbox" class="modal-toggle" />
<div class="modal">
    <form action="/dashboard/gantifoto/{id}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="w-[60em] rounded-2xl bg-transparent">
            <div class="card card-side m-auto w-[24em] bg-base-100 shadow-xl md:w-[40em]">
                <label for="my-modal-3"
                    class="btn-sm btn-circle btn absolute right-2 top-2 border border-[#000000] bg-[#eb2424] hover:bg-red-500">✕</label>
                <div class="w-[15em] rounded-l-2xl bg-[#d9d9d9] pb-3">
                    <div class="ml-3 mb-3 w-full text-xl font-normal uppercase text-[#173A6F]">
                        <p>Profile</p>
                    </div>
                    <div class="flex space-x-2">
                        <label tabindex="0" class="avatar m-auto mt-[0.3em]">
                            <div class="w-[10em] rounded-full">
                                @if (Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" />
                                @else
                                <img src="{{ asset('foto_profile/profile.jpg') }}" />
                                @endif
                            </div>
                        </label>
                    </div>
                    <div class="m-auto mt-5 h-[3em] w-fit text-center">
                        <input type="text" class="hidden" value="{{ Auth::user()->id }}" />
                        <input id="foto" type="file" name="foto"
                            class="file-input-bordered file-input file-input-xs m-auto w-3/4 max-w-xs text-center" />
                    </div>
                </div>
                <div class="card-body w-[20em] pb-3">
                    @auth
                    <div class="m-auto mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">NAMA</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->siswa->nama_siswa }}</span>
                    </div>
                    @endauth
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">NIS</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->siswa->nis }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">ANGKATAN</label>
                        <br>
                        @auth
                        @if (!isset(Auth::user()->siswa->kelas->angkatan))
                        <span class="text-center text-lg">-</span>
                        @else
                        <span class="text-center text-lg">{{ Auth::user()->siswa->kelas->angkatan->tahun }}</span>
                        @endif
                        @endauth
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">JURUSAN</label>
                        <br>
                        @auth
                        @if (!isset(Auth::user()->siswa->kelas->jurusan))
                        <span class="text-center text-lg">-</span>
                        @else
                        <span class="text-center text-lg"><span
                                class="text-center text-lg">{{ Auth::user()->siswa->kelas->jurusan->nama_jurusan }}
                                ({{ Auth::user()->siswa->kelas->jurusan->akronim }})
                            </span></span>
                        @endif
                        @endauth
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">KELAS</label>
                        <br>
                        @auth
                        @if (!isset(Auth::user()->siswa->kelas))
                        <span class="text-center text-lg">-</span>
                        @else
                        <span class="text-center text-lg">{{ Auth::user()->siswa->kelas->tingkat_kelas }}
                            {{ Auth::user()->siswa->kelas->nama_kelas }}</span>
                        @endif
                        @endauth
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">LEVEL</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->leveluser->nama_level }}</span>
                    </div>
                    <div class="mb-4 h-min w-full">
                        <label class="text-md font-normal" for="">E-MAIL</label>
                        <br>
                        <span class="text-center text-lg">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="mb-4 h-min w-full text-right">
                        <button type="submit" class="w-fit rounded-md bg-[#ffffff] px-2 py-1 text-[#4C77A9]">Simpan
                            Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endif

@endsection