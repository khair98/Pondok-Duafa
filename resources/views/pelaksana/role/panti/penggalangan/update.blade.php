@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Update Panti Asuhan
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card corona-gradient-card mb-3">
                            <div class="card-body">
                                <div class="card-text">
                                    <h4 class="card-title">Perbarui Detail Penggalangan Dana</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('pelaksana.panti.penggalangan.update', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <h6 class="p-3 rounded bg-info" for="menimbang" style="margin-top:36px">Data Penggalangan</h6>
                            <div class="form-group">
                                <label for="id_panti">Panti Asuhan</label>
                                <select class="js-select2 form-control" id="id_panti" name="id_panti" style="width: 100%;"
                                    data-placeholder="Panti...">
                                    @foreach ($pantis as $key => $value)
                                        @if($value->id == $penggalangan->id_panti)
                                            <option value="{{ $value->id }}" selected>{{ $value->nama_panti }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->nama_panti }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul.." value="{{$penggalangan->judul}}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi.." value="{{$penggalangan->deskripsi}}" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah.." value="{{$penggalangan->jumlah}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="date" class="form-control" id="waktu_mulai" name="waktu_mulai" placeholder="Waktu Mulai.." value="{{$penggalangan->waktu_mulai}}" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_selesai">Waktu Selesai</label>
                                <input type="date" class="form-control" id="waktu_selesai" name="waktu_selesai" placeholder="Waktu Selesai.." value="{{$penggalangan->waktu_selesai}}">
                            </div>
                            <div id="list-foto">
                                <label for="foto">Foto</label>
                                @if($penggalangan->foto !=null)
                                    <div class="form-group">
                                        <div class="col-12">
                                            <img class="img-preview img-fluid" id="img-preview-before" src="{{ asset('storage/foto penggalangan/' . $user->username .'/'.$penggalangan->panti->nama_panti .'/'. $penggalangan->foto)}}" alt="" style="width:150px; height: 150px">
                                        </div>
                                    </div>
                                @endif
                                <img class="img-preview img-fluid" id="img-preview" src="" alt="">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="foto" id="foto"
                                                    placeholder="Foto..." value="{{$penggalangan->foto}}">
                                                <span id="error-message-foto" class="validation-error-label"></span>
                                            </div>

                                        </div>
                                        <p style="color:red">*Pastikan file berformat jpg/jpeg/img</p>
                                    </div>
                                </div>
                            </div>
                            <div id="list-proposal">
                                <label for="proposal">Proposal</label>
                                @if($penggalangan->proposal != null)
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <a href="{{ route('pelaksana.panti.penggalangan.downloadProposal', ['id' => $penggalangan->id]) }}" class="btn btn-outline-info btn-lg" data-toggle="tooltip"
                                                target="_blank">
                                                <i class="mdi mdi-eye opacity-50 me-1"></i>
                                                Lihat Proposal
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="proposal" id="proposal"
                                                    placeholder="Proposal..." value="{{$penggalangan->proposal}}">
                                                <span id="error-message-proposal" class="validation-error-label"></span>
                                            </div>

                                        </div>
                                        <p style="color:red">*Pastikan file berformat pdf/doc/docx</p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $('#foto').on('change',function(){
            console.log('bbb')
            myfiles = $(this).val();
            console.log('file', myfiles)
            var ext = myfiles.split('.').pop();
            if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "PNG"){
                $('#error-message-foto').css("display","none");
                const image= document.querySelector('#foto')
                const imgPreview= document.querySelector('#img-preview')
                imgPreview.style.display='block';
                $('#img-preview').css("width","150px");
                $('#img-preview').css("height","150px");
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent){
                    imgPreview.src = oFREvent.target.result;
                }
                $('#img-preview-before').css("display","none");
            }else{
                $('#error-message-foto').html("File harus berformat jpg/jpeg/png!");
                $('#error-message-foto').css("display","block");
                $('#error-message-foto').css("color","red");
                $('#img-preview').css("display","none");
            }
        });
        $('#proposal').on('change',function(){
            console.log('bbb')
            myfiles = $(this).val();
            console.log('file', myfiles)
            var ext = myfiles.split('.').pop();
            if(ext == "pdf" || ext == "doc" || ext == "docx" || ext == "PDF" || ext == "DOC" || ext == "DOCX"){
                $('#error-message-proposal').css("display","none");
            }else{
                $('#error-message-proposal').html("File harus berformat pdf/doc/docx!");
                $('#error-message-proposal').css("display","block");
                $('#error-message-proposal').css("color","red");
            }
        });
        // $('#id_panti').select2()
    </script>
@endsection
