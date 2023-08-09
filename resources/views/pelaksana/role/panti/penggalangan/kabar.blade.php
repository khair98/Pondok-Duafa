@extends('pelaksana.layout.core.index')
@section('title')
    Panti - Kabar Terbaru
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
                                    <h4 class="card-title">Perbarui Kabar Terbaru</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="background-color: white; height: fit-content;">
                            <div class="card-body" style="color:black;" >
                                <form action="{{ route('pelaksana.panti.penggalangan.update.berita', ['id' => $penggalangan->id]) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                    @csrf
                                    <input id="id_penggalangan" value="{{ $penggalangan->id }}" type="hidden" name="id_penggalangan">
                                    @if($berita !=null)
                                        <input id="x" value="{{ $berita->isi }}" type="hidden" name="isi">
                                    @else
                                        <input id="x" type="hidden" name="isi" placeholder="Kabar Terbaru..">
                                    @endif
                                    <trix-editor input="x" style="width: 100%; height: fit-content !important; color:black"></trix-editor>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                                @foreach($beritas as $berita)
                                    <p><?php echo $berita->isi  ?></p>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
@endsection
