<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- MDB icon -->
      <link rel="icon" href="mdb/img/mdb-favicon.ico" type="image/x-icon">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
      <!-- Google Fonts Roboto -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="mdb/css/bootstrap.min.css">
      <!-- Material Design Bootstrap -->
      <link rel="stylesheet" href="mdb/css/mdb.min.css">
      <!-- Your custom styles (optional) -->
      <link rel="stylesheet" href="mdb/css/style.css">
      <!-- MDBootstrap Datatables  -->
      <link href="mdb/css/addons/datatables.min.css" rel="stylesheet">

    <script src="angular.min.js"></script>
    <script src="angular-route.js"></script>
    <script>
        $(document).ready(function(){
            $('.changebg').click(function(){
                $('.changebg').css("background-color", "#2E487C");
                $(this).css("background-color", "#002060");
            })

            /*$("#stud_table_data").click(function(){
                $('#dtBasicExample').DataTable();
                $('.dataTables_length').addClass('bs-select');
            })*/
            
        })
        var app=angular.module("mainapp",['ngRoute']);

            app.config(function($locationProvider,$routeProvider){
                $locationProvider.hashPrefix('');
                $routeProvider
                .when('/',{
                    templateUrl: 'tmp/markAttendance.html'
                })
                .when('/dash',{
                    templateUrl: 'tmp/markAttendance.html'
                })
                .when('/getstud/:codeword',{
                    templateUrl: 'tmp/getallstudents.html'
                })
                .when('/reports',{
                    templateUrl: 'tmp/reports.html'
                })
                .when('/websites',{
                    templateUrl: 'tmp/vitwebsites.html'
                })
            })

            app.controller("markActrl",function($scope){
                $scope.lecture= function(){
                    $('#batch').css('display','none');
                    $('#type_of_lecture').css('display','');
                }
                $scope.practical= function(){
                    $('#batch').css('display','');
                    $('#type_of_lecture').css('display','none');
                }

            })

            app.controller("reports",function($scope,$http){
              //alert()
              $scope.year2='';

              $scope.get_lecture_count= function(){
                //alert()
                var yearr=$scope.year2;
                var from_date= $scope.from_date;
                var to_date= $scope.to_date;
                //alert(to_date)
                var roll_no= $scope.roll_no;
                var ddt= to_date.getDate();
                var mmt= to_date.getMonth()+1;
                var yyt= to_date.getFullYear();
                var ddf= from_date.getDate();
                var mmf= from_date.getMonth()+1;
                var yyf= from_date.getFullYear();
                var from_date= yyf+'-'+mmf+'-'+ddf;
                var to_date= yyt+'-'+mmt+'-'+ddt;
                //alert(to_date)
                $http.get('get_lecture_count.php?from_date='+from_date+'&to_date='+to_date+'&roll_no='+roll_no+'&yearr='+yearr).then(function(d){
                  //alert(d.data)
                  //console.log(d.data)
                  $scope.stud_info= d.data;
                })

              }

              $scope.get_attendance= function(year){
                //alert(year);
                $scope.year2=year;
                $scope.attendance_data= '';
                var year= year;
                $scope.year= year;

                /*$http.get('get_attendance.php?year='+year).then(function(d){
                  //alert(d.data)
                  $scope.attendance_data= d.data;

                })*/
                
              }

              $scope.getstud2= function(){
                var year2=$scope.year2;
                var date2f= $scope.date2f;
                var dd2f= date2f.getDate();
                var mm2f= date2f.getMonth()+1;
                var yy2f= date2f.getFullYear();
                var date2f= yy2f+'-'+mm2f+'-'+dd2f;

                var date2t= $scope.date2t;
                var dd2t= date2t.getDate();
                var mm2t= date2t.getMonth()+1;
                var yy2t= date2t.getFullYear();
                var date2t= yy2t+'-'+mm2t+'-'+dd2t;

                var division2=$scope.division2;
                var subject2=$scope.subject2;
                var fromtime2=$scope.fromtime2;
                var totime2=$scope.totime2;

                $http.get('filter2.php?date2f='+date2f+'&subject2='+subject2+'&fromtime2='+fromtime2+'&totime2='+totime2+'&year2='+year2+'&date2t='+date2t+'&division2='+division2).then(function(d){
                  //alert(d.data)
                  //console.log(d.data)
                  $scope.attendance_data= d.data;

                })

              }

              /*$scope.filterdate= function(){
                alert()
                var filterdate= $scope.filterdate;
                alert(filterdate)
                var dd= filterdate.getDate();
                var mm= filterdate.getMonth()+1;
                var yy= filterdate.getFullYear();
                var filterdate= yy+'-'+mm+'-'+dd;
                $scope.searchterm= filterdate;                
              }*/

              get_attendance_data();
              function get_attendance_data(){
                $http.get('get_attendance_data.php').then(function(d){
                    //alert(d.data);
                    //console.log(d.data);
                    $scope.branchyear=d.data;
                })

              }
            })

            app.controller("getallstudents",function($scope,$routeParams,$http){
                /*$(window).load(function() {
                    if (window.location.href.indexOf('reload')==-1) {
                        window.location.replace(window.location.href+'?reload');
                    }
                });*/
                function handlesession(){
                    sessionStorage.setItem("m", 0);
                    var n = sessionStorage.getItem("m");
                    var p = sessionStorage.getItem("r");
                    if(n==0 && p!='reloaded'){
                        window.location.reload();
                        sessionStorage.setItem("r", 'reloaded');
                        //sessionStorageclear();
                    }
                }
                handlesession();


                $scope.present= function(user){
                    var roll= user.roll_no;
                    var subject= $scope.selectedItem;
                    var prof= $scope.professor_name;
                    var hours= $scope.no_of_hours;
                    var year= $scope.year;
                    var month= $scope.month;
                    var date= $scope.date;
                    var months = ['mon',"January", "February", "March", "Arpil", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var month1 = months.indexOf(month);

                    var date_is= year+'-'+month1+'-'+date;
                    //alert(date_is)
                    var from_time= $scope.from;
                    var to_time= $scope.to;
                    //alert(to_time)

                    $http.get('set_attendance.php?roll_no='+roll+'&subject='+subject+'&professor_name='+prof+'&no_of_hours='+hours+'&date='+date_is+'&from_time='+from_time+'&to_time='+to_time).then(function(d){
                        alert(d.data);
                    })
                }

                $scope.absent= function(user){
                    var roll= user.roll_no;
                    var subject= $scope.selectedItem;
                    var prof= $scope.professor_name;
                    var hours= $scope.no_of_hours;
                    var year= $scope.year;
                    var month= $scope.month;
                    var date= $scope.date;
                    var months = ['mon',"January", "February", "March", "Arpil", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var month1 = months.indexOf(month);

                    var date_is= year+'-'+month1+'-'+date;
                    //alert(date_is)
                    var from_time= $scope.from;
                    var to_time= $scope.to;
                    //alert(to_time)

                    $http.get('unset_attendance.php?roll_no='+roll+'&subject='+subject+'&professor_name='+prof+'&no_of_hours='+hours+'&date='+date_is+'&from_time='+from_time+'&to_time='+to_time).then(function(d){
                        alert(d.data);
                    })
                }

                $scope.selected_subject= function(){
                    var subject= $scope.selectedItem;
                    //alert(subject)
                    $http.get('is_elective.php?id='+subject).then(function(d){
                        //alert(d.data)
                        var txt= d.data;
                        var sub= txt[0]['elective'];
                        //alert(sub)
                        if(sub=='0'){
                            $scope.select_student= 'verified';
                        }
                        else{
                            $scope.select_student= subject;
                        }

                    })
                }
                $http.get('getsubjects.php').then(function(d){
                    console.log(d.data)
                    //alert(d.data);
                    $scope.subject= d.data;
                    var d = new Date();
                    var date = d.getDate();

                    var month = new Array();
                    month[0] = "January";
                    month[1] = "February";
                    month[2] = "March";
                    month[3] = "April";
                    month[4] = "May";
                    month[5] = "June";
                    month[6] = "July";
                    month[7] = "August";
                    month[8] = "September";
                    month[9] = "October";
                    month[10] = "November";
                    month[11] = "December";

                    var mon = month[d.getMonth()];
                    var year = d.getFullYear();

                    $scope.date= date;
                    $scope.month= mon;
                    $scope.year= year;
                })

                var id= $routeParams.codeword;
                //alert(id)
                $http.get('getstudents.php?id='+id).then(function(d){
                        //console.log(d.data);
                        var dataitem = d.data;
                        //alert(dataitem)
                        if(dataitem=='DLE'||dataitem=='ILE'){
                            //alert(dataitem)
                            $scope.students= d.data;
                        }
                        else{
                            $scope.students= d.data;
                        }
                    }
                )
            })

    </script>

    <style>
        #menu ul{
            margin: 0;
            list-style: none;
            padding: 0;
        }
        #menu ul li{
            background: #2E487C;
            height: 50px;
        }
        #menu ul li a{
            width: 100%;
            float: left;
            padding: 13px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            color:white;
            cursor: pointer;
        }
        #menu ul li a:hover{
            background: #002060;
        }
    </style>
</head>
<body>
        <div ng-app="mainapp">

                <div id="menu" style="width: 20%; height: 100%; float: left; background: #F7F0F5;">
                    <a href='logout.php' title='Logout'>
                        <i class="float-right mt-3 mr-3 large material-icons">settings_power</i>
                    </a>
                    <h1 class="my-5 text-center text-muted">Welcome</h1>
                    <!--<h4 class="text-center mt-3 text-dark">Prof.</h4>
                    <h3 class="text-center mt-1 mb-5 text-dark">
                        <?php
                          error_reporting(E_ERROR | E_PARSE); session_start(); echo $_SESSION['uname'];
                        ?>

                    </h3>-->
                    <ul>
                        <li><a href="#dash" class="changebg">ATTENDANCE</a></li>
                        <li><a href="#reports" class="changebg">REPORTS</a></li>
                        <li><a href="localhost:4200" target="_blank" class="changebg">To Do</a></li>
                        <li><a href="#websites" class="changebg">WEBSITES</a></li>
                    </ul>
                </div>
                <div id="section" class="p-5" style="width: 80%; height:600px; overflow-y: scroll; float: left;" ng-view="">

                </div>
        </div>
      <!-- jQuery -->
      <!--<script type="text/javascript" src="mdb/js/jquery.min.js"></script>
       Bootstrap tooltips 
      <script type="text/javascript" src="mdb/js/popper.min.js"></script>
       Bootstrap core JavaScript 
      <script type="text/javascript" src="mdb/js/bootstrap.min.js"></script>
       MDB core JavaScript 
      <script type="text/javascript" src="mdb/js/mdb.min.js"></script>
       MDBootstrap Datatables  
      <script type="text/javascript" src="mdb/js/addons/datatables.min.js"></script>-->
</body>
