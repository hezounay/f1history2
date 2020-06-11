
$('#add-image').click(function () {
console.log('add-image')
// compter combien j'ai de form-group pour les indices ex: grand_prix_images_0_url
const index = +$('#widgets-counter').val() // le + permet de transformer en nombre pcq val() rend tjrs un type string

// récup le prototype des entrées data-prototype
const tmpl = $('#grand_prix_images').data('prototype').replace(/__name__/g, index) // drapeau g pour indiquer qu'on va le faire plusieurs fois

// injecter le code dans la div
$('#grand_prix_images').append(tmpl)

$('#widgets-counter').val(index + 1)

// gère le bouton supprimer

handleDeleteButtons()
})    

function updateCounter () {
const count = +$('#grand_prix_images div.form-group').length

$('#widgets-counter').val(count)
}

function handleDeleteButtons () {
$('button[data-action="delete"]').click(function () {
const target = this.dataset.target // dataset (les attributs data et je veux le target)
$(target).remove()
})
}

updateCounter()
handleDeleteButtons()



    $(document).ready(function(){
        $('[data-action="delete"]').on('click',function(){
            const target = this.dataset.target
            $(target).remove()
        })
    })

    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      }); 
      
/** TIMELINE */
 
$(".step").click( function() {
	$(this).addClass("active").prevAll().addClass("active");
	$(this).nextAll().removeClass("active");
});

$(".step01").click( function() {
	$("#line-progress").css("width", "3%");
	$(".discovery").addClass("active").siblings().removeClass("active");
});

$(".step02").click( function() {
	$("#line-progress").css("width", "35%");
	$(".strategy").addClass("active").siblings().removeClass("active");
});

$(".step03").click( function() {
	$("#line-progress").css("width", "68%");
	$(".creative").addClass("active").siblings().removeClass("active");
});

$(".step04").click( function() {
	$("#line-progress").css("width", "100%");
	$(".production").addClass("active").siblings().removeClass("active");
});
sal();
