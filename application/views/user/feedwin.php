<div id="lData" data-toiuser="<?=$this->data->iuser?>"></div>
<div class="d-flex flex-column align-items-center">
    <div class="size_box_100"></div>
    <div class="w100p_mw614">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column justify-content-center">
                <a href="#" id="btnChangePPModal" data-bs-toggle="modal" data-bs-target="#profileImgModal">
                    <div class="circleimg h150 w150 pointer feedwin">
                        <img class="profileimg" src='/static/img/profile/<?= $this->data->iuser ?>/<?= $this->data->mainimg ?>' onerror='this.error=null;this.src="/static/img/profile/sad.jpg"'>
                    </div>
                </a>
            </div>
            <?php
            // $isMyFeed = $this->data->iuser === getIuser() ? true : false;
            $youme = $this->data->youme;
            $meyou = $this->data->meyou;
            ?>
            <div class="flex-grow-1 d-flex flex-column justify-content-evenly">
                <div>
                    <?php $email = $this->data->email;
                    $email_array = explode('@', $email);
                    echo $email_array[0];
                    ?>
                <!-- </div> -->
                <!-- <button type="button" id="btnModProfile" class="btn btn-outline-secondary <?= $isMyFeed ? "" : "d-none" ?>">Profile edit</button>
                            <button type="button" id="btnFollow" data-follow="0" class="btn btn-outline-primary <?= $youme & !$meyou ? "" : "d-none" ?> ">Follow Back</button>
                            <button type="button" id="btnFollow" data-follow="0" class="btn btn-outline-primary <?= !$youme & !$meyou & !getIuser() ? "" : "d-none" ?> ">Follow</button>
                            <button type="button" id="btnFollow" data-follow="1" class="btn btn-outline-secondary <?= $meyou ? "" : "d-none" ?> ">Unfollow</button> -->

                <!-- solve -->
                <?php
                if ($this->data->iuser === getIuser()) {
                    echo '<button type="button" id="btnModProfile" class="btn btn-outline-secondary">프로필 수정</button>';
                } else {
                    $data_follow = 0;
                    $cls = "btn-primary";
                    $txt = "Follow";

                    if ($this->data->meyou === 1) {
                        $data_follow = 1;
                        $cls = "btn-outline-secondary";
                        $txt = "Unfollow";
                    } else if ($this->data->youme === 1 && $this->data->meyou === 0) {
                        $txt = "Follow Back";
                    }
                    echo "<button type='button' id='btnFollow' data-youme='{$this->data->youme}' data-follow='{$data_follow}' class='btn {$cls}'>{$txt}</button>";
                }
                ?>
                </div>

                <div class="d-flex flex-row">
                    <div class="flex-grow-1">Posts <span><?= $this->data->feedCnt?></span></div>
                    <div class="flex-grow-1">Followers <span id="spanCntFollower"><?= $this->data->follower?></span></div>
                    <div class="flex-grow-1">Following <span><?= $this->data->following?></span></div>
                </div>
                <div class="bold"><?= $this->data->nm ?></div>
                <div><?= $this->data->cmt ?></div>
            </div>
        </div>
        <div id="item_container"></div>
    </div>
    <div class="loading d-none"><img src="/static/img/loading.gif"></div>
</div>

<!-- update pp modal -->
<div class="modal fade" id="profileImgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w430">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title text-center" tabindex="-1">Change Profile Pic</h5>
            </div>
            <div class="p-0 modal-body text-center" id="id-modal-body">
                <button class="pointer text-primary bg-white pt-3" id="btnUpdProfilePic">Choose from library</button>
                <hr>
                <button class="pointer text-danger bg-white c_error-or-destructive" id="btnDelCurrentProfilePic">Remove current pic</button>
                <hr>
                <button class="pointer text-muted bg-white pb-3 " data-bs-dismiss="modal" id="btnProfileImgModalClose">Cancel</button>
            </div>
        </div>
        <form class="d-none">
            <input type="file" accept="image/*" name="imgs">
        </form>
    </div>

</div>