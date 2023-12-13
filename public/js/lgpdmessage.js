$(document).ready(function messageLGPD(){
  if((Cookies.get('messageLGPD') == 'undefined' || (Cookies.get('messageLGPD') == null))){
    $('#modalMessageLGPD').modal('show')
  }

})

function aceitarPdP(){
  Cookies.set('messageLGPD', true, { expires: 365 })
}