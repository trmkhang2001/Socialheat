<?php

$currentController = $this->router->fetch_class();

if(!isset($method)){
    $method = 'save';
}
if (isset($controller)) {
    $currentController = $controller;
}
$url = sprintf('/backend/%s/%s',$currentController,$method);
/**
 * @var $item
 *
 */
?>
<script>
    var app = new Vue({
        el: '#vue-form',
        data: {
            item: <?php echo isset($item) ? json_encode($item): '{}' ?>,
        },
        methods: {
            submit: function () {
               // tinymce.triggerSave();
                var $form = $('#vue-form form');
                var urlSave = "<?php echo $url?>";
                var dataForm = new FormData($form[0]);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: urlSave,
                    //dataType: 'json', //not sure but works for me without this
                    data: dataForm,
                    contentType: false, //this is requireded please see answers above
                    processData: false, //this is requireded please see answers above
                    cache: false, //not sure but works for me without this
                    beforeSend:function(){
                        <?php if(ENVIRONMENT !== 'development'):?>
                        $form.find('button').attr('disabled', true);
                        modalLoading.show();
                    <?php endif;?>
                    },
                    error: function (error) {
                      validateForm.removeValidateMsg();
                      toastr['error']('Có lỗi xảy ra vui lòng liên hệ admin');
                    },
                    success: function (res) {
                        validateForm.removeValidateMsg();
                        if (res.success) {
                            modalLoading.hide();
                            toastr['success'](res.message);
                            $(".form-group.has-error .help-block").html('');
                            $(".form-group.has-error").removeClass('has-error');
                            setTimeout(function () {
                                <?php if(isset($urlRedirect)):?>
                                location.href = '<?php echo $urlRedirect?>';
                                <?php else:?>
                                 location.reload(true);
                                // window.history.back();
                                <?php endif;?>
                            },800);
                        }else{
                            modalLoading.hide();
                            if (res.validation) {
                              console.log(res)
                                validateForm.setValidateMsg(res.validation);
                            }
                            if(res.message && res.message.length > 0){
                                toastr['error'](res.message);
                            }
                            $form.find('button').attr('disabled', false);
                        }
                    }
                });
            },
            saveComplete: function () {

                this.submit();
            },
        },
        created: function () {
        },
    });

</script>