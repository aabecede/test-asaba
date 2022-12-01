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
                    {{-- <div class="contentnya">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <input type="text" class="form-control" name="pelanggan[]">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Makanan</label>
                                    <input type="text" class="form-control" name="makanan[]">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="text" class="form-control" name="jumlah[]">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" name="jumlah[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label> Diskon Rp</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </div> --}}
                </form>
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
