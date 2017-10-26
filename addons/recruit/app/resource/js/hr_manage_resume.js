$(function () {
    var area=new Array();
    area=dsy.Items[0];
    var html="";
    for(var i=0;i<area.length;i++){
        html+="<div class='option_date' id='city"+i+"'>"+area[i]+"</div>";
    }
    $(".select_option .cityitem").html(html);
    $(".list_item_btn ").click(function () {
        $(".list_item_btn ").removeClass("select");
        $(this).addClass("select");
    })
    $(".list_item_btn ").eq(0).click(function () {
        $(".list_content").show();
        $(".resume_content").hide();
        $(".pingjia_content").hide();
        $(".gzpj_content").hide();
    })
    $(".list_item_btn ").eq(1).click(function () {
        $(".list_content").hide();
        $(".resume_content").show();
        $(".pingjia_content").hide();
        $(".gzpj_content").hide();
    })
    $(".list_item_btn ").eq(2).click(function () {
        $(".list_content").hide();
        $(".resume_content").hide();
        $(".pingjia_content").show();
        $(".gzpj_content").hide();
    })
    $(".list_item_btn ").eq(3).click(function () {
        $(".list_content").hide();
        $(".resume_content").hide();
        $(".pingjia_content").hide();
        $(".gzpj_content").show();
    })
    //省略号显示
    var pj=$(".pj_content .content").html();
    if(pj.length>90){
        $(".pj_content .content").html(pj.substring(0,90)+"......");
    }
    var htmls="<span class='ico_biaozhu'>收起</span><svg class='icon' aria-hidden='true'><use xlink:href='#icon-shangjiantou'></use></svg>";
    var htmls1="<span class='ico_biaozhu'>显示全部</span><svg class='icon' aria-hidden='true'><use xlink:href='#icon-xiajiantou'></use></svg>";
    $(".icon_all").on("click",function () {
        var pj1=$(this).prev().html();
        if(pj1.length<97){
            $(this).prev().html(pj);
            $(this).html(htmls);
        }else{
            $(this).prev().html(pj.substring(0,90)+"......");
            $(this).html(htmls1);
        }
    })

    var flag=1;
    $(".selectinput").on("mousedown",function () {
        $(".datalist").hide();
        if(flag){
            $(this).next().css("display","block");
            flag=0;
        }else{
            $(this).next().css("display","none");
            flag=1;
        }

        $(".option_date").click(function () {
            $(this).parent().prev().find(".date_num").val($(this).html());
            $(".datalist").hide();
        })
    })

    $(document.not(".selectinput")).click(function(){
        alert(1)
        // if($(".datalist").css('display')=='block'){
        //     $(".datalist").hide();
        // }
        var list=$(".datalist");
        list.each(function () {

                $(this).hide();

        })
    });
    // $(".selectinput").on("mouseleave",function () {
    //     $(".datalist").hide();
    // })



    $(".shurupl").focus(function () {
        $(this).css("background","#f5f5f5");
    })
    $(".shurupl").blur(function () {
        if($(this).val()==""){
            $(this).css("background","none");
        }
    })

    var datatime=new Date();
    var days=datatime.getDay();
    var weekarr=["周日","周一","周二","周三","周四","周五","周六"];
    var day3=new Array();
    for(var i=0;i<7;i++){
        var dayis=new Date();
        dayis.setTime(datatime.getTime()+24*i*60*60*1000);
        day3[i]=(dayis.getMonth()+1)+"."+dayis.getDate()+"."+dayis.getDay();
        if(dayis.getDay()==0 || dayis.getDay()==6){
            $(".date_list").append("<div class='option_date weekend'  data-date='"+dayis.getDate()+"'>"+dayis.getDate()+"号"+weekarr[dayis.getDay()]+"</div>");
        }else{
            $(".date_list").append("<div class='option_date' data-date='"+dayis.getDate()+"'>"+dayis.getDate()+"号"+weekarr[dayis.getDay()]+"</div>");
        }
    }
});

for(var i=0;i<26;i++)
{
    if(i==0){
        $(".letters").append("<span class='one_letter slectletter'>"+String.fromCharCode((65+i))+"</span>")
    }else{
        $(".letters").append("<span class='one_letter'>"+String.fromCharCode((65+i))+"</span>")
    }
}
//获取工作经验
for(var i=0;i<expirence_arr.length;i++){
    $(".expirence").append("<div class='option_date'>"+expirence_arr[i]+"</div>");
}


//获取全部专业

var major_arr=['哲学 ','逻辑学 ','宗教学 ','经济学 ','经济统计学 ','财政学 ','税收学 ','金融学 ','金融工程 ','保险学 ','投资学 ','国际经济与贸易 ','贸易经济 ','法学 ','政治学与行政学 ','国际政治 ','外交学 ','社会学 ','社会工作 ','民族学 ','科学社会主义 ','中国共产党历史 ','思想政治教育 ','治安学 ','侦查学 ','边防管理 ','教育学 ','科学教育 ','人文教育 ','教育技术学 ','艺术教育 ','学前教育 ','小学教育 ','特殊教育 ','体育教育 ','运动训练 ','社会体育指导与管理 ','武术与民族传统体育 ','运动人体科学 ','汉语言文学 ','汉语言 ','汉语国际教育 ','中国少数民族语言文学 ','古典文献学 ','英语 ','俄语 ','德语 ','法语 ','西班牙语 ','阿拉伯语 ','日语 ','波斯语 ','朝鲜语 ','菲律宾语 ','梵语巴利语 ','印度尼西亚语 ','印地语 ','柬埔寨语 ','老挝语 ','缅甸语 ','马来语 ','蒙古语 ','僧伽罗语 ','泰语 ','乌尔都语 ','希伯来语 ','越南语 ','豪萨语 ','斯瓦希里语 ','阿尔巴尼亚语 ','保加利亚语 ','波兰语 ','捷克语 ','斯洛伐克语 ','罗马尼亚语 ','葡萄牙语 ','瑞典语 ','塞尔维亚语 ','土耳其语 ','希腊语 ','匈牙利语 ','意大利语 ','泰米尔语 ','普什图语 ','世界语 ','孟加拉语 ','尼泊尔语 ','克罗地亚语 ','荷兰语 ','芬兰语 ','乌克兰语 ','挪威语 ','丹麦语 ','冰岛语 ','爱尔兰语 ','拉脱维亚语 ','立陶宛语 ','斯洛文尼亚语 ','爱沙尼亚语 ','马耳他语 ','翻译 ','商务英语 ','新闻学 ','广播电视学 ','广告学 ','传播学 ','编辑出版学 ','历史学 ','世界史 ','考古学 ','文物与博物馆学 ','数学与应用数学 ','信息与计算科学 ','物理学 ','应用物理学 ','核物理 ','化学 ','应用化学 ','天文学 ','地理科学 ','自然地理与资源环境 ','人文地理与城乡规划 ','地理信息科学 ','大气科学 ','应用气象学 ','海洋科学 ','海洋技术 ','地球物理学 ','空间科学与技术 ','地质学 ','地球化学 ','生物科学 ','生物技术 ','生物信息学 ','生态学 ','心理学','应用心理学','统计学 ','应用统计学 ','理论与应用力学 ','工程力学 ','机械工程 ','机械设计制造及其自动化 ','材料成型及控制工程 ','机械电子工程 ','工业设计 ','过程装备与控制工程 ','车辆工程 ','汽车服务工程 ','测控技术与仪器 ','材料科学与工程 ','材料物理 ','材料化学 ','冶金工程 ','金属材料工程 ','无机非金属材料工程 ','高分子材料与工程 ','复合材料与工程 ','能源与动力工程 ','电气工程及其自动化 ','电子信息工程 ','电子科学与技术 ','通信工程 ','微电子科学与工程 ','信息工程 ','自动化 ','计算机科学与技术 ','软件工程 ','网络工程 ','信息安全','物联网工程 ','数字媒体技术 ','土木工程 ','建筑环境与能源应用工程 ','给排水科学与工程 ','建筑电气与智能化 ','水利水电工程 ','水文与水资源工程 ','港口航道与海岸工程 ','测绘工程 ','遥感科学与技术 ','化学工程与工艺 ','制药工程 ','地质工程 ','勘查技术与工程 ','资源勘查工程 ','采矿工程 ','石油工程 ','矿物加工工程 ','油气储运工程 ','纺织工程 ','服装设计与工程 ','轻化工程 ','包装工程 ','印刷工程 ','交通运输 ','交通工程 ','航海技术 ','轮机工程 ','飞行技术 ','船舶与海洋工程 ','航空航天工程 ','飞行器设计与工程 ','飞行器制造工程 ','飞行器动力工程 ','飞行器环境与生命保障工程 ','武器系统与工程 ','武器发射工程 ','探测制导与控制技术 ','弹药工程与爆炸技术 ','特种能源技术与工程 ','装甲车辆工程 ','信息对抗技术 ','核工程与核技术 ','辐射防护与核安全 ','工程物理 ','核化工与核燃料工程 ','农业工程 ','农业机械化及其自动化 ','农业电气化 ','农业建筑环境与能源工程 ','农业水利工程 ','森林工程 ','木材科学与工程 ','林产化工 ','环境科学与工程 ','环境工程 ','环境科学 ','环境生态工程 ','生物医学工程 ','食品科学与工程 ','食品质量与安全 ','粮食工程 ','乳品工程 ','酿酒工程 ','建筑学 ','城乡规划 ','风景园林 ','安全工程 ','生物工程 ','刑事科学技术 ','消防工程 ','农学 ','园艺 ','植物保护 ','植物科学与技术 ','种子科学与工程 ','设施农业科学与工程 ','农业资源与环境 ','野生动物与自然保护区管理 ','水土保持与荒漠化防治 ','动物科学 ','动物医学 ','动物药学 ','林学 ','园林 ','森林保护 ','水产养殖学 ','海洋渔业科学与技术 ','草业科学 ','基础医学 ','临床医学 ','口腔医学 ','预防医学 ','食品卫生与营养学 ','中医学 ','针灸推拿学 ','藏医学 ','蒙医学 ','维医学 ','壮医学 ','哈医学 ','中西医临床医学 ','药学 ','药物制剂 ','中药学 ','中药资源与开发 ','法医学 ','医学检验技术 ','医学实验技术 ','医学影像技术 ','眼视光学 ','康复治疗学 ','口腔医学技术 ','卫生检验与检疫 ','护理学 ','管理科学 ','信息管理与信息系统 ','工程管理 ','房地产开发与管理 ','工程造价 ','工商管理 ','市场营销 ','会计学 ','财务管理 ','国际商务 ','人力资源管理 ','审计学 ','资产评估 ','物业管理 ','文化产业管理 ','农林经济管理 ','农村区域发展 ','公共事业管理 ','行政管理 ','劳动与社会保障 ','土地资源管理 ','城市管理 ','图书馆学 ','档案学 ','信息资源管理 ','物流管理 ','物流工程 ','工业工程 ','电子商务 ','旅游管理 ','酒店管理 ','会展经济与管理 ','艺术史论 ','音乐表演 ','音乐学 ','作曲与作曲技术理论 ','舞蹈表演 ','舞蹈学 ','舞蹈编导 ','表演 ','戏剧学 ','电影学 ','戏剧影视文学 ','广播电视编导 ','戏剧影视导演 ','戏剧影视美术设计 ','录音艺术 ','播音与主持艺术 ','动画 ','美术学 ','绘画 ','雕塑 ','摄影 ','艺术设计学 ','视觉传达设计 ','环境设计 ','产品设计 ','服装与服饰设计 ','公共艺术 ','工艺美术 ','数字媒体艺术 ','伦理学 ','国民经济管理 ','资源与环境经济学 ','商务经济学 ','能源经济 ','金融数学 ','信用管理 ','经济与金融 ','知识产权 ','监狱学 ','国际事务与国际关系 ','政治学、经济学与哲学 ','女性学 ','家政学 ','禁毒学 ','警犬技术 ','经济犯罪侦查 ','边防指挥 ','消防指挥 ','警卫学 ','公安情报学 ','犯罪学 ','公安管理学 ','涉外警务 ','国内安全保卫 ','警务指挥与战术 ','华文教育 ','运动康复 ','休闲体育 ','应用语言学 ','秘书学 ','网络与新媒体 ','文物保护技术 ','外国语言与外国历史 ','数理基础科学 ','声学 ','化学生物学 ','分子科学与工程 ','海洋资源与环境 ','军事海洋学 ','地球信息科学与技术 ','古生物学 ','机械工艺技术 ','微机电系统工程 ','机电技术教育 ','汽车维修工程教育 ','粉体材料科学与工程 ','宝石及材料工艺学 ','焊接技术与工程 ','功能材料 ','纳米材料与技术 ','新能源材料与器件 ','能源与环境系统工程 ','新能源科学与工程 ','智能电网信息工程 ','光源与照明 ','电气工程与智能控制 ','广播电视工程 ','水声工程 ','电子封装技术 ','集成电路设计与集成系统 ','医学信息工程 ','电磁场与无线技术 ','电波传播与天线 ','电子信息科学与技术 ','电信工程及管理 ','应用电子技术教育 ','轨道交通信号与控制 ','智能科学与技术 ','空间信息与数字技术 ','电子与计算机工程 ','城市地下空间工程 ','道路桥梁与渡河工程 ','水务工程 ','导航工程 ','地理国情监测 ','资源循环科学与工程 ','能源化学工程 ','化学工程与工业生物工程 ','地下水科学与工程 ','矿物资源工程 ','海洋油气工程 ','非织造材料与工程 ','服装设计与工艺教育 ','交通设备与控制工程 ','救助与打捞工程 ','船舶电子电气工程 ','海洋工程与技术 ','海洋资源开发技术 ','飞行器质量与可靠性 ','飞行器适航技术 ','环保设备工程 ','资源环境科学 ','水质科学与技术 ','假肢矫形工程 ','葡萄与葡萄酒工程 ','食品营养与检验教育 ','烹饪与营养教育 ','历史建筑保护工程 ','生物制药 ','交通管理工程 ','安全防范工程 ','公安视听技术 ','抢险救援指挥与技术 ','火灾勘查 ','网络安全与执法 ','核生化消防 ','茶学 ','烟草 ','应用生物科学 ','农艺教育 ','园艺教育 ','蚕学 ','蜂学 ','动植物检疫 ','水族科学与技术 ','麻醉学 ','医学影像学 ','眼视光医学 ','精神医学 ','放射医学 ','妇幼保健医学 ','卫生监督 ','临床药学 ','药事管理 ','药物分析 ','药物化学 ','海洋药学 ','藏药学 ','蒙药学 ','中药制药 ','中草药栽培与鉴定 ','听力与言语康复学 ','保密管理 ','劳动关系 ','体育经济与管理 ','财务会计教育 ','市场营销教育 ','海关管理 ','交通管理 ','海事管理 ','公共关系学 ','采购管理 ','标准化工程 ','质量管理工程 ','电子商务及法律 ','旅游管理与服务教育 ','影视摄影与制作 ','书法学 ','中国画 ','艺术与科技 '];
// var major_arr=["计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销","计算机科学与技术","阿的巴尼亚语","爱的哲学","互联网技术","金融贸易管理","数学与应用数学","天文学","地球物理学","心理学","机械工程","市场营销"];
for(var i=0;i<major_arr.length;i++){
    var major=checkCh(major_arr[i]).substring(0,1);
    if(major=="A"){
        $(".major_con").append("<div class='major_list'>"+major_arr[i]+"</div>");
    }
}
$("body").on("click",".one_letter",function () {
    $(".one_letter").removeClass("slectletter");
    $(".allmajor").removeClass("slectletter");
    $(this).addClass("slectletter");
    $(".major_con").html("");
    var letter=$(this).html();
    for(var i=0;i<major_arr.length;i++){
        var major=checkCh(major_arr[i]).substring(0,1);
        if(major==letter){
            $(".major_con").append("<div class='major_list'>"+major_arr[i]+"</div>");
        }
    }
})
$("body").on("click",".allmajor",function () {
    $(".one_letter").removeClass("slectletter");
    $(this).addClass("slectletter");
    for(var i=0;i<major_arr.length;i++){
        $(".major_con").append("<div class='major_list'>"+major_arr[i]+"</div>");
    }
});

$("body").on("click",".major_list",function () {
    $("#major_select").val($(this).html());
    $(".professional_list").hide();
})

//回复面试评价
$(".checkbox input[type=checkbox]").on("click",function(){
    var _this=$(this);
    var item=_this.closest(".pjxingxing");
    if(_this.attr("checked")){
        item.find(".iconfont use").attr("xlink:href","");
        _this.next().find(".iconfont use").attr("xlink:href","#icon-zhengque1");
    }
})
$(".mspjbtn").click(function () {
    var _this=$(this);
    var pl_content=_this.closest(".item_con").find(".shurupl").val();
    var xingxing=1;//1为好评，2为中评，3为差评，默认好评
    _this.closest(".item_con").find(".iconfont use").each(function () {
        if($(this).attr("xlink:href")!=""){
            xingxing=$(this).closest(".one_pj").find(".checkbox input[type=checkbox]").val();
        }
    })
    if(pl_content==""){
        alert("请输入评价回复的内容！");
        return;
    }
    console.log(xingxing+pl_content);
    //回复评价
    $.ajax({
        url:"",
        type:"post",
        data:{
            pl_content:pl_content,
            xingxing:xingxing
        },
        success:function(data){
            if(data.status==1){
                window.location.href="";
            }else{
                console.log(data.content);
            }
        }
    })
})

//工作评价
$(".send_value").click(function () {
    var oneitem=$(this).closest(".item_con");
    var time_zaizhi=oneitem.find(".time_zaizhi").val();
    var gangwei=oneitem.find(".gangwei").val();
    var biaoxian=oneitem.find(".biaoxian").val();
    if(gangwei==""){
        alert("请输入岗位职责！");
        return;
    }
    if(biaoxian==""){
        alert("请输入评价！");
        return;
    }

    console.log(time_zaizhi+gangwei+biaoxian);

    //工作评价
    $.ajax({
        url:"",
        type:"post",
        data:{
            time_zaizhi:time_zaizhi,
            gangwei:gangwei,
            biaoxian:biaoxian
        },
        success:function(data){
            if(data.status==1){
                window.location.href="";
            }else{
                console.log(data.content);
            }
        }
    })





})