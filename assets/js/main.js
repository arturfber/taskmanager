// HELPER FUNCTIONS
function get(element){
    return document.querySelector(`${element}`)
}

function getAll(elements){
    return document.querySelectorAll(`${elements}`)
}

function log(content){
    return console.log(content)
}

function show(element){
    element.style.visibility = 'visible'
    element.style.opacity = '1'
}

function hide(element){
    element.style.visibility = 'hidden'
    element.style.opacity = '0'
}

// Phone mask
if(get("form#register input#password")){

    let pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8.innerText,50}$/,
        input = get("form#register input#password")
        
    input.onkeyup = () =>{
        if(!input.value.match(pattern)){
            input.style.borderColor = 'rgb(255, 13, 13)'
            input.style.boxShadow = '0 0 0 0.25rem rgb(255 13 13 / 30%)'
        } else {
            input.style.borderColor = '#86b7fe'
            input.style.boxShadow = '0 0 0 0.25rem rgb(13 110 253 / 25%)'
        }
    }
}

// Edit modal
if(get(".edit")){
    getAll("button.edit").forEach(button => {
        button.onclick = () => {
            let parent = button.closest("tr"),
                id = parent.querySelector("#id").innerText,
                name = parent.querySelector("#name").innerText,
                description = parent.querySelector("#description").innerText,
                status = parent.querySelector("#status").innerText,
                edit_form = get("form.edit"),
                delete_form = get("form.delete")
            
                edit_form.querySelector("input[name='id']").value = id
                edit_form.querySelector("input[name='name']").value = name
                edit_form.querySelector("textarea[name='description']").value = description
                edit_form.querySelector("select[name='status']").value = status

                delete_form.querySelector("input[name='id']").value = id
        }
    });
}