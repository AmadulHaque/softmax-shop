// Create a new element
const newElement = document.createElement("ul");
newElement.setAttribute("class", "notifications");

// Find the parent element to which you want to append the new element
const parentElement = document.querySelector(".body");

// Append the new element as a child of the parent element
parentElement.appendChild(newElement);

const notifications = document.querySelector(".notifications");
const toastDetails = {
    success: {
        icon: 'fa-circle-check',
    },
    error: {
        icon: 'fa-circle-xmark',
    },
    warning: {
        icon: 'fa-triangle-exclamation',
    },
    info: {
        icon: 'fa-circle-info',
    }
}

const removeToast = (toast) => {
    toast.classList.add("hide");
    if(toast.timeoutId) clearTimeout(toast.timeoutId); // Clearing the timeout for the toast
    setTimeout(() => toast.remove(),300); // Removing the toast after 500ms
}

const createToast = (type,msg,timer) => {
    // Getting the icon and text for the toast based on the type passed
    const { icon } = toastDetails[type];
    const toast = document.createElement("li"); // Creating a new 'li' element for the toast
    toast.className = `toast ${type}`; // Setting the classes for the toast
    // Setting the inner HTML for the toast
    toast.innerHTML = `<div class="column">
                         <i class="fa-solid ${icon}"></i>
                         <span>${msg}</span>
                      </div>
                      <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>`;
    notifications.appendChild(toast); // Append the toast to the notification ul
    // Setting a timeout to remove the toast after the specified duration
    toast.timeoutId = setTimeout(() => removeToast(toast), timer);
}

function ToastMessage(type,mag,timer=4000,position='top-right') {
    newElement.classList.add(position);
    createToast(type,mag,timer)
}
