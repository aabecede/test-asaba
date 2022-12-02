<script type="text/javascript">
	var trCount = 0;
	var tbody = $('#harga-tbody');
	var editor = new SimpleTableCellEditor("hargaTable");

	// $(document).ready(function(){
	// 	// setEditable();
	// })
	$(document).on('click', '#tambahRecord', function(){
		trCount++;
        console.log(trCount)
		$('.add-tbody').append(`@include('NeracaSurga.components.create-tr')`);
		if (trCount != 1) {
			let html = `<button class="btn btn-danger btn-sm remove" data-current="${trCount}" type="button">
					<i class="fa fa-remove"></i>
				</button>`
			let cls = '.add-tbody .section-'+trCount+' .btn-remove-show'
			$(cls).append(html)
		}
        initSelect2()
		// setEditable();
	});

    $(document).on('click', '#hitung', function(){
        var this_form = $('#formNeraca')
        var this_button = $(this)
        var data = this_form.serializeArray()
        var is_validated = customValidatorVJs(this_button, this_form)

        if (is_validated == true) {
            $.ajax({
                type: "POST",
                url: `${BASE_URL}/ajax-hitung-neraca-surga`,
                data: data,
                dataType: "json",
                success: function(response) {

                    $('#main-page-loading').css('display', 'none')
                    $("#loading-button").remove()
                    $(this_button).attr('disabled', false)

                    if (response.code == 200) {
                        $('.modal-body').html('Sedang Memproses Data...')
                        $("#HasilNecaraSurga").modal('toggle');

                        let html = htmlSetHasilNeraca({
                            response
                        })
                        $('.modal-body').html(html)

                    } else {
                        callSwal(
                            {
                                type:'warning',
                                title:response?.title ?? 'Oops',
                                text:response.message,
                                url: 0
                            }
                        )
                    }
                },
                error: function(response) {
                    $('#main-page-loading').css('display', 'none')
                    $("#loading-button").remove()
                    $(this_button).attr('disabled', false)
                    return swalTerjadiKesalahanServer()
                }
            });
        }
    })


	$(document).on('click', '.remove', function(el){
		var current = $(this).data('current')
		var cls = '.section-' + current
		var cls_detail = '.tbody-detail-' + current
		$(cls).remove()
		$(cls_detail).remove()
		trCount--;
		reindexNum();
	});

	function reindexNum(){
		$('.index-num').each(function(key, item){
			item.innerText = key+1;
		});
	}

</script>

{{-- JS coba create --}}
<script>
	$(document).ready(function() {
		// tambah_detail_tarif()
		$('#tambahRecord').trigger('click')
	});

	$('#hargaTable').on('click', '.js-table-sections-header .toggle-header', function(){
		var get_id = $(this).data('id')
		let cls = '.section-'+get_id
		console.log(cls)
		if ($(cls).hasClass('show')) {
			$(cls).removeClass('show table-active')
		}else{
			$(cls).addClass('show table-active');
		}
	})

    $('#hargaTable').on('click', '.tambah-detail-tarif', function() {
        var id = $(this).data('id')
        var cls = '.tbody-detail-' + id
        var get_clas_current = $(cls).find('tr td.current_number')
        var current_number = get_clas_current.data('id')
        current_number++
        get_clas_current.data('id', current_number)
        var html = `<tr>
                        <td class="text-center index-num-detail-${id}"></td>
                        <td>
                            <input type="text" class="form-control" required name="deskripsi[${id}][${current_number}]">
                        </td>
                        <td>
                            <input type="number" class="form-control cls-jumlah" required name="jumlah[${id}][${current_number}]">
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control cls-harga" required name="harga[${id}][${current_number}]">
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-detail-tarif" type="button"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>`
        $(cls).append(html)
        remove_detail_tarif(id)
    })

	function remove_detail_tarif(id) {
		$('.remove-detail-tarif').on('click', function() {
			var get_clas_current = $(this).parent().parent().parent().find('.current_number')
			var current_number = get_clas_current.data('id')
			// current_number--
			// get_clas_current.data('id', current_number)
			$(this).parent().parent().remove();
		})
	}

    function htmlSetHasilNeraca({
        response //must parse to JSON.parse
    }){
        let html = ``;
        html += `<div class="row">`
            $.each(response.data, function (key, value) {

                let bodyPesanan = ``
                $.each(value.pesanan, function (indexPesanan, valuePesanan) {
                    bodyPesanan += `
                        <tr>
                            <td>${indexPesanan+1}</td>
                            <td>${valuePesanan?.deskripsi}</td>
                            <td>Rp.${valuePesanan?.jumlah.toLocaleString()}</td>
                            <td>Rp.${valuePesanan?.harga.toLocaleString()}</td>
                            <td>Rp.${valuePesanan?.total.toLocaleString()}</td>
                        </tr>
                    `
                });
                let contentPesanan = `
                    <table class="table">
                        <thead class="thead-dark">
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </thead>
                        ${bodyPesanan}
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">Total Belanja</td>
                                <td>Rp.${value?.subtotal.toLocaleString()}</td>
                            </tr>
                            <tr class="text-success">
                                <td colspan="4" class="text-right">Diskon</td>
                                <td>Rp.${value?.diskon.toLocaleString()}</td>
                            </tr>
                            <tr class="text-danger">
                                <td colspan="4" class="text-right">Ongkir</td>
                                <td>Rp.${value?.ongkir.toLocaleString()}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Total</td>
                                <td>Rp.${value?.total.toLocaleString()}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <hr>
                `

                html += `
                    <div class="col-12">
                        <label class="badge badge-info">${value?.name}</label>
                    </div>
                    <div class="col-12">
                        ${contentPesanan}
                    </div>`
            });
        html += `
                    <div class="col-12 text-center">
                        <h4>Total : ${response?.total.toLocaleString()}</h4>
                    </div>
                </div>`

        return html;
    }

    // function reindexNumDetail(id) {
	// 	var cls = '.index-num-detail-' + id
	// 	$(cls).each(function(key, item) {
	// 		item.innerText = key + 1;
	// 	});
	// }

</script>
{{-- end JS coba create --}}
