if(feedObj) {
    const url = new URL(location.href);
    feedObj.iuser = parseInt(url.searchParams.get('iuser'));
    feedObj.getFeedUrl = '/user/feed' ;
    feedObj.getFeedList();
}

(function() {
    const spanCntFollower = document.querySelector('#spanCntFollower');
    const lData = document.querySelector('#lData');
    const btnFollow = document.querySelector('#btnFollow');

    const modalProfileImg = document.querySelector('#profileImgModal');
    const frmProfileImg = modalProfileImg.querySelector('form');

    const btnUpdProfilePic = document.querySelector('#btnUpdProfilePic');
    const btnDelCurrentProfilePic = document.querySelector('#btnDelCurrentProfilePic');
    const btnProfileImgModalClose = document.querySelector('#btnProfileImgModalClose');

    if(btnFollow) {
        btnFollow.addEventListener('click', function() {
            const param = {
                toiuser: parseInt(lData.dataset.toiuser)
            };
            console.log(param);
            const follow = btnFollow.dataset.follow;
            console.log('follow : ' + follow);
            const followUrl = '/user/follow';
            switch(follow) {
                case '1': //팔로우 취소
                    fetch(followUrl + encodeQueryString(param), {method: 'DELETE'})
                    .then(res => res.json())
                    .then(res => {                        
                        if(res.result) {
                            //follower number change
                            const cntFollowerVal = parseInt(spanCntFollower.innerText);
                            spanCntFollower.innerText = cntFollowerVal - 1;

                            btnFollow.dataset.follow = '0';
                            btnFollow.classList.remove('btn-outline-secondary');
                            btnFollow.classList.add('btn-primary');
                            if(btnFollow.dataset.youme === '1') {
                                btnFollow.innerText = 'Follow Back';
                            } else {
                                btnFollow.innerText = 'Follow';
                            }                            
                        }
                    });
                    break;
                case '0': //팔로우 등록
                    fetch(followUrl, {
                        method: 'POST',
                        body: JSON.stringify(param)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.result) {
                            const cntFollowerVal = parseInt(spanCntFollower.innerText);
                            spanCntFollower.innerText = cntFollowerVal + 1;
                            btnFollow.dataset.follow = '1';
                            btnFollow.classList.remove('btn-primary');
                            btnFollow.classList.add('btn-outline-secondary');
                            btnFollow.innerText = 'Unfollow';
                        }
                    });
                    break;
            }
        });
    }

    if(btnUpdProfilePic) {
        btnUpdProfilePic.addEventListener('click', e => {
            frmProfileImg.imgs.click();
        });
    
        frmProfileImg.imgs.addEventListener('change', e => {
            if(e.target.files.length){
                const fData = new FormData();
                fData.append('profileImg', e.target.files[0]);
                fetch('/user/profile', {
                    method: 'POST',
                    body: fData
                })
                .then(res => res.json())
                .then(res => {
                    if(res.result) {
                        const gData = document.querySelector('#gData');
                        const profileImgList = document.querySelectorAll('.profileimg');
                        profileImgList.forEach(item => {
                            item.src = `/static/img/profile/${gData.dataset.loginiuser}/${res.fileNm}`;
                        });
                        btnProfileImgModalClose.click();
                    }
                })
            }
        })
        
    };

    if(btnDelCurrentProfilePic) {
        btnDelCurrentProfilePic.addEventListener('click', e => {
            fetch('/user/profile', { method: 'DELETE'})
            .then(res => res.json())
            .then(res => {
                if(res.result) {
                    const profileImgList = document.querySelectorAll('.profileimg');
                    profileImgList.forEach(item => {
                        item.src = '/static/img/profile/sad.jpg';
                    });
                }
                btnProfileImgModalClose.click();
            })
        });
    }

})();