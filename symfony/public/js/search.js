$(function () {
     var timeout = null;
     $('#search-input').on('keyup', function () {
          clearTimeout(timeout);
          timeout = setTimeout(function () {
               const value = $('#search-input').val();
               if (!$('#search-input').val()) {
               } else {
                    $.get('/ad/search-json?terms=' + value, function (ads) {
                         $('#results').html('');
                         ads.forEach(function (ad) {
                              $('#results').append("<li>" + "<h3>" + ad.title + "</h3>" + "</li>" + "<div><a class='btn btn-info text-light' href=/ad/" + ad.id +">Voir l'annonce</a></div>");
                         })
                    });
               }
          }, 1000);
     });
});
