function ShowHelp(reason) {
         link='help.php?reason='+reason
         newWin=window.open(link,'help','height=500,width=400,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}