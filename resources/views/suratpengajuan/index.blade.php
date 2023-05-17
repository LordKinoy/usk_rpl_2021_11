@extends('layouts.main')

@section('title', 'Surat Pengajuan - SIMAK')

@section('container')
<div class="flex w-full">
    <div class="flex-warp mr-1">
        <a href="/dashboard"
            class="cursor-pointer rounded-lg bg-slate-100 px-4 py-1 text-[#4c77a9] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 active:bg-slate-300">Kembali</a>
    </div>
</div>

@switch(Auth::user()->level_user)
@case(1)
<div class="mx-20 my-10 min-h-screen overflow-x-auto">
    <div class='ml-auto mb-3 flex h-[3em] w-fit'>
        <div class="flex-warp m-auto">
            @if (request('show'))
            <a href="/suratpengajuan" class="cursor-pointer">
                <x-heroicon-o-x-mark class="m-auto mr-1 w-[2em] text-black" />
            </a>
            @endif
        </div>
        <div class="flex-warp">
            <form action="/suratpengajuan/show" method="GET">
                <input class='input bg-white text-black' type="text" name="show" placeholder="Cari NIS Siswa"
                    value="{{ request('show') }}">
                <button class="btn border-0 bg-[#0A3A58]" type="submit">
                    <x-heroicon-s-magnifying-glass class="m-auto w-[1em] text-white" />
                </button>
            </form>
        </div>
    </div>
    <table border="1" cellpadding="0" class="table w-full border-collapse bg-white text-center">
        <tr class="border-collapse text-white">
            <td colspan="6" class="w-max-auto sticky h-14 bg-[#0A3A58]">Verifikasi Surat Pengajuan - Hubin</td>
        </tr>
        <tr>
            <td class="bg-white text-black">NO</td>
            <td class="bg-white text-black">NIS</td>
            <td class="bg-white text-black">Perusahaan</td>
            <td class="bg-white text-black">Bukti Penerimaan</td>
            <td class="bg-white text-black">Status Pengajuan</td>
            <td class="bg-white text-black">Verifikasi</td>
        </tr>
        <?php
          $no = 1;
          ?>
        @foreach ($sp3 as $sp3s)
        <tr>
            <td class="bg-white text-black">{{ $no++ }}</td>
            <td class="bg-white text-black">{{ $sp3s->nis }}</td>
            <td class="bg-white text-black">{{ $sp3s->perusahaan->nama_perusahaan }}</td>
            <td class="bg-white text-black">
                @if ($sp3s->bukti_terima !== null)
                <span class="rounded-full bg-green-500 px-3 py-1 text-white">
                    <x-heroicon-m-check-badge class="inline-block w-5 text-white" />
                    Terlampir
                </span>
                @else
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Tidak ada
                </span>
                @endif
            </td>
            <td class="bg-white p-4 text-black">
                @switch($sp3s->status_pengajuan)
                @case('1')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Wali Kelas
                </span>
                @break

                @case('2')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Wali Kelas
                </span>
                @break

                @case('3')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Kepala Program
                </span>
                @break

                @case('4')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Kepala Program
                </span>
                @break

                @case('5')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Hubin
                </span>
                @break

                @case('6')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Hubin
                </span>
                @break

                @default
                <span class="rounded-full bg-green-500 px-3 py-1 text-white">
                    <x-heroicon-m-check-badge class="inline-block w-5 text-white" />
                    Surat Pengajuan sudah sah
                </span>
                @endswitch
            </td>
            <td class="bg-white text-black">
                <div class='m-auto flex w-full items-center text-center'>
                    <div class="flex-warp mr-auto w-1/2 items-center text-center">
                        <a href="/suratpengajuan/detail/{{ $sp3s->id_pengajuan }}"><button
                                class="mr-2 rounded-lg bg-slate-300 px-5 py-2 text-black shadow-[1px_2px_5px_rgba(0,0,1,0.2)] transition hover:bg-slate-400 active:bg-slate-500">
                                <x-heroicon-m-pencil-square class="w-[1.5em]" />
                            </button></a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="mt-2">
    </div>
</div>
@break

@case(2)
<div class="mx-20 my-10 min-h-screen overflow-x-auto">
    <div class='ml-auto mb-3 flex h-[3em] w-fit'>
        <div class="flex-warp m-auto">
            @if (request('show'))
            <a href="/suratpengajuan" class="cursor-pointer">
                <x-heroicon-o-x-mark class="m-auto mr-1 w-[2em] text-black" />
            </a>
            @endif
        </div>
        <div class="flex-warp">
            <form action="/suratpengajuan/show" method="GET">
                <input class='input bg-white text-black' type="text" name="show" placeholder="Cari NIS Siswa" value="">
                <button class="btn border-0 bg-[#0A3A58]" type="submit">
                    <x-heroicon-s-magnifying-glass class="m-auto w-[1em] text-white" />
                </button>
            </form>
        </div>
    </div>
    <table border="1" cellpadding="0" class="table w-full border-collapse bg-white text-center">
        <tr class="border-collapse text-white">
            <td colspan="6" class="w-max-auto sticky h-14 bg-[#0A3A58]">Verifikasi Surat Pengajuan - Kepala Program</td>
        </tr>
        <tr>
            <td class="bg-white text-black">NO</td>
            <td class="bg-white text-black">NIS</td>
            <td class="bg-white text-black">Perusahaan</td>
            <td class="bg-white text-black">Bukti Penerimaan</td>
            <td class="bg-white text-black">Status Pengajuan</td>
            <td class="bg-white text-black">Verifikasi</td>
        </tr>
        <?php
          $no = 1;
          ?>
        @foreach ($sp as $sp1)
        <tr>
            <td class="bg-white text-black">{{ $no++ }}</td>
            <td class="bg-white text-black">{{ $sp1->nis }}</td>
            <td class="bg-white text-black">{{ $sp1->perusahaan->nama_perusahaan }}</td>
            <td class="bg-white text-black">
                @if ($sp1->bukti_terima !== null)
                <span class="rounded-full bg-green-500 px-3 py-1 text-white">
                    <x-heroicon-m-check-badge class="inline-block w-5 text-white" />
                    Terlampir
                </span>
                @else
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Tidak ada
                </span>
                @endif
            </td>
            <td class="bg-white p-4 text-black">
                @switch($sp1->status_pengajuan)
                @case('1')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Wali Kelas
                </span>
                @break

                @case('2')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Wali Kelas
                </span>
                @break

                @case('3')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Kepala Program
                </span>
                @break

                @case('4')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Kepala Program
                </span>
                @break

                @case('5')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Hubin
                </span>
                @break

                @case('6')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Hubin
                </span>
                @break

                @default
                <span class="rounded-full bg-green-500 px-3 py-1 text-white">
                    <x-heroicon-m-check-badge class="inline-block w-5 text-white" />
                    Surat Pengajuan sudah sah
                </span>
                @endswitch
            </td>
            <td class="bg-white text-black">
                <div class='m-auto flex w-full items-center text-center'>
                    <div class="flex-warp mr-auto w-1/2 items-center text-center">
                        <a href="/suratpengajuan/detail/{{ $sp1->id_pengajuan }}"><button
                                class="mr-2 rounded-lg bg-slate-300 px-5 py-2 text-black shadow-[1px_2px_5px_rgba(0,0,1,0.2)] transition hover:bg-slate-400 active:bg-slate-500">
                                <x-heroicon-m-pencil-square class="w-[1.5em]" />
                            </button></a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="mt-2">
        {{ $sp->links() }}
    </div>
</div>
@break

@case(3)
<div class="mx-20 my-10 min-h-screen overflow-x-auto">
    <div class='ml-auto mb-3 flex h-[3em] w-fit'>
        <div class="flex-warp m-auto">
            @if (request('show'))
            <a href="/suratpengajuan" class="cursor-pointer">
                <x-heroicon-o-x-mark class="m-auto mr-1 w-[2em] text-black" />
            </a>
            @endif
        </div>
        <div class="flex-warp">
            <form action="/suratpengajuan/show" method="GET">
                <input class='input bg-white text-black' type="text" name="show" placeholder="Cari NIS Siswa" value="">
                <button class="btn border-0 bg-[#0A3A58]" type="submit">
                    <x-heroicon-s-magnifying-glass class="m-auto w-[1em] text-white" />
                </button>
            </form>
        </div>
    </div>
    <table border="1" cellpadding="0" class="table w-full border-collapse bg-white text-center">
        <tr class="border-collapse text-white">
            <td colspan="6" class="w-max-auto sticky h-14 bg-[#0A3A58]">Verifikasi Surat Pengajuan - Wali Kelas</td>
        </tr>
        <tr>
            <td class="bg-white text-black">NO</td>
            <td class="bg-white text-black">NIS</td>
            <td class="bg-white text-black">Perusahaan</td>
            <td class="bg-white text-black">Bukti Penerimaan</td>
            <td class="bg-white text-black">Status Pengajuan</td>
            <td class="bg-white text-black">Verifikasi</td>
        </tr>
        <?php
          $no = 1;
          ?>
        @foreach ($sp2 as $sp2s)
        <tr>
            <td class="bg-white text-black">{{ $no++ }}</td>
            <td class="bg-white text-black">{{ $sp2s->nis }}</td>
            <td class="bg-white text-black">{{ $sp2s->perusahaan->nama_perusahaan }}</td>
            <td class="bg-white text-black">
                @if ($sp2s->bukti_terima !== null)
                <span class="rounded-full bg-green-500 px-3 py-1 text-white">
                    <x-heroicon-m-check-badge class="inline-block w-5 text-white" />
                    Terlampir
                </span>
                @else
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Tidak ada
                </span>
                @endif
            </td>
            <td class="bg-white p-4 text-black">
                @switch($sp2s->status_pengajuan)
                @case('1')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Wali Kelas
                </span>
                @break

                @case('2')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Wali Kelas
                </span>
                @break

                @case('3')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Kepala Program
                </span>
                @break

                @case('4')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Kepala Program
                </span>
                @break

                @case('5')
                <span class="rounded-full bg-yellow-300 px-3 py-1">
                    <x-heroicon-o-clock class="inline-block w-5 text-black" />
                    Menunggu konfirmasi Hubin
                </span>
                @break

                @case('6')
                <span class="rounded-full bg-red-500 px-3 py-1 text-white">
                    <x-heroicon-m-x-circle class="inline-block w-5 text-white" />
                    Ditolak Hubin
                </span>
                @break

                @default
                <span class="rounded-full bg-green-500 px-3 py-1 text-white">
                    <x-heroicon-m-check-badge class="inline-block w-5 text-white" />
                    Surat Pengajuan sudah sah
                </span>
                @endswitch
            </td>
            <td class="bg-white text-black">
                <div class='m-auto flex w-full items-center text-center'>
                    <div class="flex-warp mr-auto w-1/2 items-center text-center">
                        <a href="/suratpengajuan/detail/{{ $sp2s->id_pengajuan }}"><button
                                class="mr-2 rounded-lg bg-slate-300 px-5 py-2 text-black shadow-[1px_2px_5px_rgba(0,0,1,0.2)] transition hover:bg-slate-400 active:bg-slate-500">
                                <x-heroicon-m-pencil-square class="w-[1.5em]" />
                            </button></a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="mt-2">
        {{ $sp2->links() }}
    </div>
</div>
@break

@endswitch

@endsection