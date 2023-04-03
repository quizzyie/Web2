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
  for (var i = 0; i < sizes.length; i++) {
    if (sizes[i].checked) {
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

function giaoDienSanPham(products, htmlSize) {
  var html = "";
  products.forEach(function (product) {
    html += `<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
      <a class="link-product" href="${HOST_ROOT}/chi-tiet">
        <div class="product__item__pic set-bg" style="background-image: url('${HOST_ROOT}/uploads/${product.img}');"  >
        
        <?php if($sp["type"]!="normal"){  ?>
          <span class="label"><?php echo $sp["type"]  ?></span>

          <?php }  ?>
          if(product.type!="normal") {
            <span class="label">product.type</span>
          }
        
          <ul class="product__hover">
            <li><a href="#"><img src="${HOST_ROOT}/public/assets/client/img/icon/heart.png" alt=""></a></li>
            <li><a href="#"><img src="${HOST_ROOT}/public/assets/client/img/icon/compare.png" alt=""> <span>Compare</span></a></li>
            <li><a href="#"><img src="${HOST_ROOT}/public/assets/client/img/icon/search.png" alt=""></a></li>
          </ul>
        </div>
      </a>
      <div class="product__item__text">
        <h6>${product.name}</h6>
        <a href="detail?idsp=${product.id} " class="add-cart" data-product-id=${product.id}>+ SEE DETAIL</a>
        <div class="rating">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <h5>$${product.sale}</h5>
        
      </div>
    </div>
  </div>`;
  });
  gdsp.innerHTML = html;
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
      giaoDienSanPham(products); //In ra giao dien San Pham
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
      showSlg.innerHTML = `<p id="showslg">Showing ${vtt + 1} – ${trang} of ${
        data.tongsp
      } results</p>`;
      // console.log(data);
      // console.log(htmlTrang);
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
    alert("Can chon size truoc khi dat hang");
  } else {
    // Get the selected quantity
    let selectedQuantity =
      document.querySelector("#quantity_value").textContent;

    // //fetch nè
    const currentUrl = HOST_ROOT;
    const relativeUrl = "/cartcontroller/themVaoGio";
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
          alert(data.error);
        } else if (data.login) {
          onLogin();
        } else {
          alert("Them san pham thanh cong");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  //Remove
}
function remove(idsp, idSize) {
  const currentUrl = HOST_ROOT;
  const relativeUrl = "/cartcontroller/xoaSanPham";
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
        alert("Xoa San Pham thanh cong");
        giaoDienGioHang(data.dsgh);
        let tongTien = document.getElementById("tongTienGH");
        tongTien.innerHTML = data.tt;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function giaoDienGioHang(dsgh) {
  let html = "";
  dsgh.forEach(function (sp) {
    html += `<tr>
    <td class="product__cart__item">
        <div class="product__cart__item__pic">
            <img src="img/shopping-cart/cart-1.jpg" alt="">
        </div>
        <div class="product__cart__item__text">
            <h6>${sp.tensp}</h6>
            <h5>${sp.sale}</h5>
        </div>
    </td>
    <td class="quantity__item">
        <div class="quantity">
          
            <div class="pro-qty-2">
            <span class="fa fa-angle-left dec qtybtn"></span>
              <input id="slg" type="text" value="${sp.tsl}">
            <span class="fa fa-angle-right inc qtybtn"></span>
            </div>
        </div>
    </td>
    <td class="cart__price">$${sp.sale * sp.tsl}</td>
    <td>${sp.size}</td>
    <td onclick="remove(${sp.product_id},${sp.idSize})" class="cart__close"><i
            class="fa fa-close"></i></td>

  </tr>`;
  });

  gdgh = document.getElementById("dsgh");
  gdgh.innerHTML = html;
}

function updateCart() {
  let dsspgh = document.querySelectorAll(".ghsp");
  const currentUrl = HOST_ROOT;
  const relativeUrl = "/cartcontroller/capNhatSanPham";
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
        alert("Cap Nhat thanh cong");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
