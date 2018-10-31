$(document).ready(function(){
    $('#downloadFromFTP').on('submit', function(e){
        e.preventDefault();
        document.getElementById('info-label').hidden = false;
        document.getElementById('downloadFromFTP').hidden = true;

        var elem = document.getElementById("ftp_progressbar");

        $.ajax({
            type: 'post',
            url: '/get_data_from_ftp',
            data: $('#downloadFromFTP').serialize(),
            success: function(response){
                connectToFtp(response);
            },
            complete: function(result) {
                var elem = document.getElementById("ftp_progressbar");

                elem.style.width = "100%";
                elem.innerHTML = "100%";
            }
        });
    });
});

function connectToFtp(response) {
    downloadElem = document.getElementById('download');
    unzipElem = document.getElementById('unzip');

    downloadElem.className = "disabled";
    unzipElem.className = "bold";
    list_array = response['file_lists_001'];

    var ftp_progressbar = document.getElementById("ftp_progressbar");
    ftp_progressbar.style.width = "0%";
    ftp_progressbar.innerHTML = "0%";

    var total_num = list_array.length;
    console.log(total_num);

    list_array.forEach(function(file_name) {
        $.ajax({
            type: 'get',
            url: '/unzip',
            data: {
                url: response['url'],
                path: response['path'],
                file_list_001: file_name
            },
            success: function(){
            },
            complete: function(result) {
                var elem = document.getElementById("ftp_progressbar");
                var percent = parseInt(elem.innerHTML.replace('%',''));

                flag = percent++;
                percent = (flag / total_num) * 100;
                elem.style.width = percent + "%";
                elem.innerHTML = percent + "%";
            }
        });
    });
}
