let gdsp = document.getElementById("dsProducts");
let dsSoTrang = document.getElementById("soTrang");
const HOST_ROOT = document.querySelector(".url_hoot_root").value;
console.log(HOST_ROOT);
const categories = document.getElementsByName("categories");
const categoryValues = [];
const brands = document.getElementsByName("brands");
const brandValues = [];
const sizes = document.getElementsByName("sizes");
const sizeValues = [];
let listSize = document.querySelectorAll(".lblSize");
// Allo
const categoryCheckbox = document.querySelectorAll('input[name="categories"]');
for (var i = 0; i < categoryCheckbox.length; i++) {
  categoryCheckbox[i].addEventListener("change", filter);
}
const brandCheckbox = document.querySelectorAll('input[name="brands"]');
for (var i = 0; i < brandCheckbox.length; i++) {
  brandCheckbox[i].addEventListener("change", filter);
}
const sizeCheckbox = document.querySelectorAll('input[name="sizes"]');
for (var i = 0; i < sizeCheckbox.length; i++) {
  sizeCheckbox[i].addEventListener("change", filter);
}

function checkedCategories() {
  for (var i = 0; i < categories.length; i++) {
    if (categories[i].checked) {
      categoryValues.push(categories[i].value);
    }
  }
}
function checkedBrands() {
  for (var i = 0; i < brands.length; i++) {
    if (brands[i].checked) {
      brandValues.push(brands[i].value);
    }
  }
}

function checkSizes() {
  for (var i = 0; i < listSize.length; i++) {
    if (listSize[i].classList.contains("active")) {
      sizeValues.push(sizes[i].value);
    }
  }
}
function getValueofCheckBox() {
  categoryValues.splice(0, categoryValues.length);
  brandValues.splice(0, brandValues.length);
  sizeValues.splice(0, sizeValues.length);
  checkedBrands();
  checkedCategories();
  checkSizes();
}

function printRadioSize(dsSizes) {
  let html = "";
  let defaultSize = 1;
  dsSizes.forEach((s) => {
    if (s.id == defaultSize) {
      html += `<label>
      <input type="radio" name="product__size" value="${s.id}" checked> ${s.name} 
      </label>`;
    } else {
      html +=
        `<label>
      <input type="radio" name="product__size" value="${s.id}">` +
        "  " +
        ` ${s.name}` +
        "  " +
        ` </label>`;
    }
  });
  return html;
}

function giaoDienSanPham(products, dsStar, dsSlgBan) {
  var html = "";
  let k = 0;
  if (products.length == 0) {
    let img = HOST_ROOT + "/uploads/khongcosanpham.png";
    html += "<div class='shopee-search-empty-result-section'> <img src='" + img + "' class='shopee-search-empty-result-section__icon'><div class='shopee-search-empty-result-section__title'>Không tìm thấy kết quả nào</div><div class='shopee-search-empty-result-section__hint'>Hãy thử sử dụng các từ khóa chung chung hơn</div></div>";
  } else {
    products.forEach(function (product) {
      html +=
        `<div class="col-lg-4 col-md-6 col-sm-6">
      <div class="product__item">
        <a href="detail?idsp=${product.id}" data-product-id="${product.id}">
          <div class="product__item__pic set-bg" style="background-image: url('${HOST_ROOT}/uploads/${product.img
        }');"  >
          
          ${product.type !== "normal"
          ? '<span class="label">' + product.type + "</span>"
          : ""
        // Hien thi type
        } 
          
          </div>
        </a>
        
        <div class="product__item__text">
        <h6>
        ${product.name} <br>
        So Luong Da Ban: ` +
        dsSlgBan[k] +
        `
      </h6>
      <a href="detail?idsp=${product.id} " class="add-cart" data-product-id=${product.id}>+ SEE DETAIL</a>
          <div class="rating">` +
        dsStar[k++] +
        `
          </div>
          <div class="product-price">
          ${product.sale < product.price
          ? `
          <div style="display: flex;">
            <del class="del-product">$${product.price}</del>
            <h5>$${product.sale}</h5>
          </div>
        `
          : `
          <h5>$${product.price}</h5>
        `
        }
      </div>
          
          
        </div>
        
        
      </div>
    </div>`;
    });
  }

  gdsp.innerHTML = html;
}

function gdSao(dsSao) {
  let htmlSao = [];
  for (i = 0; i < dsSao.length; i++) {
    htmlSao[i] = "";
    for (j = 1; j <= 5; j++) {
      if (j <= dsSao[i]) {
        htmlSao[i] += `<i class="fa fa-star" aria-hidden="true"></i> `;
      } else {
        htmlSao[i] += `<i class="fa fa-star-o" aria-hidden="true"></i> `;
      }
    }
  }
  return htmlSao;
}

function filter(vtt) {
  if (typeof vtt === "object") {
    vtt = "0";
  }

  const currentUrl = HOST_ROOT;
  const relativeUrl = "/shop/filter";
  const fullUrl = currentUrl + relativeUrl;
  let search = document.getElementById("search").value;
  let sort = document.getElementById("sort").value;
  getValueofCheckBox(); //Lay gia tri cac checkBox

  // select the input fields
  let minInput = document.querySelector(".input-min");
  let maxInput = document.querySelector(".input-max");

  // get their values
  let minValue = minInput.value;
  let maxValue = maxInput.value;

  const data = {
    trang: vtt,
    category: categoryValues,
    brand: brandValues,
    size: sizeValues,
    text: search,
    sort: sort,
    min: minValue,
    max: maxValue,
  };
  console.log(fullUrl + "  +  " + search);

  fetch(fullUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      var products = data.ds;
      var dsSlgBan = data.dsSlgBan;
      let htmlSao = gdSao(data.dsStar);

      giaoDienSanPham(products, htmlSao, dsSlgBan); //In ra giao dien San Pham
      var trang = data.soTrang;
      var htmlTrang = "";
      for (let i = 1; i <= trang; i++) {
        if (i == vtt + 1) {
          htmlTrang += `<a class="active" onclick="filter(${i - 1})">${i}</a>`;
        } else {
          htmlTrang += `<a  onclick="filter(${i - 1})">${i}</a>`;
        }
      }
      let showSlg = document.getElementById("showslg");
      showSlg.innerHTML = `<p id="showslg">Showing ${Number(vtt) + 1
        } – ${trang} of ${data.tongsp} results</p>`;
      // console.log(data);
      // console.log(htmlTrang);
      console.log(data.dsStar[1]);
      dsSoTrang.innerHTML = htmlTrang;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Giỏ Hàng
function activeSize() {
  document.addEventListener("DOMContentLoaded", function () {
    let sizeCustom = document.querySelectorAll(".size-custom");
    for (let i = 0; i < sizeCustom.length; i++) {
      sizeCustom[i].addEventListener("click", function () {
        for (let j = 0; j < sizeCustom.length; j++) {
          sizeCustom[j].classList.remove("active");
        }
        sizeCustom[i].classList.add("active");
        sendSlgSp();
      });
    }
  });
}
activeSize();
function addToCart(idsp) {
  // const sizeOptions = document.querySelectorAll(
  //   '.product__details__option__size input[type="radio"]'
  // );
  // let selectedSize = "";

  // sizeOptions.forEach((option) => {
  //   if (option.classList.contains("active")) {
  //     selectedSize = option.value;
  //     console.log(selectedSize);
  //   }
  // });
  let sizeCustom = document.querySelectorAll(".size-custom");
  let selectedSize = 0;
  sizeCustom.forEach((size) => {
    let radio = size.querySelector('input[type="radio"]');
    if (size.classList.contains("active")) {
      selectedSize = radio.value;
    }
  });

  if (selectedSize == 0) {
    Swal.fire({
      position: "top",
      icon: "error",
      title: "CẦN CHỌN SIZE TRƯỚC KHI ĐẶT HÀNG",
      showConfirmButton: true,
    });
  } else {
    // Get the selected quantity
    let selectedQuantity =
      document.querySelector("#quantity_value").textContent;

    // //fetch nè
    const currentUrl = HOST_ROOT;
    const relativeUrl = "/cart/themVaoGio";
    const fullUrl = currentUrl + relativeUrl;

    const data = {
      idsp: idsp,
      slm: selectedQuantity,
      idSize: selectedSize,
    };

    fetch(fullUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: data.error,
          });
        } else if (data.login) {
          onLogin();
        } else {
          document.getElementById("checkout_items").innerHTML = data.soSpTGh;
          Swal.fire({
            position: "center",
            icon: "success",
            title: "THÊM SẢN PHẨM THÀNH CÔNG",
            showConfirmButton: false,
            timer: 1000,
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  //Remove
}
function remove(idsp, idSize) {
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to remove it!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      const currentUrl = HOST_ROOT;
      const relativeUrl = "/cart/xoaSanPham";
      const fullUrl = currentUrl + relativeUrl;
      const data = {
        idsp: idsp,
        idSize: idSize,
      };
      fetch(fullUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else {
            document.getElementById("checkout_items").innerHTML = data.soSpTGh;
            giaoDienGioHang(data.dsgh);
            let tongTien = document.getElementById("tongTienGH");
            tongTien.innerHTML = data.tt;
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
      Swal.fire("Deleted!", "Your file has been deleted.", "success");
    }
  });
}

function giaoDienGioHang(dsgh) {
  let html = "";
  dsgh.forEach(function (sp) {
    html +=
      `<tr class="ghsp">
    <td class="product__cart__item">
        <div class="product__cart__item__pic">
            <img src="${HOST_ROOT}/uploads/${sp.image}" alt="">
        </div>
        <a href="detail?idsp=${sp.idsp}">
        <div class="product__cart__item__text">
            <h6>${sp.tenSp}` +
      " - " +
      sp.tenSize +
      `</h6>
      </a>
            <h5>${sp.giaSp}</h5>
        </div>
    </td>
    <td class="quantity__item">
        <div class="quantity">
          
            <div class="pro-qty-2">
            <span onclick="giamSlgMua(event)" class="fa fa-angle-left giam qtybtn"></span>
              <input  class="slg"  type="text" value="${sp.slm}">
              <input class="giaSp" type="hidden" value="${sp.giaSp}">
            <span onclick="tangSlgMua(event, ${sp.slgSp
      })" class="fa fa-angle-right tang qtybtn"></span>
            </div>
            <input class="idsp" type="hidden" value="${sp.idsp}">
            <input class="idsize" type="hidden" value="${sp.idSize}">
        </div>
    </td>
    <td  class="cart__price">$${sp.giaSp * sp.slm}</td>
      
        
    <td>${sp.tenSize}</td>
    <td onclick="remove(${sp.idsp},${sp.idSize})" class="cart__close"><i
            class="fa fa-close"></i></td>

  </tr>`;
  });

  gdgh = document.getElementById("dsgh");
  gdgh.innerHTML = html;
}

function updateCart() {
  Swal.fire({
    title: "Do you want to save the changes?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Save",
    denyButtonText: `Don't save`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      let dsspgh = document.querySelectorAll(".ghsp");
      const currentUrl = HOST_ROOT;
      const relativeUrl = "/cart/capNhatSanPham";
      const fullUrl = currentUrl + relativeUrl;

      let idspArray = [];
      let tslArray = [];
      let sizeArray = [];

      for (i = 0; i < dsspgh.length; i++) {
        let sp = dsspgh[i];
        let idsp = sp.querySelector(".idsp").value;
        let tsl = sp.querySelector(".slg").value;
        let size = sp.querySelector(".idsize").value;

        console.log(
          "Lan " +
          i +
          " co idsp la: " +
          idsp +
          " va tsl la: " +
          tsl +
          "  va size la " +
          size
        );
        idspArray.push(idsp);
        tslArray.push(tsl);
        sizeArray.push(size);
      }
      const data = {
        dsidsp: idspArray,
        dstsl: tslArray,
        dssize: sizeArray,
      };
      fetch(fullUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else {
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
      Swal.fire("Saved!", "", "success");
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
}

//Tang Giam So Luong Mua
let tang = document.querySelectorAll(".tang");
function tangSlgMua(event, max) {
  let slm = event.target.parentNode.querySelector(".slg");
  let gia1Sp = event.target.parentNode.querySelector(".giaSp").value;
  let giaSp = event.target.parentNode.parentNode.parentNode.nextElementSibling;
  console.log(parseInt(giaSp.innerHTML.replace("$", "")) + max);
  if (slm.value < max) {
    slm.value = parseInt(slm.value) + 1;
  }

  giaSp.innerHTML = "$" + parseInt(slm.value) * parseInt(gia1Sp);
  tongTien();
}
function giamSlgMua(event) {
  let slm = event.target.parentNode.querySelector(".slg");
  let gia1Sp = event.target.parentNode.querySelector(".giaSp").value;
  let giaSp = event.target.parentNode.parentNode.parentNode.nextElementSibling;
  console.log(parseInt(giaSp.innerHTML.replace("$", "")));
  if (slm.value > 1) {
    slm.value = parseInt(slm.value) - 1;
  }

  giaSp.innerHTML = "$" + parseInt(slm.value) * parseInt(gia1Sp);
  tongTien();
}

function tongTien() {
  let tt = document.getElementById("tongTienGH");
  let dsgh = document.querySelectorAll(".ghsp");
  let total = 0;
  for (let i = 0; i < dsgh.length; i++) {
    const sp = dsgh[i];
    let gia = sp.querySelector(".giaSp").value;
    let slg = sp.querySelector(".slg").value;
    total += gia * slg;
  }
  tt.innerHTML = "$" + total;
}

function sendSlgSp() {
  let sizeCustom = document.querySelectorAll(".size-custom");
  let selectedSize = 0;
  document.getElementById("quantity_value").innerHTML = 1;
  sizeCustom.forEach((size) => {
    let radio = size.querySelector('input[type="radio"]');
    if (size.classList.contains("active")) {
      selectedSize = radio.value;
    }
  });
  console.log(selectedSize);
  const currentUrl = HOST_ROOT;
  const relativeUrl = "/Detail/getSoLuong";
  const fullUrl = currentUrl + relativeUrl;
  let idsp = document.getElementById("idspTemp").value;
  const data = {
    idsp: idsp,
    idSize: selectedSize,
  };

  fetch(fullUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        alert(data.error);
      } else if (data.login) {
        onLogin();
      } else {
        document.getElementById("slgSpTD").innerHTML = +data.slg;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function phanTrangReview(vtt) { }
