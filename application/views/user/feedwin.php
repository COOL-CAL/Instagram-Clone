<div class="d-flex flex-column align-items-center">
    <div class="size_box_100"></div>
    <div class="w100p_mw614">
        <div class="d-flex flex-row">            
                <div class="d-flex flex-column justify-content-center">
                    <a href="#" id="btnChangePPModal" data-bs-toggle="modal" data-bs-target="#changePPModal">
                        <div class="circleimg h150 w150 pointer feedwin">
                            <img src='/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>' onerror='this.error=null;this.src="/static/img/profile/sad.jpg"'>
                        </div>
                    </a>
                </div>
                <?php
                    $youme = $this->data->youme;
                    $meyou = $this->data->meyou;
                    ?>
                    <div class="flex-grow-1 d-flex flex-column justify-content-between">
                        <div><?=$this->data->email?>
                            <button type="button" id="btnModProfile" class="btn btn-outline-secondary <?=getIuser() === $this->data->loginiuser ? "" : "d-none"?>">Profile edit</button>
                            <button type="button" id="btnFollow" data-follow="0" class="btn btn-outline-primary <?= $youme & !$meyou ? "" : "d-none" ?> ">Follow Back</button>
                            <button type="button" id="btnFollow" data-follow="0" class="btn btn-outline-primary <?= !$youme & !$meyou & !getIuser() ? "" : "d-none" ?> ">Follow</button>
                            <button type="button" id="btnFollow" data-follow="1" class="btn btn-outline-secondary <?= $meyou ? "" : "d-none" ?> ">Unfollow</button>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="flex-grow-1">Posts <span>18 </span></div>
                            <div class="flex-grow-1">Followers <span>18 </span></div>
                            <div class="flex-grow-1">Following <span>18 </span></div>
                        </div>
                        <div class="bold"><?=$this->data->nm?></div>
                        <div><?=$this->data->cmt?></div>
                    </div>
                
                <!-- solve
                </?php
                    if($this->data->iuser === getIuser()) {
                        echo '<button type="button" id=btnModProfile" class="btn btn-outline-secondary">프로필 수정</button>';
                    } else {
                        $data_follow = 0;
                        $cls = "btn-primary";
                        $txt = "팔로우";

                        if($this->data->meyou === 1) {
                            $data_follow = 1;
                            $cls = "btn-outline-secondary";
                            $txt = "팔로우 취소";
                        } else if($this->data->youme === 1 && $this->data->meyou === 0) {
                            $txt = "맞팔로우 하기";
                        }
                        echo "<button type='button' id='btnFollow' data-follow='{$data_follow}' class='btn {$cls}'>{$txt}</button>";
                    }
                ?/> 
                -->
        </div>
    </div>
</div> 

<!-- change pp modal -->
<div class="modal fade" id="changePPModal" tabindex="-1" aria-labelledby="changePPModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w430">
            <div class="modal-content" id="changePPModalContent">
                <div class="modal-header d-block">
                    <h5 class="modal-title text-center" tabindex="-1" id="changePPModalLabel">Change Profile Pic</h5>
                </div>
                <div class="p-0 modal-body text-center" id="id-modal-body">
                    <button class="text-primary bg-white pt-3">Choose from library</button><hr>
                    <button class="text-danger bg-white">Remove current pic</button><hr>
                    <button class="text-muted bg-white pb-3">Cancel</button>
                </div>
            </div>
        </div>
        
</div>