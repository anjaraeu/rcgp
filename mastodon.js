// Mastodon Share
// Create of DEADBLACKCLOVER
// License GNU GPL-3

var host = null,
    message = null;

var mastodon = document.getElementById("mastodon-share");

mastodon.innerHTML = "<div><button id='mastodon-share-btn' onclick='viewHostMastodon()'></button></div>" +
  "<div id='mastodon-share-host' hidden>"+
    "<input id='mastodon-share-ipt' type='text' placeholder='Mastodon URL'>"+
    "<button id='mastodon-share-share' onclick='getHostMastodon()'>OK</button>"+
  "</div>";

var btn = document.getElementById("mastodon-share-btn");

btn.style.width = "120px";
btn.style.height = "30px";
btn.style.backgroundColor = "#282c37";
btn.style.backgroundImage = "url(https://joinmastodon.org/static/media/logo_full.97822390.svg)";
btn.style.backgroundSize = "75% 80%";
btn.style.backgroundRepeat = "no-repeat";
btn.style.backgroundPosition = "50% 50%";
btn.style.color = "#d9e1e8";
btn.style.border = "0";
btn.style.borderRadius = "5px";

var block = document.getElementById("mastodon-share-host");

block.style.marginTop = "5px";
block.style.backgroundColor = "#282c37";
block.style.width = "180px";
block.style.padding = "5px";
block.style.borderRadius = "5px";

var ipt = document.getElementById("mastodon-share-ipt");

ipt.style.width = "110px";
ipt.style.marginRight = "5px";

function getMessageMastodon(mes) {
  message = mes;
}

function viewHostMastodon() {
  block.hidden = false;
}

function getHostMastodon(){
  host = ipt.value;
  shareMastodon();
}

function shareMastodon() {
  if(host && message){
    host = 'https://' + host + '/share?text=' + message;
    var newWin = window.open(host, "Mastodon", "width=430,height=320");
  }
}
