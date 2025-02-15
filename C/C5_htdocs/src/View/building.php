<div class="content_wrap">
    <div class="content_title">
        <div class="content_title_line"></div>
        <h2>시공 견적</h2>
    </div>

    <button data-target="#building_post_popup" data-toggle="modal" class="btn btn-primary float-right" id="building_btn">견적요청</button>
    <div class="content_box" id="building_post_list">
        <?php foreach($data[0] as $post):?>
            <?php $flag = true; if($_SESSION['user']->specialist == 1){foreach($data[1] as $request) if($request->post_id == $post->id) $flag = false;}?>
            <div class="card m-2">
                <div class="card-body building_post_card">
                <?php if($post->status == "requesting"):?>
                    <span class="badge badge-success float-right p-2">진행중</span>
                <?php else:?>
                    <span class="badge badge-secondary float-right p-2">완료</span>
                <?php endif;?>
                <h5 class="card-title"><?=$post->user_name?>(<?=$post->user_id?>)</h5>
                <p class="card-subtitle text-muted">시공일 : <?=$post->day?></p>
                <hr>
                <p class="card-text"><?=nl2br(htmlentities($post->content))?></p>
                <hr>
                <?php if($_SESSION['user']->id == $post->writer_id):?>
                    <button class="float-right btn btn-dark building_see_id_btn" data-target="#building_see_popup" data-toggle="modal" data-id="<?=$post->id?>">견적보기</button>
                <?php endif;?>
                <?php if($_SESSION['user']->specialist == 1 && $post->status == "requesting" && $flag):?>
                    <button class="float-right btn btn-primary building_request_id_btn" data-target="#building_request_popup" data-toggle="modal" data-id="<?=$post->id?>">견적 보내기</button>
                <?php endif;?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php if($_SESSION['user']->specialist == 1):?>
    <div class="content_wrap">
    <div class="content_title">
        <div class="content_title_line"></div>
        <h2>보낸 견적</h2>
    </div>

    <div class="content_box" id="building_request_list">
        <?php foreach($data[1] as $request):?>
            <div class="card m-2 building_request_card">
                <div class="card-body">
                    <?php if($request->status == "requesting"):?>
                        <span class="badge badge-success float-right p-2">진행중</span>
                    <?php elseif($request->status == "choose"):?>
                        <span class="badge badge-primary float-right p-2">선택</span>
                    <?php else:?>
                        <span class="badge badge-secondary float-right p-2">미선택</span>
                    <?php endif;?>
                    <h5 class="card-title"><?=$request->user_name?>(<?=$request->user_id?>)</h5>
                    <p class="card-subtitle text-muted">시공일 : <?=$request->day?></p>
                    <hr>
                    <p class="card-text"><?=nl2br(htmlentities($request->content))?></p>
                    <hr>
                    <p class="card-text">비용 : <?=$request->price?>원</p>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>

<div id="building_post_popup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">견적 요청</h3>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/building_post" method="post" name="building_post_form" id="building_post_form">
                    <div class="form-group">
                        <label for="day">시공일</label>
                        <input type="date" id="day" name="day" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="content">내용</label>
                        <textarea name="content" id="content" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <button class="close" id="building_post_send" type="button"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button class="btn btn-primary" id="building_post_btn">작성 완료</button>
            </div>
        </div>
    </div>
</div>

<div id="building_request_popup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">견적 보내기</h3>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/building_request" method="post" name="building_request_form" id="building_request_form">
                    <div class="form-group">
                        <label for="price">비용</label>
                        <input type="number" id="price" name="price" class="form-control">
                    </div>
                    <input type="number" hidden  name="post_id" id="post_id">
                    <button class="close" id="building_request_send" type="button"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button class="btn btn-primary" id="building_request_btn">입력완료</button>
            </div>
        </div>
    </div>
</div>

<div id="building_see_popup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h3 class="modal-title text-white">받은 견적</h3>
                <button class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="building_see_list">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>