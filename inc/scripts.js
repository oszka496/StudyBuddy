function accordionify(what) {
  if (!what.hasClass("ui-accordion")) {
    what.accordion({
      active: false,
      collapsible: true,
      heightStyle: "content",
      header: ".list-group-item",
      beforeActivate: function(event, ui){
        var link = ui.newHeader.children("a");
        var href = link.attr("href");
        ui.newPanel.load(href, function() {
          $(document).find(".accordion").each(function() {
            accordionify($(this));
          });
        });
      }
    });
  }
}
