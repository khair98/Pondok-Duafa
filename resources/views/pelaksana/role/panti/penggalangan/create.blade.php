@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Tambah Penggalangan Dana
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
                                    <h4 class="card-title">Tambah Penggalangan Dana</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('pelaksana.panti.penggalangan.create') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <h6 class="p-3 rounded bg-info" for="menimbang" style="margin-top:36px">Data Penggalangan</h6>
                            <div class="form-group">
                                <label for="id_panti">Panti Asuhan</label>
                                <select class="js-select2 form-control" id="id_panti" name="id_panti" style="width: 100%;"
                                    data-placeholder="Panti...">
                                    @foreach ($pantis as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->nama_panti }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul.." required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi.." required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control border-0" placeholder="Jumlah.." id="jumlah" name="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="date" class="form-control" id="waktu_mulai" name="waktu_mulai" placeholder="Waktu Mulai.." required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_selesai">Waktu Selesai</label>
                                <input type="date" class="form-control" id="waktu_selesai" name="waktu_selesai" placeholder="Waktu Selesai..">
                            </div>
                            <div id="list-foto">
                                <label for="foto">Foto</label>
                                <img class="img-preview img-fluid" id="img-preview" src="" alt="">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="foto" id="foto"
                                                    placeholder="Foto..." required>
                                                <span id="error-message-foto" class="validation-error-label"></span>
                                            </div>

                                        </div>
                                        <p style="color:red">*Pastikan file berformat jpg/jpeg/img</p>
                                    </div>
                                </div>
                            </div>
                            <div id="list-proposal">
                                <label for="proposal">Proposal</label>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="proposal" id="proposal"
                                                    placeholder="Proposal..." required>
                                                <span id="error-message-proposal" class="validation-error-label"></span>
                                            </div>

                                        </div>
                                        <p style="color:red">*Pastikan file berformat pdf/doc/docx</p>
                                    </div>
                                </div>
                            </div>
                            <div class="snk" style="color:yellow">
                                <i class="mdi mdi mdi-alert-circle-outline"></i> Setiap pengajuan penarikan dana ke rekening selain bank BSI akan dikenakan biaya transfer sebesar Rp. 10.000,-.  Mininal penarikan dana yaitu sebesar Rp. 100.000,-
                            </div>
                            <br>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                <input onclick="snk()" type="checkbox" class="form-check-input" id="snkCheckBox"> Saya setuju dengan syarat dan ketentuan yang ada </label>
                            </div>
                            <button disabled type="submit" id="btnSubmit" class="btn btn-primary mr-2 mt-3">Submit</button>
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

        var rupiah = document.getElementById("jumlah");
        console.log('rupiah', rupiah)
        rupiah.addEventListener("keyup", function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

        // $('#snkCheckBox').click(function(){
        // if($(this).attr('checked') == false){
        //     $('#btnSubmit').attr("disabled","disabled");   
        // }
        // else{
        //     $('#btnSubmit').removeAttr('disabled');
        // }
        // }); 

        $('#btncheck').removeAttr('disabled');
        function snk() {
            var snkCheckBox = document.getElementById("snkCheckBox");
            console.log('a')
            // jumlahLainInput.style.display = "none";
            if (snkCheckBox.checked == true){
                $('#btnSubmit').removeAttr('disabled');
            } else {
                $('#btnSubmit').attr("disabled","disabled");
            }
        }
    </script>
@endsection
