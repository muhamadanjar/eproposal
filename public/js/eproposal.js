//AIzaSyBUFQ_PdoGGeFoaimy-7AMAicWHQ3EGp3U
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
});

function numeralsOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
            console.log(evt);
            return false;
        }
    return true;
}

function lettersOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        alert("Enter letters only.");
        return false;
    }
    return true;
}

function ynOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
    if (charCode > 31 && charCode != 78 && charCode != 89 && charCode != 110 && charCode != 121) {
    alert("Enter \"Y\" or \"N\" only.");

    return false;
    }
    return true;
}

function rangeNumber(evt) {

    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
                $(this).val(0);
            return false;
        }
        var max = 100;
        var min = 0;
        if ($(this).val() > max){
             $(this).val(max);
        }else if($(this).val() < min){
             $(this).val(min);
        }
        
        
        
    return true;
}



(function($, window, document){
    $('.formConfirm').on('click', function(e) {
        e.preventDefault();
        console.log(e);
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        
        $('#formConfirm')
        .find('#frm_body').html('<h6>'+msg+'</h6>')
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
    });

    $('#formConfirm').on('click', '#frm_submit', function(e) {
        var id = $(this).attr('data-form');
        console.log(id);
        $(id).submit();
    });
    
}(jQuery, window, document));

(function($, window, document){
    var provinsi = $('select#provinsi');
    var kabkota = $('select#kabkota');
    var kecamatan = $('select#kecamatan');
    var desa = $('select#desa');
    $('.loader').hide();
    provinsi.select2(); 
    //$('select#kabkota').html("<option value=''>Pilih Kota..</option>"); 
    //$('select#kabkota').select2();
    
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
    
    //$('select#kecamatan').html("<option value=''>Pilih Kecamatan..</option>"); 
    //$('select#kecamatan').select2();
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

    //$('select#desa').html("<option value=''>Pilih Desa..</option>");
    //$('select#desa').select2();
    if($('input#kabkota').val() != null){
        $('select#kecamatan').html("<option value=''>Pilih Kecamatan..</option>");
        $.ajax({
            url: '/getKecamatan/'+$('#kabkota').val(),
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
                //$('select#kecamatan').select2();
                $('select#kecamatan').html(options);
            },
            complete: function() {
                $('.loader').hide();
            }
        });
    }
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
                   options += '<option value="' + data[x]['desa'] + '">' + data[x]['desa'] + '</option>';
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

    
}(jQuery, window, document));

(function($, window, document){
    function number_format( toFormat ) {
        return toFormat.toString().replace(
          /\B(?=(\d{3})+(?!\d))/g, "."
        );
    }
    
    function format_usulan ( d ) {
        
        if (d.hasOwnProperty('pjalan')) {
            if (d.pjalan.length > 0) {
            var table = '<div class="box">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">Jalan</h3><h5>'+d.jamterakhir_update+'</h5><div class="box-tools"><div class="btn-group"><a href="/proposal/usulan/lihat/'+d.id+'" type="button" class="btn btn-primary"><i class="fa fa-eye"></i></a><a href="/proposal/usulan/'+d.id+'" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a></div></div></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Verifikasi</th><th>Keterangan</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Verifikasi</th><th>Keterangan</th></tr>';
                for (var i = d.pjalan.length - 1; i >= 0; i--) {
                    data = d.pjalan[i];
                    var adatidak = (d.pjalan[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    var ver = (d.pjalan[i]['verifikasi']== 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    var keterangan = (data['keterangan'] != null) ? data['keterangan']:"";
                    if (data['tipeusulan'] == 'admin') {
                        table_admin += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td>'+ver+'</td><td><span class="label label-primary">'+keterangan+'</span></td></tr>';
                    }else if(data['tipeusulan'] == 'teknis'){
                        table_teknis += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td>'+ver+'</td><td><span class="label label-primary">'+keterangan+'</span></td></tr>';
                    }
                }
                table += table_admin;
                table += table_teknis;
                table += '</table></div></div>';
            }
        }
        if (d.hasOwnProperty('psab')) {
            if (d.psab.length > 0) {
            var table = '<div class="box">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">SAB</h3><div class="box-tools"><div class="btn-group"><a href="/proposal/usulan/lihat/'+d.id+'" type="button" class="btn btn-primary"><i class="fa fa-eye"></i></a><a href="/proposal/usulan/'+d.id+'" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a></div></div></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Verifikasi</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Verifikasi</th></tr>';
                for (var i = d.psab.length - 1; i >= 0; i--) {
                    data = d.psab[i];
                    var adatidak = (d.psab[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    var ver = (d.psab[i]['verifikasi']) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    if (data['tipeusulan'] == 'admin') {
                        table_admin += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td>'+ver+'</td></tr>';
                    }else if(data['tipeusulan'] == 'teknis'){
                        table_teknis += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td>'+ver+'</td></tr>';
                    }
                }
                table += table_admin;
                table += table_teknis;
                table += '</table></div></div>';
            }
        }

        if (d.hasOwnProperty('pplts')) {
            if (d.pplts.length > 0) {
            var table = '<div class="box">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">PLTS</h3><div class="box-tools"><div class="btn-group"><a href="/proposal/usulan/lihat/'+d.id+'" type="button" class="btn btn-primary"><i class="fa fa-eye"></i></a><a href="/proposal/usulan/'+d.id+'" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a></div></div></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Verifikasi</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Verifikasi</th></tr>';
                for (var i = d.pplts.length - 1; i >= 0; i--) {
                    data = d.pplts[i];
                    var adatidak = (d.pplts[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    var ver = (d.pplts[i]['verifikasi']) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
                    if (data['tipeusulan'] == 'admin') {
                        table_admin += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td>'+ver+'</td></tr>';
                    }else if(data['tipeusulan'] == 'teknis'){
                        table_teknis += '<tr><td>'+data['no']+'</td><td>'+data['namausulan']+'</td><td>'+adatidak+'</td><td>'+ver+'</td></tr>';
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
            { "data": "opd_pengusul" },
            { "data": "jumlah_usulan_juta" },
            { "data": "tahun_usulan" },
            
        ],
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    if (row['status_usulan'] == 3) {
                        return '<i class="fa fa-check-circle text-green"></i>';
                    }else if (row['status_usulan'] == 2) {
                        return '<i class="fa fa-info-circle text-blue"></i>';
                    }else{
                        return '<i class="fa fa-info-circle text-red"></i>';
                    }
                    
                },
                "targets": 0
            },
            {   
                "visible": false,  
                "targets": [ 7 ] 

            },
            {  
                "render": function(data,type,row){
                    return '<i>Rp. '+ number_format(row['jumlah_usulan_juta'])+'</i>';
                },
                "targets": [ 6 ] 
            },
        ],

        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(7, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7"><b>'+group+'</b></td></tr>'
                    );
 
                    last = group;
                }
            } );
        },

        "order": [[7, 'asc']],
        'sDom': 'lt<pi>' 

    });



    $('#table_usulan tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table_usulan.order()[0];
        if ( currentOrder[0] === 7 && currentOrder[1] === 'asc' ) {
            table_usulan.order( [ 7, 'desc' ] ).draw();
        }
        else {
            table_usulan.order( [ 7, 'asc' ] ).draw();
        }
    } )

   .on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table_usulan.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            //$(this).addClass('fa fa-plus-square-o');
            
        }else {
            // Open this row
            row.child( format_usulan(row.data()) ).show();
            tr.addClass('shown');
            //$(this).addClass('fa fa-minus-square-o');
            
        }
    } );
    var search_cat = $('#search_category');
    if (search_cat.val() != 0) {
        $('#search_text').on( 'keyup', function () {
            table_usulan
                .columns( search_cat.val() )
                .search( this.value )
                .draw();
        } );    
    }else{
        $('#search_text').on( 'keyup', function () {
            table_usulan
                
                .search( this.value )
                .draw();
        } );
    }
    
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

        if (d.hasOwnProperty('psab')) {
            if (d.psab.length > 0) {
            var table = '<div class="box box-primary">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">SAB</h3><div class="box-tools"><a href="/pengecekan/usulan/'+d.id+'" type="button" class="btn btn-block btn-primary">Cek</a></div></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Dokumen</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Dokumen</th></tr>';
                for (var i = d.psab.length - 1; i >= 0; i--) {
                    data = d.psab[i];
                    var adatidak = (d.psab[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
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

        if (d.hasOwnProperty('pplts')) {
            if (d.pplts.length > 0) {
            var table = '<div class="box">';
            var table_admin = '<tr><th colspan="3">Admin</th></tr>';
            var table_teknis = '<tr><th colspan="3">Teknis</th></tr>';
            table += '<div class="box-header"><h3 class="box-title">PLTS</h3><div class="box-tools"><a href="/pengecekan/usulan/'+d.id+'" type="button" class="btn btn-block btn-primary">Cek</a></div></div>';
            table += '<div class="box-body"><table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                table_admin += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Dokumen</th></tr>';
                table_teknis += '<tr><th>No</th><th>Usulan</th><th>Ada/Tidak</th><th>Dokumen</th></tr>';
                for (var i = d.pplts.length - 1; i >= 0; i--) {
                    data = d.pplts[i];
                    var adatidak = (d.pplts[i]['isi'] == 1) ? "<i class='fa fa-check text-blue'></i>":"<i class='fa fa-close text-red'></i>";
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
            { "data": "opd_pengusul" },
            { "data": "jumlah_usulan_juta" },
            { "data": "tahun_usulan" },
            
        ],
        "order": [[7, 'asc']],
        "columnDefs": [
           
            { "visible": false,  "targets": [ 7 ] },
            
        ],
        drawCallback: function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(7, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8"><b>'+group+'</b></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    });

    $('#table_pengecekan tbody')
    .on('click', 'td.details-control', function () {
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
    } )
    .on( 'click', 'tr.group', function () {
        var currentOrder = table_pengecekan.order()[0];
        if ( currentOrder[0] === 7 && currentOrder[1] === 'asc' ) {
            table_pengecekan.order( [ 7, 'desc' ] ).draw();
        }
        else {
            table_pengecekan.order( [ 7, 'asc' ] ).draw();
        }
    } );

    var table_pjalan = $('#table_pjalan').DataTable({
        "ajax": "/persyaratan/jalan/array",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "no" },
            { "data": "namausulan" },
            { "data": "tipeusulan" },
        ],
        "order": [[0, 'asc']]
    });

    var table_psab = $('#table_psab').DataTable({
        "ajax": "/persyaratan/sab/array",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "no" },
            { "data": "namausulan" },
            { "data": "tipeusulan" },
        ],
        "order": [[0, 'asc']]
    });

    var table_plts = $('#table_pplts').DataTable({
        "ajax": "/persyaratan/plts/array",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "no" },
            { "data": "namausulan" },
            { "data": "tipeusulan" },
        ],
        "order": [[0, 'asc']]
    });

}(jQuery, window, document));

(function($, window, document){

    /*var map;
    if($("#map").length > 0){
    function initialize() {
      var indo = { lat: -6.597952, lng: 106.801262 };
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: indo
      });
    }

    function addMarker(location, map) {
      // Add the marker at the clicked location, and add the next-available label
      // from the array of alphabetical characters.
      var marker = new google.maps.Marker({
        position: location,
        label: labels[labelIndex++ % labels.length],
        map: map
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    }*/

    $('#checkmap').click(function(){
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            $('input[name=latitude]').val(position.coords.latitude);
            $('input[name=longitude]').val(position.coords.longitude);
            //google.maps.event.trigger(map, "resize");
            //map.setCenter(pos);
            /*var marker = new google.maps.Marker({
                position: pos,
                title:"Hello World!"
            });*/
            
          }, function() {
            
          });
        } else {
          // Browser doesn't support Geolocation
         
        }        
    });
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
        google.maps.event.trigger(map, "resize");
    });

    $('select#jenis_usulan').on('change', function (){
        $('#usulan_jenis_pilih').show();
        var jenis_usulan = $(this).val();

        var options = '<option value="-">Satuan</option>';
        
        if ($(this).val() == '1') {
            data = [{'k':'KK','v':'kk'},{'k':'Jiwa','v':'jiwa'},{'k':'Km','v':'km'}];
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
            data = [{'k':'KK','v':'kk'},{'k':'Jiwa','v':'jiwa'}];
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


}(jQuery, window, document));


(function($, window, document){
    
    $('.formUpload').on('click', function(e) {
        var jalanadmin_file = $(this).closest('span').find('.jalanadmin_file');
        var jalanteknis_file = $(this).closest('span').find('.jalanteknis_file');

        var sabadmin_file = $(this).closest('span').find('.sabadmin_file');
        var sabteknis_file = $(this).closest('span').find('.sabteknis_file');

        var pltsadmin_file = $(this).closest('span').find('.pltsadmin_file');
        var pltsteknis_file = $(this).closest('span').find('.pltsteknis_file');

        if (jalanadmin_file.length > 0) {
            jalanadmin_file.trigger('click');
        }else if (jalanteknis_file.length > 0) {
            jalanteknis_file.trigger('click');
            
        }else if (sabadmin_file.length > 0) {
            sabadmin_file.trigger('click');  
        }else if (sabteknis_file.length > 0) {
            sabteknis_file.trigger('click');

        }else if (pltsadmin_file.length > 0) {
            pltsadmin_file.trigger('click');  
        }else if (pltsteknis_file.length > 0) {
            pltsteknis_file.trigger('click');    
        }
        
    });

    $('.fileupload:file').change(function(){
        var fileinput = $(this);
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;
        
        if(file.name.length < 1) {
        }else if(file.size > 209715200) {
            alert("File Terlalu Besar, Maksimal 200 Mb");
        }else if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' && file.type != 'application/pdf' && file.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            alert("File tidak diijinkan untuk di upload");
            $(this).val('');
        }else { 
            var formData = new FormData($('*formId*')[0]);
            if(!!file.type.match(/.*/)){
                formData.append("images", file);
            }
                /*$.ajax({
                    url: '/proposal/upload',  //server script to process data
                    type: 'POST',
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload){ // if upload property exists
                            myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // progressbar
                        }
                        return myXhr;
                    },
                    // Ajax events
                    success: completeHandler = function(data) {
                        
                        if(navigator.userAgent.indexOf('Chrome')) {
                            var catchFile = $(":file").val().replace(/C:\\fakepath\\/i, '');
                        }else {
                            var catchFile = $(":file").val();
                        }
                        var writeFile = $(":file");
                        writeFile.html(writer(catchFile));
                        $("*setIdOfImageInHiddenInput*").val(data.logo_id);
                        console.log($(this).closest('jalanadmin_ft'));
                    },
                    error: errorHandler = function() {
                        alert("Something went wrong!");
                    },
                    // Form data
                    data: formData,
                    // Options to tell jQuery not to process data or worry about the content-type
                    cache: false,
                    contentType: false,
                    processData: false
                }, 'json');*/
                
                $.ajax({
                    url: "/proposal/upload",
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    beforeSend: function(){
                        $('.loader').show();
                    },
                    complete: function(){
                        $('.loader').hide();
                    },
                    success: function(data){
                        
                        if($('.jalanadmin_ft').length > 0) {
                            fileinput.closest('td').find('.jalanadmin_ft')
                            .css({"color": "red", "border": "2px solid blue"}).val(data.filename);    
                        }
                        if($('.jalanteknis_ft').length > 0){
                            fileinput.closest('td').find('.jalanteknis_ft')
                            .css({"color": "red", "border": "2px solid blue"}).val(data.filename);
                        }

                        if($('.sabadmin_ft').length > 0) {
                            fileinput.closest('td').find('.sabadmin_ft')
                            .css({"color": "red", "border": "2px solid blue"}).val(data.filename);    
                        }
                        if($('.sabteknis_ft').length > 0){
                            fileinput.closest('td').find('.sabteknis_ft')
                            .css({"color": "red", "border": "2px solid blue"}).val(data.filename);
                        }

                        if($('.pltsadmin_ft').length > 0) {
                            fileinput.closest('td').find('.pltsadmin_ft')
                            .css({"color": "red", "border": "2px solid blue"}).val(data.filename);    
                        }
                        if($('.pltsteknis_ft').length > 0){
                            fileinput.closest('td').find('.pltsteknis_ft')
                            .css({"color": "red", "border": "2px solid blue"}).val(data.filename);
                        }
                    },
                    error: errorHandler = function() {
                        alert("Something went wrong!");
                    },
                });
        }
    });

    $('.filedokumentasi:file').change(function(){
        var fileinput = $(this);
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;
        
        if(file.name.length < 1) {
        }else if(file.size > 209715200) {
            alert("File Terlalu Besar, Maksimal 200 Mb");
        }else if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' && file.type != 'application/pdf' && file.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            alert("File tidak diijinkan untuk di upload");
            $(this).val('');
        }else { 
            var formData = new FormData($('*formId*')[0]);
            if(!!file.type.match(/.*/)){
                formData.append("images", file);
            }
                
                $.ajax({
                    url: "/proposal/uploaddokumentasi",
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    beforeSend: function(){
                        $('.loader').show();
                    },
                    complete: function(){
                        $('.loader').hide();
                    },
                    success: function(data){
                        console.log(data);
                    },
                    error: errorHandler = function() {
                        alert("Something went wrong!");
                    },
                });
        }
    });

    
}(jQuery, window, document));

(function($, window, document){
    

}(jQuery, window, document));

(function($, window, document){
  
    var Selector = 'th.check-all';

    $(Selector).on('change', function() {
        var $this = $(this),
            index= $this.index() + 1,
            checkbox = $this.find('input[type="checkbox"]'),
            table = $this.parents('table');
        // Make sure to affect only the correct checkbox column
        table.find('tbody > tr > td:nth-child('+index+') input[type="checkbox"]')
          .prop('checked', checkbox[0].checked);

    });

}(jQuery, window, document));

(function($, window, document){
    if( $( '.rt-clock' ).length > 0 ){
        var monthNames = [ 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember' ];
        var dayNames= [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu' ];

        var newDate = new Date();

        newDate.setDate(newDate.getDate());

        var date = dayNames[ newDate.getDay() ] + ', ' + newDate.getDate() + ' ' + monthNames[ newDate.getMonth() ] + ' ' + newDate.getFullYear();

        $( '.rt-clock .date' ).html( date );

        setInterval(
            function() {
                var seconds = new Date().getSeconds();
                $(".rt-clock .seconds").html(( seconds < 10 ? "0" : "" ) + seconds);
            },1000 );

        setInterval(
            function() {
                var minutes = new Date().getMinutes();
                $(".rt-clock .minutes").html(( minutes < 10 ? "0" : "" ) + minutes);
            },1000);

        setInterval(
            function() {
                var hours = new Date().getHours();
                $(".rt-clock .hours").html(( hours < 10 ? "0" : "" ) + hours);
            }, 1000);
    }
}(jQuery, window, document));

(function($, window, document){

    $('input.numberonly').bind('keypress', function(e) {
        return numeralsOnly(e);
    });
    $('input.letteronly').bind('keypress', function(e) {
        return lettersOnly(e);
    });
    function LinkCheck(url){
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        return http.status!=404;
    }
$.get('file/exists')
    .done(function() { 
        // exists code 
    }).fail(function() { 
        // not exists code
    })
}(jQuery, window, document));
 


