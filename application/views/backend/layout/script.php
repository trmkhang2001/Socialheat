<script>

  $('.copy-api-url').click(function(e) {
    e.preventDefault();
    var temp = $('<input>').css('opacity', '0');
    temp.val($(this).attr('data-url'));
    $('body').append(temp);
    var mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (mobile) {
      var range = document.createRange();
      range.selectNode(temp[0]);
      window.getSelection().addRange(range);
      document.execCommand('copy');
      window.getSelection().removeAllRanges();
      return false;
    }

    temp.val($(this).attr('data-url')).select();
    document.execCommand('copy');
    return false;
  });

    function render_options(list, txt_default)
    {
        if (typeof txt_default === 'undefined')
        {
            txt_default = 'Chọn';
        }
        var html = '<option value="0">--'+txt_default+'--</option>';
        $.each(list, function(index, el) {
            html += `<option value='${el.id}' >${el.name}</option>`;
        });
        return html;
    }

    jQuery(document).ready(function($) {
        $(".bs3-datepicker input").datetimepicker({
            format: 'mm/dd/yyyy'
        });

        $("a.btn-delete").click(function(event) {
            event.preventDefault();
            var _this = $(this);
            if(!confirm("Are you sure?")){
                return false;
            }
            var url = $(this).attr('href');
            var data = {id:$(this).attr('data-id')};
            $.post(url, data, function(res){
                if (res.success)
                {
                    toastr['success']("Đã xóa xong");
                    _this.parents('tr').remove();
                }else{
                    toastr['info'](res.message);
                }
            }, 'json');
        });
        var filters = <?php
            $filters = $this->input->get();
            if (!empty($filters))
            {
                echo json_encode($_GET);
            }else if (!empty($item))
            {
                echo json_encode($item);
            }else{
                echo '{}';
            }
            ?>;
        $('select[name=unit_type]').change(function () {
            let val = $(this).val();
            let $unit = $('select[name=unit]');
            if($unit && $unit.length > 0){
                $.get('/backend/ajax/getListUnit/' + val, function(res){
                    var html = render_options(res.data, 'Đơn vị công tác');
                    var unit = $unit.attr('data-value') || filters.unit || 0;
                    $unit.html(html).val(unit);
                }, 'json');
            }
        });
        $.each(filters, function(idx, el){
            $("select[name=" + idx + "]").val(el).trigger('change');
            $("input[name=" + idx + "][type=input]").val(el);
            $("input[name=" + idx + "][type=text]").val(el);
            $("input[name=" + idx + "][type=date]").val(el);
        });
        $(".pattern-currency").trigger('keyup');
       // $('select[name=unit_type]').trigger('change');
    });
    var formatNumber = {
        init: function (numberString) {
            return numberString.replace(/,/g, '');
        }
    };

    var modalLoading = {
        show:function () {
            $('.loading-bg ').removeClass('hidden');
        },
        hide:function () {
            $('.loading-bg ').addClass('hidden');
        }
    };
    var validateForm = {
        setValidateMsg:function (data) {
            $.each(data, function (key, val) {
                var $elInput = $('input[name="' +key+ '"]');
                var $elSelect = $("select[name='" + key + "']");
                var $elTextArea = $("textarea[name='" + key + "']");
                var msg = '<em class="text-danger">'+val+'</em>';
                $elInput.parents('.form-group').addClass('state-error has-error');
                $elSelect.parents('.form-group').addClass('state-error has-error');
                $elTextArea.parents('.form-group').addClass('state-error has-error');
                $elInput.parent().append(msg);
                $elSelect.parent().append(msg);
                $elTextArea.parent().append(msg);
                toastr['error'](val);
            });
        },
        removeValidateMsg:function (){
            $('.form-group').removeClass('state-error has-error');
            $('.form-group').find('.text-danger').remove();
        }
    }
</script>