$(function() {

    // Menu responsive

    function ResponsiveMenu() {

        /*Au click sur le bouton de ta navigation*/
        $('.show-menu').click(function(e) {

            /*Si le menu est visible*/
            if($('#menu').is(':visible')) {

                /*Je cible la classe et je remove la visibilité*/
            $(this).find('i').removeClass('fa-times').addClass('fa-bars');
            $('#menu').slideUp(function() {
                $('.overlay').fadeOut();
                /*Avec une petite animation c'est beaucoup mieux*/
            });

                /*  SINON*/
            } else {

                /*Tu ajoutes la classe que tu veux pour la faire apparaitre*/
            $(this).find('i').removeClass('fa-bars').addClass('fa-times');
            $('#menu').slideDown(function() {
                $('.overlay').fadeIn();
                /*Avec une petite animation c'est beaucoup mieux*/
            });

            }

            /*POur supprimer l'effet par défaut des CTA*/
            e.preventDefault();

        });

    }
    /*J'appelle la fonction*/
    ResponsiveMenu();

});
