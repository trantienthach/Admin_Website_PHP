$(function () {
    __construct();

    function __construct() {
        handleBrandLogo();
        handleLoadMaxOrder();
    }
    function handleLoadMaxOrder() {
        let orderData = {
            "baseURL_ajax" : "?controller=Brand&action=handleGetMaxOrder",
            "inputAppend"  : ".order_max"
        };
        $.ajax ({
            url : orderData['baseURL_ajax'],
            method : "POST",
            dataType: "json",
            success : (data) => {
                $(orderData['inputAppend']).val(data['orderMax']);
            },
            error(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    }

    function handleBrandLogo() {
        let logoBrandata = {
            "btnFile"        : "#brand_logo_fake",
            "inputFile"      : "#brand_logo",
            "extendAllow"    : ['jpg', 'jpeg', 'svg', 'gif', 'png'],
            "FileSize"       : 5242880,
            "spaceAppendImg" : "#brand_logo_append",
            "spaceAppendInput" : "#brand_logo_append_input",
            "imgDefault"     : "./public/images/logo/no_image-50x50.png",
            "baseURL_ajax"   : '?controller=Brand&action=uploadLogoBrand'
        }
        $(logoBrandata['btnFile']).change(function () {
            handleInputfileBrandLogo(this);
        });

        function handleInputfileBrandLogo(fileEL) {
            if (fileEL.files[0]) {
                // người dùng đã chọn ảnh
                let fileOjb = fileEL.files[0];
                if (checkExtendFileImg(fileOjb['name'])) {
                    //Tên đuôi file hợp lệ
                    if (checkFileSize(fileOjb['size'])) {
                        let fileReader = new FileReader();
                        let formData = new FormData();
                        formData.append('brand_logo', fileEL.files[0]);
                        fileReader.onload = function(e){
                            let srcImg = fileEL.files[0].name;
                            $(logoBrandata['spaceAppendImg']).attr('src',e.currentTarget.result);
                            $(logoBrandata['spaceAppendInput']).val(e.currentTarget.result);
                            $(logoBrandata['fileInput']).attr('value',srcImg);
                            appendImgURLInputHidden(formData);
                        }
                        fileReader.readAsDataURL(fileEL.files[0]);
                    }
                    else {
                        notificationAlert('error', 'Dung lượng file không vượt quá 5MB ', 5000);
                        resetFileImg();
                    }
                }
                else {
                    // Tên đuôi file không hợp lệ
                    notificationAlert('error', 'Tên file không hợp lệ, chỉ chấp nhận '  + logoBrandata['extendAllow'].join(", ") +  '', 5000);
                    resetFileImg();
                }
            }
            else {
                //người dùng chưa chọn ảnh
            }
        }
        //----------- CHECK ĐUÔI FILE ---------------//
        function checkExtendFileImg(fileName) {
            let extendFile = fileName.split('.').pop().toLowerCase();
            /**
             * Sử dụng hàm $.inArray() của jqery kiểm tra đuôi file có tồn tại , trả về -1 là không có
             */
            if ($.inArray(extendFile, logoBrandata['extendAllow']) == -1) {
                return false;
            } return true;
        }

        //----------------- CHECK SIZE FILE --------------//
        function checkFileSize(fSize) {
            if (fSize > logoBrandata['FileSize']){
                return false;
            } return true;
        }


        //---------- RESET FILE --------- //

        function resetFileImg() {
            $(logoBrandata['btnFile']).val('');
            $(logoBrandata['spaceAppendImg']).attr('src', logoBrandata['imgDefault']);
        }
        // ---------------------------------- //

        // -------- FUNCTION NOTIFI --------- //
        // ---------------------------------- //
        function notificationAlert(status = 'error', txtNotifi = 'Bạn chưa tạo thông báo cho chức năng', timeDelay = 2000) {
            $(".alert").addClass('alert_' + (status) + '');
            $(".alert").addClass('open');
            $(".alert span").text(txtNotifi);
            timeoutToggleAlert = setTimeout(function () {
                $(".alert").removeClass('open');
                $(".alert").removeClass('alert_error');
                $(".alert span").text('');
            }, timeDelay);
            let closeAlertEl = $(".alert .close");
            closeAlertEl.click(function () {
                $(".alert").removeClass('open');
                $(".alert span").text('');
            });
        }

        function appendImgURLInputHidden (formdata) {
            $.ajax({
                url         : logoBrandata['baseURL_ajax'],
                method      : "POST",
                data        : formdata,
                contentType : false,
                processData : false,
                dataType    : "json",
                success     : function(data) {
                    if(data['status'] === 'success') {
                        $("._brand_upload_logo_error_").text('Hình đã được lưu');
                        $("#brand_logo").val(data['targetFile']);
                    } else {
                        $("._brand_upload_logo_error_").text('Lưu hình ảnh không thành công')
                    }
                },
                error       : function(xhr,ajaxOptions,thrownError ) {
                    console.log (xhr.status);
                    console.log (thrownError);
                }
            });
        }

    }
});