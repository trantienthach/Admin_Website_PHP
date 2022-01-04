const imgConfig = "./public/images/logo/no_image-50x50.png";
// ========== ########## --------------------------- ########## ========== //
// ========== ########## START HANDLE CLIENT PRODUCT ########## ========== //
// ========== ########## --------------------------- ########## ========== //
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
                    <input type="hidden" name="prod_image_desc[${order}][image]" id="input_image${order}">
                </td>
                <td>
                    <input type="number" min="0" name="prod_image_desc[${order}][sort_order]" placeholder="Sắp xếp" class="form_control">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}

//
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
            console.log(imgElClear);
            console.log(inputElClear);
        });
    });
}
//
// ========== ########## ------------- ########## ========== //
// ========== ########## START SPECIAL ########## ========== //
// ========== ########## ------------- ########## ========== //

// ---------- info special ---------- //

var dataCreateRowInfoSpecial = {
    btnCreate : document.getElementById('btnCreate_rowSpecial'),
    placeAppendData: document.querySelector('table.special.content tbody'),
    rowOrderCurrent: document.querySelectorAll('table.special.content tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowInfoSpecial['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByInfoSpecial(dataCreateRowInfoSpecial['rowOrderCurrent']);
    dataCreateRowInfoSpecial['htmlEl'][dataCreateRowInfoSpecial['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowInfoSpecial['rowOrderCurrent'] === 0) {
        dataCreateRowInfoSpecial['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.special.content tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowInfoSpecial['btnClear'] = document.querySelectorAll("table.special.content button.btnClear");
    dataCreateRowInfoSpecial['rowOrderCurrent'] ++;
    handleClearInfoSpecial(dataCreateRowInfoSpecial['btnClear']);
});


function handleClearInfoSpecial(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowInfoSpecial['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.special.content tbody tr').length;
            if(numRow === 0) {
                dataCreateRowInfoSpecial['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByInfoSpecial(order) {
    return `<tr id="special_row${order}">
                <td>
                    <input class="form_control" type="text" name="prod_specialInfo[${order}]['title']" placeholder="Tiêu đề khuyến mãi" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <input class="form_control" type="number" name="prod_specialInfo[${order}]['order']" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <input class="form_control" type="text" name="prod_specialInfo[${order}]['link']" placeholder="Link liên kết" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`
}


// ---------- image special ---------- //

var dataCreateRowImgSpecial = {
    btnCreate : document.getElementById('btnCreate_rowSpecialImg'),
    placeAppendData: document.querySelector('table.special.images tbody'),
    rowOrderCurrent: document.querySelectorAll('table.special.images tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowImgSpecial['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImgSpecial(dataCreateRowImgSpecial['rowOrderCurrent']);
    dataCreateRowImgSpecial['htmlEl'][dataCreateRowImgSpecial['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowImgSpecial['rowOrderCurrent'] === 0) {
        dataCreateRowImgSpecial['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.special.images tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowImgSpecial['btnClear'] = document.querySelectorAll("table.special.images button.btnClear");
    dataCreateRowImgSpecial['rowOrderCurrent'] ++;
    handleClearImgSpecial(dataCreateRowImgSpecial['btnClear']);
    handleOpenFilemana();
});

function handleClearImgSpecial(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowInfoSpecial['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.special.images tbody tr').length;
            if(numRow === 0) {
                dataCreateRowInfoSpecial['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImgSpecial(order) {
    return `<tr id="specialImg_row${order}">
                <td>
                    <span class="thumbNail">
                        <img class="img_cover full_size" data-src-id="special_image${order}" src="./public/images/logo/no_image-50x50.png" alt="">
                    </span>
                    <div class="popover" style='transform: translate(0)'>
                        <div class="popover_content d_flex align_items_center justify_content_center">
                            <a href="./public/plugins/filemanager/dialog.php?type=0&amp;field_id=special_image${order}" type="button" data-id-input-image="input_image0" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả" style="padding: 6px 10px 7px 12px;margin-right: 3px;">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" data-id-clear-img="special_image${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="prod_specialImg[${order}][image]" id="special_image${order}">
                </td>
                <td>
                    <input class="form_control" type="text" name="prod_specialImg[${order}][title]" placeholder="Tiêu đề khuyến mãi" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <input class="form_control" type="number" name="prod_specialImg[${order}][order]" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <input class="form_control" type="text" name="prod_specialImg[${order}][link]" placeholder="Link liên kết" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`
}

// ========== ########## ----------- ########## ========== //
// ========== ########## END SPECIAL ########## ========== //
// ========== ########## ----------- ########## ========== //


// ========== ########## ----------- ########## ========== //
// ========== ########## START FLASH SALE ########## ========== //
// ========== ########## ----------- ########## ========== //
var dataCreateRowFlashSale = {
    btnCreate : document.getElementById('btnCreate_rowFlashSale'),
    placeAppendData: document.querySelector('table.flash_sale tbody'),
    rowOrderCurrent: document.querySelectorAll('table.flash_sale tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowFlashSale['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByFlashSale(dataCreateRowFlashSale['rowOrderCurrent']);
    dataCreateRowFlashSale['htmlEl'][dataCreateRowFlashSale['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowFlashSale['rowOrderCurrent'] === 0) {
        dataCreateRowFlashSale['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.flash_sale tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowFlashSale['btnClear'] = document.querySelectorAll("table.flash_sale button.btnClear");
    dataCreateRowFlashSale['rowOrderCurrent'] ++;
    handleClearFlashSale(dataCreateRowFlashSale['btnClear']);
});

function handleClearFlashSale(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowFlashSale['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.flash_sale tbody tr').length;
            if(numRow === 0) {
                dataCreateRowFlashSale['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByFlashSale(order) {
    return `
    <tr id="flashSale_row${order}">
        <td>
            <select class="form_control" name="prod_flashSale[0][customer_group_id]">
                <option value="">Mặc định</option>
                <option value="">Khách hàng tìm năng</option>
            </select>
        </td>
        <td>
            <input class="form_control" type="text" name="prod_flashSale[${order}][priority]" placeholder="Độ ưu tiên" autocomplete="off" spellcheck="false">
        </td>
        <td>
            <input class="form_control" type="number" name="prod_flashSale[${order}][price]" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
        </td>
        <td>
            <div class="input_group">
                <input class="form_control dateStart_value" type="date" name="prod_flashSale[${order}][date_start]" placeholder="Thời gian bắt đầu" autocomplete="off" spellcheck="false">
            </div>
        </td>
        <td>
            <div class="input_group">
                <input class="form_control dateEnd_value" type="date" name="prod_flashSale[${order}][date_end]" placeholder="Thời gian kết thúc" autocomplete="off" spellcheck="false">
            </div>
        </td>
        <td>
            <button type="button" class="btn btn_danger btnClear">
                <i class="fa fa-minus-circle"></i>
            </button>
        </td>
    </tr>
    `;
}

// ========== ########## ----------- ########## ========== //
// ========== ########## END FALSH SALE ########## ========== //
// ========== ########## ----------- ########## ========== //