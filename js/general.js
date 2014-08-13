//Offline
//var sAPIURL = 'http://127.0.0.1/ScavengerHuntWeb/API/api.php';
//var sAPIURL = 'http://192.168.0.107:8888/ScavengerHuntWeb/API/api.php';
//Online
//var sAPIURL = 'http://mylocalcafe.dk/API/api.php';
var sAPIURL = 'http://bejt.dk/ScavengerHuntWeb/API/api.php';

// webapp


function emptyStoarage() {
        localStorage.clear();
         location.reload();
}

function reloadPage()
  {
  $(".update").addClass("rotate");
  location.reload();  
  }

function makeTasks() {
    
    $("#webappbody").empty();
    
    var TeamNum =  parseInt( localStorage.getItem("myTeam") );
    if(!TeamNum){ window.location.href = 'http://bejt.dk/ScavengerHuntWeb/index.php'; };
    var point = 0;
    //Make ajax call 
   $.ajax({
        type: "GET",
        url: sAPIURL,
        dataType: "json",
        data: {sFunction:"GetTasksInfo",TeamNum:TeamNum}
       }).done(function(result) 
       {
           if(result.result === true){
               $.each(result.Tasks,function(index, val){   
        
                   var urlFolder = "http://scavengerhunthandin.azurewebsites.net/Admin/ImageUploadtest?TeamNum=Hold"+TeamNum+"&AsignNum=Opg"+index;
                   
                   if( val["status"] == "yes"){
                       
                       var Status =  localStorage.getItem("Opgave"+index);
                       
                       var EksPoint = val["EksPoint"];
                           if (EksPoint != 0){
                               var EksPointII = " + "+EksPoint;
                               var EksPoint = "<p>I har fået "+EksPoint+" ekstra point</p>";
                           }
                           else{
                               EksPoint = '';
                               var EksPointII = "";
                           }
                           
                       if( Status == "yes" ){
                           
                           $("#webappbody").append("<a class='taskdiv yes hidden' href='"+val["fileURL"]+"' id='task"+index+"'><h1>"+index+" "+val["beskrivelse"]+"</h1><h3>"+val["point"]+EksPointII+"</h3></a>");
                           $("#popup").hide();
                       }
                       else {
                           $("#popup").show();
                           $("#webappbody").append("<a class='taskdiv yes hidden' href='"+val["fileURL"]+"' id='task"+index+"'><h1>"+index+" "+val["beskrivelse"]+"</h1><h3>"+val["point"]+EksPointII+"</h3></a>");
                           
                           var msg = val["msg"];
                           if (msg !=''){
                               var msg = "<p>besked fra dommerne:</p><h2>"+msg+"</h2>";
                           }
                           
                            $("#popup").append("<div class='popupwindow'><h1>YES</h1>opgave "+index+" er løst"+msg+""+EksPoint+"<a href='"+val["fileURL"]+"'>Se det afleverede</a><a id='btn' href='#' onclick='reloadPage();'>OK</a></div>");
                            
                            localStorage.setItem("Opgave"+index,"yes");
                            
                            exit;
                       }
                   }
                   else if( val["status"] == "pen"){
                       $("#webappbody").append("<a class='taskdiv pen' href='"+val["fileURL"]+"' id='task"+index+"'><h1>"+index+" "+val["beskrivelse"]+"</h1><h3>"+val["point"]+"</h3><div id='status'>Afvendeter at blive godkendt</div></a>");
                   }
                   else if( val["status"] == "noo"){
                       
                       var Status =  localStorage.getItem("Opgave"+index);
                       
                       var EksPoint = val["EksPoint"];
                           if (EksPoint != 0){
                               var EksPointII = " + "+EksPoint;
                               var EksPoint = "<p>I har fået fratrukket "+EksPoint+" point</p>";
                           }
                           else{
                               EksPoint = '';
                               var EksPointII = "";
                           }
                       
                       if( Status == "noo" ){

                           $("#webappbody").append("<a class='taskdiv no' href='"+urlFolder+"' id='task"+index+"'><h1>"+index+" "+val["beskrivelse"]+"</h1><h3>"+val["point"]+"</h3></a>");
                           $("#popup").hide();
                       }
                       else {
                           $("#popup").show();
                           $("#webappbody").append("<a class='taskdiv no' href='"+urlFolder+"' id='task"+index+"'><h1>"+index+" "+val["beskrivelse"]+"</h1><h3>"+val["point"]+"</h3></a>");
                           
                           var msg = val["msg"];
                           if (msg !=''){
                               var msg = "<p>besked fra dommerne:</p><h2>"+msg+"</h2>";
                           }
                           $("#popup").append("<div class='popupwindow noo'><h1>NEJ</h1>opgave "+index+" er ikke løst godt nok"+msg+""+EksPoint+"<a href='"+val["fileURL"]+"'>Se det afleverede</a><a id='btn' href='#' onclick='reloadPage();'>OK</a></div>");
                            
                            localStorage.setItem("Opgave"+index,"noo");
                            
                            exit;
                        }
                   
                   }
                   else {       
                       $("#webappbody").append("<a class='taskdiv' href='"+urlFolder+"' id='task"+index+"'><h1>"+index+" "+val["beskrivelse"]+"</h1><h3>"+val["point"]+"</h3></a>");
                   }
       });
               $("#teamName").text(result.teamName);
               $("#teamNum").text("Hold"+result.teamNum);
               $("#teamPoints").text(result.teamPoints+" points");
           }
       });
  }
function hideSubmit() {
    $(".SubmitBox").fadeOut(function(){
        $("#TaskName").val('');
    });
    makeTasks();
}



function ShowSubmit(task) {

   var TeamNum = $("#teamNum").text();
   var Filename = TeamNum+"_opgave"+task;

   $(".SubmitBox").fadeIn();
   $("#TaskName").val(Filename);

}

// HQ 

function makePicFlow() {
    
   $("#picflowwrapper").empty();
    //Make ajax call 
   // $.ajax({
   //      type: "GET",
   //      url: sAPIURL,
   //      dataType: "json",
   //      data: {sFunction:"Getpending"}
   //     }).done(function(result) 
   //     {
   //         if(result.result === true){
               
   //             $.each(result.tasks,function(index, val){ 
               
                    // var teamNum = val.teamNum;
                    // var teamName = val.teamName;
                    // var TaskPoint = val.TaskPoint;
                    // var TaskName = val.TaskName;
                    // var TaskNum = val.TaskNum;
                    // var fileURL = val.fileURL;

                    var teamNum = "1";
                    var teamName = "gaga";
                    var TaskPoint = "20";
                    var TaskName = "lala";
                    var TaskNum = "23";
                    var fileURL = "https://myst0011.blob.core.windows.net/productimages/Hold1/Opg6/Stemme 004.m4a";
                    //var fileURL = "https://myst0011.blob.core.windows.net/productimages/Hold1/Opg2/image.jpg";

                    var Yesbtn = "<div id='yes' class='botton' onclick='setvote(\"yes\");' >Godkend</div>";
                    var Nobtn = "<div id='no' class='botton' onclick='setvote(\"no\");'>IKKE Godkendt</div>";
                    var msg = "<input id='msg' type='text' placeholder='besked'>";
                    var expoint = "<input id='expoint' type='text' placeholder='ekstra points'>";
                    var save = "<div id='save' class='botton save' onclick='setvote(\"save\");'>GEM</div>";
                    var next = "<div id='next' class='botton' onclick='saveVote(\""+teamNum+"\",\""+TaskNum+"\");'>Næste</div>";
                    
                    $("#picflowwrapper").append("<div id='imgFlowBtn' class='picFlowBox'><h1>"+TaskNum+" "+TaskName+" "+TaskPoint+"</h1><p>"+teamName+" - hold"+teamNum+"</p>"+Yesbtn+Nobtn+expoint+msg+save+next+"</div>");

                    if (fileURL.match(/(?:gif|jpg|jpeg|tiff|png|bmp)$/)) {
                      $("#picflowwrapper .picFlowBox").prepend("<a href='"+fileURL+"' target='_blank'><img src='"+fileURL+"'></a>");
                    }
                    else{
                      $("#picflowwrapper .picFlowBox").prepend('<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="364" data-setup="{}"><source src="'+fileURL+'" type="video/mp4" /><source src="'+fileURL+'" type="video/webm" /><source src="'+fileURL+'" type="video/ogg" /><track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track></video>');
                      $("#example_video_1").after("<a href='"+fileURL+"' >"+fileURL+"</a>")
                    }

  

                   
        //        });
        //     }
        // });   
    
    
    }

function setvote(vote) {
    if( vote != "save"){
    $("#imgFlowBtn #yes").removeClass("ON");
    $("#imgFlowBtn #no").removeClass("ON");
    $("#imgFlowBtn #"+vote).addClass("ON");
    }
    else{
        $("#imgFlowBtn #"+vote).toggleClass("ON");
    }
}

function saveVote(teamNum,TaskNum) {

    var voteSave = 0;
    var voteMsg = $("#imgFlowBtn #msg").val();
    var exPoint = $("#imgFlowBtn #expoint").val();
    if (exPoint == ""){ var exPoint = 0 }
    var Status = 0;
    if( $("#imgFlowBtn #yes").hasClass('ON')){  Status = "yes"; }
    if( $("#imgFlowBtn #no").hasClass('ON')){  Status = "noo"; }
    
    if( $("#imgFlowBtn #save").hasClass('ON')){  var voteSave = 1; }
    
    if( Status != 0 ){
    $("#next").text("...");  
    
    $.ajax({   
       type: 'GET',   
       url: sAPIURL,
       dataType: "json",   
       data: {sFunction:"saveVote",taskStatus:Status,save:voteSave,message:voteMsg,extrapoint:exPoint,teamNum:teamNum,TaskNum:TaskNum}
    }).done(function(result) 
       {
           if(result == true){
               makePicFlow();
           }
           else{
               alert("der er sket en fejl - prøv igen");
           }
       });
    }
}

// task editor

function makeInputsTasks(){
    
    $("#taskeditor").empty();
    //Make ajax call 
   $.ajax({
        type: "GET",
        url: sAPIURL,
        dataType: "json",
        data: {sFunction:"GetTasks"}
       }).done(function(result) 
       {
           if(result.result === true){
               
               $.each(result.tasks,function(index, val){ 
                   
                   var TAskNum = val.TaskNum;
                   var TaskName = val.TaskName;
                   var TaskPoint = val.TaskPoint;
                   var updaterbnt = "<a id='updateOk"+index+"' href='#' onclick='UpdateInputtasks(\""+index+"\");'>opdater</a>"; 
                    $("#taskeditor").append("<div class='inputtaskbox'><input id='tasknum"+index+"' maxlength='3' size='3' type='text' value='"+index+"' disabled><input id='taskname"+index+"' class='longtype' type='text' onkeydown='if (event.keyCode == 13) { UpdateInputtasks(\""+index+"\"); }' value='"+TaskName+"'><input id='taskpoint"+index+"'type='text' size='5' value='"+TaskPoint+"' onkeydown='if (event.keyCode == 13) { UpdateInputtasks(\""+index+"\"); }'>"+updaterbnt+"</div>");
               });
            }
        });    
}

function UpdateInputtasks(task) {
        
//       var aData =  {};
//              
//       for(var i = 1; i <= 100; i++) {
//          
//          var taskinfo = {};
//       
//          taskinfo["TaskNum"] = $("#tasknum"+i).val();
//          taskinfo["TaskName"] = $("#taskname"+i).val();
//          taskinfo['TaskPoint'] = $("#taskpoint"+i).val();
//          
//          aData[i] = taskinfo;
//       }
       
       //Workaround with encoding issue in IE8 and JSON.stringify
//       for (var i in aData.) {
//           aData[i] = encodeURIComponent(aData[i]);
//       }
            
          $("#updateOk"+task).text("...");  
            
          var aData =  {};          
          var taskinfo = {};
       
          taskinfo["TaskNum"] = $("#tasknum"+task).val();
          taskinfo["TaskName"] = $("#taskname"+task).val();
          taskinfo['TaskPoint'] = $("#taskpoint"+task).val();
          
          aData[task] = taskinfo;

       var sJSON = JSON.stringify(aData);
    
    $.ajax({   
       type: 'GET',   
       url: sAPIURL,
       dataType: "json",   
       data: {sFunction:"UpdateInputtasks",tasksinfo:sJSON}
    }).done(function(result) 
       {
           if(result == true){
               $("#updateOk"+task).replaceWith("<p style=' display:inline-table; margin:0px;'>OK</p>");
           }
           else{
               $("#updateOk"+task).text("fejl - ikke opdateret - prøv igen");
           }
       });
   
}

function toggleShowTasks(){

    $(".taskdiv").toggleClass('hidden');
    
    $("#update").text(function(i, v){
               return v === 'Skjul godkente' ? 'Se godkente' : 'Skjul godkente'
            })
}


function makeScorboard(){
  var numbersOfTeams = 15;
  // LAV scoreList 
  $(".scoreList").append("<ol></ol>")
  for(var i = 1; i<=numbersOfTeams; i++){
    $(".scoreList ol").append("<li><h3>Hold"+i+"</h3><p>2000p</p></li>")
  }
  // LAV indleveret
  for(var l = 1; l <= 100; l++){
    $(".TeamDiv").append("<div class='row' id='row"+l+"'></div>");
    for(var m = 1; m <= numbersOfTeams; m++){
        $(".TeamDiv #row"+l).append("<p>LINK + Point (ALLE)</p>");
    }  
  }
  // LAV opgaver
  for(var j = 1; j <= 100; j++){
    $(".AssWrapper").append("<div class='Ass'><h1>Opgave "+j+"</h1><h2>beskrivelse</h2><h3>point</h3></div>");
  }

  // Lav Chard
  for(var k = 1; k <= numbersOfTeams; k++){
    $(".TeamChartWrapper").append("<div class='rowChard'><span></span><h1>Hold "+k+"</h1></div>");
  }
  var rowChard = (200 * numbersOfTeams) + (3 * numbersOfTeams);
  $(".TeamChartWrapper").css("width", rowChard);
  $(".row").css("width", rowChard);
}