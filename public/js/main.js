let boxes = document.querySelectorAll('.logo')

boxes.forEach(function(box){
    box.addEventListener('mouseover', e=>{
        box.classList.add('reverse')

    })
    box.addEventListener('mouseout', e=>{
        box.classList.remove('reverse')
    })
})