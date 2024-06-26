@extends('layouts.app')

@section('content')

{{-- Section Main Start  --}}
<x-header>Template Header</x-header>
<div x-data="{ headerAdd: false, headerTem: null, headerEdit:false, headerId: null }">
    <div class="kategori">
        <div class="">
            <div class="rounded-xl drop-shadow-lg">
                <div class="flex justify-end pb-6">
                    <button @click="headerAdd=true" type="button" class="block px-6 py-3 text-white font-medium bg-primary rounded-xl">Tambah template</button>
                </div>
                <div class="grid grid-cols-2 gap-6 py-6">
                    @foreach($data as $d)
                    <a href="javascript:void(0)">
                        <div class="card-template-1 text-center">
                            <div class="relative" @mouseenter="headerTem='header{{ $d->id }}'" @mouseleave="headerTem=null">
                                <div x-show="headerTem === 'header{{ $d->id }}'" x-transition class="absolute top-0 left-0 right-0 bottom-0 inset-0 bg-black opacity-50"></div>
                                <div x-show="headerTem === 'header{{ $d->id }}'" class="absolute flex items-center justify-center gap-4 top-0 left-0 right-0 bottom-0 inset-0 bg-gray-500 bg-opacity-75">
                                    @if($d->default == 0)
                                    <form action="{{ route('update-default-header', $d->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-amber-400 rounded-full w-10 h-10 text-white flex justify-center items-center hover:bg-opacity-50 p-2">
                                            <i class="fa fa-star"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <button @click="headerEdit=true; headerId={{ $d->id }};" class="bg-greenSpot rounded-full w-10 h-10 text-white flex justify-center items-center hover:bg-opacity-50 p-2"><i class="fa fa-pen"></i></button>
                                    <form action="{{ route('delete.header', $d->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        <button type="submit" class="bg-primary rounded-full w-10 h-10 text-white flex justify-center items-center p-2 hover:bg-opacity-50"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                <img src="{{ asset($d->image) }}" class=" " alt="">
                            </div>
                            <h3 class="py-3 font-semibold">{{ $d->name }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div>
        <div x-show="headerAdd" x-transition>
            <div class="fixed  inset-0 bg-gray-500 opacity-75 z-10"></div>
        </div>
        <div x-show="headerAdd" x-transition.origin.bottom.duration.500ms id="tambahKop" class="w-1/2 bg-white rounded-xl p-6 absolute top-[100px] left-[350px] z-20 mx-auto drop-shadow-md">
            <div class="flex justify-between items-start pb-6">
                <div class="flex flex-col ">
                    <h3 class="text-xl font-bold text-primary">Tambah Header</h3>
                    <p class="text-sm opacity-50 w-3/4">tambah kop surat anda agar berfariasi ketika memakainya nanti</p>
                </div>
                <button @click="headerAdd=false"><i class="fas fa-xmark fa-xl"></i></button>
            </div>
            <form action="{{ route('header-post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="nameHeader" class="pb-3">Nama Header</label>
                    <input type="text" name="name" id="nameHeader" class="px-4 mt-3 rounded-lg py-2 border border-line w-full focus:outline-spotSubtle">
                </div>
                <div class="mb-6 flex gap-2 items-center">
                    <div>
                        <input type="radio" name="ukuran" id="A4" value="a4">
                        <label for="A4">3508 x 2480 px (A4)</label>
                    </div>
                    <div>
                        <input type="radio" name="ukuran" id="legal" value="legal">
                        <label for="legal">3400 x 5600 px (legal)</label>
                    </div>
                    <div>
                        <input type="radio" name="ukuran" id="tabloid" value="tabloid">
                        <label for="tabloid">3300 x 5100 px (Tabloid)</label>
                    </div>
                </div>
                <div class="mb-6 flex gap-2 items-center">
                    <input type="checkbox" name="default" id="default">
                    <label for="default">Jadikan sebagai default header</label>
                </div>
                <div>
                    <label for="templateHeader">Template Header</label>
                    <input type="file" name="templateHeader" class="dropHeader" id="templateHeader">
                </div>
                <div class="flex justify-center mt-6"><button class="px-4 py-2 rounded-lg bg-primary w-full text-white font-semibold">Tambah Header</button></div>
            </form>
        </div>
    </div>
    <div>
        <div x-show="headerEdit" x-transition>
            <div class="fixed inset-0 bg-gray-500 opacity-75 z-10"></div>
        </div>
        <div x-show="headerEdit" x-transition.origin.bottom.duration.500ms id="editKop" class="w-1/2 bg-white rounded-xl p-6 absolute top-[100px] left-[350px] z-20 mx-auto drop-shadow-md">
            <div class="flex justify-between items-start pb-6">
                <div class="flex flex-col ">
                    <h3 class="text-xl font-bold text-primary">Edit Header</h3>
                    <p class="text-sm opacity-50 w-3/4">Edit kop surat anda disini</p>
                </div>
                <button @click="headerEdit=false"><i class="fas fa-xmark fa-xl"></i></button>
            </div>
            <form :action="'{{ route('header-update', '') }}/' + headerId" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="editNameHeader" class="pb-3">Nama Header</label>
                    <input type="text" name="name" id="editNameHeader" class="px-4 mt-3 rounded-lg py-2 border border-line w-full focus:outline-spotSubtle">
                </div>
                <div class="mb-6 flex gap-2 items-center">
                    <div>
                        <input type="radio" name="ukuran" id="editA4" value="a4">
                        <label for="editA4">3508 x 2480 px (A4)</label>
                    </div>
                    <div>
                        <input type="radio" name="ukuran" id="editLegal" value="legal">
                        <label for="editLegal">3400 x 5600 px (legal)</label>
                    </div>
                    <div>
                        <input type="radio" name="ukuran" id="editTabloid" value="tabloid">
                        <label for="editTabloid">3300 x 5100 px (Tabloid)</label>
                    </div>
                </div>
                <div class="mb-6 flex gap-2 items-center">
                    <input type="checkbox" name="default" id="editDefault">
                    <label for="editDefault">Jadikan sebagai default header</label>
                </div>
                <div>
                    <label for="editTemplateHeader">Template Header</label>
                    <input type="file" name="templateHeader" class="dropHeader" id="editTemplateHeader">
                </div>
                <div class="flex justify-center mt-6"><button type="submit" class="px-4 py-2 rounded-lg bg-primary w-full text-white font-semibold">Update Header</button></div>
            </form>
        </div>
    </div>
</div>
{{-- Section Main End  --}}
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.dropHeader').dropify({
            tpl: {
                message: '<div class="dropify-message"><span class="file-icon" /> <p style="font-size: 24px;">Drag and drop a file here or click</p></div>',
            }
        })
    })
</script>
@endpush