$('#add-image').click(function() {
    //Je recupère le numero des futurs champs que je vais créer
    const index = +$('#widgets-counter').val();
    console.log(index);
    //Je recupère le prototype des entrées
    const tmpl = $('#annonce_images').data('prototype').replace(/__name__/g, index);


    //J'injecte ce code au sein de la div
    $('#annonce_images').append(tmpl);
    $('#widgets-counter').val(index + 1)
    //Je gère le bouton supprimer
    handleDeleteButtons();

});
function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    })
}

function updateConter(){
    const count = +$('#annonce_images div.form-group').length;
    $('#widgets-counter').val(count);
}
updateConter()
handleDeleteButtons();