const data = document.querySelector("#data")

function delegate(parent, child, when, what){
  function eventHandlerFunction(event){
      let eventTarget  = event.target
      let eventHandler = this
      let closestChild = eventTarget.closest(child)

      if(eventHandler.contains(closestChild)){
          what(event, closestChild)
      }
  }

  parent.addEventListener(when, eventHandlerFunction)
}

delegate(data, '.shipment ul li', 'click', (event, row) => {
  row.classList.toggle('product')
  console.log('sadasda')
})

delegate(data, '.shipment div:nth-of-type(1)', 'click', (event, row) => {
  row.parentNode.classList.toggle('arrival')
  console.log('sadasda')
})

delegate(data, '.shipment div:nth-of-type(3)', 'click', (event, row) => {
  row.parentNode.classList.toggle('shelf')
  console.log('shelf')
})