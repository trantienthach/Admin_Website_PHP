const imgConfig = "./public/images/logo/no_image-50x50.png";
handleOpenFilemana();
function handleOpenFilemana() {
    $('.iframe-btn').fancybox({
        'width'		: 900,
        'height'	: 600,
        'type'		: 'iframe',
        'autoScale'	: false
    });
}

function responsive_filemanager_callback(field_id){
    var url = jQuery('#'+field_id).val();
    $("[data-src-id='"+(field_id)+"']").attr('src', url);
    handleClearImage();
}

function handleClearImage() {
    let listBtnClearSrcImg = document.querySelectorAll("[data-id-clear-img]");
    listBtnClearSrcImg.forEach(btnEl => {
        btnEl.addEventListener('click', function() {
            let field_id = btnEl.getAttribute('data-id-clear-img');
            let imgElClear = document.querySelector("[data-src-id='"+(field_id)+"']");
            let inputElClear = document.getElementById(""+(field_id)+"");
            imgElClear.setAttribute('src',imgConfig);
            inputElClear.setAttribute('value','');
        });
    });
}

//
var dataCreateRowImagesDesc = {
    btnCreate : document.getElementById('btnCreate_rowImage'),
    placeAppendData: document.querySelector('table.table_images.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.table_images.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}


dataCreateRowImagesDesc['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowImagesDesc['rowOrderCurrent']);
    dataCreateRowImagesDesc['htmlEl'][dataCreateRowImagesDesc['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowImagesDesc['rowOrderCurrent'] === 0) {
        dataCreateRowImagesDesc['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.table_images.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowImagesDesc['btnClear'] = document.querySelectorAll("table.table_images.table button.btnClear");
    dataCreateRowImagesDesc['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowImagesDesc['btnClear']);
    handleOpenFilemana();
});


function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowImagesDesc['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.table_images.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowImagesDesc['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="image_row${order}">
                <td class="position_relative">
                    <div class="thumbNail">
                        <img data-src-id="input_image${order}" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <div class="popover position_absolute">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=input_image${order}" type="button" data-id-input-image="input_image${order}" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" data-id-clear-img="input_image${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="blog_image_desc[${order}][image]" id="input_image${order}">
                </td>
                <td>
                    <input type="number" min="0" name="blog_image_desc[${order}][sort_order]" placeholder="Sắp xếp" class="form_control">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
