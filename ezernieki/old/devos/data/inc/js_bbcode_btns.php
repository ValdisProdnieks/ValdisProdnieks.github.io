<?php

echo'
<script language=javascript>
function BBTag(tag,s,text,form){
switch(tag)
    {
    case \'[img]\':
    if (document.forms[form].elements[s].value=="IMG ")
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[img=]";

        break;
    case \'[url]\':
    if (document.forms[form].elements[s].value=="URL ")
       {
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[url=]";
        document.forms[form].elements[s].value="URL*";
        }
       else
           {
           document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[/url]";
           document.forms[form].elements[s].value="URL ";
           }
        break;
    case \'[*]\':
    if (document.forms[form].elements[s].value=="List ")
       {
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[*]";
        }
        break;
    case \'[---]\':
    if (document.forms[form].elements[s].value=="Line ")
       {
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[---]";
		}
        break;        
    case \'[b]\':
    if (document.forms[form].elements[s].value=="B ")
       {
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[b]";
        document.forms[form].elements[s].value="B*";
        }
       else
           {
           document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[/b]";
           document.forms[form].elements[s].value="B ";
           }
        break;
    case \'[i]\':
    if (document.forms[form].elements[s].value=="I ")
       {
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[i]";
        document.forms[form].elements[s].value="I*";
        }
       else
           {
           document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[/i]";
           document.forms[form].elements[s].value="I ";
           }
        break;
    case \'[u]\':
    if (document.forms[form].elements[s].value=="U ")
       {
        document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[u]";
        document.forms[form].elements[s].value="U*";
        }
       else
           {
           document.forms[form].elements[text].value = document.forms[form].elements[text].value+"[/u]";
           document.forms[form].elements[s].value="U ";
           }
        break;
    }
    document.forms[form].elements[text].focus();
}

</script>

';


?>