import { Controller } from '@hotwired/stimulus';
import * as bootstrap from 'bootstrap';

var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
  keyboard: false
})
export default class extends Controller {

    connect(){
      if(!window.essential)
        myModal.show();
    }
    acceptAll() {
      fetch('/cookie/consent')
      myModal.hide();
    }
    acceptSingle(){
      var category = event.currentTarget.dataset.category
      fetch('/cookie/consent?category='+category)
    }
    showDetailed(){
      var tabs = document.getElementsByClassName('cookie-tab')
      tabs[0].style.display = 'none'
      tabs[1].style.display = 'block'
      tabs[2].style.display = 'none'
    }
}