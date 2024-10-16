document.getElementById("propertis").onclick = function () {
    let hid = document.querySelector(".hide");
    let prop = document.querySelector(".prop");
    let valprop = document.querySelector(".valprop");
    hid.value = hid.value + prop.value + ",";
    hid.value = hid.value + valprop.value + ",";
    console.log(`${prop.value} ${valprop.value}`);
    prop.value = "";
    valprop.value = "";
}
let sections = document.querySelectorAll("body>section");
let lists = document.querySelectorAll(".title li");
for (let i = 0; i < lists.length; i++) {
    lists[i].addEventListener("click", function () {
        for (let j = 1; j < sections.length; j++) {
            sections[j].style.display = "none";
        }
        sections[i + 1].style.display = "block";
    });
}