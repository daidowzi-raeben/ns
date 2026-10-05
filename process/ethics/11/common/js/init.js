//동영상 초기화 (HTML의 상대경로 source를 우선 사용)
_this.$content = $("body").children(".content");

var $videos = _this.$content.find("video.video1");
if ($videos.length > 1) {
  $videos.slice(1).each(function() {
    this.pause();
    $(this).remove();
  });
  $videos = _this.$content.find("video.video1");
}

_this.$videoDOM = $videos.get(0);

if (!_this.$videoDOM) {
  _this.$videoDOM = document.createElement("video");
  _this.$videoDOM.classList.add("video1");
  _this.$content.get(0).insertBefore(_this.$videoDOM, _this.$content.get(0).firstChild);
}

_this.$videoDOM.classList.add("video1");
_this.$videoDOM.setAttribute("playsinline", "true");
_this.$videoDOM.setAttribute("webkit-playsinline", "true");
_this.$videoDOM.preload = "metadata";
_this.$videoDOM.autoplay = true;

var relativeSrc = "../mp4/" + strPage + ".mp4";
var sourceEl = _this.$videoDOM.querySelector("source");
if (sourceEl && sourceEl.getAttribute("src")) {
  relativeSrc = sourceEl.getAttribute("src");
} else {
  if (!sourceEl) {
    sourceEl = document.createElement("source");
    _this.$videoDOM.appendChild(sourceEl);
  }
  sourceEl.setAttribute("src", relativeSrc);
  sourceEl.setAttribute("type", "video/mp4");
}

_this.$moviePath = relativeSrc;
_this.$movieName = strPage + ".mp4";
if (!_this.$videoDOM.currentSrc) {
  _this.$videoDOM.load();
}
