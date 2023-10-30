async function sendDataToDB(target) {
    var totals = $('.converted-insights').html();
    var number_of_page = Math.ceil(parseInt(totals.replace(/,/g, '')) / 100);
    var s = $('.dataTables_filter input').val();
    var counter = 1;
    csv_data = [];
    $('.export-status').show();
    $('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%');
    for (var i = 1; i <= number_of_page; i++) {
        var url = new URL(home_url + '/backend/clients/ajax');
        const params = {
            group_id: group_id,
            limit: 100,
            current_page: i,
            totals: totals,
            friends: $('#friends').val(),
            follows: $('#follows').val(),
            city: $('#city').val(),
            Sex: $('#sex').val(),
            Relationship: $('#relationship').val(),
            export: 1,
            ages: $('#sex').val(),
            type: $('#tabs-wrapper .m-tabs__link.active').attr('data-type')
        };
      const stream =await new ReadableStream();
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
        const rawResponse = await fetch(url);
        const response = rawResponse.clone();
      if (response.ok) { // if HTTP-status is 200-299
        // get the response body (the method explained below)
        let res = await response.json();
        if (res.status === false) {
          swal({
            title: 'Error..',
            text: res.msg,
            type: 'error',
            confirmButtonText: 'Buy More Download',
          });
          // alert(res.msg);
          return false;
        }
      }
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
        // console.log(content);
        // return false;
        var html = content.uids;
        for (var k = 0; k < html.length; k++) {
          var temp = [
            html[k].uid,
            html[k].name,
            html[k].email,
            html[k].phone,
            html[k].friends,
            html[k].follow,
            // html[k].Sex,
            // formatDate(html[k].birthday),
            html[k].relationship,
            html[k].city
          ];
          // for (var z = 0; z <= extra_fields.length - 1; z++) {
          //   temp.push(html[k][extra_fields[z]]);
          // }
          csv_data.push(temp);
        }
    }
    $('.export-status').hide();
    downloadCSV(csv_data, group_id);
}

$(document).ready(function() {
    generate_data_report();
    $('.group-export-csv, #group-export-phone').click(function(e) {
        e.preventDefault();
        var $target = $(e.currentTarget);
        if($target.hasClass('can-export')) {
            sendDataToDB($target)    
        }
    });
});