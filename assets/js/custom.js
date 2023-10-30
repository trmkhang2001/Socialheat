function formatDate(date) {
  if (typeof date == 'object') return '';
  var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  date = new Date(date);
  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();
  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function generate_data_report() {
  if (0 != $("#m_chart_sex").length) {
    Morris.Donut({
      element: "m_chart_sex",
      data: [{
        label: "Male",
        value: parseInt($('#m_chart_male').attr('data-value'))
      }, {
        label: "Female",
        value: parseInt($('#m_chart_female').attr('data-value'))
      }, {
        label: "Other",
        value: parseInt($('#m_chart_other').attr('data-value'))
      }],
      colors: ['#3F51B5', '#E91E63', '#ffb822']
    })
  }
  if (0 != $("#m_chart_friend").length) {
    Morris.Donut({
      element: "m_chart_friend",
      data: [{
        label: "> 5K",
        value: parseInt($('#m_chart_gt_5000').attr('data-value'))
      }, {
        label: "4K - 5K",
        value: parseInt($('#m_chart_5000').attr('data-value'))
      }, {
        label: "3K - 4K",
        value: parseInt($('#m_chart_4000').attr('data-value'))
      }, {
        label: "2K - 3K",
        value: parseInt($('#m_chart_3000').attr('data-value'))
      }, {
        label: "1K - 2K",
        value: parseInt($('#m_chart_2000').attr('data-value'))
      }, {
        label: "< 1K",
        value: parseInt($('#m_chart_1000').attr('data-value'))
      }],
      colors: ['#3F51B5', '#E91E63', '#6610f2', '#5867dd', '#fd7e14', '#ffb822']
    })
  }
  if (0 != $("#m_chart_follow").length) {
    Morris.Donut({
      element: "m_chart_follow",
      data: [{
        label: "> 5K",
        value: parseInt($('#m_follow_gt_5000').attr('data-value'))
      }, {
        label: "4K - 5K",
        value: parseInt($('#m_follow_5000').attr('data-value'))
      }, {
        label: "3K - 4K",
        value: parseInt($('#m_follow_4000').attr('data-value'))
      }, {
        label: "2K - 3K",
        value: parseInt($('#m_follow_3000').attr('data-value'))
      }, {
        label: "1K - 2K",
        value: parseInt($('#m_follow_2000').attr('data-value'))
      }, {
        label: "< 1K",
        value: parseInt($('#m_follow_1000').attr('data-value'))
      }],
      colors: ['#3F51B5', '#E91E63', '#6610f2', '#5867dd', '#fd7e14', '#ffb822']
    })
  }
  // relationship chart
  if ($("#m_chart_relationship").length > 0) {
    var series = JSON.parse($('#relationship-series').html());
    new Chartist.Pie("#m_chart_relationship", {
      series: series,
      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
    }, {
      donut: 1,
      donutWidth: 17,
      showLabel: !1
    }).on("draw", function(e) {
      if ("slice" === e.type) {
        var t = e.element._node.getTotalLength();
        e.element.attr({
          "stroke-dasharray": t + "px " + t + "px"
        });
        var a = {
          "stroke-dashoffset": {
            id: "anim" + e.index,
            dur: 1e2,
            from: -t + "px",
            to: "0px",
            easing: Chartist.Svg.Easing.easeOutQuint,
            fill: "freeze",
            stroke: e.meta.color
          }
        };
        0 !== e.index && (a["stroke-dashoffset"].begin = "anim" + (e.index - 1) + ".end"), e.element.attr({
          "stroke-dashoffset": -t + "px",
          stroke: e.meta.color
        }), e.element.animate(a, !1)
      }
    })
  }
  if ($("#m_chart_ages").length > 0) {
    var series = JSON.parse($('#ages-series').html());
    new Chartist.Pie("#m_chart_ages", {
      series: series,
      labels: [1, 2, 3, 4, 5, 6, 7, 8]
    }, {
      donut: 1,
      donutWidth: 17,
      showLabel: !1
    }).on("draw", function(e) {
      if ("slice" === e.type) {
        var t = e.element._node.getTotalLength();
        e.element.attr({
          "stroke-dasharray": t + "px " + t + "px"
        });
        var a = {
          "stroke-dashoffset": {
            id: "anim" + e.index,
            dur: 1e2,
            from: -t + "px",
            to: "0px",
            easing: Chartist.Svg.Easing.easeOutQuint,
            fill: "freeze",
            stroke: e.meta.color
          }
        };
        0 !== e.index && (a["stroke-dashoffset"].begin = "anim" + (e.index - 1) + ".end"), e.element.attr({
          "stroke-dashoffset": -t + "px",
          stroke: e.meta.color
        }), e.element.animate(a, !1)
      }
    })
  }

  // if ($('#m_flotcharts').length > 0) {
  //   var series = JSON.parse($('#city-chart').html());
  //     console.log(series)
  //
  // }
}
$(document).ready(function() {
  // generate data table
  $(function() {
    $('#data-table').DataTable();
  });
  //-- ajax login user function 
  $('#login-form').submit(function() {
    $.post($('#login-form').attr('action'), $('#login-form').serialize(), function(json) {
      if (json.st == 0) {
        $('#login_pass').val('');
        swal({
          title: "Error..",
          text: "Sorry your email or password is not correct !",
          type: "error",
          confirmButtonText: "Try Again"
        });
      } else if (json.st == 2) {
        $('#login_pass').val('');
        swal({
          title: "Error..",
          text: "Sorry your account was deactivated!",
          type: "error",
          confirmButtonText: "Contact admin for more information"
        });
      } else {
        window.location = json.url;
      }
    }, 'json');
    return false;
  });
});
var list = [],
  totals, group_id, limit, start_index, current_page,
  csv_data = [],
  myinterval;
String.prototype.replaceAll = function(search, replacement) {
  var target = this;
  return target.split(search).join(replacement);
};
var extra_fields = [];

function build_uid_text(uid_data) {
  var uid_label = '<img src="'+home_url+'/assets/images/sociallead-uid.png" />';
  // if (uid_label.indexOf('5550') == 0) {
  //   uid_label = '<i title="No facebook" class="m--font-danger la la-circle"></i>' + uid_label;
  // } else {
  //   if (uid_data.Type == 2) {
  //     uid_label = '<i title="Facebook account deactive" class="m--font-warning la la-check-circle"></i>' + uid_label;
  //   } else {
  //     uid_label = '<i title="Facebook account active" class="m--font-success la la-check-circle"></i>' + uid_label;
  //   }
  // }
  return uid_label;
}

function download_phone(data, name) {
  var filename, link;
  var csv = "PHONE";
  csv = csv + '\n';
  for (var i = data.length - 1; i >= 0; i--) {
    var d = data[i];
    console.log(d);
    csv += d[3];
    csv += '\n';
  }
  // if (csv == null) return;
  date = new Date();
  filename = 'phone-' + name + '-' + date.getDate() + '-' + date.getMonth() + '-' + date.getFullYear() + '.csv';
  csvData = new Blob([csv], {
    type: 'text/csv',
    charset: 'utf-8'
  });
  var csvUrl = URL.createObjectURL(csvData);
  // data = encodeURI(csv);
  link = document.createElement('a');
  link.setAttribute('href', csvUrl);
  link.setAttribute('download', filename);
  link.click();
}

function downloadCSV(data, name) {
  var filename, link;
  var csv = "\ufeff Social Profile,NAME,EMAIL,PHONE,FRIEND,FOLLOW,RELATIONSHIP,City";
  // for (var i = 0; i <= extra_fields.length - 1; i++) {
  //   csv = csv + ',' + extra_fields[i];
  // }
  csv = csv + '\n';
  for (var i = data.length - 1; i >= 0; i--) {
    var d = data[i];
    for (var j = 0; j <= d.length - 1; j++) {
      if (typeof d[j] === 'string') {
        d[j] = d[j].replaceAll(',', '');
      }
      csv += d[j];
      if (j < d.length - 1) {
        csv += ',';
      }
    }
    csv += '\n';
  }
  var universalBOM = "\uFEFF";
  // if (csv == null) return;
  date = new Date();
  filename = 'Socialheat -' + name + '-' + date.getDate() + '-' + date.getMonth() + '-' + date.getFullYear() + '.csv';
  csvData = new Blob([csv], {
    type: 'text/csv',
    charset: 'utf-8'
  });
  var csvUrl = URL.createObjectURL(csvData);
  // data = encodeURI(csv);
  link = document.createElement('a');
  link.setAttribute('href', csvUrl);
  link.setAttribute('download', filename);
  link.click();
}

function uid_table_trigger_click() {
  $('td.uid, td.Friends, td.Follow').click(function() {
    var tr = $(this).parent('tr'),
      uid = tr.find('.uid').text();
    if (uid.indexOf('5550') == 0) {
      url = home_url + 'details/id/' + uid;
    } else {
      url = 'https://facebook.com/' + uid;
      if ($(this).hasClass('friends')) {
        url = url + '/friends';
      }
      if ($(this).hasClass('follows')) {
        url = url + '/followers';
      }
    }
    window.open(url, '_blank');
  });
  $('td.Name').click(function() {
    var tr = $(this).parent('tr'),
      url = home_url + 'details/id/' + tr.find('.uid').text();
    window.open(url, '_blank');
  })
}

function showFullPhone(e) {
  var $currentTarget = $(e);
  var data = $currentTarget.parent('td').attr('data-origional');
  $currentTarget.html(data);
}

function uid_pagination(current_page) {
  limit = $('select[name="myTable_length"]').val();
  // console.log(limit)
  $('#myTable_info').html('Show ' + (limit * (current_page - 1) + 1) + ' to ' + limit * (current_page) + ' in ' + totals + ' element');
  var order = get_order_by();
  $.ajax({
    type: 'get',
    url: home_url + '/backend/clients/ajax',
    data: {
      group_id: group_id,
      limit: limit,
      current_page: current_page,
      totals: totals,
      friends: $('#friends').val(),
      follows: $('#follows').val(),
      city: $('#city').val(),
      ages: $('#age').val(),
      Sex: $('#sex').val(),
      Relationship: $('#relationship').val(),
      order: order['order'],
      orderby: order['orderby'],
      s: $('#search').val(),
      type: $('#tabs-wrapper .m-tabs__link.active').attr('data-type')
    },
    beforeSend: function() {
      $('.dataTables_wrapper .m-loader').show();
    },
    success: function(data) {
      $('#overlay').fadeOut();
      clearInterval(myinterval);
      $('.dataTables_wrapper .m-loader').hide();
      $('#uidTable tbody').html('');
      var tr = '';
      var html = data['uids'];

      for (var k = 0; k < html.length; k++) {
        var icon = '';
        var email = html[k].email == null ? "" : html[k].email + ' <span class="viewfull"><i class="flaticon-eye"></i></span>';
        var phone =  html[k].Phone == null ? "" : html[k].Phone + ' <span class="viewfull"><i class="flaticon-eye"></i></span>';

        tr += '<tr>';
        tr += '<td><a target="_blank" href="https://facebook.com/' + html[k].Uid + '"><img style="width:40px;" class="m--img-rounded m--marginless" target="_blank" src="'+html[k].url_thumb+'"></a></td>';
        tr += '<td class="Name">' + '<a target="_blank" href="https://facebook.com/' + html[k].Uid + '">' + (html[k].Name == null ? " ": html[k].Name)  + '</a>' + '</td>';

        tr += '<td class="email" data-origional="'+html[k].email_Original +'"><span onclick=showFullPhone(this)>' + email + '</span></td>';
        tr += '<td class="Phone" data-origional="'+html[k].Phone_Original +'" ><span style="float: left" onclick=showFullPhone(this)>' + phone  + '</span> </td>';

        tr += '<td class="Friends">' + '<a target="_blank" href="https://facebook.com/' + html[k].Uid + '/friends">' + html[k].Friends + '</a>' + '</td>';
        tr += '<td class="Follow">' + '<a target="_blank" href="https://facebook.com/' + html[k].Uid + '/followers">' + html[k].Follow + '</a>' + '</td>';
        tr += '<td class="Birthday">' + html[k].Birthday + '</td>';
        tr += '<td class="Sex"><span class="m-badge  m-badge--' + html[k].Sex + ' m-badge--wide"><i class="la la-' + html[k].Sex + '"></i>' + html[k].Sex + '</span></td>';
        
        tr += '<td class="Relationship"><span class="m-badge  m-badge--' + html[k].Relationship + ' m-badge--wide">' + (html[k].Relationship == null ? " ": html[k].Relationship) + '</span></td>';

        for (var i = 0; i <= extra_fields.length - 1; i++) {
          tr += '<td class="' + extra_fields[i] + '">' + (html[k][extra_fields[i]] == null ? " ": html[k][extra_fields[i]]) + '</td>';
        }
        tr += '<td class="Phone">' + (html[k].City == null ? " ": html[k].City)  + '</td>';

        tr += '</tr>';
      }
      $('#uidTable tbody').append(tr);
      $('#myTable_paginate').html(data['pagination']);
      $('#uids-form #myTable_paginate a').click(function(e) {
        e.preventDefault();
        current_page = $(this).attr('data-dt-idx');
        uid_pagination(current_page);
      });
      totals = data.totals;
      if (totals > parseInt($('.profile-remaining').html() )) {
        $('.btn-export').removeClass('can-export');
      }else {
        $('.btn-export').addClass('can-export');
      }
      $('#myTable_info').html('Show ' + (limit * (current_page - 1) + 1) + ' to ' + limit * (current_page) + ' in ' + totals + ' element');
      $('.active .converted, .converted-insights').text(totals);
    }
  });
}

function get_order_by() {
  if ($('.sorting_desc').length > 0) {
    return {
      order: 'desc',
      orderby: $('.sorting_desc').text()
    }
  }
  if ($('.sorting_asc').length > 0) {
    return {
      order: 'asc',
      orderby: $('.sorting_asc').text()
    }
  }
  return {
    order: 'desc',
    orderby: 'Friends'
  }
}

function crawlingStatus() {
  var items = Array("Chotot","Facebook","Sendo","Instagram", "Lotus", "5Giay", "Lazada", "Shoppe", "Tiki", "Tinhte", "Voz", "Youtube", "Tiktok", "Linkedin");
  $('.social-title').html(items[Math.floor(Math.random() * items.length)]);
  var value_now = $('#overlay .progress-bar').attr('aria-valuenow');
  value_now = parseInt(value_now) + 15;
  if (value_now < 96) {
    $('#overlay .progress-bar').attr('aria-valuenow', value_now);
    $('#overlay .progress-bar').css('width', value_now + "%");
  }

}

$(document).ready(function() {
  if ($('#uid-data').length > 0) {
    var data_items = JSON.parse($('#uid-data').html());
      group_id = data_items.group_id;
    uid_pagination(1);
    myinterval = setInterval(crawlingStatus, 500)
  }
  
  var result_length = 0;
  var count = 0;
  var uid_table = $('#myTable').DataTable(
    {
     "language": {
            "lengthMenu": "Show _MENU_ row per page",
            "zeroRecords": "Sorry - No results match",
            "info": "Show page _PAGE_ in _PAGES_",
            "infoEmpty": "Does not exist",
            "infoFiltered": "(filtered from _MAX_ total element)",
            "search":       "Find:",
        }
    }
  );
  extra_fields = JSON.parse($('#extra-fields').html());

  function ajax_request_group(current_page) {
    var elt = $('#tag-input');
    var tag_ids = elt.val();
    var type = $('#type').val();
    var data = {
      type: type,
      tags: tag_ids,
      current_page: current_page,
      cat_id: $('#cat').val(),
      tags: $('#tags').val(),
      s: $('#group-search').val()
    };
    $.ajax({
      type: 'get',
      url: home_url + 'datalist/ajax',
      data: data,
      beforeSend: function() {
        $('.dataTables_wrapper .m-loader').show();
      },
      success: function(res) {
        $('.dataTables_wrapper .m-loader').hide();
        $('#groupTable tbody').html(res);
        $('#groupTable_paginate').html(res.pagination);
        group_pagination();
      }
    });
    $.ajax({
      type: 'get',
      url: home_url + 'datalist/ajaxpagination',
      data: data,
      beforeSend: function() {
        $('.dataTables_wrapper .m-loader').show();
      },
      success: function(res) {
        $('.dataTables_wrapper .m-loader').hide();
        // $('#groupTable tbody').html(res);
        $('#groupTable_paginate').html(res);
        group_pagination();
      }
    });
  }
  $('#tag-input').select2({
    width: '200px'
  });

  function group_pagination() {
    $('#groupTable_paginate a').click(function(e) {
      e.preventDefault();
      current_page = $(this).attr('data-dt-idx');
      ajax_request_group(current_page);
    })
  }
  group_pagination();
  $('#tag-input').change(function(e) {
    ajax_request_group(1);
  });
  $('#group-search').change(function(e) {
    ajax_request_group(1);
  });
  if ($('#category-data').length > 0) {
    var category_data = JSON.parse($('#category-data').html());
    var category = [];
    var grouptable = $('#catTable').DataTable({
      pageLength: 25,
      language: {
            "lengthMenu": "Show _MENU_ row per page",
            "zeroRecords": "Sorry - No results match",
            "info": "Show page _PAGE_ trong _PAGES_",
            "infoEmpty": "Does not exist",
            "infoFiltered": "(filtered from _MAX_ total element)",
            "search":       "Find:",
        }
    });
  }
  if ($('#tag-data').length > 0) {
    var category_data = JSON.parse($('#tag-data').html());
    var category = [];
    var grouptable = $('#tagTable').DataTable({
      order: [
        [1, 'desc']
      ],
      pageLength: 25,
      language: {
        "lengthMenu": "Show _MENU_ row per page",
        "zeroRecords": "Sorry - No results match",
        "info": "Show page _PAGE_ trong _PAGES_",
        "infoEmpty": "Does not exist",
        "infoFiltered": "(filtered from _MAX_ total element)",
        "search":       "Find:",
        }
    });
  }
  // uid in a group
  if ($('#uid-data').length > 0) {
    var data_items = JSON.parse($('#uid-data').html());
    group_id = data_items.group_id,
      limit = data_items.limit,
      start_index = data_items.start_index,
      current_page = data_items.current_page;
    var totals = data_items.totals;
    $('select[name="myTable_length"]').change(function() {
      uid_pagination(1);
    });
    $('#uids-form input, #uids-form select').change(function() {
      uid_pagination(1);
    });
    $('#uids-form #myTable_paginate a').click(function(e) {
      e.preventDefault();
      current_page = $(this).attr('data-dt-idx');
      uid_pagination(current_page);
    });
    $('#tabs-wrapper .m-tabs__link').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        $('#tabs-wrapper .m-tabs__link').removeClass('active');
        $this.addClass('active');
        uid_pagination(1);
    })

    $('#uids-form  th.sorting, #uids-form  th.sorting_asc, #uids-form  th.sorting_desc').click(function(e) {
      var $this = $(this);
      if ($this.hasClass('sorting')) {
        $('table th.sorting_desc').removeClass('sorting_desc').addClass('sorting');
        $('table th.sorting_asc').removeClass('sorting_asc').addClass('sorting');
        $this.addClass('sorting_desc');
        $this.removeClass('sorting');
      } else if ($this.hasClass('sorting_asc')) {
        $this.addClass('sorting_desc');
        $this.removeClass('sorting_asc');
      } else if ($this.hasClass('sorting_desc')) {
        $this.addClass('sorting_asc');
        $this.removeClass('sorting_desc');
      }
      uid_pagination(1);
    });
    
  }
});

function mix_uid_pagination(data) {
  var limit = parseInt(data['limit']),
    current_page = parseInt(data['current_page']);
  $('#myTable_info').html('Show ' + (limit * (current_page - 1) + 1) + ' to ' + limit * (current_page) + ' in ' + totals + ' element');
  var s = $('.dataTables_filter input').val();
  var order = get_order_by();
  data['order'] = order['order'];
  data['orderby'] = order['orderby'];
  $.ajax({
    type: 'get',
    url: home_url + 'analysis/uids',
    data: data,
    beforeSend: function() {
      $('.dataTables_wrapper .m-loader').show();
    },
    success: function(data) {
      $('.dataTables_wrapper .m-loader').hide();
      $('#uidTable tbody').html('');
      var tr = '';
      var html = data['uids'];
      for (var k = 0; k < html.length; k++) {
        var uid_label = build_uid_text(html[k]);
        var email = html[k].email == null ? "" : html[k].email + ' <span class="viewfull"><i class="flaticon-eye"></i></span>';
        var phone =  html[k].Phone == null ? "" : html[k].Phone + ' <span class="viewfull"><i class="flaticon-eye"></i></span>';
        tr += '<tr>';
        // tr += '<td><a target="_blank" href="https://facebook.com/' + html[k].Uid + '">' + uid_label + '</a></td>';
        tr += '<td><a target="_blank" href="https://facebook.com/' + html[k].Uid + '"><img style="width:40px;" class="m--img-rounded m--marginless" target="_blank" src="'+html[k].url_thumb+'"></a></td>';
        tr += '<td class="Name">' + '<a target="_blank" href="https://facebook.com/' + html[k].Uid + '">' + (html[k].Name == null ? " ": html[k].Name)  + '</a>' + '</td>';

        tr += '<td class="email" data-origional="'+html[k].email_Original +'"><span onclick=showFullPhone(this)>' + email + '</span></td>';
        tr += '<td class="Phone" data-origional="'+html[k].Phone_Original +'" ><span onclick=showFullPhone(this)>' + phone  + '</span></td>';

        tr += '<td class="Friends">' + '<a target="_blank" href="https://facebook.com/' + html[k].Uid + '/friends">' + html[k].Friends + '</a>' + '</td>';
        tr += '<td class="Follow">' + '<a target="_blank" href="https://facebook.com/' + html[k].Uid + '/followers">' + html[k].Follow + '</a>' + '</td>';
        tr += '<td class="Birthday">' + html[k].Birthday + '</td>';
        tr += '<td class="Sex"><span class="m-badge  m-badge--' + html[k].Sex + ' m-badge--wide"><i class="la la-' + html[k].Sex + '"></i>' + html[k].Sex + '</span></td>';
        
        tr += '<td class="Relationship"><span class="m-badge  m-badge--' + html[k].Relationship + ' m-badge--wide">' + (html[k].Relationship == null ? " ": html[k].Relationship) + '</span></td>';

        for (var i = 0; i <= extra_fields.length - 1; i++) {
          tr += '<td class="' + extra_fields[i] + '">' + (html[k][extra_fields[i]] == null ? " ": html[k][extra_fields[i]]) + '</td>';
        }
        tr += '<td class="Phone">' + (html[k].City == null ? " ": html[k].City)  + '</td>';
        tr += '</tr>';
      }
      $('#uidTable tbody').append(tr);
      $('#myTable_paginate').html(data['pagination']);
      $('#myTable_paginate a').click(function(e) {
        e.preventDefault();
        current_page = $(this).attr('data-dt-idx');
        var elt = $('#group-input');
        var group_uids = elt.val();
        var mix = $('#analysis-action').val();
        var limit = $('select[name="myTable_length"]').val()
        var data = {
          action: mix,
          group_uids: group_uids,
          current_page: current_page,
          friends: $('#friends').val(),
          Sex: $('#sex').val(),
          Relationship: $('#relationship').val(),
          limit: limit,
          ages: $('#age').val(),
        };
        var order = get_order_by();
        data['order'] = order['order'];
        data['orderby'] = order['orderby'];
        mix_uid_pagination(data);
      });
      totals = data.totals;
      $('#myTable_info').html('Show ' + (limit * (current_page - 1) + 1) + ' to ' + limit * (current_page) + ' in ' + totals + ' element');
      $('.converted').text(totals);
      $('.converted_email').text(data.total_emails);
      if (totals > parseInt($('.profile-remaining').html() )) {
        $('#export-csv-mix-minus').hide();
      }else {
        $('#export-csv-mix-minus').show();
      }
    },
    error: function() {
      $('.dataTables_wrapper .m-loader').hide();
    },
    complete: function() {
      $('.dataTables_wrapper .m-loader').hide();
    }
  });
}
// mix
$(document).ready(function() {
  totals = 0;
  var mix = $('#analysis-action').val();
  var mix_table = $('#myTable').DataTable({
     "language": {
       "lengthMenu": "Show _MENU_ row per page",
       "zeroRecords": "Sorry - No results match",
       "info": "Show page _PAGE_ trong _PAGES_",
       "infoEmpty": "Does not exist",
       "infoFiltered": "(filtered from _MAX_ total element)",
       "search":       "Find:",
        }
  });
  // $('#category, #group').select2({
  //   width: "100%"
  // });
  // var elt = $('#group-input');
  // elt.tagsinput({
  //   itemValue: 'value',
  //   itemText: 'text'
  // });
  $('#category').change(function() {
    var cats = $(this).val();
    $.ajax({
      type: 'get',
      url: home_url + 'analysis/group',
      data: {
        cats: cats
      },
      beforeSend: function() {},
      success: function(html) {
        $('#group').html(html);
        $('#group').trigger("select2:updated");
      }
    });
  });
  $('#group').change(function(e) {
    if ($(this).val() != '') {
      elt.tagsinput('add', {
        "value": $(this).val(),
        "text": $('#group option:selected').text()
      });
    }
    var group_uids = elt.val();
    $.ajax({
      type: 'get',
      url: home_url + 'analysis/count',
      data: {
        action: mix,
        group_uids: group_uids
      },
      beforeSend: function() {
        $('#get-data').text('Counting');
        $('#get-data').addClass('counting m-loader');
      },
      success: function(html) {
        $('#get-data').text('Get data');
        $('#get-data').removeClass('counting m-loader');
        totals = html.totals;
        $('.converted').text(html.totals);
      }
    });
  });
  $('#min-mix-form').submit(function(e) {
    var list = [];
    csv_data = [];
    var counter = 0;
    e.preventDefault();
    if (!elt.val()) {
      alert("You must select at least one group/fanpage");
      return false;
    }
    if ($('#get-data').hasClass('counting')) {
      return false;
    }
    var group_uids = elt.val();
    var data = {
      action: mix,
      group_uids: group_uids,
      current_page: 1,
      friends: $('#friends').val(),
      city: $('#city').val(),
      ages: $('#age').val(),
      Sex: $('#sex').val(),
      Relationship: $('#relationship').val(),
      limit: $('select[name="myTable_length"]').val()
    };
    mix_uid_pagination(data);
  });
  $('#mixTable_wrapper select, #mixTable_wrapper input').change(function(e) {
    e.preventDefault();
    current_page = 1;
    var group_uids = elt.val();
    var data = {
      action: mix,
      group_uids: group_uids,
      current_page: current_page,
      friends: $('#friends').val(),
      city: $('#city').val(),
      ages: $('#age').val(),
      Sex: $('#sex').val(),
      Relationship: $('#relationship').val(),
      limit: $('select[name="myTable_length"]').val()
    };
    mix_uid_pagination(data);
  });
  $('#min-mix-form th.sorting, #min-mix-form th.sorting_asc, #min-mix-form th.sorting_desc').click(function(e) {
    var $this = $(this);
    e.preventDefault();
    if ($this.hasClass('sorting')) {
      $('table th.sorting_desc').removeClass('sorting_desc').addClass('sorting');
      $('table th.sorting_asc').removeClass('sorting_asc').addClass('sorting');
      $this.addClass('sorting_desc');
      $this.removeClass('sorting');
    } else if ($this.hasClass('sorting_asc')) {
      $this.addClass('sorting_desc');
      $this.removeClass('sorting_asc');
    } else if ($this.hasClass('sorting_desc')) {
      $this.addClass('sorting_asc');
      $this.removeClass('sorting_desc');
    }
    current_page = 1;
    var group_uids = elt.val();
    var data = {
      action: mix,
      group_uids: group_uids,
      current_page: current_page,
      friends: $('#friends').val(),
      city: $('#city').val(),
      ages: $('#age').val(),
      Sex: $('#sex').val(),
      Relationship: $('#relationship').val(),
      limit: $('select[name="myTable_length"]').val()
    };
    mix_uid_pagination(data);
  });
  // filter
  // export csv
  

  async function sendMixDataToDB(target) {
    var number_of_page = Math.ceil(totals / 1000);
    var s = $('.dataTables_filter input').val();
    var counter = 1;
    csv_data = [];
    $('.export-status').show();
    var group_uids = elt.val();
    for (var i = 1; i <= number_of_page; i++) {
        var url = new URL(home_url + 'analysis/uids');
        const params = {
            action: mix,
            group_uids: group_uids,
            current_page: 1,
            friends: $('#friends').val(),
            city: $('#city').val(),
            ages: $('#age').val(),
            Sex: $('#sex').val(),
            Relationship: $('#relationship').val(),
            limit: 1000,
            export: 1
        };
        var order = get_order_by();
        params['order'] = order['order'];
        params['orderby'] = order['orderby'];
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
        const rawResponse = await fetch(url);
        
        const reader = rawResponse.body.getReader();
        const contentLength = +rawResponse.headers.get('Content-Length');
        // Step 3: read the data
        let receivedLength = 0; // received that many bytes at the moment
        let chunks = []; // array of received binary chunks (comprises the body)
        while(true) {
            const {done, value} = await reader.read();

            if (done) {
                break;
            }

            chunks.push(value);
            receivedLength += value.length;

            var file_down_percent = receivedLength/4983540*100;
            var percent = Math.round((i / number_of_page) * 100);
            percent = percent + (file_down_percent/number_of_page);
            percent = percent.toPrecision(3);
            $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%');
            $('.progress-bar').text(percent + '% Complete');
        }
                // Step 4: concatenate chunks into single Uint8Array
        let chunksAll = new Uint8Array(receivedLength); // (4.1)
        let position = 0;
        for(let chunk of chunks) {
          chunksAll.set(chunk, position); // (4.2)
          position += chunk.length;
        }

        // Step 5: decode into a string
        let result = new TextDecoder("utf-8").decode(chunksAll);

        // We're done!
        let content = JSON.parse(result);
        // const content = await rawResponse.json();
        var html = content.uids;
        
        for (var k = 0; k < html.length; k++) {
          var temp = [
            html[k].Uid,
            html[k].Name,
            html[k].email,
            html[k].Phone,
            html[k].Friends,
            html[k].Follow,
            html[k].Sex,
            formatDate(html[k].Birthday),
            html[k].Relationship,
            html[k].City
          ];
          for (var z = 0; z <= extra_fields.length - 1; z++) {
            temp.push(html[k][extra_fields[z]]);
          }
          csv_data.push(temp);
        }
    }
    $('.export-status').hide();
    downloadCSV(csv_data, group_id);
  }

  $('#export-csv-mix-minus').click(function(e) {
      e.preventDefault();
      var $target = $(e.currentTarget);
      sendMixDataToDB($target)
  })

  $('#view-report').click(function(e) {
    e.preventDefault();
    var $target = $(this);
    $target.addClass('m-loader');
    var group_uids = elt.val();
    var data = {
      action: mix,
      group_uids: group_uids
    };
    $.ajax({
      type: 'get',
      url: home_url + 'analysis/generate_report',
      data: data,
      beforeSend: function() {},
      success: function(html) {
        $('#report-content').html(html);
        generate_data_report();
        $('#report-content').slideDown();
      },
      complete: function() {
        $target.removeClass('m-loader');
      }
    });
  });
  $('#setup-fields').click(function(e) {
    e.preventDefault();
    $('.uid-field-panel').toggle();
    $('#setup-fields').find('i').toggleClass('la-caret-down la-caret-up')
  });
  $('.uid-field-panel input').click(function() {
    var $style = $('#field-display-style');
    var style = '';
    $('.uid-field-panel input').each(function() {
      if (this.checked) {
        style += 'th.' + $(this).val() + ' : display: inline-block;';
        style += 'td.' + $(this).val() + ' { display: inline-block; }';
      } else {
        style += 'th.' + $(this).val() + ' { display: none; }';
        style += 'td.' + $(this).val() + ' { display: none; }';
      }
    });
    $style.html(style);
  });
});
$('.read_more').click(function(e){
  e.preventDefault();
  var content = $(this).parent().find('p');
  if(content.hasClass('read-less')){
    content.removeClass('read-less')
    content.addClass('read-more');
    $(this).text('Read less');
  }else{
    content.removeClass('read-more')
    content.addClass('read-less');
    $(this).text('Read more');
  }
});

if(typeof $filter_created_date !== 'undefined'){
  $('select[name=created_date]').val($filter_created_date);
}
if(typeof $filter_count !== 'undefined'){
  $('select[name=count]').val($filter_count);
}


$('.over-play').on('click', function() {
  var post_id = $(this).attr('data-id');
  var _this = $(this);
  var video_src = _this.parent().find('video source').attr('src');
  if (!video_src) {
    $.get('/dashboard/get_link_video/' + post_id, function(res) {
      if (res.success) {
        _this.parent().find('video source').attr('src',res.video_link);
        var $video = document.getElementById(post_id);
        $video.load();
        $video.play();
        _this.parent().find('.icon_play').remove();
        _this.remove();
      }else{
        swal({
          title: "Error..",
          text:res.message,
          type: "error",
          confirmButtonText: "Contact admin for more information"
        });
        // alert(res.message)
      }
    }, 'json');
  }
});


$(document).ready(function(res){
  $('.refresh-post').click(function(e){
    e.preventDefault();
    var postId = $(this).data('post-id');
    var _this = $(this);
    if(postId){
      $.get('/dashboard/favourite/' + postId + '?is_refresh=1', function(res) {
        if (res.success) {
          swal({
            title: "Success..",
            text:res.message,
            type: "success",
          });
          _this.addClass('not-active');

        }else{
          swal({
            title: "Error..",
            text:res.message,
            type: "error",
            confirmButtonText: "Contact admin for more information"
          });
        }
      }, 'json');
    }
  })

  $('.add-favourite').click(function(e){
    e.preventDefault();
    var postId = $(this).data('post-id');
    var _this = $(this);
    if(postId){
      $.get('/dashboard/favourite/' + postId, function(res) {
        if (res.success) {
          swal({
            title: "Success..",
            text:res.message,
            type: "success",
          });
          _this.addClass('not-active');
         _this.find('i').attr('class','fas fa-heart');
        }else{
          swal({
            title: "Error..",
            text:res.message,
            type: "error",
            confirmButtonText: "Contact admin for more information"
          });
        }
      }, 'json');
    }
  })
  $('.report-post').click(function(e){
    e.preventDefault();
    var postId = $(this).data('post-id');
    var _this = $(this);
    if(postId){
      $.get('/dashboard/report_item/' + postId, function(res) {
        if (res.success) {
          swal({
            title: "Success..",
            text:res.message,
            type: "success",
          });
          _this.addClass('not-active');
        }else{
          swal({
            title: "Error..",
            text:res.message,
            type: "error",
            confirmButtonText: "Contact admin for more information"
          });
        }
      }, 'json');
    }
  })
})