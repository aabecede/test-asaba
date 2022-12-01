<tbody class="js-table-sections-header section-${trCount}">
    <tr>
        <td colspan="5">
            <hr>
        </td>
    </tr>
    <tr>
        <td class="text-center toggle-header index-num" data-id="${trCount}">
            <i class="fa fa-angle-right"></i> ${trCount}
        </td>
        <td colspan="3">
            <select class="form-control js-select2-tags select-nama" required name="nama_orang[${trCount}]" data-placeholder="Masukkan Nama">
            </select>
        </td>
        <td class="text-right btn-remove-show">
        </td>
    </tr>
</tbody>
<tbody style="background-color: whitesmoke" class="tbody-detail-${trCount}">
    <tr>
        <th class="text-center"></th>
        <th class="text-center">Deskripsi</th>
        <th class="text-center">Jumlah</th>
        <th class="text-center">Harga</th>
        <th></th>
    </tr>
    <tr>
        <td class="text-center index-num-detail-id current_number" data-id="1">

        </td>
        <td>
            <input type="text" class="form-control" required name="deskripsi[${trCount}][0]">
        </td>
        <td>
            <input type="number" class="form-control cls-jumlah" required name="jumlah[${trCount}][0]">
        </td>
        <td class="text-center">
            <input type="number" class="form-control cls-harga" required name="harga[${trCount}][0]">
        </td>
        <td>
            <button class="btn btn-info tambah-detail-tarif" type="button" data-id="${trCount}">
                <span class="fa fa-plus"></span>
            </button>
        </td>
    </tr>
</tbody>

