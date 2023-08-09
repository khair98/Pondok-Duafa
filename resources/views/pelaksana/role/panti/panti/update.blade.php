@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Update Panti Asuhan
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card corona-gradient-card mb-3">
                            <div class="card-body">
                                <div class="card-text">
                                    <h4 class="card-title">Update Panti Asuhan</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('pelaksana.panti.panti.update', ['id' => $panti->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <h6 class="p-3 rounded bg-info" for="menimbang" style="margin-top:36px">Data Panti Asuhan</h6>
                            <input type="hidden" id="id_panti" name="id_panti" value="{{$panti->id}}">
                            <div class="form-group">
                                <label for="nama">Nama Panti Asuhan</label>
                                <input type="text" class="form-control" id="nama_panti" name="nama_panti" placeholder="Nama Panti" value="{{Auth::user()->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Panti Asuhan</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Panti" value="{{Auth::user()->alamat}}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{Auth::user()->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="kontak">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak" value="{{Auth::user()->no_hp}}" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_anak">Jumlah Anak</label>
                                <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" placeholder="Jumlah Anak" value="{{$panti->jumlah_anak}}" required>
                            </div>
                            <label for="profil">Profil Panti Asuhan</label>
                            <div class="card" style="background-color: white; height: fit-content;">
                                <div class="card-body" style="color:black">
                                    @if($panti->profil !=null)
                                        <input id="x" value="{{ $panti->profil }}" type="hidden" name="profil">
                                    @else
                                        <input id="x" type="hidden" name="profil" placeholder="Profil..">
                                    @endif
                                    <trix-editor input="x" style="width: 100%; height: 900px; color:black"></trix-editor>
                                </div>
                            </div>  
                            <h6 class="p-3 rounded bg-info" for="foto" style="margin-top:36px">Foto Panti Asuhan</h6>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-info" onclick="addFoto()">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                        <span>Foto</span>
                                    </button>
                                </div>
                            </div>
                            <div id="list-foto">
                                @foreach($panti->foto as $key=>$foto)
                                    <?php $k=$key?>
                                    <img width="150px" height="150px" class="img-preview-{{$k}} img-fluid" id="img-preview-{{$k}}" alt="" src="{{ asset('storage/foto panti/' . $panti->id . '/'. $foto->foto)}}" alt="">
                                    {{-- <img class="img-preview img-fluid" id="img-preview" src="" alt=""> --}}
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input type="file" class="form-control" name="foto[]" id="the-file-{{$k}}"
                                                        placeholder="Foto Panti Asuhan..." onchange="loop({{ $k }})" value="{{$foto->foto}}">
                                                    <span id="error-message-foto-{{$k}}" class="validation-error-label"></span>
                                                </div>
                                            </div>
                                            <p style="color:red">*Pastikan file berformat jpg/jpeg/img <br> *Pastikan ukuran file tidak lebih dari 2MB</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <h6 class="p-3 rounded bg-info" for="foto" style="margin-top:36px">Surat Izin</h6>
                            @if($panti->surat_izin != null)
                                <div class="surat-izin mt-5">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <a href="{{ route('pelaksana.panti.panti.downloadSuratIzin', ['id' => $panti->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                                        style="margin-bottom:24px" target="_blank">
                                                        <i class="mdi mdi-download opacity-50 me-1"></i>
                                                        Download Surat Izin
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <label for="perizinan" style="color:yellow">Tidak ada surat perizinan</label>
                            @endif
                            <div id="list-perizinan">
                                <label for="perizinan">Upload surat izin panti asuhan</label>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="surat_izin" id="surat_izin"
                                                    placeholder="Surat Izin Panti Asuhan..." required>
                                                <span id="error-message-surat-izin" class="validation-error-label"></span>
                                            </div>

                                        </div>
                                        <p style="color:red">*Pastikan file berformat pdf/doc/docx/jpg/jpeg/png</p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        var idFoto = 1
        var foto = {!! json_encode($panti->foto) !!}
        let k=-1;
        foto.forEach(myFunction)

        function myFunction(){
            k++;
        }
        function addFoto() {
			$('#list-foto').append(`
                <div class="form-group row" id="field-foto-${idFoto}">
                    <div class="col-12">
                        <img class="preview-${idFoto} img-fluid" id="preview-${idFoto}" src="" alt="">
                        <div class="form-group row">
                            <div class="col-11">
                                <input type="file" class="form-control" name="foto-addition[]" id="foto-${idFoto}"
                                    placeholder="Foto Panti Asuhan..." required onchange="tambah(${idFoto})">
                                <span id="error-foto-${idFoto}" class="validation-error-label"></span>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger" onclick="deleteFoto(${idFoto})">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </div>
                        <p style="color:red">*Pastikan file berformat jpg/jpeg/img <br> *Pastikan ukuran file tidak lebih dari 2MB</p>
                    </div>
                </div>
            `)
			idFoto++
		}

        function deleteFoto(idFoto) {
            $(`#field-foto-${idFoto}`).remove()
        }

        $('#surat_izin').on('change',function(){
            console.log('a')
            myfiles = $(this).val();
            var ext = myfiles.split('.').pop();
            if(ext == "pdf" || ext == "doc" || ext == "docx" || "jpg" || ext == "jpeg" || ext == "png" || ext == "PDF" || ext == "DOC" || ext == "DOCX" || ext == "JPG" || ext == "JPEG" || ext == "PNG"){
                $('#error-message-surat-izin').css("display","none");
            }else{
                $('#error-message-surat-izin').html("File harus berformat pdf/doc/docx/jpg/jpeg/png!");
                $('#error-message-surat-izin').css("display","block");
                $('#error-message-surat-izin').css("color","red");
            }
        });

        function loop(k){
            myfiles = $(`#the-file-${k}`).val();
            var input=$(`#the-file-${k}`)
            console.log('file', input)
            var ext = myfiles.split('.').pop();
            if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "PNG"){
                $(`#error-message-foto-${k}`).css("display","none");
                    const image= document.querySelector(`#the-file-${k}`)
                    const imgPreview= document.querySelector(`#img-preview-${k}`)
                    imgPreview.style.display='block';
                    $(`#img-preview-${k}`).css("width","150px");
                    $(`#img-preview-${k}`).css("height","150px");
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);
                    oFReader.onload = function(oFREvent){
                        imgPreview.src = oFREvent.target.result;
                    }
            }else{
                $(`#error-message-foto-${k}`).html("File harus berformat jpg/jpeg/png!");
                $(`#error-message-foto-${k}`).css("display","block");
                $(`#error-message-foto-${k}`).css("color","red");
                $(`#img-preview-${k}`).css("display","none");
            }
        }

        function tambah(idFoto){
            myfiles = $(`#foto-${idFoto}`).val();
            var input=$(`#foto-${idFoto}`);
            var ext = myfiles.split('.').pop();
            console.log('myfile', myfiles)
            if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "PNG"){
                $(`#error-foto-${idFoto}`).css("display","none");
                const imagejs= document.querySelector(`#foto-${idFoto}`)
                const imgPreviewJs= document.querySelector(`#preview-${idFoto}`)
                imgPreviewJs.style.display='block';
                $(`#preview-${idFoto}`).css("width","150px");
                $(`#preview-${idFoto}`).css("height","150px");
                const oFReader = new FileReader();
                oFReader.readAsDataURL(imagejs.files[0]);
                oFReader.onload = function(oFREvent){
                    imgPreviewJs.src = oFREvent.target.result;
                }
            }else{
                $(`#error-foto-${idFoto}`).html("File harus berformat jpg/jpeg/png!");
                $(`#error-foto-${idFoto}`).css("display","block");
                $(`#error-foto-${idFoto}`).css("color","red");
                $(`#preview-${idFoto}`).css("display","none");
            }
        }
    </script>
@endsection
