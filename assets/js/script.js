// document.addEventListener('DOMContentLoaded', () => {
//   // let nav = document.querySelector("nav");
//   // window.onscroll = function() {
//   //   if(document.documentElement.scrollTop > 20){
//   //     nav.classList.add("sticky");
//   //   }else {
//   //     nav.classList.remove("sticky");
//   //   }
//   // }

//   const report = document.querySelector("#report");
//   const reportModal = document.querySelector("#report-modal");

//   const closereport = document.querySelector("#report-close");

//   report.addEventListener('click', (e) => {
//     e.preventDefault();
//     reportModal.style.display = 'block';
//   });

//   closereport.addEventListener('click', (e) => {
//     reportModal.style.display = 'none';
//   });

//   window.addEventListener('click', (e) => {
//     if(e.target == reportModal)
//     {
//       reportModal.style.display = 'none';
//     }
//     else
//     {
//       return false;
//     }
//   });
// });