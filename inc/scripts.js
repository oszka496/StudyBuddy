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

addthisevent.settings({
  mouse     : false,
  css       : false,
  outlook   : {show:true, text:"Add to Outlook Calendar"},
  google    : {show:true, text:"Add to Google Calendar"},
  hotmail   : {show:false, text:"Hotmail Calendar"},
  yahoo   : {show:false, text:"Yahoo Calendar"},
  ical      : {show:true, text:"Add to iCal Calendar"},
  facebook  : {show:false, text:"Facebook Event"},
  dropdown  : {order:"google,outlook,ical"},
  callback  : ""
});