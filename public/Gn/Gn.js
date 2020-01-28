
$('.overlay').hide();

$('#add').on('click', function(e) {
    e.preventDefault();
    $('.overlay').fadeIn(300);
});

$('.activity').not('.activity.active').hide();


$('.close').on('click', function(e) {
    $('.overlay').fadeOut(300);
});




$('#migration').on('click', function(e) {
    $('#migration').addClass('active')
    $('#module').removeClass('active')
    $('#bdd').removeClass('active')
    $('#migration_content').show();
    $('#module_content').hide();
    $('#database_content').hide();
});


$('#module').on('click', function(e) {
    $('#migration').removeClass('active')
    $('#module').addClass('active')
    $('#bdd').removeClass('active')
    $('#migration_content').hide();
    $('#module_content').show();
    $('#database_content').hide();
});

$('#bdd').on('click', function(e) {
    $('#bdd').addClass('active')
    $('#module').removeClass('active')
    $('#migration').removeClass('active')
    $('#migration_content').hide();
    $('#module_content').hide();
    $('#database_content').show();
});


document.querySelectorAll('.button').forEach(button => {
    button.addEventListener('click', e => {
        button.classList.add('processing');
        e.preventDefault();
    });
});


$('#bdd_create').on('click', function (e) {
    e.preventDefault();
    loadershow()
    var link = $('#bdd').attr("rel")
    $.ajax({
        url: link,
        data:{
            database : "true",
        },
        type:"get",
        success:function(msg){
             loaderhide()
              if (msg == "true"){
                  $('#rslt').html("<div class=\"alert alert--success\">Base de donnée creer avec succes</div>");
              }

            if (msg == "false") {
                  $('#rslt').html("<div class=\"alert alert--danger\">La Base de donnée existe déjà !!</div>");
              }
            if (msg == "false2") {
                $('#rslt').html("<div class=\"alert alert--danger\">Une erreur s'est produite veuillez verifier votre configuration</div>");
            }
        }
    })


})


function loadershow() {
    $('.loader').show()
}

function loaderhide() {
    $('.loader').hide()
}

$('#create_module').on('click', function (e) {
    e.preventDefault()
    var module = $('#modulename').val()
    var tabl = document.getElementById('table').checked
    var table = 0
     if (tabl == true){
        table = 1;
     }

     console.log(tabl)

    if (module == ""){
        $('#moduleerror').html("<em style='color: #d10e1c;'>Veuillez saisir le nom du module</em>")
    }
    else{
        $('#create_module').html("<img src='/Gn/spinner.svg' style='width: 30px;'>")
        $('#moduleerror').html("")
        var link = $('.form').attr("rel")
        $.ajax({
            url: link,
            data:{
                module : module,
                 table : table
            },
            type:"get",
            success:function(msg){
                var m = module.charAt(0).toUpperCase() + module.substring(1);
                $('.moduleresultat').show()
                if (msg == "false"){
                    $('#resultlastmsg').html("<b style='color: #990000'> Une erreur s'est produite</b>")
                }

               if(msg == m){
                   $('#resultatcontroller').html("<em style='color: #29622f'> * modules/"+msg+"/Controller/"+msg+"Controller.php</em>")
                   $('#resultatmodel').html("<em style='color: #29622f'>  * app/models/"+msg+".php</em>")
                   $('#resultatview').html("<em style='color: #29622f'>  * modules/"+msg+"/View/index.twig</em> <br> <br> * modules/"+msg+"/View/detail.twig</em> ")
                   $('#resultlastmsg').html("<b style='color: #419d4c'> Module creer avec succes</b>")
               }
            }
        })
    }

})