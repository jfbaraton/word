'use strict';
angular.module('verb.tempus.widget',['word.field.widget'])
    .controller('verbTempusWidgetController', ['$scope','$http', function($scope,$http) {
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
    }])
    .directive('verbTempusWidget', function() {
        return {
            restrict: 'E',
            scope: {
                idbaseform: '@',
                declinationortempus: '@'
            },
            templateUrl: 'verb-tempus-widget.html',
            controller: 'verbTempusWidgetController'
        };
    })
;
