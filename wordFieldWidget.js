'use strict';
angular.module('word.field.widget',[])
    .controller('wordFieldWidgetController', ['$scope','$http', function($scope,$http) {
        $scope.insertdata = function(){
            console.log("insertdata");
            $http.post("insert.php", {'typedValue': $scope.name,'blabla': 'BBBBB' })//$scope.name
                .success(function(data, status, headers, config){
                    console.log("data saved");
                });
        };
        $scope.readdata = function(){
            console.log("readdata");
            $http.post("read.php", {'typedValue': $scope.name,'blabla': 'BBBBB' })//$scope.name
                .success(function(data, status, headers, config){
                    console.log("data read");
                    $scope.name = "OK";
                });
        };

        $scope.$on('wordField:newData', function (event, row) {
            if($scope.typed == "-" && $scope.correction == '-') {
                $scope.handleRowData(row);
            }
        });

        $scope.$on('verbTempus:newData', function (event, data) {
            if($scope.typed == "-" && $scope.correction == '-') {
                console.log('verbField:new tempus Data start', data);
                data.forEach(function (row) {
                    $scope.idbaseform = row.idBaseForm;
                    if (row.declinationOrTempus == $scope.declinationortempus) {
                        console.log('handling row data locally in wordField');
                        $scope.handleRowData(row);
                    } else {
                        //console.log('verbTempus:newData - rejected ',row.declinationOrTempus);
                    }
                })
            }
        });

        $scope.$on('wordField:reset', function (event) {
            $scope.typed = "-";
            $scope.correction = "-";
        });

        $scope.handleRowData = function(row){
            $scope.idbaseform = row.idBaseForm;
            if(row.declinationOrTempus == $scope.declinationortempus
                && row.personalProname == $scope.personal
                && row.plural == $scope.plural){
                if($scope.label == "-"){
                    if($scope.plural == "0"){
                        if(row.declinationOrTempus.includes("passive")){
                            $scope.label = "Passif";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " ei";
                            }
                        }else if(row.personalProname == 1){
                            $scope.label = "Minä";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " en";
                            }
                        }else if(row.personalProname == "2"){
                            $scope.label = "Sinä";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " et";
                            }
                        }else if(row.personalProname == "3"){
                            $scope.label = "Hän";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " ei";
                            }
                        }else{
                            $scope.label = "Singulier?";
                        }
                    }else if($scope.plural == "1"){
                        if(row.declinationOrTempus.includes("passive")){
                            $scope.label = "Passif";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " ei";
                            }
                        }else if(row.personalProname == "1"){
                            $scope.label = "Me";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " emme";
                            }
                        }else if(row.personalProname == "2"){
                            $scope.label = "Te";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " ette";
                            }
                        }else if(row.personalProname == "3"){
                            $scope.label = "He";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " eivät";
                            }
                        }else{
                            $scope.label = "Pluriel?";
                        }
                    }else {
                        if (row.declinationOrTempus.includes("passive")) {
                            $scope.label = "Passif";
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label += " ei";
                            }
                        } else {
                            if(row.declinationOrTempus.includes("negative")) {
                                $scope.label = " ei";
                            }else {
                                $scope.label = "###JEFF";
                            }
                        }
                    }
                }
                $scope.typed = row.finnish;//""
                $scope.correction = row.finnish;
            }else{
                console.log('verbField:',row.declinationOrTempus == $scope.declinationortempus);
                console.log('verbField:',row.personalProname == $scope.personal);
                console.log('verbField:',row.plural == $scope.plural);
                console.log('verbField:newData - rejected ',row.declinationOrTempus);
            }
        }

    }])
    .directive('wordFieldWidget', function() {
        return {
            restrict: 'E',
            scope: {
                idbaseform: '@',
                declinationortempus: '@',
                plural: '@',
                personal: '@',
                label: '@'
            },
            templateUrl: 'word-field-widget.html',
            controller: 'wordFieldWidgetController'
        };
    })
;
