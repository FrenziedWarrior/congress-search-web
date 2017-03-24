<!DOCTYPE html>
<html lang="en" ng-app="myApp">
    <head>
        <title>HW 8</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- JAVASCRIPT SCRIPT LOADING -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-animate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-sanitize.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.2.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3a4b1a30e3.js"></script>
        <script src="js/congress.js" type="text/javascript"></script>
        <script src="js/dirPagination.js" type="text/javascript"></script>
    </head>
    
<body>
    
    <!-- HEADER WRAPPER -->
    <div class="header navbar navbar-fixed-top">
        <div class="container-fluid" >
            <div class="row" style="">
                <div id="menu-toggle" class="col-md-1">
                    <span class="glyphicon glyphicon-menu-hamburger" style="float:left; padding-top:15px; z-index: 100; "></span>
                </div>      
                <div id="header-items" class="col-md-11" style="text-align:center; padding-top:12px">
                    <a href="http://sunlightfoundation.com/" target="_blank" style="text-decoration:none">
                        <img src="http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/logo.png" alt="Sunlight Logo" class="image-responsive" style="width: 4em;">
                    </a>
                    <div class="inline" style="font-weight:bold;">Congress API</div> 
                </div>
            </div>
        </div>
    </div>

    
    
    
    
    <!-- BODY WRAPPER -->
    <div id="body-wrapper">          
        <!-- SIDEBAR WRAPPER -->    
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li id="navLegislators">
                    <a data-toggle="tab" class="navtabActive" href="#page-wrapper">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="nav-label">Legislators</span>
                    </a>
                </li>
                <li id="navBills">
                    <a data-toggle="tab" href="#page-wrapper">
                        <i class="fa fa-file-o" aria-hidden="true"></i>
                        <span class="nav-label">Bills</span>
                    </a>
                </li>
                <li id="navCommittees">
                    <a data-toggle="tab" href="#page-wrapper">
                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span class="nav-label">Committees</span>
                        
                    </a>
                </li>
                <li id="navFavorites">
                    <a data-toggle="tab" href="#page-wrapper">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="nav-label">Favorites</span>
                        
                    </a>
                </li>
            </ul>
        </div>




        <!-- PAGE WRAPPER -->
        <div id="page-wrapper" class="tab-pane fade in active" ng-controller="dataFetch" >
            <div class="container-fluid">
                
                <!-- DYNAMIC PAGE HEADER ACCORDING TO NAV-TAB SELECTED -->
                <div class="page-header">
                    <h2 class="page-title">Legislators</h2>
                </div>           
                
                
                <div id="myCarousel" class="carousel slide" data-interval="false">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <!-- CAROUSEL ITEM: TABLE VIEW-->
                        <div class="item active">
                            <!-- MAIN PANEL: TABS AND TABLE -->
                            <div class="panel panel-default">
                                <!-- DYNAMIC TABS ACCORDING TO NAV-TAB SELECTED -->
                                <div id="tab-wrapper" class="panel-heading" style="padding: 0; background-color: white; ">
                                    <ul class="tabLegislators nav nav-tabs">
                                        <li class="active" id="leg-state-tab"> <a data-toggle="tab" href="#resultTbl" >States</a> </li>
                                        <li id="leg-house-tab"> <a data-toggle="tab" href="#resultTbl">House</a> </li>
                                        <li id="leg-senate-tab"> <a data-toggle="tab" href="#resultTbl">Senate</a> </li>
                                    </ul>
                        
                                    <ul class="tabBills nav nav-tabs">
                                        <li class="active" id="bill-active-tab"> <a data-toggle="tab" href="#state" >Active Bills</a> </li>
                                        <li id="bill-new-tab"> <a data-toggle="tab" href="#state">New Bills</a> </li>
                                    </ul>

                                    <ul class="tabCommittees nav nav-tabs">
                                        <li class="active" id="com-house-tab"> <a data-toggle="tab" href="#hello" >House</a> </li>
                                        <li id="com-senate-tab"> <a data-toggle="tab" href="#hello">Senate</a> </li>
                                        <li id="com-joint-tab"> <a data-toggle="tab" href="#hello">Joint</a> </li>
                                    </ul>

                                    <ul class="tabFavorites nav nav-tabs">
                                        <li class="active" id="fav-leg-tab"> <a data-toggle="tab" href="#state" >Legislators</a> </li>
                                        <li id="fav-bill-tab"> <a data-toggle="tab" href="#state">Bills</a> </li>
                                        <li id="fav-com-tab"> <a data-toggle="tab" href="#state">Committees</a> </li>
                                    </ul>
                                </div> <!-- END MAIN PANEL HEADING : TAB-WRAPPER -->
                    
                    
                    
                                <!-- TAB CONTENT -->
                            <div class="tab-content" >
                                <div class="tab-pane active" id="resultTbl">
                                    <div class="panel-body">
                                        <div class="panel panel-default" >
                                            <div class="panel-heading">
                                                <!-- TABLE HEADING PANEL WITH SEARCH FIELDS       -->
<!--                                                <div class="form-group select-field" ng-show="checkStateTabActive()">-->
                                              <div class="row form-group" >
                                                    <div class="col-md-6 col-xs-12" ng-show="activeTabCheck('leg-st')">
                                                        <label for="inputField1" >Legislators by State</label>
                                                    </div>
                                                    <div class="col-md-6 col-xs-12" ng-show="activeTabCheck('leg-st')">
                                                    <select id="inputField1" class="form-control select-field" ng-model="selectedState">
                                                        <option value="" selected>All States</option>
                                                        <option ng-repeat="x in states" value="{{x.code}}">{{ x.state|capitalize }}</option>
                                                    </select>
                                                    </div>
                                                    

                                                <div class="form-group text-field" ng-hide="activeTabCheck('leg-st')">
                                                    <label for="inputField2">Legislators By House</label>
                                                    <input id="inputField2" type="text" class="form-control" placeholder="Search" ng-model="filterQuery" ng-hide="activePage == 'fav'">
                                                </div>
                                                </div>
                                     
                                            </div> <!-- END TABLE PANEL HEADING: TABLE TITLE AND SERACH FIELD -->





                                            <!-- TABLE WITH RESULTS FROM API CALL -->

                                            <div class="panel-body table-responsive" ng-show="activePage == 'leg'" ng-cloak>
                                                <table class="table table-hover ">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:18%">Party</th>
                                                            <th style="width:18%">Name</th>
                                                            <th style="width:18%">Chamber</th>
<!--                                                            <th style="width:18%" ng-if="senateTabInactive" class="dist-col">District</th>-->
                                                            <th style="width:18%" ng-hide="activeTabCheck('leg-s')" class="dist-col">District</th>
                                                            <th style="width:18%">State</th>
                                                            <th style="width:10%"></th>
                                                        </tr>

                                                    </thead>

                                                    <tbody>
                                                        <tr class="legRow" dir-paginate="x in myLegislators | filter:{state:selectedState} | filter:filterQuery | itemsPerPage: 10">
                                                            <td ng-bind-html="getPartyLogo(x)"></td>
                                                            <td ng-bind="getFullname(x)"></td>
                                                            <td ng-bind-html="getChamberSrc(x)"></td>
<!--                                                            <td ng-bind="getDistrict(x)" class="dist-col" ng-if="senateTabInactive"></td>-->
                                                            <td ng-bind="getDistrict(x)" class="dist-col" ng-hide="activeTabCheck('leg-s')"></td>
                                                            <td ng-bind="getStatename(x)"></td>
                                                            <td><button type="button" ng-click="fetchLegDetails(x.bioguide_id)" href="#myCarousel" role="button" data-slide="next" class="left btn btn-primary">
                                                                View Details
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                              </table>

                                            </div> <!-- END TABLE PANEL BODY -->

                                                
                                            <!-- BILL TABLE DEFINITIONS -->
                                                <div class="panel-body table-responsive" ng-show="activePage == 'bil'" ng-cloak>
                                                    <table class="table table-hover ">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:15%">Bill ID</th>
                                                                <th style="width:10%">Bill Type</th>
                                                                <th class="hide-xs" style="width:20%">Title</th>
                                                                <th style="width:15%">Chamber</th>
                                                                <th style="width:15%">Introduced On</th>
                                                                <th style="width:15%">Sponsor</th>
                                                                <th style="width:10%"></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr class="billRow" dir-paginate="x in myBills | filter:filterQuery | itemsPerPage: 10" >
                                                                <td>{{x.bill_id | uppercase}}</td>
                                                                <td>{{x.bill_type | uppercase}}</td>
                                                                <td class="hide-xs" >{{x.official_title}}</td>
                                                                <td ng-bind-html="getChamberSrc(x)"></td>
                                                                <td>{{x.introduced_on}}</td>
                                                                <td>{{getFullnameWithTitle(x.sponsor)}}</td>
                                                                <td><button type="button" ng-click="fetchBillDetails(x)" href="#myCarousel" role="button" data-slide="next" class="left btn btn-primary">
                                                                View Details
                                                                </button></td>
                                                            </tr>
                                                        </tbody>
                                                  </table>
                                                </div>
                                          




                                            <!-- OTHER TABLE DEFINITIONS -->
                                                <div class="panel-body table-responsive" ng-show="activePage == 'com'">
                                                    <table class="table table-hover ">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:5%"></th>
                                                                <th style="width:15%">Chamber</th>
                                                                <th style="width:15%">Committee ID</th>
                                                                <th style="width:15%">Name</th>
                                                                <th style="width:15%" ng-hide="activeTabCheck('com-j')">Parent Committee</th>
                                                                <th style="width:15%" ng-hide="activeTabCheck('com-j') || activeTabCheck('com-s')">Contact</th>
                                                                <th style="width:10%" ng-hide="activeTabCheck('com-j') || activeTabCheck('com-s')">Office</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr dir-paginate="x in myComs | filter:filterQuery | itemsPerPage: 10">
                                                                <td>
                                                                    <button type="button" class="btn btn-default" ng-click="addFavorite('comm', x.committee_id)">
                                                                    <i class="fa fa-star fa-1x ng-class:{iconEnabled:checkFavComm(x.committee_id), iconDisabled:!checkFavComm(x.committee_id)}" aria-hidden="true"></i>
                                                                    </button>
                                                                </td>
                                                                <td ng-bind-html='getChamberSrc(x)'></td>
                                                                <td>{{x.committee_id}}</td>
                                                                <td>{{x.name}}</td>
                                                                <td ng-hide="activeTabCheck('com-j')">{{x.parent_committee_id}}</td>
                                                                <td ng-hide="activeTabCheck('com-j') || activeTabCheck('com-s')">{{getPhone(x)}}</td>
                                                                <td ng-hide="activeTabCheck('com-j') || activeTabCheck('com-s')">{{getOffice(x)}}</td>
                                                            </tr>
                                                        </tbody>
                                                  </table>
                                                </div>
                                            

                                            
                                            <!-- OTHER TABLE DEFINITIONS -->
                                             <div class="panel-body" ng-show="activePage == 'fav'" style="overflow-x: scroll">
                                                    <table class="table table-hover" ng-show="activeTabCheck('fav-l')">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th style="width:15%">Image</th>
                                                                <th style="width:15%">Party</th>
                                                                <th style="width:15%">Name</th>
                                                                <th style="width:15%">Chamber</th>
                                                                <th style="width:15%">State</th>
                                                                <th style="width:15%">Email</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr ng-repeat="item in favLegDetails">
                                                                <td>
                                                                    <button type="button" ng-click="deleteFavorite('legs', item.bioguide_id)" class="btn btn-default">
                                                                    <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <img class="image image-responsive fav-leg-thumb" alt="legislator-image" 
                                                                        ng-src="http://theunitedstates.io/images/congress/225x275/{{item.bioguide_id}}.jpg"> 
                                                                </td>
                                                                <td class="wrap-cols" ng-bind-html="getPartyLogo(item)"></td>
                                                                <td class="wrap-cols" ng-bind-html="getFullname(item)"></td>
                                                                <td class="wrap-cols" ng-bind-html="getChamberSrc(item)"></td>
                                                                <td class="wrap-cols">{{item.state_name}}</td>
                                                                <td class="wrap-cols" ng-bind-html="getEmail(item)"></td>
                                                                <td><button type="button" ng-click="fetchLegDetails(item.bioguide_id)" href="#myCarousel" role="button" data-slide="next" class="btn btn-primary">View Details</button></td>
                                                            </tr>
                                                        </tbody>
                                                  </table>
                                                 
                                                  <table class="table table-hover" ng-show="activeTabCheck('fav-b')">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th style="width:15%">Bill ID</th>
                                                                <th style="width:15%">Bill Type</th>
                                                                <th style="width:15%">Title</th>
                                                                <th style="width:15%">Chamber</th>
                                                                <th style="width:15%">Introduced On</th>
                                                                <th style="width:15%">Sponsor</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr ng-repeat="item in favBillDetails">
                                                                <td><button type="button" ng-click="deleteFavorite('bill', item.bill_id)" class="btn btn-default">
                                                                    <i class="fa fa-trash"></i>
                                                                    </button></td>
                                                                <td class="wrap-cols">{{item.bill_id | uppercase}}</td>
                                                                <td class="wrap-cols">{{item.bill_type | uppercase}}</td>
                                                                <td class="wrap-cols">{{item.official_title}}</td>
                                                                <td class="wrap-cols" ng-bind-html="getChamberSrc(item)"></td>
                                                                <td class="wrap-cols">{{item.introduced_on}}</td>
                                                                <td class="wrap-cols">{{getFullnameWithTitle(item.sponsor)}}</td>
                                                                <td><button type="button" ng-click="fetchBillDetails(item)" href="#myCarousel" role="button" data-slide="next" class="btn btn-primary">View Details</button></td>
                                                            </tr>
                                                        </tbody>
                                                  </table>
                                                
                                             
                                                 <table class="table table-hover" ng-show="activeTabCheck('fav-c')">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th style="width:15%;">Chamber</th>
                                                                <th style="width:15%;">Committee ID</th>
                                                                <th style="width:15%;">Name</th>
                                                                <th style="width:15%;">Parent Committee</th>
                                                                <th style="width:15%;">Sub Committee</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr ng-repeat="item in favCommDetails">
                                                                <td><button type="button" ng-click="deleteFavorite('comm', item.committee_id)" class="btn btn-default">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </button>
                                                                </td>
                                                                <td class="wrap-cols" ng-bind-html="getChamberSrc(item)"></td>
                                                                <td class="wrap-cols">{{item.committee_id}}</td>
                                                                <td class="wrap-cols">{{item.name}}</td>
                                                                <td class="wrap-cols">{{item.parent_committee_id}}</td>
                                                                <td class="wrap-cols">{{item.subcommittee }}</td>
                                                            </tr>
                                                        </tbody>
                                                  </table>
                                                
                                             
                                            
                                            
                                            
                                            </div>


                                            
                                            <div class="text-center" ng-hide="activePage == 'fav'">
                                                <dir-pagination-controls
                                                    id="paginationBar"
                                                    boundary-links="true" 
                                                    on-page-change="pageChangeHandler(newPageNumber)" 
                                                    template-url="js/dirPagination.tpl.html">
                                                </dir-pagination-controls>
                                            </div>
                                        </div> <!-- END PANEL: table -->   
                                    </div> <!-- END PANEL BODY: main -->
                               </div> <!-- END TAB PANE: main -->
                            </div> <!-- END TAB CONTENT -->
                        </div> <!-- END PANEL: main -->
                        </div> <!-- END CAROUSEL ITEM 1: TABLE VIEW -->
                    
                    
                        
                    <!-- CAROUSEL ITEM: DETAILS VIEW-->
                    <div id="itemDetail" class="item">
                        <!-- Starting with legislator details -->
                        <div class="panel panel-default" ng-if="showingLegs">
                            <div class="panel-heading">
                                <button id="backBtn" class="btn btn-default" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </button>
                                <h3 class="inline">Details</h3>
                                <button class="btn btn-default" style="float:right; " ng-click="addFavorite('legs', myLegDetails.bioguide_id)">
                                    <i class="fa fa-star fa-1x ng-class:{iconEnabled:checkFavLeg(myLegDetails.bioguide_id), iconDisabled:!checkFavLeg(myLegDetails.bioguide_id)}" aria-hidden="true"></i>
                                </button>
                            </div>
                                
                            <div class="panel-body" ng-cloak>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- personal details -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="leg-pic-wrapper block-xs">
                                                            <img class="leg-dp image-responsive" alt="legislator-image" 
                                                                ng-src="http://theunitedstates.io/images/congress/225x275/{{myLegDetails.bioguide_id}}.jpg"> 
                                                        </td>
                                                                
                                                        <td class="block-xs">
                                                            <table class="table">
                                                                <tr><td ng-bind="getFullnameWithTitle(myLegDetails)"></td></tr>
                                                                <tr><td ng-bind-html="getEmail(myLegDetails)"></td></tr>
                                                                <tr><td ng-bind="getChamberLabel(myLegDetails)"></td></tr>
                                                                <tr><td ng-bind-html="getContact(myLegDetails)"></td></tr>
                                                                <tr><td ng-bind-html="getPartySrc(myLegDetails)"></td></tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>Start Term</strong></td>
                                                        <td ng-bind="getTermStart(myLegDetails)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>End Term</strong></td>
                                                        <td ng-bind="getTermEnd(myLegDetails)"></td>
                                                    </tr>
                                                    <tr class="hide-xs">
                                                        <td ><strong>Term</strong></td>
                                                        <td><uib-progressbar animate='false' class='progress' value='getTermPerc(myLegDetails)' type='success'><b>{{getTermPerc(myLegDetails)}}%</b></uib-progressbar></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>Office</strong></td>
                                                        <td ng-bind="getOffice(myLegDetails)"></td>
                                                    </tr>   
                                                    <tr>
                                                        <td class="hide-xs"><strong>State</strong></td>
                                                        <td ng-bind="getStatename(myLegDetails)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>Fax</strong></td>
                                                        <td ng-bind-html="getFax(myLegDetails)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>Birthday</strong></td>
                                                        <td ng-bind="getBirthday(myLegDetails)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>Social Links</strong></td>
                                                        <td ng-bind-html="getSocialLinks(myLegDetails)"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <!-- bills and committees -->
                                            <h4>Committees</h4>
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Chamber</th>
                                                        <th>Committee ID</th>
                                                        <th class="hide-xs">Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="x in topComs">
                                                        <td>{{ x.chamber|capitalize }}</td>
                                                        <td>{{ x.committee_id }}</td>
                                                        <td class="hide-xs">{{ x.name }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                            <h4>Bills</h4>
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Bill ID</th>
                                                        <th class="hide-xs">Title</th>
                                                        <th class="hide-xs">Chamber</th>
                                                        <th class="hide-xs">Bill Type</th>
                                                        <th class="hide-xs">Congress</th>
                                                        <th>Link</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="x in topBills">
                                                        <td>{{ x.bill_id }}</td>
                                                        <td class="hide-xs">{{ x.official_title }}</td>
                                                        <td class="hide-xs">{{ x.chamber }}</td>
                                                        <td class="hide-xs">{{ x.bill_type }}</td>
                                                        <td class="hide-xs">{{ x.congress }}</td>
                                                        <td ><a target="_blank" ng-href="{{x.last_version.urls.pdf}}" target="_blank">Link</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bill Details Page -->
                        <!-- Starting with legislator details -->
                        <div class="panel panel-default" ng-if="showingBills">
                            <div class="panel-heading">
                                <button id="backBtn" class="btn btn-default" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </button>
                                <h3 class="inline">Details</h3>
                                <button class="btn btn-default " style="float:right; " ng-click="addFavorite('bill', thisBill.bill_id)">
                                    <i class="fa fa-star fa-1x ng-class:{iconEnabled:checkFavBill(thisBill.bill_id), iconDisabled:!checkFavBill(thisBill.bill_id)}" aria-hidden="true"></i>
                                </button>
                            </div>
                        
                           <div class="panel-body" ng-cloak>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- bill details -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Bill ID</strong></td>
                                                        <td>{{thisBill.bill_id | uppercase }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="hide-xs"><strong>Title</strong></td>
                                                        <td class="hide-xs" ng-bind="thisBill.official_title"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Bill Type</strong></td>
                                                        <td>{{thisBill.bill_type | uppercase }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Sponsor</strong></td>
                                                        <td ng-bind="getFullnameWithTitle(thisBill.sponsor)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Chamber</strong></td>
                                                        <td>{{thisBill.chamber | capFirst}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Status</strong></td>
                                                        <td ng-bind="getBillStatus(thisBill)"></td>
                                                    </tr>   
                                                    <tr>
                                                        <td><strong>Introduced On</strong></td>
                                                        <td ng-bind="thisBill.introduced_on"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Congress URL</strong></td>
                                                        <td ng-bind-html="getCongressUrl(thisBill)"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Version Status</strong></td>
                                                        <td ng-bind="thisBill.last_version.version_name"></td>
<!--                                                        <td>N.A.</td>-->
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Bill URL</strong></td>
                                                        <td ng-bind-html="getBillLink(thisBill)"></td>
<!--                                                        <td>N.A.</td>-->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="col-md-6" ng-bind-html="getBillPdf(thisBill)"></div>
                                    </div>
                                </div>
                            </div>
                        
                        
                        
                        
                        
                        
                    </div> <!-- END CAROUSEL ITEM 2: DETAIL VIEW -->
                </div> <!-- END DIV: listbox -->
            </div> <!-- END DIV: carousel -->

        </div> <!-- END PAGE WRAPPER > CONTAINER-FLUID -->
    </div> <!-- END PAGE WRAPPER -->
    </div>  <!-- END BODY WRAPPER -->


    
    

</body>
    
</html>
