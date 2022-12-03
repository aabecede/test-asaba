@extends('BaseLayout.BaseIndex')
@section('content')
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Neraca Surga</h4>
            </div>
            <div class="card-body">
                <form id="formNeraca" enctype="multipart/form-data">
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover js-table-sections add-tbody" id="hargaTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10%;">#</th>
                                    <th class="text-center" style="width: 1px;" colspan="3"></th>
                                    <th class="text-center" style="width: 10%;">#</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Jumlah Diskon </label>
                                    <input type="number" class="form-control" name="diskon" id="diskon" value="">
                                </div>
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Jumlah Ongkir </label>
                                    <input type="number" class="form-control" name="Ongkir" id="diskon" value="">
                                </div>
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-info" type="button" id="hitung">Hitung</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-primary" type="button" id="tambahRecord">Tambah Record</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="HasilNecaraSurga" tabindex="-1" role="dialog" aria-labelledby="HasilNecaraSurgaTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hasil Neraca Surga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary btn-save">Save changes</button> --}}
            </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-editable.css')}}">
@endpush
@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('NeracaSurga.components.create-js')
@endpush
