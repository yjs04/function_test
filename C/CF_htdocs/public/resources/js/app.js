class App{
    constructor(){
        this.captcha_word = null;
        this.housing_id = null;
        this.review_id = null;
        this.building_id = null;
        
        window.addEventListener("click",this.click);
        window.addEventListener("change",this.change);
    }

    change =e=>{
        let target = e.target , val = target.value;
        if(target.classList.contains("price_input")){
            val = parseInt(val);
            if(val < 1 || isNaN(val)) val = 1;
            target.value = val;
        }
    }

    click=e=>{
        let target = e.target , id = target.id;
        if(id == "join_open") this.captcha();
        if(id == "join_btn") this.join();
        if(id == "login_btn") this.login();
        if(id == "housing_btn") this.housing_write();
        if(target.classList.contains("housing_score_btn")) this.housing_id = target.getAttribute("data-id");
        if(target.classList.contains("housing_score_add")) this.housing_score(target.getAttribute("data-id"));
        if(target.classList.contains("review_btn")) this.review_id = target.getAttribute("data-id");
        if(id == "review_send_btn") this.review_write();
        if(id == "building_post_btn") this.building_post();
        if(target.classList.contains("building_request_btn")) this.building_id = target.getAttribute("data-id");
        if(id == "building_request_send_btn") this.building_request();
        if(target.classList.contains("building_see_btn")) {this.building_id = target.getAttribute("data-id"); this.building_see();}
        if(target.classList.contains("building_choose_btn")) this.building_choose(target.getAttribute("data-id"));
    }

    building_choose(request_id){
        $.ajax({
            url:"/building_update",
            method:"post",
            data:{post_id:this.building_id,request_id:request_id},
            success(data){
                alert("견적이 선택되었습니다.");
                location.href="/building";
            }
        });
    }

    building_see(){
        document.querySelector("#building_see_list").innerHTML = "";
        $.ajax({
            url:"/building_load",
            method:"post",
            data:{post_id:this.building_id},
            success(data){
                let list = JSON.parse(data);
                if(list.length == 0) document.querySelector("#building_see_list").innerHTML = `<p class="alert alert-secondary d-block w-100 p-2">받은 견적이 없습니다.</p>`;
                else {
                    list.forEach(x=>{
                        let dom = document.createElement("div");
                        if(x.status == "requesting"){
                            dom.innerHTML = `<div class="review_card">
                                                <div class="review_card_info">
                                                    <h5 class="review_title">${x.user_name}(${x.user_id})</h5>
                                                    <p class="pl-2 text-muted">비용 : ${x.price}원</p>
                                                </div>
                                                <div class="review_card_body">
                                                    <button class="btn btn-dark building_choose_btn float-right" data-id="${x.id}">선택</button>
                                                </div>
                                                <div class="review_card_top"></div>
                                            </div>`;
                        }else{
                            dom.innerHTML = `<div class="review_card">
                                                <div class="review_card_info">
                                                    <h5 class="review_title">${x.user_name}(${x.user_id})</h5>
                                                    <p class="pl-2 text-muted">비용 : ${x.price}원</p>
                                                </div>
                                                <div class="review_card_body">
                                                </div>
                                                <div class="review_card_top"></div>
                                            </div>`;
                        }
                        document.querySelector("#building_see_list").appendChild(dom.firstChild);
                    })
                }
            }
        });
    }

    building_request(){
        const form = document.building_request_form;
        if(form.price.value == "") return alert("내용을 입력해주세요.");
        form.post_id.value = this.building_id;
        document.querySelector("#building_request_send").setAttribute("type","submit");
        $("#building_request_send").trigger("click");
    }

    building_post(){
        const form = document.building_post_form;
        if(form.day.value == '' || form.content.value == "") return alert("내용을 입력해주세요.");
        document.querySelector("#building_post_send").setAttribute("type","submit");
        $("#building_post_send").trigger("click");
    }

    review_write(){
        const form = document.review_form;
        if(form.content.value == "" || form.price.value == "" || form.score.val == "") return alert("내용을 입력해주세요.");
        form.specialist_id.value = this.review_id;
        document.querySelector("#review_send").setAttribute("type","submit");
        $("#review_send").trigger("click");
    }

    housing_score(id){
        $.ajax({
            url:"/housing_score",
            method:"post",
            data:{post_id:this.housing_id,val:id},
            success(data){
                $("#housing_score_close").trigger("click");
                setTimeout(()=>{
                    alert("평점이 등록되었습니다.");
                    location.href= "/housing";
                },500);
            }
        })
    }

    housing_write(){
        const form = document.housing_form;
        if(form.before_img.value == "" || form.after_img.value == "" || form.content.value == "" )return alert("내용을 입력해주세요.");
        document.querySelector("#housing_write_send").setAttribute("type","submit");
        $("#housing_write_send").trigger("click");
    }

    login(){
        const form = document.login_form;
        if(form.user_id.value == "" || form.password.value == "") return alert("내용을 입력해주세요.");
        $.ajax({
            url:"/loginCheck",
            method:"post",
            data:{user_id:form.user_id.value,password:form.password.value},
            success(data){
                if(JSON.parse(data)){
                    document.querySelector("#login_send").setAttribute("type","submit");
                    $("#login_send").trigger("click");
                }else return alert("아이디 또는 비밀번호가 일치하지 않습니다.");
            }
        })
    }

    join(){
        const form = document.join_form;
        if(form.user_id.value == "" || form.user_name.value == "" || form.password.value == "" || form.img.value == "" || form.captcha_word.value == "") return alert("내용을 입력해주세요.");
        if(form.captcha_word.value !== this.captcha_word) return alert("자동입력방지 문자를 잘못 입력하였습니다.");
        $.ajax({
            url:"/joinCheck",
            method:"post",
            data:{user_id:form.user_id.value},
            success(data){
                if(JSON.parse(data)){
                    document.querySelector("#join_send").setAttribute("type","submit");
                    $("#join_send").trigger("click");
                }else alert("중복되는 아이디입니다. 다른 아이디를 사용해주세요.");
            }
        }) 
    }

    captcha(){
        this.captcha_word = Math.random().toString(36).substr(2,5);
        this.captcha_word = this.captcha_word.substr(0,3) + (this.captcha_word.substr(3,2).toUpperCase());
        const canvas = document.querySelector("#captcha");
        const ctx = canvas.getContext("2d");

        canvas.width = 466;
        canvas.height = 100

        ctx.font = "50px Arial";
        ctx.fillText(this.captcha_word,(canvas.width - ctx.measureText(this.captcha_word).width)/2,70);
    }
}

window.onload=()=>{
    let app = new App();
}