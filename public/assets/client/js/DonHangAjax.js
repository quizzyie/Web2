function giaoDienHoaDon(dshd) {
  var html = ``;

  dshd.forEach(function (dh) {
    let huyDHButton = "";
    if (dh.ttDH == 1 || dh.ttDH == 2) {
      huyDHButton =
        '<button onclick="huyDonHang(event)" type="button" class="btn btn-primary" style="margin-right:12px">Hủy đơn hàng</button>';
    }

    html += `<tr>
    <td>
        <div class="d-flex align-items-center">
            <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt=""
                style="width: 45px; height: 45px" />
            <div class="ms-3">
                <p class="fw-bold mb-1">${dh.tenNN}</p>
                <p class="text-muted mb-0">${dh.sdt}</p>
            </div>
        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">${dh.diaChi}</p>
    </td>
    <td>
        <p class="mb-1">${dh.dateOrder} </p>
    </td>
    <td> ${dh.tt}</td>
    <td>${dh.tongBill}</td>

    <td>
    ${huyDHButton}
        <a href="purchase_Order_Detail?idhd=${dh.idDH}">Detail</a>
        <input class="idDH" type="hidden" value="${dh.idDH}">
    </td>
</tr>`;
  });
  return html;
}

function huyDonHang(event) {
  var target = event.target;
  var idDH = target.parentNode.querySelector(".idDH").value;

  const currentUrl = HOST_ROOT;
  const relativeUrl = "/Purchase_Order/huyDonHang";
  const fullUrl = currentUrl + relativeUrl;
  const data = {
    iddh: idDH,
  };
  console.log(idDH);

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
        var html = giaoDienHoaDon(data.dsdh);
        document.getElementById("xemLaiHoaDon").innerHTML = html;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
