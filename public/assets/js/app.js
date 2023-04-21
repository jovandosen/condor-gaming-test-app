var updateUserButtons = document.getElementsByClassName("update-user-btn");

var hiddenFieldAdded = false;

for(var i = 0; i < updateUserButtons.length; i++) {

    updateUserButtons[i].addEventListener("click", function() {

        var addUserBtnBox = document.getElementById("add-user-btn-box");

        var user = JSON.parse(this.dataset.user);

        var userForm = document.getElementById("user-form");

        var userFormTitle = document.getElementById("user-crud-title");

        userFormTitle.innerHTML = 'Update User';

        if(hiddenFieldAdded === false) {
            createInputFields(addUserBtnBox);
        }

        addUserDataToForm(user);

        document.getElementById("add-user-btn").remove();

        hiddenFieldAdded = true;

    });

}

function createInputFields(box) {
    var action = document.createElement("input");

    action.setAttribute("type", "hidden");
    action.setAttribute("name", "method");
    action.setAttribute("value", "PATCH");

    //append
    box.appendChild(action);

    var id = document.createElement("input");

    id.setAttribute("type", "hidden");
    id.setAttribute("name", "userID");
    id.setAttribute("value", "");
    id.setAttribute("id", "userid");

    //append
    box.appendChild(id);

    var updateBtn = document.createElement("input");

    updateBtn.setAttribute("type", "submit");
    updateBtn.setAttribute("name", "update_user");
    updateBtn.setAttribute("value", "UPDATE");
    updateBtn.setAttribute("id", "update-user-btn");

    //append
    box.appendChild(updateBtn);
}

function addUserDataToForm(user) {
    document.getElementById("fname").value = user.FirstName;
    document.getElementById("lname").value = user.LastName;
    document.getElementById("email").value = user.Email;
    document.getElementById("country").value = user.Country;
    document.getElementById("city").value = user.City;
    document.getElementById("userid").value = user.ID;
}