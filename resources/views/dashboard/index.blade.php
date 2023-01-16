@extends('layouts.main')

@section('title', 'Dashboard Hubin - SIMAK')

@section('container')
<div class="mb-3 w-full text-center text-[20px] font-normal uppercase tracking-widest text-[#173a6e] md:text-[28px]">
    selamat datang
    {{ auth()->user()->username }}</div>
<div class="flex flex-wrap gap-4 lg:grid lg:grid-cols-4 lg:grid-rows-3">
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
                <p class="text-lg font-light md:text-2xl">{{Auth::user()->username }}</p>
                @if (Auth::user()->level_user == 1)
                <p class="text-lg font-light md:text-2xl">Super Admin</p>
                @elseif (Auth::user()->level_user == 2)
                <p class="text-lg font-light md:text-2xl">Staff Hubin</p>
                @elseif (Auth::user()->level_user == 3)
                <p class="text-lg font-light md:text-2xl">Kepala Program</p>
                @elseif (Auth::user()->level_user == 4)
                <p class="text-lg font-light md:text-2xl">Wali Kelas</p>
                @elseif (Auth::user()->level_user == 5)
                <p class="text-lg font-light md:text-2xl">Pembimbing Sekolah</p>
                @elseif (Auth::user()->level_user == 6)
                <p class="text-lg font-light md:text-2xl">Pembimbing Perusahaan</p>
                @elseif (Auth::user()->level_user == 7)
                <p class="text-lg font-light md:text-2xl">Siswa</p>
                @endif
                <a href="#" class="hidden h-20 md:inline">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-3 py-1 align-bottom text-[#4C77A9]">
                        <label for="my-modal-3">
                            Lihat Profil
                        </label>
                    </button>
                </a>
            </div>
        </div>
        {{-- div 3 --}}
        <div class="relative mt-8 md:mt-10 md:block">
            <a href="#" class="absolute right-0 left-0 -bottom-16 md:hidden">
                <button class="mt-3 w-full rounded-md bg-[#ffffff] px-3 py-1 align-bottom text-[#4C77A9]">Edit
                    Profil</button>
            </a>
        </div>
    </div>

    {{-- Surat pengajuan --}}
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

    {{-- Nilai sertifikat --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#47b5ff] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest">Nilai Sertifikat</p>
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
            <x-heroicon-o-clipboard-document-list class="w-[130px] text-[#8bd0ff] md:w-[140px]" />
        </div>
    </div>

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

    {{-- sertifikat --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#67699d] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Sertifikat</p>
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
            <x-heroicon-o-document-check class="w-[130px] text-[#abacc9] md:w-[140px]" />
        </div>
    </div>

    {{-- Wali Kelas --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#0A3A58] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Wali Kelas</p>
            </div>
            <div>
                <a href="#">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-user-plus class="w-[130px] text-[#7893a3] md:w-[140px]" />
        </div>
    </div>

    {{-- Kepala Program --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#256D85] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between lg:w-[45%]">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Kepala Program</p>
            </div>
            <div>
                <a href="#">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-m-user-plus class="w-[130px] text-[#7893a3] md:w-[140px]" />
        </div>
    </div>

    {{-- Presensi Siswa --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#00b191] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between lg:w-[45%]">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Presensi Siswa</p>
            </div>
            <div>
                <a href="#">
                    <button class="mt-5 rounded-md bg-[#ffffff] px-5 py-1 align-bottom text-[#4C77A9]">Lihat</button>
                </a>
            </div>
        </div>
        {{-- div 2 --}}
        <div>
            <x-heroicon-o-clock class="w-[130px] text-[#73d4c2] md:w-[140px]" />
        </div>
    </div>

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

    {{-- Data Prakerin --}}
    <div
        class="jusify-between flex h-[155px] w-full rounded-xl bg-[#67699d] px-5 py-3 text-white shadow-md shadow-slate-500 md:px-5">
        {{-- div 1 --}}
        <div class="flex w-1/2 flex-col justify-between">
            <div>
                <p class="text-lg font-semibold uppercase tracking-widest text-[#ffffff]">Data Prakerin</p>
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
            <x-heroicon-s-document-text class="w-[130px] text-[#abacc9] md:w-[140px]" />
        </div>
    </div>
</div>

{{-- pop up profile --}}
<input type="checkbox" id="my-modal-3" class="modal-toggle" />
<div class="modal">
    <div class="w-[60em] bg-transparent rounded-2xl">

        <form action="" enctype="multipart/form-data">

            <div class="card card-side bg-base-100 shadow-xl w-[24em] md:w-[40em] m-auto">
                <label for="my-modal-3"
                    class="btn btn-sm btn-circle absolute bg-[#eb2424] hover:bg-red-500 border border-[#000000] right-2 top-2">✕</label>
                <div class="bg-[#d9d9d9] w-[15em] rounded-l-2xl pb-3">
                    <div class="w-full ml-3 font-normal uppercase text-xl mb-3 text-[#173A6F]">
                        <p>Profile</p>
                    </div>
                    <div class="flex space-x-2 m-auto">
                        <div class="relative m-auto w-[9em] h-[9em]">
                            <img src="President_Suharto,_1993.jpg" alt="Pa Har" class="w-[9em] h-[9em] rounded-full" />
                        </div>
                    </div>
                    <div class="w-fit m-auto mt-3 text-center">
                        <label class="font-normal text-center m-auto" for="image-profile">
                            <p class="font-normal text-center m-auto text-[#173A6F]">GANTI FOTO</p>
                        </label>
                        <input type="file" name="image-profile" id="image-profile"
                            class="text-center m-auto file-input file-input-bordered file-input-xs w-3/4 max-w-xs" />
                    </div>
                </div>
                <div class=" card-body w-[20em] pb-3">
                    <div class="w-full h-min m-auto mb-4">
                        <label class="font-normal text-md" for="">NAMA</label>
                        <br>
                        <span class="text-lg text-center">{{ Auth::user()->username }}</span>
                    </div>
                    <div class="w-full h-min mb-4">
                        <label class="font-normal text-md" for="">NIK</label>
                        <br>
                        <span class="text-lg text-center">dsccsa</span>
                    </div>
                    <div class="w-full h-min mb-4">
                        <label class="font-normal text-md" for="">LEVEL</label>
                        <br>
                        @if (Auth::user()->level_user == 1)
                        <span class="text-lg text-center">Super Admin</span>
                        @elseif (Auth::user()->level_user == 2)
                        <span class="text-lg text-center">Staff Hubin</span>
                        @elseif (Auth::user()->level_user == 3)
                        <span class="text-lg text-center">Kepala Program</span>
                        @elseif (Auth::user()->level_user == 4)
                        <span class="text-lg text-center">Wali Kelas</span>
                        @elseif (Auth::user()->level_user == 5)
                        <span class="text-lg text-center">Pembimbing Sekolah</span>
                        @elseif (Auth::user()->level_user == 6)
                        <span class="text-lg text-center">Pembimbing Perusahaan</span>
                        @elseif (Auth::user()->level_user == 7)
                        <span class="text-lg text-center">Siswa</span>
                        @endif
                    </div>
                    <div class="w-full h-min mb-4">
                        <label class="font-normal text-md" for="">E-MAIL</label>
                        <br>
                        <span class="text-lg text-center">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="w-full h-min mb-4">
                        <label class="font-normal text-md" for="">KONTAK</label>
                        <br>
                        <span class="text-lg text-center">dsdsds</span>
                    </div>
                    <div class="modal-action">
                        <button type="submit"
                            class="btn bg-[#256D85] rounded-lg px-5 py-3 text-center shadow-md hover:bg-emerald-700 font-light text-white">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection