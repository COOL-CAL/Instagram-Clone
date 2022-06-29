function encodeQueryString(params) {
    const keys = Object.keys(params);
    return keys.length
            ? "?" + keys.map(key => //map: 길이가 같은 새로운 배열 만들 때. 근데? 내용을 바꿔.
                                encodeURIComponent(key) + "=" +
                                encodeURIComponent(params[key])
                            ).join("&")
            : "";
}
// const feedObj = {
//     limit: 20,
//     itemLength: 0,
//     currentPage: 1,
//     loadingElem: document.querySelector('.loading'), // index.php class loading

//     getFeedList: function () {
//         this.showLoading();
//         const param = {
//             page: this.currentPage++
//         }
//         fetch('/feed/rest' + encodeQueryString(param))
//         .then(res => res.json())
//         .then(list => {
//             console.log(list);
//             this.hideLoading();
//         })
//         .catch(e => {
//             console.error(e);
//             this.hideLoading();
//         })
//         // const parent = this;
//         // setTimeout(() => {
//         //     parent.hideLoading();
//         // }, 1000);
//     },

//     showLoading: function () { this.loadingElem.classList.remove('d-none'); },
//     hideLoading: function () { this.loadingElem.classList.add('d-none'); }

// }

// feedObj.getFeedList();
