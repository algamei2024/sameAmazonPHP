let befor = document.querySelector(".shows>div> .befor");
let scrol = document.getElementsByClassName("newShows")[0];
befor.addEventListener("click", function () {
    let cop = scrol.firstElementChild.cloneNode(true);
    scrol.firstElementChild.remove();
    scrol.appendChild(cop);
});
let after = document.querySelector(".shows>div> .after");
after.onclick = function () {
    let cop = scrol.lastElementChild.cloneNode(true);
    scrol.lastElementChild.remove();
    scrol.firstElementChild.before(cop);
    
    
}
let f = 0;
let sign = document.getElementById("sign");
sign.addEventListener("click", function () {
    window.location.href = "sign.php";
});
// document.querySelector(".prof").addEventListener("click", (e) => {
//         console.log("aldal");
//         document.body.innerHTML += ` <div class="profile">
//                 <h1>الملف الشخصي</h1>
//                 <div>
//                     <span>اسم المستخدم</span>
//                     <span class="username"></span>
//                 </div>
//                 <div>
//                     <span>البريد الالكتروني </span>
//                     <span class="email"></span>
//                 </div>
//             </div>`;
// });
document.body.onload = function () {
    document.querySelector(".newShows").innerHTML = '';
    for (let i = 0; i < object.imgs.length; i++) {
        document.querySelector(".newShows").innerHTML += 
            `<a href='project.php?id=${object.id_cat[i]}' style="color:black"> <div class="mon" name = '${object.id_cat[i]}'>
                            <div><img src=${object.imgs[i]} alt=""></div>
                            <div>
                                <span>
                                   ${object.name_cat[i]}
                                </span>
                            </div>
                        </div></a>`;
    }
}