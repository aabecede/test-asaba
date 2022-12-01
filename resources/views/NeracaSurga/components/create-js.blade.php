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

                    if (response.status == 1) {
                        $('.content-triage').html(response.html)
                        export_data = response.triage
                    } else {
                        callSwal(
                            {
                                type:'warning',
                                title:response.title,
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

	// function setEditable(){
	// 	editor.SetEditableClass("editable",{

	// 	  // method used to vali<a href="https://www.jqueryscript.net/time-clock/">date</a> new value
	// 	  validation : function(val){
	// 	  	return val;
	// 	  },

	// 	  // method used to format new value
	// 	  formatter : function(val){
	// 	  	return parseFloat(val).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'});
	// 	  },

	// 	  // key codes
	// 	  keys : {
	// 	    validation: [13],
	// 	    cancellation: [27]
	// 	  },
	// 	  internals: {
    // 		renderValue: (elem, formattedNewVal) => {
    // 			var jenis = $(elem).parent().find('.select-jenis').val();
    // 			if(jenis == 'persen'){
    // 				var nilai = $(elem).parent().find('.harga-in').val();
	//     			$(elem).text(nilai+'%');
    // 			} else {
	//     			$(elem).text(formattedNewVal);
    // 			}
    // 		},
    // 		renderEditor: (elem, oldVal) => {
    // 			// oldVal = oldVal.replace(/\D/g,'');
    // 			oldVal = $(elem).parent().find('.harga-in').val();
    // 			$(elem).html(`<input type='number' min="0" class="form-control" style="width:100%; max-width:none">`);
    // 			var input = $(elem).find('input');
    // 			input.focus();
    // 			input.val(oldVal);
    // 		},
    // 		extractEditorValue: (elem) => {
    // 			var inp = $(elem).parent().find('.harga-in');
    // 			var harga = $(elem).find('input').val()
    // 			inp.val(harga);
    // 			return harga;
    // 		},
    // 		extractValue: (elem) => { return $(elem).text(); }
	//     }
	// 	});
	// }

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

	// function tambah_detail_tarif() {
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
	// }

	function remove_detail_tarif(id) {
		$('.remove-detail-tarif').on('click', function() {
			var get_clas_current = $(this).parent().parent().parent().find('.current_number')
			var current_number = get_clas_current.data('id')
			// current_number--
			// get_clas_current.data('id', current_number)
			$(this).parent().parent().remove();
		})
	}

    // function reindexNumDetail(id) {
	// 	var cls = '.index-num-detail-' + id
	// 	$(cls).each(function(key, item) {
	// 		item.innerText = key + 1;
	// 	});
	// }

</script>
{{-- end JS coba create --}}
