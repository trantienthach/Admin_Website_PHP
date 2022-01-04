const imgConfig = "./public/images/logo/no_image-50x50.png";

// ========== ########## START MAIN BANNER ########## ========== //

var dataCreateRowMiniBanner = {
    btnCreate : document.getElementById('btnCreate_rowMiniBanner'),
    placeAppendData: document.querySelector('table.mini_banner_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.mini_banner_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowMiniBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByMiniBanner(dataCreateRowMiniBanner['rowOrderCurrent']);
    dataCreateRowMiniBanner['htmlEl'][dataCreateRowMiniBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowMiniBanner['rowOrderCurrent'] === 0) {
        dataCreateRowMiniBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.mini_banner_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowMiniBanner['btnClear'] = document.querySelectorAll("table.mini_banner_banner_table.table button.btnClear");
    dataCreateRowMiniBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowMiniBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('miniBannerImgRow')[1]);
            (dataCreateRowMiniBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.mini_banner_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowMiniBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByMiniBanner(order)
{
    return `<tr id="miniBannerImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="miniBanner[${order}]['title']" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="miniBanner[${order}]['desc']" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="miniBanner[${order}]['link']" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="miniBanner[${order}]['target']" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>300x155</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 200px; display: flex;">
                        <img data-src-id="miniBanner${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="miniBanner[${order}]['image']" id="miniBanner${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=miniBanner${order}" type="button" data-id-input-image="miniBanner${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner chính">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="miniBanner${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="miniBanner[${order}][order]" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// ========== ########## END MAIN BANNER ########## ========== //
// ========== ########## START SUB BANNER ########## ========== //

var dataCreateRowHeaderBanner = {
    btnCreate : document.getElementById('btnCreate_rowHeaderBanner'),
    placeAppendData: document.querySelector('table.header_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.header_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowHeaderBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByHeaderBanner(dataCreateRowHeaderBanner['rowOrderCurrent']);
    dataCreateRowHeaderBanner['htmlEl'][dataCreateRowHeaderBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowHeaderBanner['rowOrderCurrent'] === 0) {
        dataCreateRowHeaderBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.header_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowHeaderBanner['btnClear'] = document.querySelectorAll("table.header_banner_table.table button.btnClear");
    dataCreateRowHeaderBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowHeaderBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('headerBannerImgRow')[1]);
            (dataCreateRowHeaderBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.header_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowHeaderBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByHeaderBanner(order)
{
    return `<tr id="headerBannerImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="headerBanner[${order}]['title']" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="headerBanner[${order}]['desc']" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="headerBanner[${order}]['link']" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="headerBanner[${order}]['target']" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>100%x50</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 150px; display: flex;">
                        <img data-src-id="headerBanner${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="headerBanner[${order}]['image']" id="headerBanner${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=headerBanner${order}" type="button" data-id-input-image="headerBanner${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner phụ">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="headerBanner${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="headerBanner[${order}][order]" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// // ========== ########## END SUB BANNER ########## ========== //

// // ========== ########## START RIGHT BANNER ########## ========== //

var dataCreateRowContentBanner = {
    btnCreate : document.getElementById('btnCreate_rowContentBanner'),
    placeAppendData: document.querySelector('table.content_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.content_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowContentBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowContentBanner['rowOrderCurrent']);
    dataCreateRowContentBanner['htmlEl'][dataCreateRowContentBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowContentBanner['rowOrderCurrent'] === 0) {
        dataCreateRowContentBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.content_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowContentBanner['btnClear'] = document.querySelectorAll("table.content_banner_table.table button.btnClear");
    dataCreateRowContentBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowContentBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('contentBannerImgRow')[1]);
            (dataCreateRowContentBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.content_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowContentBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="contentBannerImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="contentBanner[${order}]['title']" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="contentBanner[${order}]['desc']" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="contentBanner[${order}]['link']" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="contentBanner[${order}]['target']" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>100%x100</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 150px; display: flex;">
                        <img data-src-id="contentBanner${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="contentBanner[${order}]['image']" id="contentBanner${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=contentBanner${order}" type="button" data-id-input-image="contentBanner${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner phụ">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="contentBanner${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="contentBanner[${order}][order]" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// // ========== ########## END RIGHT BANNER ########## ========== //

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