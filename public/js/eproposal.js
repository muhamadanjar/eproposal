(function($, window, document){
$('.loader').hide();
$('select#provinsi').select2({
    no_results_text: "Oops, nothing found!"
}); 
$('select#kabkota').html("<option value=''>Pilih Kota..</option>"); 
$('select#kabkota').select2();
$('select#provinsi').on('change', function (){
    $('select#kabkota').html("<option value=''>Pilih Kota..</option>");// add this on each call then add the options when data receives from the request
    $.ajax({
        url: '/getKabKota/'+$(this).val(),
        dataType: "json",
        beforeSend: function() {
            $('.loader').show();
        },
        success: function(data) {
            $('select#kabkota').empty(); 
        
            var options = '<option value="0">Pilih Kota..</option>';
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['kode_kabupaten'] + '">' + data[x]['kabupaten'] + '</option>';    
            }
            $('select#kabkota').select2();
            $('select#kabkota').html(options);
            $("#kabkota").trigger("chosen:updated");
        },
        complete: function() {
            $('.loader').hide();
        }
    });
});

    $('select#kecamatan').html("<option value=''>Pilih Kecamatan..</option>"); 
    $('select#kecamatan').select2();
    $('select#kabkota').on('change', function (){
        $('select#kecamatan').html("<option value=''>Pilih Kecamatan..</option>");// add this on each call then add the options when data receives from the request
        
        $.ajax({
            url: '/getKecamatan/'+$(this).val(),
            dataType: "json",
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(data) {
                $('select#kecamatan').empty(); 
            
                var options = '<option value="0">Pilih Kecamatan..</option>';
                for (var x = 0; x < data.length; x++) {
                    //console.log($('#jenis_usulan').val());
                    if ($('#jenis_usulan').val() == 2 || $('#jenis_usulan').val() == 3) {
                        if (data[x]['lokpri'] == 1) {
                            options += '<option value="' + data[x]['kode_kecamatan'] + '">' + data[x]['kecamatan'] + '</option>';        
                        }
                    }else{
                        options += '<option value="' + data[x]['kode_kecamatan'] + '">' + data[x]['kecamatan'] + '</option>';
                    }
                }
                $('select#kecamatan').select2();
                $('select#kecamatan').html(options);
            },
            complete: function() {
                $('.loader').hide();
            }
        });
    });

    $('select#desa').html("<option value=''>Pilih Desa..</option>");
    $('select#desa').select2();
    $('select#kecamatan').on('change', function (){
        $('select#desa').html("<option value=''>Pilih Desa..</option>");// add this on each call then add the options when data receives from the request
        
        $.ajax({
            url: '/getDesa/'+$(this).val(),
            dataType: "json",
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(data) {
                $('select#desa').empty(); 
            
                var options = '<option value="0">Pilih Desa..</option>';
                for (var x = 0; x < data.length; x++) {
                   options += '<option value="' + data[x]['kode_desa'] + '">' + data[x]['desa'] + '</option>';
                }
                $('select#desa').select2();
                $('select#desa').html(options);
            },
            complete: function() {
                $('.loader').hide();
            }
        });
    }); 
}(jQuery, window, document));


(function($, window, document){
    $('select#pembangunan').on('change', function (){
        console.log($(this).val());
    });
}(jQuery, window, document));
//removeClass

(function($, window, document){
    function format ( d ) {
        console.log(d);
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Jalan:</td>'+
                '<td><a href="jalan?usulan='+d[0]+'" class="btn btn-primary btn-small">Jalan</a></td>'+
            '</tr>'+
            '<tr>'+
                '<td>SAB:</td>'+
                '<td><a href="sab?usulan='+d[0]+'" class="btn btn-primary btn-small">SAB</a></td>'+
            '</tr>'+
            '<tr>'+
                '<td>PLTS:</td>'+
                '<td><a href="plts?usulan='+d[0]+'" class="btn btn-primary btn-small">PLTS</a></td>'+
            '</tr>'+
           
        '</table>';
    }
    function format_role ( d ) {
        console.log(d);
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Jalan:</td>'+
                '<td><a href="jalan?usulan='+d[0]+'" class="btn btn-primary btn-small">Jalan</a></td>'+
            '</tr>'+
            '<tr>'+
                '<td>SAB:</td>'+
                '<td><a href="sab?usulan='+d[0]+'" class="btn btn-primary btn-small">SAB</a></td>'+
            '</tr>'+
            '<tr>'+
                '<td>PLTS:</td>'+
                '<td><a href="plts?usulan='+d[0]+'" class="btn btn-primary btn-small">PLTS</a></td>'+
            '</tr>'+
           
        '</table>';
    }
    var table = $('#example').DataTable();
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.fa-plus-square-o', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
           // tr.removeClass('fa fa-plus-square-o');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
            //tr.addClass('fa fa-minus-square-o');
        }
    } );

    var table_role = $('#role').DataTable();

    $('#role tbody').on('click', 'td.fa-plus-square-o', function () {
        var tr = $(this).closest('tr');
        var row = table_role.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            tr.removeClass('fa fa-plus-square-o');
        }else {
            // Open this row
            row.child( format_role(row.data()) ).show();
            tr.addClass('shown');
            tr.addClass('fa fa-minus-square-o');
        }
    } );
}(jQuery, window, document));

(function($, window, document){
    function format_usulan ( d ) {
        
        if (d.hasOwnProperty('pjalan')) {
            if (d.pjalan.length > 0) {
            var table = '<div class="box">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">Jalan</h3></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th></tr>';
                for (var i = d.pjalan.length - 1; i >= 0; i--) {
                    data = d.pjalan[i];
                    var adatidak = (d.pjalan[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    if (data['tipeusulan'] == 'admin') {
                        table_admin += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td></tr>';
                    }else if(data['tipeusulan'] == 'teknis'){
                        table_teknis += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td></tr>';
                    }
                }
                table += table_admin;
                table += table_teknis;
                table += '</table></div></div>';
            }
        }
            
        return table;
    }
    
    var table_usulan = $('#table_usulan').DataTable({
        "ajax": "/proposal/usulan/array",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "provinsi" },
            { "data": "kabupaten" },
            { "data": "kecamatan" },
            { "data": "desa" },
            { "data": "skpd_pengusul" },
            { "data": "jumlah_usulan" },
            
        ],
        "order": [[4, 'asc']]
    });
    
    $('#table_usulan tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table_usulan.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            $(this).addClass('fa fa-plus-square-o');
            
        }else {
            // Open this row
            row.child( format_usulan(row.data()) ).show();
            tr.addClass('shown');
            $(this).addClass('fa fa-minus-square-o');
            
        }
    } );
    
                
              

    function format_pengecekan ( d ) {
        if (d.hasOwnProperty('pjalan')) {
            if (d.pjalan.length > 0) {
            var table = '<div class="box">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">Jalan</h3><div class="box-tools"><a href="/pengecekan/usulan/'+d.id+'" type="button" class="btn btn-block btn-primary">Cek</a></div></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Dokumen</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Dokumen</th></tr>';
                for (var i = d.pjalan.length - 1; i >= 0; i--) {
                    data = d.pjalan[i];
                    var adatidak = (d.pjalan[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    if (data['tipeusulan'] == 'admin') {
                        table_admin += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td><a href="/files/'+data['file']+'" class="fa fa-file-text text-green"></a></td></tr>';
                    }else if(data['tipeusulan'] == 'teknis'){
                        table_teknis += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td><a href="/files/'+data['file']+'" class="fa fa-file-text text-green"></a></td></tr>';
                    }
                }
                table += table_admin;
                table += table_teknis;
                table += '</table></div></div>';
            }
        }
            
        return table;
    }

    var table_pengecekan = $('#table_pengecekan').DataTable({
        "ajax": "/proposal/usulan/array",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "provinsi" },
            { "data": "kabupaten" },
            { "data": "kecamatan" },
            { "data": "desa" },
            { "data": "skpd_pengusul" },
            { "data": "jumlah_usulan" },
            
        ],
        "order": [[1, 'asc']]
    });

    $('#table_pengecekan tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table_pengecekan.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            
            
        }else {
            // Open this row
            row.child( format_pengecekan(row.data()) ).show();
            tr.addClass('shown');
            

        }
    } );

    /*$('#table_pengecekan tbody').on( 'click', 'a.linkpeng', function () {
        var data = table_pengecekan.row( $(this).parents('tr') ).data();
        document.location = '/proposal/pengecekan/'+data.id;
    } );*/

}(jQuery, window, document));

(function($, window, document){
    $('#usulan-group').hide();
    $('#usulan_jenis_pilih').hide();
        $('#jalan_sirip').hide();
        $('#sarana_air_bersih').hide();
        $('#plts').hide();

        $('#pjalan').hide();
        $('#psab').hide();
        $('#pplts').hide();
        
    
    
    $('select#tahun').on('change', function (){
        $('#usulan-group').show();
    });

    $('select#jenis_usulan').on('change', function (){
        $('#usulan_jenis_pilih').show();
        var jenis_usulan = $(this).val();

        var options = '<option value="-">Satuan</option>';
        
        if ($(this).val() == '1') {
            data = [{'k':'KK','v':'kk'},{'k':'Jiwa','v':'jiwa'}];
            $('#jalan_sirip').show();
            $('#sarana_air_bersih').hide();
            $('#plts').hide();
            $('#lainnya').hide();

            $('.pjalan').show();
            $('.psab').hide();
            $('.pplts').hide();


        } else if($(this).val() == '2'){
            data = [{'k':'KK','v':'kk'},{'k':'Ha','v':'ha'}];
            $('#jalan_sirip').hide();
            $('#sarana_air_bersih').show();
            $('#plts').hide();
            $('#lainnya').hide();

            $('.pjalan').hide();
            $('.psab').show();
            $('.pplts').hide();

        } else if($(this).val() == '3'){
            data = [{'k':'KK','v':'kk'},{'k':'Jiwa','v':'jiwa'},{'k':'Km','v':'km'}];
            $('#jalan_sirip').hide();
            $('#sarana_air_bersih').hide();
            $('#plts').show();
            $('#lainnya').hide();

            $('.pjalan').hide();
            $('.psab').hide();
            $('.pplts').show();
        } else {
            data = [{'k':'KK','v':'kk'},{'k':'Jiwa','v':'jiwa'},{'k':'Km','v':'km'}];
            $('#jalan_sirip').hide();
            $('#sarana_air_bersih').hide();
            $('#plts').hide();
            $('#lainnya').show();

            $('.pjalan').hide();
            $('.psab').hide();
            $('.pplts').hide();
        }
        
        for (var x = 0; x < data.length; x++) {
            options += '<option value="' + data[x]['v'] + '">' + data[x]['k'] + '</option>';
        }
        $('select#penerima_manfaat_satuan').html(options);
        
    });

    function dataupload(id){
        $("#btnselectiamge"+ id).on('click',function(){
                    $("#fileinput"+ id).val('');
                    $("#fileinput"+ id).trigger('click');
        });
        $("#fileinput"+ id).on('change',function(){
                    $("#picture"+ id).parent().parent().find('label.parsley-error').remove();
                    var allowed = ['chm','pdf','doc','docx'];
                    /*if(id==2)
                    {
                        var allowed = ['png','jpg','gif','jpeg'];
                    }*/
                    var tmp = $(this).val();
                    var ex_tmp = tmp.split('.');
                    if(allowed.indexOf(ex_tmp[ex_tmp.length-1])<0)
                    {
                        $("#picture"+ id).addClass('parsley-error');
                        $("#picture"+ id).parent().parent().append('<label class="parsley-error" for="image">Extension File Not Allowed</label>');
                        return false;
                    }
                    //checking validation size
                    var size = $(this)[0].size;
                    var max_size =20*1024*1024;
                    if(size>max_size)
                    {
                        $("#picture"+ id).addClass('parsley-error');
                        $("#picture"+ id).parent().parent().append('<label class="parsley-error" for="image">File Size Allowed '+ max_size +' byte</label>');
                        return false;
                    }
                    //end checking size
                    input = document.getElementById("fileinput"+ id);
                    file = input.files[0];
                    if(file != undefined){
                        formData= new FormData();
                        if(!!file.type.match(/.*/)){
                            formData.append("images", file);
                            $.ajax({
                                url: "http://localhost/baper/public/kebijakan/upload",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType:'json',
                                beforeSend: function(){
                                    $("#picture").parent().parent().find('label.parsley-error').remove();
                                    submit_form = false;
                                },
                                complete: function(){
                                     
                                },
                                success: function(data){
                                    if(data.error)
                                    {
                                        $("#picture"+ id).parent().parent().find('label.parsley-error').remove();
                                        $("#picture"+ id).parent().parent().append('<label class="parsley-error" for="image">'+data.message+'</label>');
                                        return false;
                                    }
                                    else if(!data.error)
                                    {
                                        $("#picture"+ id).parent().parent().find('label.parsley-error').remove();
                                        $("#picture"+ id).val(data.filename);
                                        submit_form = true;
                                        return false;
                                    }
                                }
                              });
                        }else{
                            $("#picture"+ id).parent().parent().find('label.parsley-error').remove();
                            $("#picture"+ id).parent().parent().append('<label class="parsley-error" for="image">Invalid File</label>');
                            return false;
                        }
                    }else{
                        $("#picture"+ id).parent().find('label.error').remove();
                        $("#picture"+ id).parent().append('<label class="error" for="image">Invalid File</label>');
                        return false;
                    }
        });
        $("#clearimage"+ id).on('click',function(){
                    $("#picture"+ id).val('');
        }); 
    }

}(jQuery, window, document));
 