/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$ (document).ready (function () {
  for (var i = 0; i < 10; i++) {
    $.post ("/sistema/seleccionImagen.php", {
      index: $ ("main > img").length + (i + 2)
    }, function (data, status) {
      if (data.length) {
        var img = $ ("<img/>").attr ("src", data);
        img.addClass ("imagen");
        img.attr ("alt", "imágen");
        $ ("main").append (img);
      }
    });
  }

  $ (window).scroll (function (event) {
    if ($ (window).scrollTop () == $ (document).height () - $ (window).height ()) {
      for (var i = 0; i < 10; i++) {
        $.post ("/sistema/seleccionImagen.php", {
          index: $ ("main > img").length + (i + 2)
        }, function (data, status) {
          if (data.length) {
            var img = $ ("<img/>").attr ("src", data);
            img.addClass ("imagen");
            img.attr ("alt", "imágen");
            $ ("main").append (img);
          }
        });
      }
    }
  });
})