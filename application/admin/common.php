<?php
function replaceIndex($char,$str,$index){
  $strArr = str_split($str);
  $strArr[$index] = $char;
  return implode("",$strArr);
}

function checkPromise($level,$action){
  $promise = [
    1=>[
      "showarticles",
      "showarticleadd",
      "addarticle",
      "showarticleedit",
      "editarticle",
      "deletearticle",
      "showcategories",
      "showcategoryadd",
      "addcategory",
      "showcategoryedit",
      "checklogin",
      "logout",
      "showusers",
      "showuseradd",
      "showuseredit",
      "adduser",
      "edituser",
      "stopuser",
      "startuser",
      "deleteuser",
      "showcomments",
      "agreecomment",
      "nocomment",
      "stopcomment",
      "startcomment",
      "deletecomment",
      'index',
    ],
    2=>[
      "showarticles",
      "showarticleadd",
      "addarticle",
      "showarticleedit",
      "editarticle",
      "deletearticle",
      "showcategories",
      "showcategoryadd",
      "addcategory",
      "showcategoryedit",
      "checklogin",
      "logout",
      "showusers",
      "showuseradd",
      "showuseredit",
      "edituser",
      "stopuser",
      "startuser",
      "showcomments",
      "agreecomment",
      "nocomment",
      "stopcomment",
      "startcomment",
      "deletecomment",
      'index',
    ],
    3=>[
      "showarticles",
      "showarticleadd",
      "addarticle",
      "showarticleedit",
      "editarticle",
      "checklogin",
      "logout",
      "showusers",
      "showuseradd",
      "showuseredit",
      "edituser",
      "showcomments",
      "agreecomment",
      "nocomment",
      "stopcomment",
      "startcomment",
      "deletecomment",
      'index',
    ],
    4=>[      
      "checklogin",
      "logout",
      "showusers",  
      "showuseredit", 
      "edituser",
      "showcomments",
      "agreecomment",
      "nocomment",
      "stopcomment",
      "startcomment",
      "deletecomment",
      'index',
    ]
  ];
  if(array_search($action,$promise[$level]) === false){
    return false;
  }else{
    return true;
  }

}