require('./bootstrap');

// Masonry library



$(document).ready(function() {
  Macy({
    container: '#hdrItems',
    margin: {
      x: 25,
      y: 25  
    },
    columns: 4,
    breakAt: {
      520: 2,
      400: 1
    }
  });
});