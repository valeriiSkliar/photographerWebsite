import {getCsrfToken} from "../helpers/getCsrfToken.js"

function preventDefaultA () {

    const collectionA = document.getElementsByClassName('buttonWork');

    for (let i = 0; i<collectionA.length; i+=1) {
        collectionA[i].addEventListener('click',(evt) => {
                 evt.preventDefault();
                 document.getElementById('application_form').scrollIntoView();
        })
    };

}

preventDefaultA();

function calendarLimit () {
    let presentDate = new Date();
    let presentYear = presentDate.getFullYear();
    let nextYear = String(Number(presentYear) + 1);
    let presentMonth = String(Number(presentDate.getMonth()) + 1);
    let presentDay = presentDate.getUTCDate();
    let minLimit = `${presentYear}-${presentMonth}-${presentDay}`;
    let maxLimit = `${nextYear}-${presentMonth}-${presentDay}`;
    const dateElement = document.getElementById('var_input_5');
    dateElement.setAttribute("min",minLimit);
    dateElement.setAttribute("max",maxLimit);
};

calendarLimit();

function errorInput (examElement) {
    examElement.style.border = '2px solid red';
}

function trueInput (examElement) {
    examElement.style.border = 'none';
}

function sendMessage (service, name, surname, phone, date) {
    const messageToAdmin = {
        service,
        name,
        surname,
        phone,
        date
    };
    const message = JSON.stringify(messageToAdmin);
    fetch ('/application-submit',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': `${getCsrfToken()}`
        },
        body: message
      }).then(data=>data.json()).then(data=>console.log(data))
}

document.getElementById('button_send').addEventListener('click',() => {
    const serviceElement = document.getElementById('var_input_6');
    const workService = serviceElement.options[serviceElement.selectedIndex].textContent;
    const nameElement = document.getElementById('var_input_2');
    const surnameElement = document.getElementById('var_input_3');
    const phoneElement = document.getElementById('var_input_4');
    const dateElement = document.getElementById('var_input_5');
    if (validInput(nameElement) && validInput(surnameElement) && validInput (phoneElement) && dateElement.value) {
        sendMessage(workService,nameElement.value,surnameElement.value,phoneElement.value,dateElement.value);
        nameElement.value = '';
        surnameElement.value = '';
        phoneElement.value = '';
        dateElement.value = '';
    }
    else {
        alert('Please enter correct details');
    }
})

document.getElementById('var_input_5').addEventListener('input', (event) => {
    if (event.target.value) {
        trueInput(event.target);
    }
    else {
        errorInput(event.target);
    }
})

document.getElementById('var_input_2').addEventListener('input', (event) => {

    if (validInput(event.target,'\[A-Za-z]+\\b')) {
        trueInput(event.target)
    }
    else {
        errorInput(event.target)
    }

})

document.getElementById('var_input_3').addEventListener('input', (event) => {

    if (validInput(event.target,'\[A-Za-z]+\\b')) {
        trueInput(event.target)
    }
    else {
        errorInput(event.target)
    }

})

document.getElementById('var_input_4').addEventListener('input', (event) => {

    if (validInput(event.target,'\\+\\d{12,13}\\b')) {
        trueInput(event.target)
    }
    else {
        errorInput(event.target)
    }

})

function validInput (inputElement,regExpActive) {
    const regExp = new RegExp(regExpActive);
    if (regExp.test(inputElement.value)) {
        return true
    }
}


