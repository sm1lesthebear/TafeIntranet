/**
 * Created by Student on 24/08/2016.
 */
function disableTextorDropdown(first_ID, second_ID, checkbox) {
    if (document.getElementById(checkbox).checked == true) {
        document.getElementById(second_ID).style.display = '';
        document.getElementById(first_ID).style.display = 'none';
    }
    else {
        document.getElementById(first_ID).style.display = '';
        document.getElementById(second_ID).style.display = 'none';

    }
}
function useExistingClient(client_select, first_name, last_name, email, phonenumber, checkbox) {
    if (document.getElementById(checkbox).checked == true)
    {
        document.getElementById(client_select).style.display = '';

        document.getElementById(first_name).style.display = 'none';
        document.getElementById(last_name).style.display = 'none';
        document.getElementById(email).style.display = 'none';
        document.getElementById(phonenumber).style.display = 'none';
    }
    else
    {
        document.getElementById(client_select).style.display = 'none';
        document.getElementById(first_name).style.display = '';
        document.getElementById(last_name).style.display = '';
        document.getElementById(email).style.display = '';
        document.getElementById(phonenumber).style.display = '';
    }

}

function passwordcheck(Password, PasswordConfirm) {
    var Pass = document.getElementById(Password).value;
    var PassConfirm = document.getElementById(PasswordConfirm).value;
    if (Pass !== PassConfirm)
    {
        document.getElementById('PasswordNotMatch').style.display = '';
        document.getElementById('submit').disabled = true;
    }
    else
    {
        document.getElementById('PasswordNotMatch').style.display = 'none';
        document.getElementById('submit').disabled = false;
    }
}