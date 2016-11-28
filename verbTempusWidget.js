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

        $scope.$on('verbTempus:newData', function (event, data) {
            console.log('verbTempus:newData start', data);
            data.forEach(function (row) {
                $scope.idbaseform = row.idBaseForm;
                if(row.declinationOrTempus == $scope.declinationortempus){
                    console.log('broadcasting to wordField:newData');
                    $scope.$broadcast('wordField:newData',row);
                }else{
                    //console.log('verbTempus:newData - rejected ',row.declinationOrTempus);
                }
            })
        });
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
