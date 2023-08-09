@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Tambah Panti Asuhan
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
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
                                    <h4 class="card-title">Tambah Daftar Panti Asuhan</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('pelaksana.panti.panti.create') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <h6 class="p-3 rounded bg-info" for="menimbang" style="margin-top:36px">Data Panti Asuhan</h6>
                            <div class="form-group">
                                <label for="nama">Nama Panti Asuhan</label>
                                <input type="text" class="form-control" id="nama_panti" name="nama_panti" placeholder="Nama Panti" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Panti Asuhan</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Panti" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="kontak">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_anak">Jumlah Anak</label>
                                <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" placeholder="Jumlah Anak">
                            </div>
                            <label for="profil">Profil Panti Asuhan</label>
                            <div class="card" style="background-color: white; height: fit-content;">
                                <div class="card-body" style="color:black">
                                    <input id="x" type="hidden" name="profil" placeholder="Kabar Terbaru..">
                                    <trix-editor input="x" style="width: 100%; height: 300px; color:black"></trix-editor>
                                </div>
                            </div>  
                            <h6 class="p-3 rounded bg-info" for="menimbang" style="margin-top:36px">Foto Panti Asuhan</h6>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-info" onclick="addFoto()">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                        <span>Foto</span>
                                    </button>
                                </div>
                            </div>
                            <div id="list-foto">
                                <img class="img-preview img-fluid" id="img-preview" src="" alt="">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="foto[]" id="the-file"
                                                    placeholder="Foto Panti Asuhan..." required>
                                                <span id="error-message-foto" class="validation-error-label"></span>
                                            </div>

                                        </div>
                                        <p style="color:red">*Pastikan file berformat jpg/jpeg/img <br> *Pastikan ukuran file tidak lebih dari 2MB</p>
                                    </div>
                                </div>
                            </div>
                            <div id="list-perizinan">
                                <label for="perizinan">Surat Izin Panti Asuhan</label>
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
        function addFoto() {
			$('#list-foto').append(`
                <div class="form-group row" id="field-foto-${idFoto}">
                    <div class="col-12">
                        <img class="img-preview-${idFoto} img-fluid" id="img-preview-${idFoto}" src="" alt="">
                        <div class="form-group row">
                            <div class="col-11">
                                <input type="file" class="form-control" name="foto[]" id="the-file-${idFoto}"
                                    placeholder="Foto Panti Asuhan..." required onchange="foto(${idFoto})">
                                <span id="error-message-foto-${idFoto}" class="validation-error-label"></span>
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
        $('#the-file').on('change',function(){
            console.log('bbb')
            myfiles = $(this).val();
            console.log('file', myfiles)
            var ext = myfiles.split('.').pop();
            if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "PNG"){
                if ((this.files[0].size > 1048576)){
                    $('#error-message-foto').html("Ukuran file maksimal 2 MB!");
                    $('#error-message-foto').css("display","block");
                    $('#error-message-foto').css("color","red");
                    $('#img-preview').css("display","none");
                }
                else{
                    $('#error-message-foto').css("display","none");
                    const image= document.querySelector('#the-file')
                    const imgPreview= document.querySelector('#img-preview')
                    imgPreview.style.display='block';
                    $('#img-preview').css("width","150px");
                    $('#img-preview').css("height","150px");
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);
                    oFReader.onload = function(oFREvent){
                        imgPreview.src = oFREvent.target.result;
                    }
                }
            }else{
                $('#error-message-foto').html("File harus berformat jpg/jpeg/png!");
                $('#error-message-foto').css("display","block");
                $('#error-message-foto').css("color","red");
                $('#img-preview').css("display","none");
            }
        });

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

        function foto(idFoto){
            myfiles = $(`#the-file-${idFoto}`).val();
            var input=$(`#the-file-${idFoto}`)
            console.log('file', input)
            var ext = myfiles.split('.').pop();
            if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "PNG"){
                $(`#error-message-foto-${idFoto}`).css("display","none");
                    const imagejs= document.querySelector(`#the-file-${idFoto}`)
                    const imgPreviewJs= document.querySelector(`#img-preview-${idFoto}`)
                    imgPreviewJs.style.display='block';
                    $(`#img-preview-${idFoto}`).css("width","150px");
                    $(`#img-preview-${idFoto}`).css("height","150px");
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(imagejs.files[0]);
                    oFReader.onload = function(oFREvent){
                        imgPreviewJs.src = oFREvent.target.result;
                    }
            }else{
                $(`#error-message-foto-${idFoto}`).html("File harus berformat jpg/jpeg/png!");
                $(`#error-message-foto-${idFoto}`).css("display","block");
                $(`#error-message-foto-${idFoto}`).css("color","red");
                $(`#img-preview-${idFoto}`).css("display","none");
            }
        }
    </script>
@endsection
