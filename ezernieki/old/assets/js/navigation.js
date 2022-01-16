function toggleElement(id) {
    const x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }
  
  function showElement(id) {
    const x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } 
  }
  
  function hideElement(id) {
    const x = document.getElementById(id);
    if (x.className.indexOf("w3-show") != -1) {
      x.className = x.className.replace(" w3-show", "");
    }
  }

  function showHome(){
    showElement("main");
    hideElement("guest_house");
    hideElement("services");
    hideElement("daba");
  }

  function showGuestHouse(){
    hideElement("main");
    showElement("guest_house");
    hideElement("services");
    hideElement("daba");
  }  

  function showServices(){
    hideElement("main");
    hideElement("guest_house");
    showElement("services");
    hideElement("daba");
  } 

  function showNature(){
    hideElement("main");
    hideElement("guest_house");
    hideElement("services");
    showElement("daba");
  }