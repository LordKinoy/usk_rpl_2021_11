@extends('layouts.main')

@section('title', 'Kompetensi - SIMAK')

@section('container')
<div class="flex w-full">
    <div class="flex-warp mr-1">
        @if (Auth::user()->guru->kepalaprogram->jurusan == null)
        @else
        <label for="my-modal-3"
            class="mr-3 cursor-pointer rounded-lg bg-slate-100 px-4 py-1 text-[#4c77a9] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 active:bg-slate-300">
            Tambah
        </label>
        @endif
        <a href="/dashboard"
            class="cursor-pointer rounded-lg bg-slate-100 px-4 py-1 text-[#4c77a9] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 active:bg-slate-300">Kembali</a>
    </div>
</div>
<div class="mx-20 my-10 min-h-screen overflow-x-auto">
    <table border="1" cellpadding="0" class="table w-full border-collapse bg-white text-center">
        <tr class="border-collapse text-white">
            @if (Auth::user()->guru->kepalaprogram->jurusan == null)
            <td colspan="6" class="w-max-auto sticky h-14 bg-[#0A3A58]">Data Kompetensi Jurusan</td>
            @else
            <td colspan="6" class="w-max-auto sticky h-14 bg-[#0A3A58]">Data Kompetensi Jurusan
                {{ Auth::user()->guru->kepalaprogram->jurusan->akronim }}</td>
            @endif
        </tr>
        <tr>
            <td class="bg-white text-black">NO</td>
            <td class="bg-white text-black">Nama Kompetensi</td>
            <td class="bg-white text-black">Aksi</td>
        </tr>
        <?php
      $no = 1;
      ?>
        @if (Auth::user()->guru->kepalaprogram->jurusan == null)
        @else
        @foreach ($kompetensi as $key)
        <tr>
            <td class="bg-white text-black">{{ $no++ }}</td>
            <td class="w-3/4 bg-white text-black">{{ $key->nama_kompetensi }}</td>
            <td class="bg-white text-black">
                <a href="#delete-kompetensi/{{ $key->id_kompetensi }}"><button
                        class="rounded-lg bg-red-500 px-5 py-2 text-black shadow-[1px_2px_5px_rgba(0,0,1,0.2)] transition hover:bg-red-600 active:bg-slate-500">
                        <x-heroicon-m-trash class="w-[1.5em]" />
                    </button></a>
            </td>
        </tr>
        <div id="delete-kompetensi/{{ $key->id_kompetensi }}" class="modal">
            <div class="modal-box items-center justify-center bg-white text-black">
                <x-heroicon-o-exclamation-triangle
                    class="mx-auto h-[10em] w-[10em] items-center justify-center text-sm text-red-600" />
                <h3 class="mt-2 text-center text-lg font-semibold">
                    Apakah Anda Yakin ingin menghapus data kompetensi dengan nama {{ $key->nama_kompetensi }}?
                </h3>
                <p class="text-center">Data yang terhapus tidak dapat kembali!</p>
                </p>
                <!-- Button -->
                <div class="gird modal-action flex justify-center">
                    <a href="#"
                        class="btn-[#FF8138] btn-outline btn w-[120px] bg-[#fff] text-[#FF8138] hover:border-[#FF8138] hover:bg-[#FFF] hover:text-[#FF8138]">Batalkan</a>
                    <a href="kompetensi/hapus/{{ $key->id_kompetensi }}"
                        class="btn w-[120px] border-[#ED1C24] bg-[#ED1C24] text-[#fff] hover:border-[#ED1C24] hover:bg-[#ED1C24] dark:text-[#fff]">Hapus</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </table>
    @if (Auth::user()->guru->kepalaprogram->jurusan == null)
    @else
    <input id="my-modal-3" type="checkbox" class="modal-toggle" />
    <div class="modal">
        <div class="container w-2/3">
            <form action="{{ url('kompetensi/tambah') }}" method="POST">
                @csrf
                <table id="dynamicAddRemove" class="table-bordered mb-2 table w-full bg-white">
                    <tr>
                        <th colspan="2" class="h-14 bg-[#0A3A58] text-center text-white">Tambah Kompetensi Jurusan
                            {{ Auth::user()->guru->kepalaprogram->jurusan->akronim }} <label for="my-modal-3"
                                class="btn-sm btn-circle btn absolute right-2 top-2 border border-[#000000] bg-[#eb2424] hover:bg-red-500">✕</label>
                        </th>
                    </tr>
                    <tr>
                        <td class="w-3/4 items-center bg-white">
                            <input type="text" name="addmore[0][id_jurusan]"
                                value="{{ Auth::user()->guru->kepalaprogram->jurusan->id_jurusan }}"
                                class="form-control hidden" value="" />
                            <input type="text" name="addmore[0][nama_kompetensi]" placeholder="Masukan Kompetensi"
                                class="border-sm form-control w-full rounded-md border bg-white py-3 text-center text-black" />
                        </td>
                        <td class="items-center bg-white"><button id="dynamic-ar" type="button" name="add"
                                class="cursor-pointer rounded-lg bg-[#0A3A58] px-5 py-2 text-[#ffffff] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 hover:text-green-500 active:bg-slate-300 lg:inline-block">Tambah
                                Input Kompetensi</button>
                        </td>
                    </tr>
                </table>
                <button type="submit"
                    class="cursor-pointer rounded-lg bg-slate-100 px-4 py-1 text-[#4c77a9] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 active:bg-slate-300">Simpan</button>
            </form>
        </div>
        @endif
        @if (Auth::user()->guru->kepalaprogram->jurusan == null)
        @else
        <!-- JavaScript -->
        <script src="/assets/jquery.js"></script>
        <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(
                '<tr><td class="w-3/4 bg-white"><input type="text" name="addmore[' +
                i +
                '][id_jurusan]" class="form-control hidden text-black" value="{{ Auth::user()->guru->kepalaprogram->jurusan->id_jurusan }}" /><input type="text" name="addmore[' +
                i +
                '][nama_kompetensi]" placeholder="Masukan Kompetensi" class="text-black form-control w-full py-3 rounded-md text-center bg-white border border-sm"  /></td><td class="bg-white"><button type="button" class="cursor-pointer rounded-lg px-5 py-2 text-[#ffffff] shadow-[1px_2px_10px_rgba(0,0,1,0.2)] transition hover:bg-slate-200 hover:text-red-500 active:bg-slate-300 lg:inline-block bg-red-500">Hapus Input Kompetensi</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
        </script>
        @endif
    </div>
</div>

@endsection