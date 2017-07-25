var UID = {
	_current: 0,
	getNew: function(){
		this._current++;
		return this._current;
	}
};
HTMLElement.prototype.pseudoStyle = function(element,prop,value){
	var _this = this;
	var _sheetId = "pseudoStyles";
	var _head = document.head || document.getElementsByTagName('head')[0];
	var _sheet = document.getElementById(_sheetId) || document.createElement('style');
	_sheet.id = _sheetId;
	var className = "pseudoStyle" + UID.getNew();

	_this.className +=  " "+className;

	_sheet.innerHTML += "\n."+className+":"+element+"{"+prop+":"+value+"}";
	_head.appendChild(_sheet);
	return this;
};

var i = 0;
document.querySelector('label').onclick = function (e) {
  var burger = document.getElementById("burger");
  var cross = document.getElementsByTagName("span");
  var ul = document.querySelector("ul.nav__right");

if(i % 2 == 0){
  burger.pseudoStyle("after","display","none!important");
  cross[0].style.display = "block";
  ul.style.display = "block";
  ul.style.position = "absolute";
  ul.style.top = "0px";
  ul.style.left = "0px";
  ul.style.width = "100%";
  ul.style.height = "100%";
  ul.style.background = "#FFF";

  document.getElementById("menu").addEventListener("click",function(e) {
    if(e.target && e.target.nodeName == "A") {
      this.style.display = "none";
      burger.pseudoStyle("after","display","block!important");
      cross[0].style.display = "none";
      ul.style.display = "none";
      if(i % 2 == 1){
        i += 1;
      }
    }
  });
  i +=1;
}else{
  burger.pseudoStyle("after","display","block!important");
  cross[0].style.display = "none";
  ul.style.display = "none";
  i +=1;
}
  e.preventDefault();
}
