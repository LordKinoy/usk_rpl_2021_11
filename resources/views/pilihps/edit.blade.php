@extends('layouts.main')

@section('title', 'Form Pilih Pembimbing Sekolah - SIMAK')

@section('container')
<div class="flex w-full">
    <div class="flex-warp mr-auto">
        <a href="/pilihpembimbingsekolah"
            class="hidden cursor-pointer rounded-lg bg-slate-100 px-4 py-1 text-[#4c77a9] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 active:bg-slate-300 lg:inline-block">Kembali</a>
    </div>
</div>
<div class="mb-3 flex w-full justify-center align-middle">
    <p class="font-light text-black uppercase" style="font-size: 32px">Pilih Pembimbing Sekolah</p>
</div>
<div class="overflow-x-auto mx-5 md:mx-20 my-5 md:my-10 min-h-screen">
    <div class="w-2/4 m-auto min-h-screen text-center">
        @foreach ($edit as $e)
        <form method="POST" action="/pilihpembimbingsekolah/edit/update">
            @csrf
            <div>
                <input disabled hdden value="{{$e->id_prakerin}}"
                    class="disabled:bg-white border-none text-center w-full input bg-white" />
                <label for="" class="text-black">
                    NIS Siswa
                    <input disabled value="{{$e->nis}}"
                        class="disabled:bg-white border-none text-center w-full input bg-white" />
                </label>
                <input type="text" class="hidden" name="id_prakerin" value="{{$e->id_prakerin}}" />
                <br><br>
                <label for="" class="text-black">
                    Nama Siswa
                    <input disabled value="{{$e->siswa->nama_siswa}}"
                        class="disabled:bg-white border-none text-center w-full input bg-white" />
                </label>
                <input type="text" class="hidden" name="id_prakerin" value="{{$e->id_prakerin}}" />
                <br><br>
                <label for="" class="text-black">
                    Nama Perusahaan
                    <input disabled value="{{$e->perusahaan->nama_perusahaan}}"
                        class="disabled:bg-white border-none text-center w-full input bg-white" />
                </label>
                <input type="text" class="hidden" name="id_prakerin" value="{{$e->id_prakerin}}" />
                <br><br>
                <label for="" class="text-black">
                    Daftar Pembimbing Sekolah
                </label>
                <select name="id_ps" class="border-none text-center w-full input bg-white text-black">
                    @foreach ($ps as $ps)
                    @if($ps->id_ps == $e->id_ps)
                    <option selected value="{{ $e->id_ps }}">{{ $e->pembimbingsekolah->guru->nama_guru }} -
                        {{ $e->pembimbingsekolah->guru->nip_guru }}
                    </option>
                    @else
                    <option value="{{ $ps -> id_ps }}">{{ $ps -> nama_ps }} - {{ $ps -> nip_guru }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <br>
            <button
                class="hidden cursor-pointer rounded-lg bg-slate-100 px-4 py-1 text-[#4c77a9] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 active:bg-slate-300 lg:inline-block"
                type="submit" value="Simpan">Pilih Pembimbing</button>
        </form>
        @endforeach
    </div>
</div>

@endsection