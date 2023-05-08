const onOutsideLogin = (event) => {
    const ignoreClickOnMeElement = document.querySelector(".form-main-login");
    const isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        offForm();
    }
};

const onOutsideRegister = (event) => {
    const ignoreClickOnMeElement = document.querySelector(".form-main-register");
    const isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        offForm();
    }
};

const onOutsideForgot = (event) => {
    const ignoreClickOnMeElement = document.querySelector(".form-main-forgot");
    const isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        offForm();
    }
};


const resetFormLogin = () => {
    const form = document.querySelector(".container-form-login");
    const showErr = form.querySelector('.alert-danger');
    showErr.textContent = "";
    showErr.classList.add('hidden');
    let inputs = document.querySelectorAll('.container-form-login .form-control');
    let errors = document.querySelectorAll('.container-form-login .error');
    inputs.forEach(item => item.value = "");
    errors.forEach(item => item.textContent = "");
}
const resetFormRegister = () => {
    const form = document.querySelector(".container-form-register");
    const showErr = form.querySelector('.alert-danger');
    showErr.textContent = "";
    showErr.classList.add('hidden');
    let inputs = document.querySelectorAll('.container-form-register .form-control');
    let errors = document.querySelectorAll('.container-form-register .error');
    inputs.forEach(item => item.value = "");
    errors.forEach(item => item.textContent = "");
}

const resetFormForgot = () => {
    const form = document.querySelector(".container-form-forgot");
    const showErr = form.querySelector('.alert-danger');
    showErr.textContent = "";
    showErr.classList.add('hidden');
    let inputs = document.querySelectorAll('.container-form-forgot .form-control');
    let errors = document.querySelectorAll('.container-form-forgot .error');
    inputs.forEach(item => item.value = "");
    errors.forEach(item => item.textContent = "");
}

const onFormLogin = () => {
    const form = document.querySelector(".container-form-login");
    form.classList.add("active");
    form.querySelector('.email').focus();
};
const onFormRegister = () => {
    const form = document.querySelector(".container-form-register");
    form.classList.add("active");
    form.querySelector('.fullname').focus();
};

const onFormForgot = () => {
    const form = document.querySelector(".container-form-forgot");
    form.classList.add("active");
};


const offForm = () => {
    const formLogin = document.querySelector(".container-form-login");
    formLogin.classList.remove("active");
    const formRegister = document.querySelector(".container-form-register");
    formRegister.classList.remove("active");
    const formForgot = document.querySelector(".container-form-forgot");
    formForgot.classList.remove("active");
};

const onLogin = () => {
    resetFormLogin()
    offForm();
    onFormLogin();
};

const onRegister = () => {
    resetFormRegister()
    offForm();
    onFormRegister();
};

const onForgot = () => {
    resetFormForgot()
    offForm();
    onFormForgot();
};

async function checkLogin() {
    const form = document.querySelector(".container-form-login");
    const showErr = form.querySelector('.alert-danger');
    const email = form.querySelector('.email').value.trim();
    const password = form.querySelector('.password').value;
    let validate = true;

    if (!email) {
        form.querySelector('.error-email').textContent = "Vui lòng nhập email!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        form.querySelector('.error-email').textContent = "Email không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else {
        form.querySelector('.error-email').textContent = "";
    }

    if (!password) {
        form.querySelector('.error-password').textContent = "Vui lòng nhập mật khẩu!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else if (password.length < 6) {
        form.querySelector('.error-password').textContent = "Mật khẩu ít nhất 6 kí tự!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else {
        form.querySelector('.error-password').textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('email', email);
        data.append('password', password);
        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/post_login", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);
        if (jsonData['check']) {
            offForm();
            if (jsonData['check_admin']) {
                sweetConfirm('Chuyển sang trang đăng nhập Admin?', jsonData['msg'], async function (confirmed) {
                    if (confirmed) {
                        let host_root = document.querySelector('.url_hoot_root').value;
                        await location.assign(host_root + '/admin');
                        // location.reload();
                    }
                });
            } else {
                await Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Đăng nhập thành công!',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => {
                    location.reload();
                }, 0);
            }
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }
    } else {
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        showErr.classList.remove('hidden');
    }
}


const checkRegister = async () => {
    const form = document.querySelector(".container-form-register");
    const showErr = form.querySelector('.alert-danger');
    const fullname = form.querySelector('.fullname').value.trim();
    const email = form.querySelector('.email').value.trim();
    const phone = form.querySelector('.phone').value.trim();
    const password = form.querySelector('.password').value;
    const confirm_password = form.querySelector('.confirm_password').value;
    let validate = true;
    if (!fullname) {
        form.querySelector('.error-fullname').textContent = "Vui lòng nhập họ tên!";
        if (validate) {
            validate = false;
            form.querySelector('.fullname').focus();
        }
    } else if (fullname.length < 6) {
        form.querySelector('.error-fullname').textContent = "Họ tên ít nhất 6 kí tự!";
        if (validate) {
            validate = false;
            form.querySelector('.fullname').focus();
        }
    } else {
        form.querySelector('.error-fullname').textContent = "";
    }

    if (!email) {
        form.querySelector('.error-email').textContent = "Vui lòng nhập email!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        form.querySelector('.error-email').textContent = "Email không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else {
        form.querySelector('.error-email').textContent = "";
    }

    if (!phone) {
        form.querySelector('.error-phone').textContent = "Vui lòng nhập số điện thoại!";
        if (validate) {
            validate = false;
            form.querySelector('.phone').focus();
        }
    } else if (!/(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/.test(phone)) {
        form.querySelector('.error-phone').textContent = "Số điện thoại không hợp lệ không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.phone').focus();
        }
    } else {
        form.querySelector('.error-phone').textContent = "";
    }

    if (!password) {
        form.querySelector('.error-password').textContent = "Vui lòng nhập mật khẩu!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else if (password.length < 6) {
        form.querySelector('.error-password').textContent = "Mật khẩu ít nhất 6 kí tự!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else {
        form.querySelector('.error-password').textContent = "";
    }

    if (!confirm_password) {
        form.querySelector('.error-confirm_password').textContent = "Vui lòng xác nhận mật khẩu!";
        if (validate) {
            validate = false;
            form.querySelector('.confirm_password').focus();
        }
    } else if (confirm_password != password) {
        form.querySelector('.error-confirm_password').textContent = "Mật khẩu nhập lại không trùng khớp!";
        if (validate) {
            validate = false;
            form.querySelector('.confirm_password').focus();
        }
    } else {
        form.querySelector('.error-confirm_password').textContent = "";
    }

    if (validate) {
        showErr.textContent = "Vui lòng đợi...";
        showErr.classList.remove('hidden');
        let data = new URLSearchParams();
        data.append('fullname', fullname);
        data.append('email', email);
        data.append('phone', phone);
        data.append('password', password);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/post_register", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        if (jsonData['check']) {
            resetFormRegister();
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }
    } else {
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        showErr.classList.remove('hidden');
    }
}

const checkForgot = async () => {
    const form = document.querySelector(".container-form-forgot");
    const showErr = form.querySelector('.alert-danger');
    const email = form.querySelector('.email').value.trim();
    let validate = true;

    if (!email) {
        form.querySelector('.error-email').textContent = "Vui lòng nhập email!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        form.querySelector('.error-email').textContent = "Email không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else {
        form.querySelector('.error-email').textContent = "";
    }

    if (validate) {
        showErr.textContent = "Vui lòng đợi...";
        showErr.classList.remove('hidden');
        let data = new URLSearchParams();
        data.append('email', email);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/post_forgot", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        if (jsonData['check']) {
            resetFormForgot();
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }
    } else {
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        showErr.classList.remove('hidden');
    }
}

function sweetConfirm(title, message, callback) {
    Swal.fire({
        title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý!'
    }).then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}


const onLogout = async () => {
    sweetConfirm('Đăng xuất?', 'Bạn có chắc chắn muốn đăng xuất!', async function (confirmed) {
        if (confirmed) {
            let data = new URLSearchParams();
            let host_root = "";
            if (document.querySelector('.url_hoot_root')) {
                host_root = document.querySelector('.url_hoot_root').value;
            }
            let response = await fetch(host_root + "/auth/logout", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: data.toString()
            })
            location.reload();
        }
    });

}

const handleSubcribe = async (event) => {
    document.querySelector('.success-subcribe').textContent = "";
    event.preventDefault();
    let subcribe = document.querySelector('.subcribe').value;
    let validate = true;
    if (!subcribe) {
        document.querySelector('.error-subcribe').textContent = "Vui lòng nhập vào email!";
        validate = false;
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(subcribe)) {
        document.querySelector('.error-subcribe').textContent = "Email không hợp lệ!";
        validate = false;
    } else {
        document.querySelector('.error-subcribe').textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('email', subcribe);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/contact/subcribe", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        document.querySelector('.error-subcribe').textContent = "";
        document.querySelector('.success-subcribe').textContent = jsonData['msg'];
        document.querySelector('.subcribe').value = "";

        Swal.fire({
            position: 'center',
            icon: jsonData['type'],
            title: jsonData['msg'],
            showConfirmButton: false,
            timer: 1500
        })
    } else {
        Swal.fire({
            position: 'center',
            icon: "error",
            title: "Vui lòng kiểm tra lại dữ liệu!",
            showConfirmButton: false,
            timer: 1500
        })
    }
}

const sendMessage = async (event) => {
    event.preventDefault();
    let showErr = document.querySelector('.alert-contact');
    let name = document.querySelector('.name-contact').value;
    let email = document.querySelector('.email-contact').value;
    let message = document.querySelector('.message').value;
    console.log(message);

    let validate = true;
    if (!name) {
        document.querySelector('.error-name-contact').textContent = "Vui lòng nhập vào họ tên!";
        validate = false;
    } else if (name.length < 6) {
        document.querySelector('.error-name-contact').textContent = "Họ tên ít nhất 6 kí tự!";
        validate = false;
    } else {
        document.querySelector('.error-name-contact').textContent = "";
    }

    if (!email) {
        document.querySelector('.error-email-contact').textContent = "Vui lòng nhập vào email!";
        validate = false;
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        document.querySelector('.error-email-contact').textContent = "Email không hợp lệ!";
        validate = false;
    } else {
        document.querySelector('.error-email-contact').textContent = "";
    }

    if (!message) {
        document.querySelector('.error-message').textContent = "Vui lòng nhập vào lời nhắn!";
        validate = false;
    } else if (message.length < 10) {
        document.querySelector('.error-message').textContent = "Lời nhắn ít nhất 10 kí tự!";
        validate = false;
    } else {
        document.querySelector('.error-message').textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('name', name);
        data.append('email', email);
        data.append('message', message);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/contact/send", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        document.querySelector('.name-contact').value = "";
        document.querySelector('.email-contact').value = "";
        document.querySelector('.message').value = "";
        if (jsonData['check']) {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
            Swal.fire({
                position: 'center',
                icon: "success",
                title: jsonData['msg'],
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
            Swal.fire({
                position: 'center',
                icon: "error",
                title: jsonData['msg'],
                showConfirmButton: false,
                timer: 1500
            })
        }

    } else {
        showErr.classList.remove('hidden');
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu!";
        Swal.fire({
            position: 'center',
            icon: "error",
            title: "Vui lòng kiểm tra lại dữ liệu!",
            showConfirmButton: false,
            timer: 1500
        })
    }
}

async function fetchCountReview() {
    let data = new URLSearchParams();
    let host_root = "";
    if (document.querySelector('.url_hoot_root')) {
        host_root = document.querySelector('.url_hoot_root').value;
    }

    let response = await fetch(host_root + "/admin/reviews/get_quantity", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    })
    let jsonData = await response.json();

    const items = document.querySelectorAll(".count-review");
    items.forEach(item => item.textContent = jsonData['quantity']);
}

// fetch data pagination
async function fetchData(page) {
    let data = new URLSearchParams();
    data.append('page', page);
    let url_module = document.querySelector('.url_module').value + '/phan_trang';

    let response = await fetch(url_module, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    })
    let jsonData = await response.json();
    document.querySelector('.fetch-data-table').innerHTML = jsonData; // outputs an array of user objects
    groupBtnPage = document.querySelectorAll('.btn-page');
    groupBtnPage.forEach(item => {
        const btn = item.querySelector('a');
        if (btn.textContent != page) {
            btn.classList.remove('active');
        } else {
            btn.classList.add('active');
        }
    })

    await fetchCountReview();
}

async function fetchPagination(page) {
    let data = new URLSearchParams();
    data.append('page', page);

    let url_module = document.querySelector('.url_module').value + '/pagination';

    let response = await fetch(url_module, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data.toString()
    })
    let jsonData = await response.json();

    document.querySelector('.fetch-pagination').innerHTML = jsonData; // outputs an array of user objects
    groupBtnPage = document.querySelectorAll('.btn-page');
    groupBtnPage.forEach(item => {
        const btn = item.querySelector('a');
        item.onclick = (e) => {
            e.preventDefault();
            let page = btn.textContent;
            fetchData(page);
        }
    })
}

if (document.querySelector('.url_module')) {
    fetchPagination(1)
    fetchData(1)
}

const onSubmitReview = async (event) => {
    event.preventDefault();
    const showErr = document.querySelector('.alert-review');
    const form = document.querySelector('#review_form');
    const name = form.querySelector('#review_name').value;
    const email = form.querySelector('#review_email').value;
    const message = form.querySelector('#review_message').value;

    const error_review_name = document.querySelector('.error-review_name');
    const error_review_email = document.querySelector('.error-review_email');
    const error_review_message = document.querySelector('.error-review_message');

    let validate = true;
    if (!name) {
        error_review_name.textContent = "Vui lòng nhập vào họ tên!";
        validate = false;
    } else if (name.length < 6) {
        error_review_name.textContent = "Họ tên ít nhất 6 kí tự!";
        validate = false;
    } else {
        error_review_name.textContent = "";
    }

    if (!email) {
        error_review_email.textContent = "Vui lòng nhập vào email!";
        validate = false;
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        error_review_email.textContent = "Email không hợp lệ!";
        validate = false;
    } else {
        error_review_email.textContent = "";
    }

    if (!message) {
        error_review_message.textContent = "Vui lòng nhập vào lời nhắn!";
        validate = false;
    } else if (message.length < 10) {
        error_review_message.textContent = "Lời nhắn ít nhất 10 kí tự!";
        validate = false;
    } else {
        error_review_message.textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('name', name);
        data.append('email', email);
        data.append('message', message);

        let count_star = form.querySelector('.user_star_rating').querySelectorAll('.fa-star');
        data.append('star', count_star.length);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/contact/send_review", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();

        document.querySelector('#review_name').value = "";
        document.querySelector('#review_email').value = "";
        document.querySelector('#review_message').value = "";
        showErr.textContent = jsonData['msg'];
        showErr.classList.remove('hidden');

        Swal.fire({
            position: 'center',
            icon: jsonData['type'],
            title: jsonData['msg'],
            showConfirmButton: false,
            timer: 1500
        })

        await fetchData(1);
        await fetchPagination(1);



    } else {
        showErr.classList.remove('hidden');
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu!";
        Swal.fire({
            position: 'center',
            icon: "error",
            title: "Vui lòng kiểm tra lại dữ liệu!",
            showConfirmButton: false,
            timer: 1500
        })
    }
}


async function onCheckout(event) {
    event.preventDefault();
    const form_checkout = document.querySelector('.checkout__form');

    const showErr = form_checkout.querySelector('.alert-checkout');
    const input_fullname = form_checkout.querySelector('.fullname-checkout');
    const input_address = form_checkout.querySelector('.address-checkout');
    const input_phone = form_checkout.querySelector('.phone-checkout');
    const input_note = form_checkout.querySelector('.note-checkout');

    const error_input_fullname = form_checkout.querySelector('.error-fullname-checkout');
    const error_input_address = form_checkout.querySelector('.error-address-checkout');
    const error_input_phone = form_checkout.querySelector('.error-phone-checkout');
    const error_input_note = form_checkout.querySelector('.error-note-checkout');

    let fullname = input_fullname.value;
    let address = input_address.value;
    let phone = input_phone.value;
    let note = input_note.value;

    let validate = true;
    if (!fullname) {
        error_input_fullname.textContent = "Vui lòng nhập vào họ tên!";
        validate = false;
    } else if (fullname.length < 6) {
        error_input_fullname.textContent = "Họ tên ít nhất 6 kí tự!";
        validate = false;
    } else {
        error_input_fullname.textContent = "";
    }

    if (!phone) {
        error_input_phone.textContent = "Vui lòng nhập số điện thoại!";
        validate = false;
    } else if (!/(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/.test(phone)) {
        error_input_phone.textContent = "Số điện thoại không hợp lệ không hợp lệ!";
        validate = false;
    } else {
        error_input_phone.textContent = "";
    }


    if (!address) {
        error_input_address.textContent = "Vui lòng nhập vào địa chỉ!";
        validate = false;
    } else if (address.length < 10) {
        error_input_address.textContent = "Địa chỉ ít nhất 10 kí tự!";
        validate = false;
    } else {
        error_input_address.textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('fullname', fullname);
        data.append('phone', phone);
        data.append('address', address);
        data.append('note', note);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/checkout/themHoaDon", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: jsonData['msg'],
            showConfirmButton: false,
            timer: 1500
        })
        setTimeout(() => {
            location.assign('cart');
        }, 1500);

    } else {
        showErr.classList.remove('hidden');
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu!";
    }
}


function clickCartLogout(event) {
    event.preventDefault();
    onFormLogin();
}


