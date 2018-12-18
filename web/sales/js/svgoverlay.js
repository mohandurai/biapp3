/**
 * SVG Overlay constructor
 * @param {Object} options May contain the map and the content of the overlay
 */
function SvgOverlay(options) {
    // this = sessionStorage.getItem('overlay');
  this.options_ = options || {};
  // console.log('this.options_');
  // console.log(this.options_);
  this.container_ = document.createElement('div');
  this.container_.style.position = 'absolute';

  this.center_ = new google.maps.LatLng(0, 0);
  // console.log( 'this.center_');
  // console.log( this.center_);
  if (!this.options_.layer) {
    this.options_.layer = 'overlayLayer';
  }
  oversp1 = sessionStorage.getItem('map');
  if (this.options_.map) {
    // console.log('this');
    // console.log(this);
    // console.log(map);
    this.setMap(this.options_.map);
  }

  if (this.options_.content) {
    // console.log('B');
    // console.log(this);
    this.setContent(this.options_.content);
  }
}
SvgOverlay.prototype = new google.maps.OverlayView();
// console.log('A');
/**
 * Internal method. Triggered when `setMap` was called with an argument.
 */
SvgOverlay.prototype.onAdd = function() {
  // this.getPanes()[this.options_.layer].appendChild(this.container_);
  // alert(this.container_);
  var li = this.getPanes()['overlayMouseTarget'].appendChild(this.container_);
  // console.log('rose');
  
  // console.log(li);
  // console.log(onAdd.getBounds());
  // this.setMap(map);
};

/**
 * Set the new SVG content to display on a map.
 * @param {String} content The content to display (SVG)
 */
SvgOverlay.prototype.setContent = function(content) {
  this.container_.innerHTML = content;
  this.content_ = content;
  this.svg_ = this.container_.getElementsByTagName('svg')[0];

  this.draw();
};

/**
 * Get the assigned SVG string.
 * @return {String} The content passed in
 */
SvgOverlay.prototype.getContent = function() {
  return this.content_;
};

/**
 * Get the surrounding DOM container.
 * @return {Element} The container element
 */
SvgOverlay.prototype.getContainer = function() {
  return this.container_;
};

/**
 * Get the SVG element.
 * @return {Element} The SVG element
 */
SvgOverlay.prototype.getSvg = function() {
  return this.svg_;
};

/**
 * Internal method. Called when the layer needs an update.
 */
SvgOverlay.prototype.draw = function() {
  var projection = this.getProjection(),
    style, center, width, offset, left, top;
    // console.log('rose ponnu');
    // console.log(this.center_);
  if (!projection || !this.svg_) {
    return;
  }

  style = this.container_.style;

  // console.log('I am mental');
  // console.log(this.center_);
  // compute layer offset
  svglat.push(this.center_);
  center = projection.fromLatLngToDivPixel(this.center_);
  width = Math.round(projection.getWorldWidth());
  offset = width / 2;

  left = Math.round(center.x) - offset;
  top = Math.round(center.y) - offset;

  // scale svg to world bounds
  this.svg_.setAttribute('width', width);
  this.svg_.setAttribute('height', width);

  // apply offset
  style.left = left + 'px';
  style.top = top + 'px';
};

/**
 * Internal method. Triggered when `setMap` was called with `null.
 */
SvgOverlay.prototype.onRemove = function() {
  this.container_.parentNode.removeChild(this.container_);
};



// SvgOverlay.prototype.boundsAt = function (zoom, center, projection, div) {
//     var p =  this.getProjection();
//     if (!p) return undefined;
//     var d = this.container_.getElementsByTagName('svg')[0];
//     console.log('dddddd');
//     console.log(p);
//     console.log(map.getProjection());
//     console.log(d.getAttribute('width'));
//     var zf = Math.pow(2, map.zoom) * 2;
//     var dw = d.getAttribute('width');//.toInt()  / zf;
//     var dw = parseInt(dw) / zf;;
//     var dh = d.getAttribute('height');//.toInt() / zf;
//     var dw = parseInt(dh) / zf;;
//     var cpx = p.fromLatLngToPoint(this.center_ || this.getCenter());
//     return new google.maps.LatLngBounds(
//         p.fromPointToLatLng(new google.maps.Point(cpx.x - dw, cpx.y + dh)),
//         p.fromPointToLatLng(new google.maps.Point(cpx.x + dw, cpx.y - dh)));
// }

/**
 * Make module compatible to module loaders
 */
if (typeof module == 'object') {
  // console.log('robin');
  module.exports = SvgOverlay;
}
