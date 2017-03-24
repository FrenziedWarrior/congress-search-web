// JQuery Script
$(document).ready(function() {
    $("#tab-wrapper").children().css("display", "none");
    $(".tabLegislators").css("display", "block");
    
    function stateLegClicked() {
        $("label[for='inputField1']").html("Legislators By State");
        angular.element($('#page-wrapper')).scope().setActive("leg-st");
        angular.element($('#page-wrapper')).scope().setLegs("all");
        angular.element($('#page-wrapper')).scope().$apply();
    }
    
    function houseLegClicked() {
        $("label[for='inputField2']").html("Legislators By House");        
        angular.element($('#page-wrapper')).scope().setActive("leg-h");
        angular.element($('#page-wrapper')).scope().setLegs("house");
        angular.element($('#page-wrapper')).scope().selectedState="";
        angular.element($('#page-wrapper')).scope().$apply();
    }

    function senateLegClicked() {
        $("label[for='inputField2']").html("Legislators By Senate");
        angular.element($('#page-wrapper')).scope().setActive("leg-s");
        angular.element($('#page-wrapper')).scope().setLegs("senate");
        angular.element($('#page-wrapper')).scope().selectedState="";
        angular.element($('#page-wrapper')).scope().$apply();
    }
    
    function activeBillsClicked() {
        $("label[for='inputField2']").html("Active Bills");
        angular.element($('#page-wrapper')).scope().setBills("active");
        angular.element($('#page-wrapper')).scope().setActive("bill-a");
        angular.element($('#page-wrapper')).scope().$apply();

    }

    function newBillsClicked() {
        $("label[for='inputField2']").html("New Bills");
        angular.element($('#page-wrapper')).scope().setBills("new");
        angular.element($('#page-wrapper')).scope().setActive("bill-n");
        angular.element($('#page-wrapper')).scope().$apply();
    }
    
    function houseComClicked() {
        $("label[for='inputField2']").html("House");
        angular.element($('#page-wrapper')).scope().setComs("house");
        angular.element($('#page-wrapper')).scope().setActive("com-h");
        angular.element($('#page-wrapper')).scope().$apply();
    }

    function senateComClicked() {
        $("label[for='inputField2']").html("Senate");
        angular.element($('#page-wrapper')).scope().setComs("senate");
        angular.element($('#page-wrapper')).scope().setActive("com-s");
        angular.element($('#page-wrapper')).scope().$apply();
    }

    function jointComClicked() {
        $("label[for='inputField2']").html("Joint");
        angular.element($('#page-wrapper')).scope().setComs("joint");
        angular.element($('#page-wrapper')).scope().setActive("com-j");
        angular.element($('#page-wrapper')).scope().$apply();
    }
    
    function legFavClicked() {
        $("label[for='inputField2']").html("Favorite Legislators");
        angular.element($('#page-wrapper')).scope().setActive("fav-l");
        angular.element($('#page-wrapper')).scope().$apply();
    }
    
    function billFavClicked() {
        $("label[for='inputField2']").html("Favorite Bills");
        angular.element($('#page-wrapper')).scope().setActive("fav-b");
        angular.element($('#page-wrapper')).scope().$apply();
    }
    
    function comFavClicked() {
        $("label[for='inputField2']").html("Favorite Committees");
        angular.element($('#page-wrapper')).scope().setActive("fav-c");
        angular.element($('#page-wrapper')).scope().$apply();
    }
        
                
    $("#leg-state-tab").on("click", stateLegClicked);
    $("#leg-house-tab").on("click", houseLegClicked);
    $("#leg-senate-tab").on("click", senateLegClicked);
    $("#bill-active-tab").on("click", activeBillsClicked);
    $("#bill-new-tab").on("click", newBillsClicked);
    $("#com-house-tab").on("click", houseComClicked);
    $("#com-senate-tab").on("click", senateComClicked);
    $("#com-joint-tab").on("click", jointComClicked);
    $("#fav-leg-tab").on("click", legFavClicked);
    $("#fav-bill-tab").on("click", billFavClicked);
    $("#fav-com-tab").on("click", comFavClicked);

    
    // HANDLER: NAV-SIDEBAR DISPLAY TOGGLE
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#body-wrapper").toggleClass("toggled");
    });
    
    
    // NAVIGATION BAR CLICK HANDLER 
    $(".sidebar-nav li").click(function(e) {
        e.preventDefault();
        
        // CHANGE NAV-TABS ACTIVE COLOR
        $(this).parent().find('a').removeClass("navtabActive");
        $(this).children(0).addClass("navtabActive");
        
        // CHANGE PAGE TITLE
        var navText = $(this).attr('id').substr(3);
        $(".page-title").html(navText);
        
        // CHANGE PAGE TABS
        var activeTabClass = ".tab"+navText;
        $("#tab-wrapper").children().css("display", "none");
        $(activeTabClass).css("display", "block");
        
        // LEAVING DETAILS PAGE, if necessary
        if ($('#itemDetail').hasClass('active')) {
            $("#backBtn").click();            
        }

        // SETTING ACTIVE PAGE
        var pageCode = navText.substr(0,3).toLowerCase();
        angular.element($('#page-wrapper')).scope().activePage = pageCode;
        if(pageCode == 'leg') {
            angular.element($('#page-wrapper')).scope().getLegsByState();
            stateLegClicked();
            $(".tabLegislators").children("li").each(function() {
                if ($(this).hasClass("active")) {
                    $(this).toggleClass('active');
                }  
            });
            $("#leg-state-tab").toggleClass('active');   
        }
        else if(pageCode == 'bil') {
            angular.element($('#page-wrapper')).scope().fetchBills();
            activeBillsClicked();
            $(".tabBills").children("li").each(function() {
                if ($(this).hasClass("active")) {
                    $(this).toggleClass('active');
                }  
            });
            $("#bill-active-tab").toggleClass('active');
        }
        else if(pageCode == 'com') {         
            angular.element($('#page-wrapper')).scope().fetchCommittees();
            houseComClicked();
            $(".tabCommittees").children("li").each(function() {
                if ($(this).hasClass("active")) {
                    $(this).toggleClass('active');
                }  
            });
            $("#com-house-tab").toggleClass('active');   
            
            
        }
        else if(pageCode == 'fav') {                   
            angular.element($('#page-wrapper')).scope().initFavoriteLists();
            legFavClicked();
            $(".tabFavorites").children("li").each(function() {
                if ($(this).hasClass("active")) {
                    $(this).toggleClass('active');
                }  
            });
            
        }
        
        //Applyling after all changes are made
        angular.element($('#page-wrapper')).scope().$apply();

    });
    
    

});


// *******************************************************************************************************************************************************


// AngularJS Script

var myApp = angular.module('myApp', ['angularUtils.directives.dirPagination','ngSanitize', 'ngAnimate', 'ui.bootstrap']);

function capitalizeFirst(inputStr) {
    return (!!inputStr) ? inputStr.charAt(0).toUpperCase() + inputStr.substr(1).toLowerCase() : '';    
}

function sortByLastname(obj) {
    obj.sort( function (a,b) {
        if( a.last_name > b.last_name ) {
            return 1;
        }
        if( a.last_name < b.last_name ) {
            return -1;
        }
        return 0;
    });
}

function undefObj(obj) { return !obj; }


myApp.filter('capFirst', function() {
    return function(inputStr) {
        return (!!inputStr) ? inputStr.charAt(0).toUpperCase() + inputStr.substr(1).toLowerCase() : '';    
    }
});

myApp.filter('capitalize', function() {
    return function(input) {
        var stateWords = input.split(' ');
        var finalState = "";
        for (var i in stateWords) {
            finalState += capitalizeFirst(stateWords[i]) + " ";
        }
        return finalState;
    }
});

myApp.controller('dataFetch', ['$sce', '$scope', '$http', '$filter', function($sce, $scope, $http, $filter) {
    $scope.states = [
    { code: 'AL', state: 'ALABAMA'}, 
    { code: 'AK', state: 'ALASKA' },
    { code: 'AS', state: 'AMERICAN SAMOA' },
    { code: 'AZ', state: 'ARIZONA' },
    { code: 'AR', state: 'ARKANSAS' },
    { code: 'CA', state: 'CALIFORNIA' },
    { code: 'CO', state: 'COLORADO' },
    { code: 'CT', state: 'CONNECTICUT' },
    { code: 'DE', state: 'DELAWARE' },
    { code: 'DC', state: 'DISTRICT OF COLUMBIA' },
    { code: 'FL', state: 'FLORIDA' },
    { code: 'GA', state: 'GEORGIA' },
    { code: 'GU', state: 'GUAM' },    
    { code: 'HI', state: 'HAWAII'},
    { code: 'ID', state: 'IDAHO' },
    { code: 'IL', state: 'ILLINOIS' },
    { code: 'IN', state: 'INDIANA' },
    { code: 'IA', state: 'IOWA'},
    { code: 'KS', state: 'KANSAS' },
    { code: 'KY', state: 'KENTUCKY' },
    { code: 'LA', state: 'LOUISIANA' },
    { code: 'ME', state: 'MAINE'},
    { code: 'MD', state: 'MARYLAND' },
    { code: 'MA', state: 'MASSACHUSETTS' },
    { code: 'MI', state: 'MICHIGAN' },
    { code: 'MN', state: 'MINNESOTA' },
    { code: 'MS', state: 'MISSISSIPPI' },
    { code: 'MO', state: 'MISSOURI' },
    { code: 'MT', state: 'MONTANA' },
    { code: 'NE', state: 'NEBRASKA' },
    { code: 'NV', state: 'NEVADA'},
    { code: 'NH', state: 'NEW HAMPSHIRE' },
    { code: 'NJ', state: 'NEW JERSEY' },
    { code: 'NM', state: 'NEW MEXICO' },
    { code: 'NY', state: 'NEW YORK' },
    { code: 'NC', state: 'NORTH CAROLINA' },
    { code: 'ND', state: 'NORTH DAKOTA' },
    { code: 'MP', state: 'NORTHERN MARIANA ISLANDS' },
    { code: 'OH', state: 'OHIO'},
    { code: 'OK', state: 'OKLAHOMA' },
    { code: 'OR', state: 'OREGON'},
    { code: 'PA', state: 'PENNSYLVANIA' },
    { code: 'PR', state: 'PUERTO RICO' },
    { code: 'RI', state: 'RHODE ISLAND' },
    { code: 'SC', state: 'SOUTH CAROLINA' },
    { code: 'SD', state: 'SOUTH DAKOTA' },
    { code: 'TN', state: 'TENNESSEE' },
    { code: 'TX', state: 'TEXAS'},
    { code: 'VI', state: 'VIRGIN ISLANDS' },
    { code: 'UT', state: 'UTAH' },
    { code: 'VT', state: 'VERMONT' },
    { code: 'VA', state: 'VIRGINIA' },
    { code: 'WA', state: 'WASHINGTON' },
    { code: 'WV', state: 'WEST VIRGINIA' },
    { code: 'WI', state: 'WISCONSIN' },
    { code: 'WY', state: 'WYOMING' }
];
    
    $scope.setActive = function(argTab) { 
        $scope.activeTab = argTab; 
    }
    
    $scope.activeTabCheck = function(argTab) { 
        return ($scope.activeTab == argTab); 
    }
    

    $scope.getLegsByState = function() {
        $http.get('/data_fetch.php?method=leg&state=all').then(function receiveData(response) {            
            var all_legs = response.data.results;
            $scope.allLegs = all_legs;
            $scope.myLegislators = all_legs;

            // split list based on chamber
            $scope.houseLegs = [];
            $scope.senateLegs = [];
            for(var i=0; i<all_legs.length; ++i) {
                if (all_legs[i].chamber == 'house') {
                    $scope.houseLegs.push(all_legs[i]); 
                }
                else if (all_legs[i].chamber == 'senate') {
                    $scope.senateLegs.push(all_legs[i]); 
                }
            }

            sortByLastname($scope.houseLegs);
            sortByLastname($scope.senateLegs);                        
        });                    
}

    
    $scope.setLegs = function(key) {
        switch(key) {
            case 'house':
                $scope.myLegislators = $scope.houseLegs;
                break;
            case 'senate':
                $scope.myLegislators = $scope.senateLegs;
                break;
            case 'all':
                $scope.myLegislators = $scope.allLegs;
                break;
        }
    }

        
/*
    $scope.getLegsByHouse = function() {
        $http.get('/congress8.php?method=leg&chamber=house').then(function receiveData(response) {        
            $scope.myLegislators = response.data.results;
        });
    }
    
    $scope.getLegsBySenate = function() {
        $http.get('/congress8.php?method=leg&chamber=senate').then(function receiveData(response) {        
            $scope.myLegislators = response.data.results;
        });
    }
*/

    
    $scope.fetchLegDetails = function(key) {
        $scope.showingLegs = true;
        $scope.showingBills = false;
        $http.get('/data_fetch.php?method=leg&bid='+key).then(function receiveData(response) {        
            $scope.myLegDetails = JSON.parse(response.data[0]).results[0];
            $scope.topBills = JSON.parse(response.data[1]).results;
            $scope.topComs = JSON.parse(response.data[2]).results;
        });     
    }


    
    
    
    $scope.fetchBills = function() {
        $scope.showingBills = true;
        $scope.showingLegs = false;
        $http.get('/data_fetch.php?method=bill').then(function receiveData(response) {        
            $scope.myActiveBills = JSON.parse(response.data[0]).results;
            $scope.myNewBills = JSON.parse(response.data[1]).results;
            $scope.allBills = $scope.myActiveBills.concat($scope.myNewBills);
            $scope.setBills('active');
        });
    }
    
    $scope.setBills = function(arg) {
        $scope.myBills = (arg=='active') ? $scope.myActiveBills : $scope.myNewBills;            
    }
    
    
    $scope.fetchBillDetails = function(obj) {
        $scope.thisBill = obj;
    }
    
    
    
    
    
    
    
    $scope.fetchCommittees = function() {
        $http.get('/data_fetch.php?method=com').then(function receiveData(response) {
            var myComs = response.data.results;
            $scope.allComs = myComs;
            $scope.houseComs = [];
            $scope.senateComs = [];
            $scope.jointComs = [];
            for(var i=0; i<myComs.length; ++i) {
                if (myComs[i].chamber == 'house') {
                    $scope.houseComs.push(myComs[i]); 
                }
                else if (myComs[i].chamber == 'senate') {
                    $scope.senateComs.push(myComs[i]); 
                }
                else if (myComs[i].chamber == 'joint') {
                    $scope.jointComs.push(myComs[i]);                         
                }
            }                
            $scope.setComs('house');
        });   
    }
    
    $scope.setComs = function(key) {
        switch(key) {
            case 'house':   
                $scope.myComs = $scope.houseComs;
                break;
            case 'senate':   
                $scope.myComs = $scope.senateComs;
                break;
            case 'joint':   
                $scope.myComs = $scope.jointComs;
                break;
        }
    }

    
    
    
/*
    function filterFavorites(item) {
        return idList.indexOf(item.bioguide_id) != -1;
    }
*/
    
    function findLegislatorByID(bid) {
        for(var i=0; i<$scope.allLegs.length; i++) {   
            if (bid == $scope.allLegs[i].bioguide_id)
                return $scope.allLegs[i];
        }
    }
    
    function findBillByID(bid) {
        for(var i=0; i<$scope.allBills.length; i++) {   
            if (bid == $scope.allBills[i].bill_id)
                return $scope.allBills[i];
        }
    }
    
    function findCommByID(bid) {
        for(var i=0; i<$scope.allComs.length; i++) {   
            if (bid == $scope.allComs[i].committee_id)
                return $scope.allComs[i];
        }
    }
    
    $scope.initFavoriteLists = function() {
        try {
            $scope.favLegs = JSON.parse(localStorage["legs"]);
            $scope.favLegDetails = [];
            var idList = $scope.favLegs;
            for(var i=0; i<idList.length; i++) {
                $scope.favLegDetails.push(findLegislatorByID(idList[i]));
            }
        }
        catch (e) {
            $scope.favLegs = [];
        }
        
        try {
            $scope.favBill = JSON.parse(localStorage["bill"]);
            $scope.favBillDetails = [];
            var idList = $scope.favBill;
            for(var i=0; i<idList.length; i++) {
                $scope.favBillDetails.push(findBillByID(idList[i]));
            }
        }
        catch (e) {
            $scope.favBill = [];
        }
        
        try {
            $scope.favComm = JSON.parse(localStorage["comm"]);
            $scope.favCommDetails = [];
            var idList = $scope.favComm;
            for(var i=0; i<idList.length; i++) {
                $scope.favCommDetails.push(findCommByID(idList[i]));
            }
        }
        catch (e) {
            $scope.favComm = [];
        }
    }

        
    $scope.addFavorite = function(itemKey, itemID) {
        var favList;
        switch(itemKey) {
            case "legs": favList = $scope.favLegs; break;
            case "bill": favList = $scope.favBill; break;
            case "comm": favList = $scope.favComm; break;
        }

        if (favList.indexOf(itemID) == -1)  { // itemID does not exist in local storage
            favList.push(itemID);
            localStorage[itemKey] = JSON.stringify(favList);
            switch(itemKey) {
                case "legs": $scope.favLegs = favList; break;
                case "bill": $scope.favBill = favList; break;
                case "comm": $scope.favComm = favList; break;
            }

        }
        else {
            $scope.deleteFavorite(itemKey, itemID);
        }
    }
    
    
    var markedID;
    function filterID(item) {
        return item != markedID;
    }
    
    function filterLegsDetail(item) {
        return item.bioguide_id != markedID;
    }
    
    function filterBillDetail(item) {
        return item.bill_id != markedID;
    }
    
    function filterCommDetail(item) {
        return item.committee_id != markedID;
    }
    
    
    $scope.deleteFavorite = function(itemKey, itemID) {
        var favList, favDetails;
        var filteredList;
        
        markedID = itemID;
        switch(itemKey) {
            case "legs": {
                favList = $scope.favLegs;
                favDetails = $scope.favLegDetails;
                break;
            }
            case "bill": {
                favList = $scope.favBill; 
                favDetails = $scope.favBillDetails;
                break;
            }
            case "comm": {
                favList = $scope.favComm; 
                favDetails = $scope.favCommDetails;
                break;
            }
        }
        
        
        filteredList = favList.filter(filterID);
        localStorage[itemKey] = JSON.stringify(filteredList);

        switch(itemKey) {
            case "legs": { 
                $scope.favLegs = filteredList; 
                filteredList = favDetails.filter(filterLegsDetail);
                $scope.favLegDetails = filteredList;
                break;
            } 
            case "bill": {
                $scope.favBill = filteredList; 
                filteredList = favDetails.filter(filterBillDetail);
                $scope.favBillDetails = filteredList;
                break;
            }
            case "comm": {
                $scope.favComm = filteredList; 
                filteredList = favDetails.filter(filterCommDetail);
                $scope.favCommDetails = filteredList;
                break;
            }
        }
        
        filteredList = favDetails.filter(filterCommDetail);
    }


    $scope.checkFavLeg = function (bid) {
        if ($scope.favLegs.indexOf(bid) == -1) 
            return false;
        else 
            return true;
    }
    $scope.checkFavBill = function (bid) {
        if ($scope.favBill.indexOf(bid) == -1) 
            return false;
        else 
            return true;
    }
    $scope.checkFavComm = function (bid) {
        if ($scope.favComm.indexOf(bid) == -1) 
            return false;
        else 
            return true;
    }
    
/*
    
    $scope.setStateTabActive = function() { $scope.stateTabActive = true; }
    $scope.unsetStateTabActive = function() { $scope.stateTabActive = false; }
    $scope.checkStateTabActive = function() { return $scope.stateTabActive; }

    $scope.setHouseTabActive = function() {$scope.houseTabActive = true;}
    $scope.unsetHouseTabActive = function() {$scope.houseTabActive = false;}
    
    $scope.unsetSenateTabInactive = function() {$scope.senateTabInactive = false;}
    $scope.setSenateTabInactive = function() {$scope.senateTabInactive = true;}
    
*/
    
    
    // Legislator methods
    $scope.getFullname = function(d) {        
        if(!undefObj(d)) {
            return d.last_name + ", " + d.first_name;
        }
    }
    
    $scope.getFullnameWithTitle = function(d) {
        if(!undefObj(d)) {
            return d.title + ". " + d.last_name + ", " + d.first_name;
        }
    }
    
    
    $scope.getChamberSrc = function(d) {
        if(!undefObj(d)) {
            var url = "http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/";
            if(d.chamber == 'house') {
                url += "h.png";
            }
            else if (d.chamber == 'senate' || d.chamber == 'joint') {
                url += "s.svg";
            }

            var template1 = "<img class='ch-logo image-responsive' alt='chamber-logo' src=" + url + ">"
            var template2 = "<div class=label-chamber>" + capitalizeFirst(d.chamber) + "</div>"; 
            return $sce.trustAsHtml(template1 + template2);
        }
    }

    
    
    $scope.getChamberLabel = function(d) {
        if(!undefObj(d)) {
            return "Chamber: "+ capitalizeFirst(d.chamber); 
        }
    }

    
    $scope.getDistrict = function(d) {
        if(!undefObj(d)) {
            return d.district ? "District " + d.district : "N.A.";
        }
    }
    
    $scope.getPartyLogo = function(d) {
        if(!undefObj(d)) {
            var picFilename = d.party.toLowerCase() + ".png";
            var otherUrl = "http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/" + picFilename;
            var indPicUrl =  "http://independentamericanparty.org/wp-content/themes/v/images/logo-american-heritage-academy.png";
            var picUrl = (d.party == "I") ? indPicUrl : otherUrl;
            var template = "<img class='party-logo image-responsive' alt='Indep.' src='" + picUrl + "'>";
            return $sce.trustAsHtml(template);
        }
    }

    $scope.getPartySrc = function(d) {
        if(!undefObj(d)) {
            var picFilename = d.party.toLowerCase() + ".png";
            var otherUrl = "http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/" + picFilename;
            var indPicUrl =  "http://independentamericanparty.org/wp-content/themes/v/images/logo-american-heritage-academy.png";
            var picUrl = (d.party == "I") ? indPicUrl : otherUrl;
            var template = "<img class='party-logo image-responsive' alt='party_logo' src='" + picUrl + "'><span>";
            if (d.party == 'D') { template += 'Democrat'; }
            else if(d.party == 'R') { template += 'Republican'; }
            else if(d.party == 'I') { template += 'Independent'; }
            template += "</span>";
            return $sce.trustAsHtml(template);    
        }
    }

    
    
    $scope.getEmail = function(d) {
        if(!undefObj(d)) {
            var template = "<a href='mailto:" + d.oc_email + "'>" + d.oc_email +"</a>";
            return $sce.trustAsHtml(template);
        }
    }
    
    
    
    
    $scope.getPhone = function(d) {
        if(!undefObj(d)) {  
           return d.phone ? d.phone : "N.A.";
        }
    }
    
    
    $scope.getContact = function(d) {
        if(!undefObj(d)) {
            var template = "<a href='tel:+1-" + d.phone + "'>" + d.phone+ "</a>";
            template = "<span>Contact: </span>" + template;   
            return $sce.trustAsHtml(template);  
        }
    }
    

    $scope.getTermStart = function(d) {
        if(!undefObj(d)) {
            return $filter('date')(new Date(d.term_start), "MMM d, yyyy");
        }
    }

    $scope.getTermEnd = function(d) {
        if(!undefObj(d)) {
            return $filter('date')(new Date(d.term_end), "MMM d, yyyy");    
        }
    }

    $scope.getTermPerc = function(d) {
        if(!undefObj(d)) {
            var endDate = new Date(d.term_end);
            var startDate = new Date(d.term_start);
            var nowDate = new Date();
            return parseInt((nowDate - startDate)/(endDate - startDate)*100);
        }
    }
    
    $scope.getOffice = function(d) {
        if(!undefObj(d)) {
            return (!d.office) ? "N.A" : d.office;    
        }
    }
    $scope.getStatename = function(d) {
        if(!undefObj(d)) {
            return d.state_name;    
        }
    }
    $scope.getFax = function(d) {
        if(!undefObj(d)) {
            if(!d.fax) {
                return "N.A.";
            }
            var template = "<a href='fax:+1-" + d.fax + "'>" + d.fax+ "</a>";
            return $sce.trustAsHtml(template);
        }
    }

    $scope.getBirthday = function(d) {
        if(!undefObj(d)) {
            return $filter('date')(new Date(d.birthday), "MMM d, yyyy"); 
        }
    }
    $scope.getSocialLinks = function(d) {
        if(!undefObj(d)) {
            var fLink = "http://www.facebook.com/" + d.facebook_id;
            var tLink = "http://www.twitter.com/" + d.twitter_id;
            var wLink = d.website;
            var templateT = "<a href='"+tLink+"' target='_blank'><img class='social image-responsive' alt='linkto-Twitter' src='http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/t.png'></a>";
            var templateF = "<a href='"+fLink+"' target='_blank'><img class='social image-responsive' alt='linkto-Facebook' src='http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/f.png'></a>";
            var templateW = "<a href='"+wLink+"' target='_blank'><img class='social image-responsive' alt='linkto-Website' src='http://www-scf.usc.edu/~akarmaka/congress_QMpz/images/w.png'></a>";
            return $sce.trustAsHtml(templateT+ templateF + templateW); //         
        }
    }
    

    // Bill methods
    $scope.getBillStatus = function(d) {
        if(!undefObj(d)) {
            return (d.history.active == true) ? 'Active' : 'New';
        }
    }

    $scope.getCongressUrl = function(d) {
        if(!undefObj(d)) {
            var template = "<a target=_blank href='" + d.urls.congress + "'>URL</a>";
            return $sce.trustAsHtml(template);
        }
    }
    
    $scope.getBillLink= function(d) {
        if(!undefObj(d)) {
            var template = "<a target=_blank href='" + d.last_version.urls.pdf + "'>Link</a>";
            return $sce.trustAsHtml(template);
        }
    }
    
    $scope.getBillPdf= function(d) {
//        return "NA";
        if(!undefObj(d)) {
            var template = "<object width='100%' height='600' type='application/pdf' data='" + d.last_version.urls.pdf + "'></object>";
            return $sce.trustAsHtml(template);
        }
    }

    
    // intitializing homepage data
    $scope.activePage = 'leg';
    $scope.setActive('leg-st');
    $scope.getLegsByState(); // initialize myLegislators
    $scope.fetchBills(); // initialize myBills
    $scope.fetchCommittees(); // initialize myCommittees
    $scope.initFavoriteLists();
}]);
