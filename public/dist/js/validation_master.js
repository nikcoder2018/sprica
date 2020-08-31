$(document).ready(function(){

    var vErrorMessage = {

        'vRequired' : "Bu alanı boş bıraktınız !",
        'vNumeric' : "Bu alana sadece sayı girilmelidir.",
        'vNumericNot' : "Bu alana sadece harf girilmelidir.",
        'vEmailFilter' : "Geçerli bir eposta adresi girmeniz gerekiyor.",
        'vMinchar' : "En az %c Karakter girmeniz gerekiyor.",
        'vMaxchar' : "En fazla %c Karakter girebilirsiniz.",
        'vPasswordConfirm' : "Girdiğiniz şifreler birbiriyle uyuşmamaktadır.",
        'vCheckRequired' : "Bu alanda seçim yapmanız gerekiyor.",
        'vTcRequired' : "Geçerli bir Kimlik Numarası Girmeniz Gerekiyor..",
        'vYoutube' : "Girdiğiniz video linki desteklenmemektedir. Lütfen tekrar deneyin.",
        'vFileSize' : "%c KB'den fazla resim veya dosya yükleyemezsiniz."

    };

    var RequiredClass = [

        'vRequired',
        'vNumeric',
        'vNumericNot',
        'vEmailFilter',
        'vMinchar',
        'vMaxchar',
        'vYoutube',
        'vFileSize'

    ];

    $('.vEmailFilter').attr({'autocorrect':'off','autocapitalize':'none'});

    $('.vEmailFilter').keyup(function(){
        $(this).css({'text-transform':'lowercase'});
        return $(this).val($(this).val().toLowerCase());
    });

    $.fn.validationForm = function(options){

        var option = $.extend({
            ajaxType: false,
            ajaxReturnPage : false,
            ajaxHideType : false,
            ajaxRefreshPage : false,
            ajaxScrollBottom : true
        }, options );

        $(".cellphone",this).mask("0(599) 999 9999");
        $(".fixedphone",this).mask("0(999) 999 9999");

        //$(".moneyFilter").autoNumeric("init");

        function formatCurrency(total) {
            var neg = false;
            if(total < 0) {
                neg = true;
                total = Math.abs(total);
            }
            return (neg ? "" : '') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
        }

        $(".domain",this).click(function(){
            $(this).val("http://");
        });


        $(".domain",this).bind('paste', function(e) {
            var el = $(this);
            setTimeout(function() {
                var text = $(el).val();
                $('.domain',this).val( text.replace('http://http://','http://') );
            }, 100);
        });

        $(".domain-search-input",this).click(function(){
            $(this).val("www.");
        });


        $(".domain-search-input",this).bind('paste', function(e) {
            var el = $(this);
            setTimeout(function() {
                var text = $(el).val();
                $('.domain').val( text.replace('www.www.','www.') );
            }, 100);
        });

        var selectForm = this;

        $(selectForm).attr('error','true');

        this.find(':input:not(:submit,:button)').focusout(function(){
            $(this).trigger('change');
        });

        this.find(':file').change(function(){
            if($(this).val() !== ""){

                $(this).parents('.input-file-upload-blax').find('.file-input-type').addClass('active');

            }else{

                $(this).parents('.input-file-upload-blax').find('.file-input-type').removeClass('active');

            }
        });

        this.find('input:checkbox,input:radio').change(function(){

            if($(this).hasClass('vCheckRequired') === true){

                $(this).parents('.vCheckRequired').find('.vError').remove();

                var vErrors = [];
                var vSuccess = [];

                var Classes = $(this).parent('.vCheckRequired').attr('class').split(' ');

                if($(this).is(':checked') === false){

                    $(this).parents('.vCheckRequired').append('<div class="vError"><p class="vErrorIn">'+ vErrorMessage.vCheckRequired +'</p></div>');

                }else{

                    $(this).parents('.vCheckRequired').find('.vError').remove();
                    $(this).css({'background':'#dff0d8','border-color':'#d6e9c6'});

                }

            }

        });

        this.find(':input:not(:submit,:button,:checkbox,:radio)').change(function(){

            var vErrors = [];
            var vSuccess = [];

            $(this).parent('.vError').find('p.vErrorIn').remove();

            var input = $(this);

            var Classes = $(this).attr('class').split(' ');

            $.each(Classes,function(cKey,cItem){


                if(required($(input),cItem) === false){

                    vErrors.push({
                        'type':cItem,
                        'input' : input,
                        'parent' : input.data('parent')
                    });

                    $(selectForm).attr('error','true');

                    return false;

                }else if(required($(input),cItem) === true){

                    vSuccess.push({
                        'input' : input
                    });

                    $(selectForm).removeAttr('error');

                }


            });

            if(vErrors.length > 0){

                $.each(vErrors,function(key,value){

                    $(vErrors[key].input).parents('.vError').find('p.vErrorIn').remove();
                    $(vErrors[key].input).parents('.vError').contents().unwrap();

                    if(!vErrors[key].parent){
                        $(vErrors[key].input).wrap('<div class="vError"></div>');
                    }else{
                        $(vErrors[key].input).parents(vErrors[key].parent).eq(0).wrap('<div class="vError"></div>');
                    }

                    if(vErrors[key].type == "vMinchar"){
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type].replace('%c',$(vErrors[key].input).data('minchar')) +'</p>');
                    }else if(vErrors[key].type == "vMaxchar"){
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type].replace('%c',$(vErrors[key].input).data('maxchar')) +'</p>');
                    }else if(vErrors[key].type == "vFileSize"){
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type].replace('%c',$(vErrors[key].input).data('size')  / 1024) +'</p>');
                    }else{
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type] +'</p>');
                    }
                    $(vErrors[key].input).css({'background':'none'});
                });

                return false;
            }else if(vSuccess.length > 0){
                $.each(vSuccess,function(key,value){

                    $(vSuccess[key].input).parents('.vError').find('p.vErrorIn').remove();
                    $(vSuccess[key].input).parents('.vError').contents().unwrap();


                });
            }else{
                return true;
            }

        });

        this.submit(function(ev){

            if(option.ajaxType === true){
                ev.preventDefault();
            }

            var vErrors = [];
            var vSuccess = [];

            $(this).find('.vError').find('p.vErrorIn').remove();
            $(this).find('.vError').each(function(){
                $(this).find(':input').parents('.vError').contents().unwrap();
            });
            var form = this;

            $(form).find('.vCheckRequired').each(function(){

                if($(this).find(':input').is(':checked') === false){
                    vErrors.push({
                        'type': 'vCheckRequired',
                        'input' : $(this),
                        'parent' : $(this).data('parent'),
                        'checked' : true
                    });

                    $(selectForm).attr('error','true');

                }

            });

            $(form).find(':input:not(:submit,:button,:checkbox)').each(function(e){

                var input = $(this);

                if($(this).attr('class')){

                    var Classes = $(this).attr('class').split(' ');

                    $.each(Classes,function(cKey,cItem){

                        if(required($(input),cItem) === false){

                            vErrors.push({
                                'type':cItem,
                                'input' : input,
                                'parent' : input.data('parent')
                            });

                            return false;
                            ev.preventDefault();

                        }else{

                            vSuccess.push({
                                'input' : input
                            });

                        }

                    });

                }else{

                    // ev.preventDefault();
                    return true;

                }

            });

            if(vErrors.length > 0){

                $(selectForm).find('.vError').contents().unwrap();

                var count = 0;

                $.each(vErrors,function(key,value){

                    count++;

                    if(count == 1){
                        $('html,body').animate({
                                scrollTop: $(selectForm).offset().top-10},
                            'slow');
                    }



                    if(vErrors[key].checked === true){
                        $(vErrors[key].input).append('<div class="vError"><p class="vErrorIn">'+ vErrorMessage[vErrors[key].type] +'</p></div>');
                    }else if(!vErrors[key].parent){
                        $(vErrors[key].input).wrap('<div class="vError"></div>');
                    }else{
                        $(vErrors[key].input).parents(vErrors[key].parent).eq(0).wrap('<div class="vError"></div>');
                    }

                    if(vErrors[key].type == "vMinchar"){
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type].replace('%c',$(vErrors[key].input).data('minchar')) +'</p>');
                    }else if(vErrors[key].type == "vMaxchar"){
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type].replace('%c',$(vErrors[key].input).data('maxchar')) +'</p>');
                    }else if(vErrors[key].type == "vFileSize"){
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type].replace('%c',$(vErrors[key].input).data('size')  / 1024) +'</p>');
                    }else{
                        $(vErrors[key].input).parents('.vError').append('<p class="vErrorIn">'+ vErrorMessage[vErrors[key].type] +'</p>');
                    }
                    $(vErrors[key].input).css({'background':'none','border-color':'inherit'});


                });

                if(vSuccess.length > 0){
                    $.each(vSuccess,function(key,value){
                        if(vSuccess[key].type == 'vRequired' && vSuccess[key].type == 'vNumeric'){
                            $(vSuccess[key].input).css({'background':'#dff0d8','border-color':'#d6e9c6'});
                        }
                    });
                }

                ev.preventDefault();
                return false;
            }else{
                if(option.ajaxType === true){

                    thisForm = $(this);

                    /*
                    $('.vAjaxErrors').append('<div class="alerts alert-info"> İşleminiz Gerçekleştiriliyor. Lütfen bekleyiniz <div class="alert-loading"><img src="https://www.asansorhizmet.com/lib/images/loading.gif"/></div></div>');
                    */
                    $.ajax({
                        type:"POST",
                        url:$(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(sonuc){
                            $(thisForm).find(".vAjaxErrors").html(sonuc);
                        }
                    });
                    return false;
                    ev.preventDefault();
                }else{
                    return true;
                }
            }

        });

        $(this).find(':input.vCharLimit').each(function(){

            $(this).wrap('<div class="charWrap"></div>');
            $(this).parents('.charWrap').append('<div class="charlimit">'+ $(this).data('maxchar') +'</div>');
            $(this).keyup(function(){
                $(this).css({'padding-right':$(this).parents('.charWrap').find('.charlimit').width()+30});
                var maxchar = $(this).data('maxchar');
                var keychar = $(this).val().length;
                var endchar = maxchar-keychar;
                if(endchar < 0){
                    maxchar = maxchar;
                    $(this).val($(this).val().substr(0,maxchar));
                }else{
                    $(this).parents('.charWrap').find('.charlimit').html(endchar);
                }
            });

        });

        function isEmptyInput(value) {
            return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
        }


        function required(item,control){

            switch (control) {

                case "vFileSize":

                    if($(item)[0].files[0].size < $(item).data('size')){
                        return true;
                    }else{
                        return false;
                    }

                    break;

                case 'vRequired':

                    if($(item).hasClass('cellphone') === true){

                        if($(item).val() === "0(5__) ___ ____" || $(item).val() === ""){
                            return false;
                        }else{
                            return true;
                        }

                    }else if($(item).hasClass('selectstyle') === true){

                        if( item.children('option').length <= 0 ){
                            return false;
                        }else{
                            return true;
                        }

                    }else{
                        if(isEmptyInput($(item).val())){
                            return false;
                        }else{
                            return true;
                        }

                    }


                    break;

                case 'vNumeric':

                    if($.isNumeric($(item).val()) === false){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vNumericNot':

                    patterns = /^[a-zA-Z_-İıŞşĞğÇçÖöÜüÖö ]*$/;

                    // console.log(typeof $(item).val());

                    if(!patterns.test($(item).val())){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vPasswordConfirm':

                    if($(item).val() !== $(selectForm).find('.vPassword').val()){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vEmailFilter':

                    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

                    if(!pattern.test($(item).val())){

                        return false;

                    }else{
                        return true;
                    }

                    break;

                case 'vMinchar':

                    if($(item).val().trim().length < $(item).data('minchar')){
                        return false;
                    }else{
                        return true;
                    }


                    break;

                case 'vMaxchar':

                    if($(item).val().trim().length > $(item).data('maxchar')){
                        return false;
                    }else{
                        return true;
                    }


                    break;

                case 'vCheckRequired':

                    if($(item).is(':checked') === false){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vYoutube':

                    var str = $(item).val();

                    var n = str.indexOf("https://www.youtube.com/watch?v");

                    if(n == -1){
                        return false;
                    }else{
                        return true;
                    }

                    break;

                case 'vTcRequired':

                    var checkTcNum = function(value) {
                        value = value.toString();
                        var isEleven = /^[0-9]{11}$/.test(value);
                        var totalX = 0;
                        for (var i = 0; i < 10; i++) {
                            totalX += Number(value.substr(i, 1));
                        }
                        var isRuleX = totalX % 10 == value.substr(10,1);
                        var totalY1 = 0;
                        var totalY2 = 0;
                        for (var i = 0; i < 10; i+=2) {
                            totalY1 += Number(value.substr(i, 1));
                        }
                        for (var i = 1; i < 10; i+=2) {
                            totalY2 += Number(value.substr(i, 1));
                        }
                        var isRuleY = ((totalY1 * 7) - totalY2) % 10 == value.substr(9,0);
                        return isEleven && isRuleX && isRuleY;
                    };


                    var isValid = checkTcNum($(item).val());
                    if (isValid) {
                        return true;
                    }
                    else {
                        return false;
                    }

                    break;


                default:

            }

        }

        return this;
    };


});
