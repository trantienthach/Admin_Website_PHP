$(function() {

    __construct();

    function __construct()
    {
        handleChangeStatus();
        handleDelete();
        handleMultiAction();
        handleRecommendSearch() 
        
    }

    function handleMultiAction()
    {
        let dataAction = {
            "btnMulti"       : ".action_wrap .page_action_item .form_change_wrap .form_button",
            "listCheck"      : "#table_content .checkItem",
            "baseURL_delete" : "?controller=Categories&action=deleteMulti",
            "baseURL_status" : "?controller=Categories&action=changeStatusMulti",
        };

        $(dataAction['btnMulti']).click(function() {
            let $actionValue = $(this).parents('.form_change_wrap').find('select').val();
            if( $actionValue.length !== 0 ) {
                let $listIdCateProd = [];
                $(dataAction['listCheck']).each(function() {
                    if(this.checked) {
                        $listIdCateProd.push(parseInt($(this).parents('tr').attr('data-id')));
                    }
                });
                if( $listIdCateProd.length !== 0 ) {
                    if( $actionValue === 'delete' ) {
                        // delete CateProd
                        if( confirm("Bạn có thực sự muốn xóa danh sách danh mục này ?") ) {
                            $.ajax({
                                url: dataAction['baseURL_delete'],
                                method: "POST",
                                data: { list_id_cateprod : $listIdCateProd },
                                beforeSend() {
                                    console.log('deleting list CateProd');
                                },
                                dataType: "json",
                                success(data) {
                                    if(data['status']) {
                                        $listIdCateProd.forEach(item => {
                                            $("tr[data-id='"+ (item) +"']").stop().fadeOut(300);
                                        });
                                    } else {
                                        notificationAlert('error', "Xóa danh sách danh mục không thành công", 5000);
                                    }
                                },
                                error(xhr, AjaxOptions, thrownError) {
                                    notificationAlert('error', 'Xóa danh sách danh mục không thành công', 5000);
                                    console.log(xhr.status);
                                    console.log(thrownError);
                                }
                            });
                        }
                    } else {
                        $.ajax({
                            url: dataAction['baseURL_status'],
                            method: "POST",
                            data: { list_id_cateprod : $listIdCateProd, cateprod_is_status : $actionValue },
                            beforeSend() {
                                console.log('Updating list CateProd');
                            },
                            dataType: "json",
                            success(data) {
                                if(data['status']) {
                                    $listIdCateProd.forEach(item => {
                                        let statusOld = $actionValue === 'on' ? 'off' : 'on';
                                        $("tr[data-id='"+ (item) +"']").find('.toggle_status').removeClass(statusOld);
                                        $("tr[data-id='"+ (item) +"']").find('.toggle_status').addClass($actionValue);
                                    });
                                    notificationAlert('status', "Cập nhật danh sách danh mục thành công", 5000);
                                } else {
                                    notificationAlert('error', "Cập nhật danh sách danh mục không thành công", 5000);
                                }
                            },
                            error(xhr, AjaxOptions, thrownError) {
                                notificationAlert('error', 'Cập nhật danh sách danh mục không thành công', 5000);
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error', "Vui lòng chọn 1 danh mục", 5000);
                }
            } else {
                notificationAlert('error', "Vui lòng chọn 1 hành động", 5000);
            }
        });
    }

    function handleChangeStatus()
    {
        let dataStatus = {
            "btnChange"     : ".toggle_status .toggle_group",
            "baseURL"       : "?controller=Categories&action=changeStatusItem"
        };

        $(dataStatus['btnChange']).click(function() {
            let $cateprod_id = parseInt($(this).parents('tr').attr('data-id'));
            let $cateprod_is_status = $(this).parents('.toggle_status').hasClass('on') ? "off" : "on";
            $.ajax({
                url: dataStatus['baseURL'],
                method: "POST",
                data: {
                    cateprod_id : $cateprod_id,
                    cateprod_is_status : $cateprod_is_status
                },
                dataType: "json",
                beforeSend() {
                    console.log('updating status...');
                },
                success(data) {
                    if(data['status']) {
                        notificationAlert('success', 'Cập nhật trạng thái thành công', 5000);
                    } else {
                        notificationAlert('error', 'Cập nhật trạng thái thất bại', 5000);
                    }
                },
                error(xhr, AjaxOptions, thrownError) {
                    notificationAlert('error', 'Cập nhật trạng thái thất bại', 5000);
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    function handleDelete()
    {
        let dataDelete = {
            "btnDelete" : "#table_content table.table tr td.delete",
            "baseURL" : "?controller=Categories&action=deleteItem"
        };
        $(dataDelete['btnDelete']).click(function() {
            if(confirm("Bạn có thực sự muốn xóa danh mục này ?")) {
                let $cateprod_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: dataDelete['baseURL'],
                    method: "POST",
                    data: { cateprod_id : $cateprod_id },
                    dataType: "json",
                    beforeSend() {
                        console.log('deleting');
                    },
                    success(data) {
                        console.log(data);
                        if(data['status']) {
                            notificationAlert('success', "Xóa sản phẩm thành công", 5000);
                            $("tr[data-id='"+ ($cateprod_id) +"']").stop().fadeOut(300);
                        } else {
                            notificationAlert('error', "Xóa sản phẩm không thành công", 5000);
                        }
                    },
                    error(xhr, AjaxOptions, thrownError) {
                        notificationAlert('error', "Xóa sản phẩm không thành công", 5000);
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    }

    function handleRecommendSearch() {
        let dataSearch = {
            "wrapper"              : "body",
            "formSearchEl"         : "#formSearch_CateProd",
            "inputSearch"          : ".action_wrap .page_action_item.search .form_control",
            "spaceAppend"          : ".search_recommend_wrap .search_list",
            "recommendBox"         : ".search_recommend_wrap",
            "recommendItem"        : ".search_recommend_wrap .search_list li",
            "fieldSearch"          : ["cateprod_name"],
            "searchResponsive"     : [],
            "setTimeOutBlur"       : undefined,
            "baseURL_search"       : "?controller=Categories&action=handleGetFieldCateProdBySearchCateProdName",
            "baseURL_customizeUrl" : "?controller=Search&action=handleCustomizeUrl"
        };
        /**
         * Handle form submit action
         */
        $(dataSearch['formSearchEl']).submit(function() {
            event.preventDefault();
            let _self = this;
            let $strSearch = $(dataSearch['inputSearch']).val();
            if( $strSearch.length > 0 ) {
                $.ajax({
                    url: dataSearch['baseURL_customizeUrl'],
                    method: "POST",
                    data: { strSearch : $strSearch },
                    dataType: "json",
                    success(data) {
                        let urlCurrent = $(_self).attr('data-url');
                        let urlSearch  = urlCurrent + `&strSearch=${data['qSearch']}`;
                        window.location.replace(urlSearch);
                    },
                    error(xhr, ajaxOption, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });


        /**
         * effect keyup
         * -- Bắt sự kiện đang nhấn word vào input
         */
        $(dataSearch['wrapper']).delegate(dataSearch['inputSearch'], "keyup", function() {
            /**
             * B1: Get keyword from input send to server and get data from database
             */
            let $strSearch = $(this).val();
            if( $strSearch.length !== 0 ) {
                $.ajax({
                    url: dataSearch['baseURL_search'],
                    method: "POST",
                    data: { strSearch: $strSearch, fieldSearch : dataSearch['fieldSearch'] },
                    dataType: "json",
                    success (data) {
                        if( data['searchResponsive'].length !== 0 ) {
                            if(data['searchResponsive'].length > 10) {
                                $(dataSearch['recommendBox']).addClass('scroll');
                            } else {
                                $(dataSearch['recommendBox']).removeClass('scroll');
                            }
                            renderHtmlSearch(data['searchResponsive'], 'cateprod_name');
                            handleSelectSearchItem();
                            dataSearch['searchResponsive'] = data['searchResponsive'];
                            $(dataSearch['recommendBox']).stop().show(0);
                        } else {
                            $(dataSearch['recommendBox']).stop().hide(0);
                            dataSearch['searchResponsive'] = [];
                        }
                    },
                    error(xhr, ajaxOption, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                })
            } else {
                $(dataSearch['recommendBox']).stop().hide(0);
            }
        });

        /**
         * Handle submit form search action
         */

        /**
         * effect focus
         * -- Bắt sự kiện trỏ chuộc vào input
         */
         $(dataSearch['inputSearch']).focus(function() {
            clearTimeout(dataSearch['setTimeOutBlur']);
            if(dataSearch['searchResponsive'].length !== 0) {
                $(dataSearch['recommendBox']).stop().show(0);
            }
        });

        /**
         * effect blur
         * -- Thoát ra khỏi input
         */
        $(dataSearch['inputSearch']).blur(function() {
            dataSearch['setTimeOutBlur'] = setTimeout(function() {
                $(dataSearch['recommendBox']).stop().hide(0);
            }, 500);
        });

        /**
         * Select search recommend item
         */
        function handleSelectSearchItem() {
            $(dataSearch['recommendItem']).click(function() {
                let strSearch = $(this).text();
                $(dataSearch['inputSearch']).val(strSearch);
            });
        }

        /**
         * Append data before search
         * -- render html
         */
        function renderHtmlSearch(data, fieldSearch) {
            let htmlS = '';
            htmlS = data.map(function(item) {
                return `<li>${item[fieldSearch]}</li>`;
            });
            $(dataSearch['spaceAppend']).html(htmlS.join(''));
        }
    }

    function notificationAlert(status = 'error', txtNotify = 'Bạn chưa tạo thông báo cho chức năng', timeDelay = 2000) {
        $(".alert").addClass('alert_'+(status)+'');
        $(".alert").addClass('open');
        $(".alert span").text(txtNotify);
        timeoutToggleAlert = setTimeout(function() {
            $(".alert").removeClass('open');
            $(".alert").removeClass('alert_error');
            $(".alert span").text('');
        }, timeDelay);
        let closeAlertEl = $(".alert .close");
        closeAlertEl.click(function() {
            $(".alert").removeClass('open');
            $(".alert span").text('');
        });
    }
});