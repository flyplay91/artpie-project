$(document).ready(function() {
  if ($('#adGallerysItems').length > 0) {
    Macy({
      container: '#adGallerysItems',
      margin: {
        x: 25,
        y: 25  
      },
      columns: 3,
      breakAt: {
        520: 2,
        400: 1
      }
    });
  }
  
});