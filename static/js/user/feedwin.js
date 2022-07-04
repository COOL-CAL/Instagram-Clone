function getFeedList() {
    if(!feedObj) { return; }
    feedObj.showLoading();            
    const param = {
        page: feedObj.currentPage++
    }
    fetch('/user/feed' + encodeQueryString(param))
    .then(res => res.json())
    .then(list => {                
        feedObj.makeFeedList(list);                
    })
    .catch(e => {
        console.error(e);
        feedObj.hideLoading();
    });
}
getFeedList();

(function() {
    const gData = document.querySelector('#gData');

    const btnFollow = document.querySelector('#btnFollow');
    if(btnFollow) {
        btnFollow.addEventListener('click', function() {
            const param = {
                toiuser: parseInt(gData.dataset.toiuser)
            };
            console.log(param);
            const follow = btnFollow.dataset.follow;
            console.log('follow : ' + follow);
            const followUrl = '/user/follow';
            switch(follow) {
                case '1' : //unfollow
                    fetch(followUrl + encodeQueryString(param), {method: 'DELETE'})
                    .then(res => res.json())
                    .then(res => {
                        if(res.result) {
                            btnFollow.dataset.follow = '0';
                            btnFollow.classList.remove('btn-outline-secondary');
                            btnFollow.classList.add('btn-primary');
                            if(btnFollow.dataset.youme === '1'){
                                btnFollow.innerText = 'Follow Back';
                            } else {
                                btnFollow.innerText = 'Follow';
                            }
                        }
                    
                    });
                    break;
                case '0' : //follow
                    fetch(followUrl, {
                        method: 'POST',
                        body: JSON.stringify(param)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.result) {
                            btnFollow.dataset.follow = '1';
                            btnFollow.classList.remove('btn-primary');
                            btnFollow.classList.add('btn-outline-secondary');
                            btnFollow.innerText = 'Unfollow';
                        }
                    })
                    break;
            }
        });
    }
})();